<form class="px-4 py-2">
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="tipoAusencia">Tipo de Ausencia:</label>
      <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="tipoAusencia">
        <option value="">Selecciona una opción</option>
        <option value="vacaciones">Vacaciones</option>
        <option value="permiso">Permiso</option>
      </select>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="fechaInicio">Fecha de Inicio:</label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fechaInicio" type="date">
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="fechaFin">Fecha de Fin:</label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fechaFin" type="date">
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="motivo">Motivo:</label>
      <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="motivo" rows="3"></textarea>
    </div>
    <div class="flex items-center justify-end">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
        Registrar
      </button>
    </div>
  </form>
