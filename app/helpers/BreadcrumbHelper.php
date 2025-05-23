<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('autoBreadcrumb')) {
    function autoBreadcrumb(): array
    {
        $name = Route::currentRouteName(); // contoh: kategori.create
        if (!$name) return [];

        $segments = explode('.', $name); // ['kategori', 'create']
        $result = [];

        if (count($segments) > 0) {
            $label = ucfirst(str_replace('_', ' ', $segments[0]));
            $url = route($segments[0] . '.index');
            $result[] = ['label' => $label, 'url' => $url];
        }

        if (count($segments) > 1) {
            $action = match ($segments[1]) {
                'create' => 'Tambah',
                'edit' => 'Edit',
                'show' => 'Detail',
                default => ucfirst(str_replace('_', ' ', $segments[1]))
            };
            $result[] = ['label' => $action];
        }

        return $result;
    }
}
