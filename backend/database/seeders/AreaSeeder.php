<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{

    Private $arrayAreas = array (
        array('descripcion' => 'SECRETARIA GENERAL TECNICA'),
        array('descripcion' => 'SECRETARIA GENERAL ADMINISTRATIVA'),
        //array('descripcion' => 'ASESORIA LETRADA'),
        array('descripcion' => 'ASESORIA LEGAL'),
        array('descripcion' => 'DIRECCIÓN DE PERSONAL'),
        array('descripcion' => 'DIRECCIÓN DE ADMINISTRACIÓN'),
        array('descripcion' => 'DIRECCIÓN DE REGISTRACIONES'),
        array('descripcion' => 'VOCALIA A'),
        array('descripcion' => 'VOCALIA B'),
        array('descripcion' => 'VOCALIA C'),
        array('descripcion' => 'VOCALIA D')
    );

    Private $arraySubAreas = array (
        array('descripcion' => 'DEPARTAMENTO FALLOS'),
        array('descripcion' => 'ARCHIVO'),
        //array('descripcion' => 'PROSECRETARIA'),
        //array('descripcion' => 'MAYORDOMIA'),
        array('descripcion' => 'DPTO. MESA DE ENTRADAS Y SALIDAS'),
        array('descripcion' => 'DPTO. NOTIFICACIONES'),
        array('descripcion' => 'DIRECCIÓN DE INFORMATICA'),
        //array('descripcion' => 'Dpto. TESORERIA'),
        //array('descripcion' => 'Dpto. CONTABLE'),
        array('descripcion' => 'RELATORIA A'),
        array('descripcion' => 'RELATORIA B'),
        array('descripcion' => 'RELATORIA C'),
        array('descripcion' => 'RELATORIA D'),
        //array('descripcion' => 'FISCALIZADORES'),
        array('descripcion' => 'AUDITORIA A'),
        array('descripcion' => 'AUDITORIA B'),
        array('descripcion' => 'AUDITORIA C'),
        array('descripcion' => 'AUDITORIA D'),
        array('descripcion' => 'PRESIDENCIA'),
        array('descripcion' => 'MAESTRANZA'),
        array('descripcion' => 'UNIDAD EXTERNA')
        //array('descripcion' => 'EQUIPO CTA DE INVERSIÓN')
        //último sin coma
        );

    public function run()
    {
        //DB::table('areas')->delete();
        foreach ($this->arrayAreas as $a)
        {
            $area = new Area();
            $area->descripcion = $a['descripcion'];
            $area->save();
        }

        foreach ($this->arraySubAreas as $s_a)
        {
            $sub_area = new Area();
            $sub_area->descripcion = $s_a['descripcion'];
            $sub_area->save();
        }
    }

}
