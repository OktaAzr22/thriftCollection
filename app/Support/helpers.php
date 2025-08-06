<?php

use Illuminate\Support\Str;

if (!function_exists('smartTruncate')) {
    function smartTruncate($text, $charLimit = 10)
{
    if (Str::length($text) <= $charLimit) return $text;

    // ambil sampai karakter limit tapi potong di spasi paling akhir
    $short = Str::substr($text, 0, $charLimit + 1); // tambah +1 biar spasi aman
    $lastSpace = strrpos($short, ' ');

    if ($lastSpace === false) {
        return Str::substr($text, 0, $charLimit) . '...';
    }

    return trim(Str::substr($short, 0, $lastSpace)) . ' ...';
}

}
