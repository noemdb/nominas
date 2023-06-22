<form class="mx-auto mt-8">
    <div class="mb-6">
      <label class="block mb-2 font-bold text-gray-700" for="name">
        Nombre completo
      </label>
      <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        id="name"
        type="text"
        placeholder="Ingrese su nombre completo"
      >
    </div>
    <div class="mb-6">
      <label class="block mb-2 font-bold text-gray-700" for="document-type">
        Tipo de documento
      </label>
      <select
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        id="document-type"
      >
        <option value="">Seleccione un tipo de documento</option>
        <option value="dni">DNI</option>
        <option value="passport">Pasaporte</option>
        <option value="other">Otro</option>
      </select>
    </div>
    <div class="mb-6">
      <label class="block mb-2 font-bold text-gray-700" for="document-number">
        Número de documento
      </label>
      <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        id="document-number"
        type="text"
        placeholder="Ingrese su número de documento"
      >
    </div>
    <div class="mb-6">
      <label class="block mb-2 font-bold text-gray-700" for="document-image">
        Imagen del documento
      </label>
      <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        id="document-image"
        type="file"
      >
    </div>
    <div class="mb-6">
      <label class="block mb-2 font-bold text-gray-700" for="expiration-date">
        Fecha de vencimiento
      </label>
      <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        id="expiration-date"
        type="date"
        placeholder="Ingrese la fecha de vencimiento"
      >
    </div>
    <div class="flex items-center justify-between">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
        Registrar
      </button>
    </div>
  </form>
