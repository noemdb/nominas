<form class="mx-auto">
    <div class="mb-6">
        <label class="block text-gray-700 font-bold mb-2" for="fecha">Fecha</label>
        <input
            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="fecha" type="date" placeholder="Seleccionar fecha">
    </div>
    <div class="mb-6">
        <label class="block text-gray-700 font-bold mb-2" for="horas">Horas</label>
        <input
            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="horas" type="number" step="0.5" placeholder="Ingresar horas">
    </div>
    <div class="mb-6">
        <label class="block text-gray-700 font-bold mb-2" for="descripcion">Descripción</label>
        <textarea
            class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="descripcion" rows="3" placeholder="Ingresar descripción"></textarea>
    </div>
    <div class="flex items-center">
        <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            type="submit">
            Registrar horas extras
        </button>
    </div>
</form>
