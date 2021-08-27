<?php

namespace App\Http\Livewire;

use App\Models\Rematador;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class RematadorTable extends LivewireDatatable
{
    public $model = Rematador::class;

    public function columns()
    {
        //
    }
}