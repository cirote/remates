<?php

namespace App\Http\Livewire;

use App\Models\Lugar;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;

class LugarTable extends LivewireDatatable
{
    public $model = Lugar::class;

    public function columns()
    {
        return [
            Column::name('nombre')->label('Lugar del remate')
        ];
    }
}