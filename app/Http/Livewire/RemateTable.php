<?php

namespace App\Http\Livewire;

use App\Models\Remate;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class RemateTable extends LivewireDatatable
{
    public $model = Remate::class;

    public function builder()
    {
        return Remate::query()->leftJoin('lugares', 'lugares.id', 'remates.lugar_id')->where('descartado', false);
    }
    
    public function columns()
    {
        return [
            DateColumn::name('remate_fecha')->defaultSort('asc'),

            DateColumn::name('publicacion_fecha'),

            DateColumn::name('created_at')->label('fecha de creación'),

            Column::name('bien')->label('bien a rematar')->searchable(),

            Column::name('condiciones')->label('condiciones del remate')->searchable(),

            BooleanColumn::name('interesante'),

            Column::name('lugares.nombre')->label('lugar'),

            // BooleanColumn::name('descartado'),

            Column::callback(['id', 'bien'], function ($id, $bien) 
                {
                    return view('table-actions', ['id' => $id, 'nombre' => $bien]);
                }
            )->unsortable()
        ];
    }

    public function getLugarProperty()
    {
        return Lugar::all();
    }
}