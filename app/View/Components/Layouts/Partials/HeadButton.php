<?php

namespace App\View\Components\Layouts\Partials;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeadButton extends Component
{
    public function __construct(
        public string  $text,
        public ?string $url = null,
        public ?string $icon = null,
        public ?string $color = null,
        public ?string $idm = null,
        public bool    $modal = false,
        public ?array  $gateway = null
    )
    {
    }

    public function render(): View
    {
        if ($this->modal && $this->idm) {
            $this->url = '#';
        }
        return view('components.layouts.partials.head-button');
    }
}
