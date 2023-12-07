<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class Layout extends Component
{
    public function __construct(
        public string $title,
    ){}

    public function render()
    {
        return view('components.layouts.layout');
    }
}
