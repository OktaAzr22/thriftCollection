@props(['name', 'label' => null, 'type' => 'text', 'required' => false])

<div class="mb-4">
    @if($label)
    <label for="{{ $name }}" class="block mb-1 font-semibold">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
           {{ $attributes->merge([
               'class' => 'w-full p-2 border rounded focus:outline-none focus:ring focus:border-blue-300'
           ]) }}
           @if($required) required @endif>
</div>
