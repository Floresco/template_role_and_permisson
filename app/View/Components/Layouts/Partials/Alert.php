<?php

namespace App\View\Components\Layouts\Partials;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class Alert extends Component
{
    public function __construct(
        public ?string $message = null,
        public ?string $title = '',
        public ?string $type = 'primary',
        public bool $dismiss = false,
    )
    {
    }

    public function render(): View
    {
        if (Session::has('alerts')) {
            $data = Session::get('alerts');
            $this->message = $data['message'] ?? null;
            $this->title = $data['title'] ?? '';
            $this->type = $data['type'] ?? 'primary';
            $this->dismiss = $data['dismiss'] ?? false;
        }
        return view('components.layouts.partials.alert');
    }
}
