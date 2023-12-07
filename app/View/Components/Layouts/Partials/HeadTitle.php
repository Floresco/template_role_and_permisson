<?php

namespace App\View\Components\Layouts\Partials;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeadTitle extends Component
{
    public function __construct(
        public string $title
    ){}

    public function render(): View
    {
        return view('components.layouts.partials.head-title');
    }
}
