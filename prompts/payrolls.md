Requiero una nueva funcionalidad

**1.1. Fase 1: Apertura de Nómina (Tabla `payrolls`)**

**Objetivo:** Registrar un nuevo período de nómina.

**Tabla Requerida (definir migración y modelo):**

-   **`payrolls`**:
    -   `id` (PK)
    -   `name` (string, ej: "Nómina Quincena 1 - Enero 2025")
    -   `date_start` (date)
    -   `date_end` (date)
    -   `num_days` (integer, calculado automáticamente)
    -   `description` (text, nullable)
    -   `observations` (text, nullable)
    -   `status_exchange` (boolean, default false)
    -   `status_active` (boolean, default true)
    -   `status_public` (boolean, default false)
    -   `status_approved` (boolean, default false)
    -   `created_at`, `updated_at` (timestamps)

**Componente Livewire:** Un componente (`IndexPayroll`) que permita al administrador abrir una nueva nómina, ingresando el nombre, fechas de inicio y fin, y una descripción.

**Sigue la siguiente secuencia de pasos:**

1. genera la migracion correspondiente payrolls
2. genera la migracion correspondiente Payroll
3. Genera la route correspondinte: en routes/web.php en Sección: Setup Routes sigue el patron de Route::resource('discounts', DiscountController::class);
4. genera el controller PayrollController siguiendo el patron en app/Http/Controllers/Setup/DiscountController.php
5. genera el component livewire (app/Livewire/Setup/IndexPayroll.php) siguiedo la logica y patron de diseno en app/Livewire/Setup/IndexDiscount.php
6. genera la view correspondiente siguiedo la logica y patron de diseno en resources/views/setup/index-discount.blade.php
7. ajusta la view correspondiente del component livewire siguiedo la logica y patron de diseno en resources/views/livewire/setup/index-discount.blade.php
8. genera la view correspondiente en resources/views/livewire/setup/partials/payroll-header.blade.php siguiedo la logica y patron de diseno en resources/views/livewire/setup/partials/header.blade.php
9. genera la view correspondiente en resources/views/livewire/setup/partials/payroll-search.blade.php siguiedo la logica y patron de diseno en resources/views/livewire/setup/partials/search.blade.php
10. genera la view correspondiente en resources/views/livewire/setup/partials/payroll-table.blade.php siguiedo la logica y patron de diseno en resources/views/livewire/setup/partials/table.blade.php
11. genera la view correspondiente en resources/views/livewire/setup/partials/payroll-modal.blade.php siguiedo la logica y patron de diseno en resources/views/livewire/setup/partials/modal.blade.php
