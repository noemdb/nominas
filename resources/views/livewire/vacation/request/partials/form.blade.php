<form class="p-8 bg-white rounded-lg shadow-lg">

    <div class="mb-6">
      <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
      <input type="text" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
    </div>

    <div class="mb-6">
      <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Correo electrónico</label>
      <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

      <div class="mb-6">
        <label for="dias" class="block mb-2 text-sm font-medium text-gray-900">Días de vacaciones</label>
        <input type="number" id="dias" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
      </div>

      <div class="mb-6">
        <label for="fecha_inicio" class="block mb-2 text-sm font-medium text-gray-900">Fecha de inicio</label>
        <input type="date" id="fecha_inicio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
      </div>

    </div>

    <div class="mb-6">
      <label for="motivo" class="block mb-2 text-sm font-medium text-gray-900">Motivo</label>
      <textarea id="motivo" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required></textarea>
    </div>


    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
      Enviar solicitud
    </button>

  </form>
