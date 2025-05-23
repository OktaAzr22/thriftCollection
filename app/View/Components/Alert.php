<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $message = null,   // pesan (default ambil dari session)
        public string $color  = 'blue',   // blue | green | red | dll
        public int    $duration = 3000    // ms, lama tampil + progress bar
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
