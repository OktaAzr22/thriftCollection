<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmptyMessage extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $message;
    public $buttonText;
    public $buttonUrl;

    public function __construct($title = null, $message = null, $buttonText = null, $buttonUrl = null)
    {
        $this->title = $title ?? 'No items found';
        $this->message = $message ?? "This brand doesn't have any products yet.";
        $this->buttonText = $buttonText ?? 'Back';
        $this->buttonUrl = $buttonUrl ?? url()->previous();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.empty-message');
    }

    

}
