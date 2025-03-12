<?php

namespace App\Actions\Remates;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use GuzzleHttp;
use GuzzleHttp\Client;
use DiDom\Document;
use App\Models\Lugar;
use App\Models\Rematador;
use App\Models\Remate;

class ImportarRemates
{
    const URL_BASE = 'https://impo.com.uy/remates';

    public static function do()
    {
        return (new static())->execute();
    }

    public function execute()
    {
        $this->agregar_remates(
            $this->leer_url(static::URL_BASE)->find('.item_info')
        );
    }

    private function agregar_remates($remates)
    {
        foreach ($remates as $remate)
        {
            if ($datos = $this->to_array($remate))
            {
                $remate = $this->get_remate($datos);

                // dd($rematador);
            }
        }
    }

    private function get_lugares($remate): Lugar
    {
        return Lugar::firstOrCreate([
            'nombre' => $remate['lugar']
        ]);
    }

    private function get_rematador($remate): Rematador
    {
        $nombre = $apellido = '';

        foreach(explode(' ', $remate['rematador']) as $nombre_original)
        {
            if ($nombre_original == Str::upper($nombre_original))
            {
                $apellido .= ' ' . $nombre_original;
            }

            else 
            {
                $nombre .= ' ' . $nombre_original;
            }
        }

        return Rematador::byMatriculaOrCreate([
            'matricula' => (int) $remate['matricula'],
            'apellido'  => trim($apellido),
            'nombre'    => trim($nombre)
        ]);
    }

    private function get_remate($remate): Remate
    {
        $rematador = $this->get_rematador($remate);

        $lugar = $this->get_lugares($remate);

        return Remate::byAvisoOrCreate([
            'aviso'             => $remate['aviso'],
            'remate_fecha'      => $remate['fecha'],
            'remate_hora'       => $remate['hora'],
            'publicacion_fecha' => $remate['publicacion'],
            'publicacion_url'   => $remate['url'],
            'bien'              => $remate['bien'],
            'condiciones'       => $remate['condiciones'],
            'lugar_id'          => $lugar->id,
            'localidad_id'      => null,
            'rematador_id'      => $rematador->id,
        ]);
    }

    private function to_array($remate)
    {
        if (! $fechaStrong = $remate->find('.rfecha strong'))
        {
            return null;
        }

        $infoRow = $remate->find('.cinfo');

        $bien = trim(str_replace('Bien a rematar - ', '', $infoRow[0]->text()));

        if (! Str::contains($bien, 'Bien inmueble'))
        {
            if (! Str::contains($bien, 'Bienes inmuebles'))
            {
                return null;
            }
        }

        $datos_rematador = explode(' y ', trim(str_replace('Rematador - ', '', $infoRow[2]->text())))[0];

        $datos_rematador = str_replace([' mat. N ', ',mat. N '], [', mat. N ', ', mat. N '], $datos_rematador);

        $datos_rematador = str_replace(',,', ',', $datos_rematador);

        $datos_rematador = explode(', ', trim(str_replace('Rematador - ', '', $datos_rematador)));

        if (count($datos_rematador) != 2)
        {
            $rematador = $datos_rematador[0];

            if (isset($datos_rematador[1])) 
            {
                $matricula = substr(trim(str_replace('mat. N ', '', $datos_rematador[1])), 0, strpos($datos_rematador[1], ' '));
            } 
            
            else 
            {
                $matricula = null; 
            }
        }

        else
        {
            list($rematador, $matricula) = $datos_rematador;
        }

        $fechaRow = $remate->find('.cfecha');

        list($publicacion, $aviso) = explode(', ', trim(str_replace('Publicado en el Diario Oficial el da ', '', $fechaRow[0]->text())));

        $url = $remate->find('.cfecha a');

        return [
            'fecha'       => Carbon::createFromFormat('d/m/Y', $fechaStrong[0]->text()),
            'hora'        => $fechaStrong[1]->text(),
            'lugar'       => $fechaStrong[2]->text(),
            'bien'        => $bien,
            'condiciones' => trim(str_replace('Condiciones - ', '', $infoRow[1]->text())),
            'rematador'   => trim(str_replace('  ', ' ', $rematador)),
            'matricula'   => trim(str_replace('mat. N ', '', $matricula)),
            'publicacion' => Carbon::createFromFormat('d/m/Y', $publicacion),
            'aviso'       => trim(str_replace('ver el aviso ', '', str_replace(' completo.', '', $aviso))),
            'url'         => $url[0]->attr('href')
        ];
    }

    private function leer_url($url)
    {
        return new Document(
            file_get_contents($url)
        );
    }
}