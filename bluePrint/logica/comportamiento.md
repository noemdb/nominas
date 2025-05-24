### 📌 Sección: COMPORTAMIENTO LABORAL

Esta sección evalúa y registra distintos aspectos del comportamiento del trabajador que afectan directamente el cálculo de su salario quincenal. Incluye los siguientes elementos clave:

#### 1. **ASISTENCIA**

-   Indica si el trabajador asistió los días laborales correspondientes a la quincena.
-   Puede estar expresado en número de días u otra codificación (por ejemplo, 0 para faltas).

#### 2. **FALTAS**

-   Registra los días que el trabajador no asistió sin justificación válida.
-   Impacta directamente el salario y puede implicar descuentos.

#### 3. **PERMISOS**

-   Registra los días que el trabajador se ausentó con autorización.
-   Aunque no siempre se descuentan del sueldo, sí se consideran para evaluaciones internas.

#### 4. **RETARDOS**

-   Número de veces que el trabajador llegó tarde.
-   Puede afectar bonificaciones o generar sanciones.

#### 5. **OBSERVACIONES**

-   Campo libre o codificado donde se anotan notas adicionales sobre el comportamiento del trabajador.
-   Ejemplos: “Actitud Positiva”, “Problemas de puntualidad”, etc.

#### 6. **BONIFICACIÓN O DESCUENTO**

-   Puede derivarse de la evaluación anterior.
-   Positivo (bono por conducta o productividad) o negativo (por faltas o retardos reiterados).

---

### 🔧 Aplicación Web: Lógica a Implementar

Para trasladar esta sección a una aplicación web, la lógica sería:

1. **Formulario para Registro de Comportamiento:**

    - Campos: Asistencia, Faltas, Permisos, Retardos, Observaciones.
    - Validación: Por ejemplo, si hay más de 3 retardos, sugerir sanción.

2. **Cálculo Automático de Bonos/Descuentos:**

    - Fórmulas que se apliquen automáticamente según el comportamiento registrado.
    - Ejemplo:

        ```
        if faltas > 0:
            descuento = sueldo_diario * faltas
        elif retardos > 3:
            descuento = 0.5 * sueldo_diario
        else:
            bonificacion = 100
        ```

3. **Visualización Histórica:**

    - Mostrar al trabajador o administrador el historial de comportamiento laboral.
    - Filtros por mes, tipo de evento, etc.

4. **Integración con Nómina Final:**

    - Bonos o descuentos calculados se integran al total a pagar al trabajador.
