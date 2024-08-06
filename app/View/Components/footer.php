<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Entidad;


class Footer extends Component
{
    public $entidad;

    public function __construct()
    {
        $this->entidad = Entidad::first();
    }

    public function render(): View|Closure|string
    {
        return view('components.footer', ['entidad' => $this->entidad]);
    }
}