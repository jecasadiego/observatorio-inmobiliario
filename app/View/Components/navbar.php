<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Entidad;

class navbar extends Component
{
    public $entidad;

    public function __construct()
    {
        $this->entidad = Entidad::first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar', ['entidad' => $this->entidad]);
    }
}
