<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // Asegúrate de importar esta clase

class Venta extends Model
{
    use HasFactory;
    protected $table = 'venta';
    protected $primaryKey = 'id'; // Clave primaria de la tabla venta es 'id'
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['fk_id_cliente', 'descripcion', 'fecha', 'total'];
    public $timestamps = false;

    // Relación con Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'fk_id_cliente',"id");
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

    // Relación con Accesorios a través de DetalleVentaAccesorio (Usando belongsToMany)
    public function accesorios(): BelongsToMany
    {
        return $this->belongsToMany(Accesorio::class, 'detalle_venta_accesorio', 'fk_id_venta', 'fk_id_accesorio', 'id', 'id');
    }
}