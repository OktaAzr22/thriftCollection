<div class="flex items-center justify-center min-h-[70vh]">
    <div class="w-full max-w-md p-10 text-center ">
        <div class="flex items-center justify-center w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full">
            <i class="text-3xl text-gray-400 fas fa-box-open"></i>
        </div>
        <h3 class="mb-2 text-xl font-semibold text-gray-800">{{ $title }}</h3>
        <p class="mb-6 text-sm text-gray-500">{{ $message }}</p>
        <a href="{{ $buttonUrl }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition bg-blue-600 rounded-md hover:bg-blue-700">
            {{ $buttonText }}
        </a>
    </div>
</div>
