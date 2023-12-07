<?php

namespace App\View\Components\Layouts\Partials;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    public function render(): View
    {
        return view('components.layouts.partials.navbar');
    }
}
