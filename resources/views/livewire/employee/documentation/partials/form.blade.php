<form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="nombre">
            Nombre del empleado
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="nombre" type="text" placeholder="Ingrese el nombre del empleado">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="tipo-documento">
            Tipo de documento
        </label>
        <select
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="tipo-documento">
            <option>Seleccione el tipo de documento</option>
            <option>Documento 1</option>
            <option>Documento 2</option>
            <option>Documento 3</option>
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="fecha-vencimiento">
            Fecha de vencimiento
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="fecha-vencimiento" type="date">
    </div>
    <div class="flex items-center justify-between">
        <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            type="button">
            Guardar
        </button>
    </div>
</form>
