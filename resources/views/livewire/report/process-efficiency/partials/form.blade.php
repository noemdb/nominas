<form class="px-4 py-2">
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="nombreProceso">Nombre del Proceso:</label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombreProceso" type="text" placeholder="Nombre del Proceso">
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="eficiencia">Eficiencia del Proceso (%):</label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="eficiencia" type="number" min="0" max="100" step="any" placeholder="Eficiencia del Proceso">
    </div>
    <div class="flex items-center justify-end">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
        Registrar Eficiencia
      </button>
    </div>
  </form>
