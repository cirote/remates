<?php

namespace App\Http\Livewire\Remates;

use Livewire\Component;
use App\Models\Remate;

class Show extends Component
{
    public function render()
    {
        $remates = Remate::where('descartado', false)->where('remate_fecha', '>=', date('Y-m-d'))->get();

        return view('livewire.remates.show')->with('remates', $remates);
    }

    public function descartar(Remate $remate)
    {
        $remate->descartado = true;

        $remate->save();
    }

    public function interesar(Remate $remate)
    {
        $remate->interesante = true;

        $remate->save();
    }
}
