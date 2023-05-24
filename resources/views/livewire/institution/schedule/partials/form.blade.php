<form class="mx-2 p-6 bg-white rounded">
    <h2 class="text-2xl font-bold mb-6">Registro de horario laboral</h2>

    <!-- Día -->
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="dia">
            Día
        </label>
        <select
            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="dia">
            <option>Lunes</option>
            <option>Martes</option>
            <option>Miércoles</option>
            <option>Jueves</option>
            <option>Viernes</option>
            <option>Sábado</option>
            <option>Domingo</option>
        </select>
    </div>

    <!-- Hora de entrada -->
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="entrada">
            Hora de entrada
        </label>
        <input
            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="entrada" type="time">
    </div>

    <!-- Hora de salida -->
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="salida">
            Hora de salida
        </label>
        <input
            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="salida" type="time">
    </div>

    <!-- Horas trabajadas -->
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="horas">
            Horas trabajadas
        </label>
        <input
            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="horas" type="number" placeholder="Ingrese las horas trabajadas">
    </div>

    <!-- Botón de envío -->
    <div class="flex items-center justify-center">
        <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            type="submit">
            Registrar
        </button>
    </div>
</form>
