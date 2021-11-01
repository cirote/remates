<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rematador extends Model
{
    protected $table = 'rematadores';

    protected $guarded = [];

    public static function byMatriculaOrCreate($atributtes)
    {
        if ($rematador = static::where('matricula', $atributtes['matricula'])->first())
        {
            return $rematador;
        }

        return static::create($atributtes);
    }

    public function getNombreCompletoAttribute()
    {
        return $this->apellido . ', ' . $this->nombre;
    }
}
