<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">
                <i class="fas fa-tags mr-2"></i>Manajemen Kategori
            </h1>
        </div>

        <!-- Notification Area -->
        <div id="notification-container" class="fixed top-5 right-5 z-50 space-y-3"></div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Form Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-blue-600 px-6 py-4 text-white">
                    <h2 class="text-lg font-semibold">
                        <i class="fas {{ isset($kategori) ? 'fa-edit' : 'fa-plus' }} mr-2"></i>
                        {{ isset($kategori) ? 'Edit Kategori' : 'Tambah Kategori Baru' }}
                    </h2>
                </div>
                <div class="p-6">
                    <form method="POST" 
                        action="{{ isset($kategori) ? route('kategori.update', $kategori->id) : route('kategori.store') }}">
                        @csrf
                        @if(isset($kategori))
                            @method('PUT')
                        @endif

                        <div class="mb-4">
                            <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">
                                Nama Kategori
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-tag text-gray-400"></i>
                                </div>
                                <input type="text" id="nama" name="nama"
                                    class="pl-10 w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500
                                    @error('nama') border-red-500 @enderror"
                                    placeholder="Masukkan nama kategori"
                                    value="{{ isset($kategori) ? $kategori->nama : old('nama') }}">
                            </div>
                            @error('nama')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-3">
                            @if(isset($kategori))
                                <a href="{{ route('kategori.index') }}" 
                                   class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                                    <i class="fas fa-times mr-1"></i> Batal
                                </a>
                            @endif
                            <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                <i class="fas {{ isset($kategori) ? 'fa-save' : 'fa-plus' }} mr-1"></i>
                                {{ isset($kategori) ? 'Update' : 'Simpan' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Table Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-blue-600 px-6 py-4 text-white">
                    <h2 class="text-lg font-semibold">
                        <i class="fas fa-list-ul mr-2"></i>Daftar Kategori
                    </h2>
                </div>
                <div class="p-6">
                    @if($kategoris->isEmpty())
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-info-circle text-blue-500"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        Tidak ada data kategori
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kategori</th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($kategoris as $index => $item)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->nama }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                <div class="flex justify-center space-x-2">
                                                    <a href="{{ route('kategori.index', ['kategori' => $item->id]) }}" 
                                                       class="text-yellow-600 hover:text-yellow-900"
                                                       title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" 
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to show notification
        function showNotification(type, message) {
            const container = document.getElementById('notification-container');
            const id = Date.now();
            
            let icon, bgColor, borderColor;
            if (type === 'success') {
                icon = 'fa-check-circle';
                bgColor = 'bg-green-100';
                borderColor = 'border-l-green-500';
            } else {
                icon = 'fa-exclamation-circle';
                bgColor = 'bg-red-100';
                borderColor = 'border-l-red-500';
            }
            
            const notification = document.createElement('div');
            notification.id = `notification-${id}`;
            notification.className = `w-full max-w-xs p-4 border-l-4 ${borderColor} ${bgColor} rounded-lg shadow-lg transform transition-all duration-500 ease-in-out`;
            notification.innerHTML = `
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i class="fas ${icon} ${type === 'success' ? 'text-green-500' : 'text-red-500'}"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium ${type === 'success' ? 'text-green-800' : 'text-red-800'}">
                            ${message}
                        </p>
                    </div>
                    <button onclick="closeNotification('notification-${id}')" class="ml-auto -mx-1.5 -my-1.5 p-1.5 rounded-lg inline-flex items-center justify-center h-8 w-8 ${type === 'success' ? 'text-green-500 hover:bg-green-200' : 'text-red-500 hover:bg-red-200'} focus:outline-none">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            
            container.appendChild(notification);
            
            // Auto close after 4 seconds
            setTimeout(() => {
                closeNotification(`notification-${id}`);
            }, 4000);
        }
        
        function closeNotification(id) {
            const notification = document.getElementById(id);
            if (notification) {
                notification.style.opacity = '0';
                setTimeout(() => {
                    notification.remove();
                }, 500);
            }
        }
        
        // Check for session messages
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                showNotification('success', '{{ session('success') }}');
            @endif
            
            @if($errors->any())
                @foreach($errors->all() as $error)
                    showNotification('error', '{{ $error }}');
                @endforeach
            @endif
        });
    </script>
</body>
</html>