<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $table = 'servicio';
    protected $primaryKey = 'id_servicio';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['costo', 'descripcion_servicio', 'estado'];
    public $timestamps = false;
}
