<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente'; // Nombre de la tabla
    protected $primaryKey = 'id_cliente'; // Clave primaria personalizada
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['nombre', 'direccion', 'telefono'];
    public $timestamps = false;

    // Relación con Venta
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'fk_id_cliente', 'id_cliente'); // Relación con la tabla venta
    }
}