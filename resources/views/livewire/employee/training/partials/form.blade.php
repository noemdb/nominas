<form class="mx-auto mt-8">
    <div class="mb-6">
        <label class="block mb-2 font-bold text-gray-700" for="name">
            Nombre completo
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="name" type="text" placeholder="Ingrese su nombre completo">
    </div>
    <div class="mb-6">
        <label class="block mb-2 font-bold text-gray-700" for="birthdate">
            Fecha de nacimiento
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="birthdate" type="date" placeholder="Ingrese su fecha de nacimiento">
    </div>
    <div class="mb-6">
        <label class="block mb-2 font-bold text-gray-700" for="gender">
            Género
        </label>
        <div class="relative">
            <select
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="gender">
                <option value="">Seleccione su género</option>
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
                <option value="otro">Otro</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path
                        d="M9.293 13.707a1 1 0 0 1-1.414 0l-3-3a1 1 0 0 1 1.414-1.414L8 11.586l2.293-2.293a1 1 0 0 1 1.414 1.414l-3 3z" />
                </svg>
            </div>
        </div>
    </div>
    <div class="mb-6">
        <label class="block mb-2 font-bold text-gray-700" for="address">
            Dirección
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="address" type="text" placeholder="Ingrese su dirección">
    </div>
    <div class="mb-6">
        <label class="block mb-2 font-bold text-gray-700" for="phone">
            Teléfono
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="phone" type="tel" placeholder="Ingrese su número de teléfono">
    </div>
    <div class="flex items-center justify-between">
        <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            type="button">
            Registrar
        </button>
    </div>
</form>
