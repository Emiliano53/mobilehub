<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Accesorio extends Model
{
    use HasFactory;

    protected $table = 'accesorios'; // Nombre de la tabla
    protected $primaryKey = 'id_accesorios'; // Clave primaria personalizada
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['nombre', 'tipo', 'marca', 'precio', 'existencia', 'estado'];
    public $timestamps = false;

    public static function addUniqueConstraint()
    {
        Schema::table('accesorios', function (Blueprint $table) {
            $table->unique(['nombre', 'tipo', 'marca']);
        });
    }
}
