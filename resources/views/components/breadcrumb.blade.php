@props(['items' => []])

<nav class="flex text-sm text-gray-700 mb-4" aria-label="Breadcrumb">
  <ol class="inline-flex items-center space-x-1 md:space-x-3">

    {{-- Home --}}
    <li class="inline-flex items-center">
      <a href="{{ url('/') }}" class="inline-flex items-center text-gray-500 hover:text-blue-600">
        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 20V14H14V20H19V12H16L10 5.5L4 12H1V20H6V14H10V20Z"/>
        </svg>
        Home
      </a>
    </li>

    {{-- Items --}}
    @foreach ($items as $item)
      <li>
        <div class="flex items-center">
          <svg class="w-4 h-4 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M7.05 4.05L12.95 10L7.05 15.95L8.464 17.364L15.828 10L8.464 2.636L7.05 4.05Z" />
          </svg>

          @if (isset($item['url']))
            <a href="{{ $item['url'] }}" class="ml-1 text-gray-500 hover:text-blue-600">
              {{ $item['label'] }}
            </a>
          @else
            <span class="ml-1 text-gray-400">{{ $item['label'] }}</span>
          @endif
        </div>
      </li>
    @endforeach

  </ol>
</nav>
