<form class="px-4 py-2">
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">Nombre del Empleado:</label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" type="text" placeholder="Nombre del Empleado">
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="salario">Salario Mensual:</label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="salario" type="number" min="0" step="any" placeholder="Salario Mensual">
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="diasTrabajados">Días Trabajados:</label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="diasTrabajados" type="number" min="0" step="any" placeholder="Días Trabajados">
    </div>
    <div class="flex items-center justify-end">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
        Calcular Nómina
      </button>
    </div>
  </form>
