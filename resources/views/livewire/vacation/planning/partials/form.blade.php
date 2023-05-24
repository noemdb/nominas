<form class="w-full">
    <div class="mb-4">
      <label class="block text-gray-700 font-bold mb-2" for="empleado">
        Empleado
      </label>
      <select class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="empleado">
        <option>Selecciona un empleado</option>
        <option>Juan Pérez</option>
        <option>María González</option>
        <option>Pedro Rodríguez</option>
      </select>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 font-bold mb-2" for="fecha_inicio">
        Fecha de inicio
      </label>
      <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fecha_inicio" type="date">
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 font-bold mb-2" for="fecha_fin">
        Fechade fin
      </label>
      <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fecha_fin" type="date">
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 font-bold mb-2" for="dias_solicitados">
        Días solicitados
      </label>
      <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="dias_solicitados" type="number" min="1" max="30">
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 font-bold mb-2" for="estado">
        Estado
      </label>
      <select class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="estado">
        <option>Aprobado</option>
        <option>Pendiente</option>
        <option>Rechazado</option>
      </select>
    </div>
    <div class="flex items-center justify-between">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
        Guardar
      </button>
    </div>
  </form>
