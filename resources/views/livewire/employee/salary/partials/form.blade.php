<form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="nombre">
            Nombre
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="nombre" type="text" placeholder="Nombre">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="apellido">
            Apellido
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="apellido" type="text" placeholder="Apellido">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="salario">
            Salario
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="salario" type="number" min="0" step="0.01" placeholder="Salario">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="fecha">
            Fecha
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="fecha" type="date">
    </div>
    <div class="flex items-center justify-between">
        <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            type="button">
            Registrar
        </button>
    </div>
</form>
