<form action="{{ route('kode.cek') }}" method="POST" class="max-w-md mx-auto mt-10">
    @csrf
    <label class="block text-gray-700">Masukkan Kode:</label>
    <input type="text" name="kode" class="border p-2 w-full mt-2" required>
    <button type="submit" class="mt-3 bg-blue-600 text-white px-4 py-2 rounded">Masuk</button>

    @if(session('error'))
        <p class="text-red-500 mt-2">{{ session('error') }}</p>
    @endif
</form>
