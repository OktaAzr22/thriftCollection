@extends('layouts.app')

@section('content')
<x-alert />
    @include('brands.partials.form')
    <div class="flex flex-col flex-1 p-4 overflow-hidden bg-white rounded-lg shadow-xl/30 dark:bg-gray-900">
        <div class="flex flex-col items-start justify-between gap-4 mb-4 sm:flex-row sm:items-center">
            <h2 class="text-xl font-semibold ">List Brand</h2>
            <form action="{{ route('brands.index') }}" method="GET" class="relative w-full sm:w-auto">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama brand..."
                        class="w-full px-4 py-2 text-sm placeholder-gray-400 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:border-gray-600 dark:bg-gray-700 sm:w-64" />
                    @if(request('search'))
                    <button type="button" onclick="this.form.search.value='';this.form.submit()"
                        class="absolute text-xl -translate-y-1/2 right-3 top-1/2 hover:text-red-500 focus:outline-none dark:hover:text-red-400">
                        &times;
                    </button>
                    @endif
                </div>
            </form>
        </div>
        @include('brands.partials.table')
    </div>
@endsection