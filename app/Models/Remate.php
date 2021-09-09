<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remate extends Model
{
    protected $table = 'remates';

    protected $guarded = [];

    public static function byAvisoOrCreate($atributtes)
    {
        if ($remate = static::where('aviso', $atributtes['aviso'])->first())
        {
            return $remate;
        }

        return static::create($atributtes);
    }

    public function lugar($query)
    {
        return $this->hasOne(Lugar::class);
    }
}
