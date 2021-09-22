<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use App\Models\Remate;

class RemateTable extends LivewireDatatable
{
    public $model = Remate::class;

    public function builder()
    {
        return Remate::query()
            ->leftJoin('lugares', 'lugares.id', 'remates.lugar_id')
            ->leftJoin('rematadores', 'rematadores.id', 'remates.rematador_id')
            ->where('descartado', false)
            ->where('remate_fecha', '>=',date('Y-m-d') );
    }
    
    public function columns()
    {
        return [
            Column::callback(['remate_fecha', 'remate_hora'], function ($remate_fecha, $remate_hora) 
                {
                    return Carbon::parse($remate_fecha)->format('d/m/Y') . ' ' . substr($remate_hora, 0, 5);
                }
            )->label('fecha remate')->defaultSort('asc'),
            
            DateColumn::name('publicacion_fecha'),

            DateColumn::name('created_at')->label('fecha de creación'),

            Column::name('bien')->label('bien a rematar')->searchable(),

            Column::name('condiciones')->label('condiciones del remate')->searchable(),

            BooleanColumn::name('interesante')->label('ok'),

            Column::name('lugares.nombre')->label('lugar'),

            Column::name('rematadores.apellido')->label('rematador')
        ];
    }

    public function getLugarProperty()
    {
        return Lugar::all();
    }
}