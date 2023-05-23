<form class="mx-auto">
    <div class="mb-4">
        <label for="fecha" class="block text-gray-700 font-bold mb-2">Fecha</label>
        <input type="date" name="fecha" id="fecha"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
        <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre del Empleado</label>
        <input type="text" name="nombre" id="nombre"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
        <label for="salario" class="block text-gray-700 font-bold mb-2">Salario Base</label>
        <input type="number" name="salario" id="salario"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
        <label for="bonos" class="block text-gray-700 font-bold mb-2">Bonos</label>
        <input type="number" name="bonos" id="bonos"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
        <label for="deducciones" class="block text-gray-700 font-bold mb-2">Deducciones</label>
        <input type="number" name="deducciones" id="deducciones"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
        <label for="total" class="block text-gray-700 font-bold mb-2">Total</label>
        <input type="number" name="total" id="total"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            readonly>
    </div>
    <div>
        <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            type="submit">
            Enviar
        </button>
    </div>
</form>
