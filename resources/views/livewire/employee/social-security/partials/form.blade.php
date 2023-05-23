<div class="mx-auto mt-8">
    <form class="space-y-6" action="#" method="POST">
        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700">
                Nombre completo
            </label>
            <div class="mt-1">
                <input type="text" name="nombre" id="nombre" autocomplete="given-name"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            </div>
        </div>
        <div>
            <label for="tipo_documento" class="block text-sm font-medium text-gray-700">
                Tipo de documento
            </label>
            <div class="mt-1">
                <select id="tipo_documento" name="tipo_documento" autocomplete="tipo_documento"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    <option value="cedula">Cédula</option>
                    <option value="dni">DNI</option>
                    <option value="pasaporte">Pasaporte</option>
                    <option value="cedula">Cédula</option>
                    <option value="dni">DNI</option>
                    <option value="pasaporte">Pasaporte</option>
                    <option value="otro">Otro</option>
                </select>
            </div>
        </div>
        <div>
            <label for="numero_documento" class="block text-sm font-medium text-gray-700">
                Número de documento
            </label>
            <div class="mt-1">
                <input type="text" name="numero_documento" id="numero_documento" autocomplete="numero_documento"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            </div>
        </div>
        <div>
            <label for="eps" class="block text-sm font-medium text-gray-700">
                EPS
            </label>
            <div class="mt-1">
                <input type="text" name="eps" id="eps" autocomplete="eps"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            </div>
        </div>
        <div>
            <label for="afp" class="block text-sm font-medium text-gray-700">
                AFP
            </label>
            <div class="mt-1">
                <input type="text" name="afp" id="afp" autocomplete="afp"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            </div>
        </div>
        <div>
            <label for="arl" class="block text-sm font-medium text-gray-700">
                ARL
            </label>
            <div class="mt-1">
                <input type="text" name="arl" id="arl" autocomplete="arl"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            </div>
        </div>
        <div class="pt-5">
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">
                    Registrar
                </button>
            </div>
        </div>
    </form>
</div>
