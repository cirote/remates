<?php

namespace App\Http\Livewire;

use App\Models\Lugar;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class LugarTable extends LivewireDatatable
{
    public $model = Lugar::class;

    public $beforeTableSlot = 'componenetes';

    public function columns()
    {
        return [
            NumberColumn::name('id')->filterable(),

            Column::name('nombre')->label('Lugar del remate')->searchable()->editable(),

            Column::callback(['id', 'nombre'], function ($id, $nombre) 
            {
                return view('table-actions', ['id' => $id, 'nombre' => $nombre]);
            })->unsortable()
        ];
    }
}