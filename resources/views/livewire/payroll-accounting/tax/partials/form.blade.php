<form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="nombre">
            Nombre de la bonificación
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="nombre" type="text" placeholder="Ingrese el nombre de la bonificación">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="descripcion">
            Descripción
        </label>
        <textarea
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="descripcion" placeholder="Ingrese una descripción de la bonificación"></textarea>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="monto">
            Monto
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="monto" type="number" placeholder="Ingrese el monto de la bonificación">
    </div>
    <div class="flex items-center justify-between">
        <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            type="button">
            Registrar
        </button>
    </div>
</form>
