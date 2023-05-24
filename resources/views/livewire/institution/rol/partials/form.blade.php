<form class="mx-2 p-6 bg-white rounded">


    <!-- Nombre del rol -->
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="nombre">
            Nombre del rol
        </label>
        <input
            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="nombre" type="text" placeholder="Ingrese el nombre del rol">
    </div>

    <!-- Descripción del rol -->
    <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="descripcion">
            Descripción del rol
        </label>
        <textarea
            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="descripcion" placeholder="Ingrese la descripción del rol"></textarea>
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
