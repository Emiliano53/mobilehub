<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $table = 'venta';
    protected $primaryKey = 'id_venta';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['fk_id_cliente', 'descripcion', 'fecha', 'total'];
    public $timestamps = false;

    // Relación con Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'fk_id_cliente');
    }

    // Relación con DetalleServicioVenta
    public function detallesServicio()
    {
        return $this->hasMany(Detalle_Servicio_Venta::class, 'fk_id_venta');
    }

    // Relación con DetalleVentaAccesorio
    public function detallesAccesorio()
    {
        return $this->hasMany(Detalle_Venta_Accesorio::class, 'fk_id_venta');
    }
}
