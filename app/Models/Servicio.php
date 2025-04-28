<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicio'; // Nombre de la tabla
    protected $primaryKey = 'id_servicio'; // Clave primaria personalizada
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['descripcion_servicio', 'costo', 'estado'];
    public $timestamps = false;
}
