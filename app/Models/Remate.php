<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remate extends Model
{
    protected $table = 'remates';

    protected $guarded = [];

    protected $dates = ['remate_fecha', 'publicacion_fecha', 'created_at'];

    public static function byAvisoOrCreate($atributtes)
    {
        if ($remate = static::where('aviso', $atributtes['aviso'])->first())
        {
            return $remate;
        }

        return static::create($atributtes);
    }

    public function lugar()
    {
        return $this->belongsTo(Lugar::class);
    }

    public function rematador()
    {
        return $this->belongsTo(Rematador::class);
    }
}
