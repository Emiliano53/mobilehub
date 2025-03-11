<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_Venta_Accesorio extends Model
{
    use HasFactory;
    protected $table = 'detalle_venta_accesorio';
    protected $primaryKey = 'id_detalle_venta_accesorio';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['fk_id_venta', 'fk_id_accesorio', 'cantidad', 'costo', 'monto'];
    public $timestamps = false;

    // Relación con Accesorio
    public function accesorio()
    {
        return $this->belongsTo(Accesorio::class, 'fk_id_accesorio');
    }

    // Relación con Venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'fk_id_venta');
    }
}
