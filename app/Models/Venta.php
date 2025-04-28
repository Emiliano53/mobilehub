<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'venta'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['fk_id_cliente', 'fecha', 'total', 'descripcion', 'estado'];
    public $timestamps = false;

    // Relación con Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'fk_id_cliente', 'id_cliente'); // Clave foránea y primaria correctas
    }

    // Relación con Accesorios (tabla pivote)
    public function accesorios()
    {
        return $this->belongsToMany(
            Accesorio::class,
            'detalle_venta_accesorio', // Nombre de la tabla pivote
            'fk_id_venta', // Clave foránea en la tabla pivote que apunta a Venta
            'fk_id_accesorio' // Clave foránea en la tabla pivote que apunta a Accesorio
        )->withPivot('cantidad', 'precio_unitario', 'subtotal'); // Incluye columnas adicionales de la tabla pivote
    }
}