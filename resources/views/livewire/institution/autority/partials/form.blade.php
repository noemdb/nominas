<div class="mb-3">
    <form class="p-8 bg-white rounded-lg shadow-lg">
        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre completo:</label>
            <input type="text" id="nombre" name="nombre"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                required>
        </div>
        <div class="mb-4">
            <label for="cedula" class="block text-gray-700 font-bold mb-2">Cédula de identidad:</label>
            <input type="text" id="cedula" name="cedula"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                required>
        </div>
        <div class="mb-4">
            <label for="cargo" class="block text-gray-700 font-bold mb-2">Cargo:</label>
            <input type="text" id="cargo" name="cargo"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                required>
        </div>
        <div class="mb-4">
            <label for="telefono" class="block text-gray-700 font-bold mb-2">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Correo electrónico:</label>
            <input type="email" id="email" name="email"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                required>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Guardar</button>
            <button type="reset"
                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancelar</button>
        </div>
    </form>
</div>
