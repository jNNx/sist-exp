<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Area extends Model
{
    use HasFactory;

    //Relacion uno a muchos polimorfica
    public function historiales()
    {
        return $this->hasMany('App\Models\Historial');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function expedientes()
    {
        return $this->morphMany('App\Models\Expediente', 'area_actual');
    }

    public static function all_areas(){
        $arrray_areas = collect([]);
        $areas = Area::all();
        foreach ($areas as $area) {
            $arrray_areas->push(['idd' => $area->id.'.'.$area->descripcion,
                                 'id' => $area->id,
                                 'nombre' => $area->descripcion]);
        }
        
        return $arrray_areas;
    }
}
