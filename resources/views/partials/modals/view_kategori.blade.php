<div id="modal-DataKategori" class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-300 opacity-0 pointer-events-none bg-black/50">
   <div class="relative w-full max-w-xl max-h-[90vh] p-6 transition-all duration-300 transform scale-95 bg-white rounded-xl shadow-lg overflow-y-auto">
      <button onclick="closeModal('DataKategori')" class="absolute text-xl text-gray-400 hover:text-gray-600 top-4 right-5">✕</button>
      
      <h2 class="mb-5 text-xl font-semibold text-center text-gray-800">Daftar Kategori</h2>
 <!-- Form Edit -->
      <form id="form-edit-kategori" method="POST" class="hidden pt-4 mt-6 space-y-4 border-t">
         @csrf
         @method('PUT')
         <input type="hidden" name="id" id="edit-id">
         <div>
            <label for="edit-nama" class="block text-sm font-medium text-gray-700">Edit Nama Kategori</label>
            <input type="text" id="edit-nama" name="nama"
               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
               required>
         </div>
         <div class="flex justify-end gap-2">
            <button type="button" onclick="hideEditForm()" class="px-4 py-2 text-sm text-gray-700 bg-gray-200 rounded hover:bg-gray-300">Batal</button>
            <button type="submit" class="px-4 py-2 text-sm text-white bg-green-600 rounded hover:bg-green-700">Simpan</button>
         </div>
      </form>
      <!-- Tabel Kategori -->
      <div class="overflow-x-auto">
         <table class="w-full text-sm text-left border-t border-gray-200">
            <thead class="text-gray-600 bg-gray-50">
               <tr>
                  <th class="w-3/5 px-4 py-2">Nama</th>
                  <th class="w-2/5 px-4 py-2 text-center">Aksi</th>
               </tr>
            </thead>
            <tbody class="text-gray-700">
               @foreach ($kategoris as $kategori)
               <tr class="border-t hover:bg-gray-50">
                  <td class="px-4 py-2">{{ $kategori->nama }}</td>
                  <td class="px-4 py-2 space-x-1 text-center">
                     <button
                        onclick="showEditForm({{ $kategori->id }}, '{{ $kategori->nama }}')"
                        class="inline-flex items-center px-3 py-1 text-xs font-medium text-white bg-yellow-500 rounded hover:bg-yellow-600">
                        <i class="mr-1 fas fa-edit"></i>Edit
                     </button>
                     <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="inline-block form-delete" data-jenis="kategori">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-3 py-1 text-xs font-medium text-white bg-red-500 rounded hover:bg-red-600">
                           <i class="mr-1 fas fa-trash"></i>Hapus
                        </button>
                     </form>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>

     
   </div>
</div>

<script>
   const baseKategoriUpdate = "{{ url('/kategori') }}";

  

   function showEditForm(id, nama) {
      const form = document.getElementById('form-edit-kategori');
      form.classList.remove('hidden');
      document.getElementById('edit-id').value = id;
      document.getElementById('edit-nama').value = nama;
      form.action = `${baseKategoriUpdate}/${id}`;
   }

   function hideEditForm() {
      const form = document.getElementById('form-edit-kategori');
      form.classList.add('hidden');
      form.action = '';
      document.getElementById('edit-id').value = '';
      document.getElementById('edit-nama').value = '';
   }
</script>


