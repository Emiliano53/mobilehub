<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_Servicio_Venta extends Model
{
    use HasFactory;
    protected $table = 'detalle_servicio_venta';
    protected $primaryKey = 'id_detalle_servicio_venta';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['fk_id_servicio', 'fk_id_venta', 'cantidad', 'costo', 'monto'];
    public $timestamps = false;

    // Relación con Servicio
    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'fk_id_servicio');
    }

    // Relación con Venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'fk_id_venta');
    }
}
