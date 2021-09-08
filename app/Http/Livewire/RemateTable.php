<?php

namespace App\Http\Livewire;

use App\Models\Remate;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class RemateTable extends LivewireDatatable
{
    public $model = Remate::class;

    public function columns()
    {
        return [
            DateColumn::name('remate_fecha'),

            DateColumn::name('publicacion_fecha'),

            Column::name('bien')->label('bien a rematar')->searchable(),

            Column::name('condiciones')->label('condiciones del remate')->searchable(),

            Column::callback(['id', 'bien'], function ($id, $bien) 
            {
                return view('table-actions', ['id' => $id, 'nombre' => $bien]);
            })->unsortable()
        ];
    }
}