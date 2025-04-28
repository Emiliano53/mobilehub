<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accesorio extends Model
{
    use HasFactory;
    protected $table = 'accesorios';
    protected $primaryKey = 'id_accesorios';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['existencia', 'nombre', 'precio', 'tipo', 'marca'];
    public $timestamps = false;
}
