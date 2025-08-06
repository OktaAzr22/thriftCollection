<!-- Overlay -->
<div id="drawer-overlay" class="fixed inset-0 z-40 hidden bg-black bg-opacity-40" onclick="closeDrawer()"></div>
<div id="drawer" class="fixed inset-0 z-50 flex justify-start pl-6 transition-opacity duration-300 bg-black opacity-0 pointer-events-none bg-opacity-40" onclick="closeDrawer()">
  <div class="bg-white w-full max-w-xl h-[90vh] my-auto rounded-lg shadow-2xl transform -translate-x-full transition-transform duration-300 flex flex-col" onclick="event.stopPropagation()">
    <div class="sticky top-0 z-10 flex items-center justify-between p-4 bg-white border-b rounded-t-lg">
      <h2 class="text-lg font-semibold">Detail Produk</h2>
      <button onclick="closeDrawer()" class="text-gray-600 hover:text-black">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="flex-1 p-4 space-y-3 overflow-hidden text-sm text-gray-700">
      <div class="flex flex-col gap-4 p-4 rounded-lg sm:flex-row bg-gray-50">
        <div class="flex items-center justify-center w-full sm:w-1/3">
          <img id="drawerImage" src="" alt="Image"
            class="object-contain w-full p-2 bg-white border rounded-lg shadow-sm max-h-48" />
        </div>
        <div class="flex flex-col justify-between w-full space-y-3 text-sm text-gray-700 sm:w-2/3">
          <div>
            <p id="drawerName" class="text-lg font-semibold text-gray-900"></p>
            <p id="drawerBrand" class="text-sm italic text-gray-500"></p>
          </div>
          <p>
            <span class="font-medium text-gray-500">Tanggal:</span>
            <span id="drawerDate" class="ml-2 text-gray-800"></span>
          </p>
          <div class="grid grid-cols-2 gap-4">
            <div>
              <p class="text-gray-500">Harga:</p>
              <p id="drawerPrice" class="text-base font-semibold text-green-600"></p>
            </div>
            <div>
              <p class="text-gray-500">Ongkir:</p>
              <p id="drawerShipping" class="text-base font-semibold text-blue-600"></p>
            </div>
          </div>
          <div class="flex justify-between pt-2 mt-2 text-base font-bold text-red-600 border-t">
            <span>Total</span>
            <span id="drawerTotal"></span>
          </div>
          <div class="grid grid-cols-1 gap-3 mt-3 text-sm sm:grid-cols-3">
            <div class="p-2 bg-white rounded shadow-sm">
              <span class="text-gray-500">Kategori:</span><br>
              <span id="drawerCategory" class="font-medium text-gray-800"></span>
            </div>
            <div class="p-2 bg-white rounded shadow-sm">
              <span class="text-gray-500">Toko:</span><br>
              <span id="drawerStore" class="font-medium text-gray-800"></span>
            </div>
            <div class="p-2 bg-white rounded shadow-sm">
              <span class="text-gray-500">Asal:</span><br>
              <span id="drawerAsal" class="font-medium text-gray-800"></span>
            </div>
          </div>
        </div>
      </div>
      <div class="px-6 py-4 mt-2 border-t">
        <h3 class="mb-2 text-sm font-semibold text-gray-600 uppercase">Deskripsi</h3>
        <div class="pr-1 overflow-y-auto max-h-40">
          <p id="drawerDesc" class="text-gray-700 whitespace-pre-line"></p>
        </div>
      </div>
    </div>
  </div>
</div>