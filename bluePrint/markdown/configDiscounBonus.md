Como asistente de código especializado en programación e ingeniería de software, tu tarea es generar todo el código y la lógica necesaria para implementar un sistema de cálculo de nómina completo y robusto (Requisito Principal, Fase de Configuración) en Laravel 10, utilizando Livewire para el frontend y Tailwind CSS para el estilo. El objetivo es sistematizar el cálculo de la nómina para una planilla de trabajadores, dado un rango de fechas, basándose en un análisis detallado de comportamiento, cálculos de salario, deducciones, bonificaciones y el monto total.

**Contexto y Requerimientos Generales:**

Stack Tecnológico:
-. Framework: Laravel 10
-. Frontend: Livewire 3.6 + Tailwind CSS 3.4
-. wireui/wireui 2.4
-. Base de datos: MySQL/PostgreSQL
-. Patrones: Repository, Service Layer, Strategy Pattern

El sistema debe manejar la configuración de descuentos, deducciones y bonificaciones, el registro de comportamiento de los trabajadores, y el cálculo de la nómina en fases bien definidas. La base de datos ya cuenta con las siguientes tablas y sus estructuras: `users`, `institutions`, `areas`, `rols`, `workers`, `positions`, y `worker_behaviors`.

**Objetivo:** Desarrollar una seccion de configuracion de nómina que permita:

1.  **Configuración Flexible:** Registrar y gestionar descuentos, deducciones y bonificaciones con reglas de aplicabilidad detalladas (a nivel de institución, trabajador, rol, área o posición).

**Detalle de las Fases y Requerimientos Específicos:**

### 1. Fase de Configuración (Tablas `discounts`, `deductions`, `bonuses`)

**Objetivo:** Crear un seccion para registrar y gestionar descuentos, deducciones y bonificaciones que la institución puede aplicar sobre el salario de un trabajador.

**Tablas Requeridas (definir migraciones y modelos):**

-   **`discounts`**:

    -   `id` (PK)
    -   `name` (string)
    -   `description` (text)
    -   `institution_id` (FK a `institutions.id`, nullable)
    -   `area_id` (FK a `areas.id`, nullable)
    -   `rol_id` (FK a `rols.id`, nullable)
    -   `position_id` (FK a `positions.id`, nullable)
    -   `worker_id` (FK a `workers.id`, nullable)
    -   `type` (enum: 'fijo', 'variable')
    -   `amount` (decimal, 10, 2, nullable, para tipo 'fijo')
    -   `percentage` (decimal, 5, 2, nullable, para tipo 'variable', representa % de 0 a 100)
    -   `name_function` (string, nullable, para tipo 'variable', nombre de la función que calcula el monto)
    -   `created_at`, `updated_at` (timestamps)

-   **`deductions`**: (Misma estructura que `discounts`, adaptar `name_function` si es necesario)

    -   `id` (PK)
    -   `name` (string)
    -   `description` (text)
    -   `institution_id` (FK a `institutions.id`, nullable)
    -   `area_id` (FK a `areas.id`, nullable)
    -   `rol_id` (FK a `rols.id`, nullable)
    -   `position_id` (FK a `positions.id`, nullable)
    -   `worker_id` (FK a `workers.id`, nullable)
    -   `type` (enum: 'fijo', 'variable')
    -   `amount` (decimal, 10, 2, nullable)
    -   `percentage` (decimal, 5, 2, nullable)
    -   `name_function` (string, nullable)
    -   `created_at`, `updated_at` (timestamps)

-   **`bonuses`**: (Misma estructura que `discounts`, adaptar `name_function` si es necesario)
    -   `id` (PK)
    -   `name` (string)
    -   `description` (text)
    -   `institution_id` (FK a `institutions.id`, nullable)
    -   `area_id` (FK a `areas.id`, nullable)
    -   `rol_id` (FK a `rols.id`, nullable)
    -   `position_id` (FK a `positions.id`, nullable)
    -   `worker_id` (FK a `workers.id`, nullable)
    -   `type` (enum: 'fijo', 'variable')
    -   `amount` (decimal, 10, 2, nullable)
    -   `percentage` (decimal, 5, 2, nullable)
    -   `name_function` (string, nullable)
    -   `created_at`, `updated_at` (timestamps)

**Reglas de Aplicabilidad y Validación:**

-   **`ApplicabilityService`**: Crea un servicio (`app/Services/ApplicabilityService.php`) con un método `validateApplicability($data)` que asegure que solo uno de los campos de relación (`institution_id`, `area_id`, `rol_id`, `position_id`, `worker_id`) esté presente para cada registro de descuento, deducción o bonificación. Si institution_id está presente, se considera "general" plaicable a todos los workers activos. Este servicio debe ser inyectable y reutilizable.

-   **Formularios Livewire:** Implementa componentes Livewire (`IndexDiscount`,`CreateEditDiscount`, `IndexDeduction`, `CreateEditDeduction`, `IndexBonus`, `CreateEditBonus`) para la gestión CRUD de estos registros. Utiliza: component modulares y reusables, validación de Laravel en los componentes Livewire y el `ApplicabilityService`. Considera que esta logica debe estar en folders llama Setup, en app y en resuources respectivamente.

-   **Routes y Controller:** Crea las routes y controllers necesarios bajos el namespace Setup

**Consideraciones Adicionales y Directrices para la Implementación:**

-   **Modelos Eloquent:** Genera todos los modelos Eloquent necesarios con sus relaciones (`hasMany`, `belongsTo`, etc.) y mutadores/accesores si son útiles.
-   **Validación de Datos:** Implementa validación robusta en todos los formularios Livewire y controladores para asegurar la integridad de los datos.
-   **Manejo de Errores:** Incluye mecanismos de manejo de errores claros y mensajes informativos para el usuario.
-   **Internacionalización (i18n):** Prepara la base para futuras traducciones.
-   **Pruebas (Opcional pero Recomendado):** Considera escribir pruebas unitarias para los servicios de cálculo y las reglas de aplicabilidad, y pruebas de características para los componentes Livewire.
-   **Estructura de Carpetas:** Organiza el código de manera lógica dentro de `app/Http/Livewire`, `app/Models`, `app/Services`, etc.
-   **Notificaciones:** Al finalizar el procesamiento de una nómina, considera un sistema de notificación (flash messages con Livewire o notificaciones de Laravel).
-   **UI/UX (Livewire/Tailwind):** Los componentes Livewire deben tener una interfaz de usuario clara y funcional, estilizada con Tailwind CSS. Considera la reactividad de Livewire para mejorar la experiencia del usuario al registrar comportamientos o configurar elementos.

**Flujo de Trabajo Sugerido para el Asistente:**

1.  **Migraciones y Modelos:** Genera las migraciones y modelos para las nuevas tablas (`discounts`, `deductions`, `bonuses`).
2.  **Servicio de Aplicabilidad:** Crea `ApplicabilityService.php`.
3.  **Componentes Livewire de Configuración:** Genera los componentes CRUD para `discounts`, `deductions`, `bonuses`, incluyendo las vistas y la lógica de validación.
4.  **Rutas:** Define las rutas necesarias en `web.php` para acceder a los componentes Livewire.

Procede paso a paso, enfocándote en una sección a la vez. No dudes en solicitar aclaraciones o asistencia en cada etapa.
