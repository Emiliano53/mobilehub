<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'venta';

    protected $fillable = [
        'fk_id_cliente',
        'fecha',
        'total',
        'descripcion',
        'activo',
        'metodo_pago'
    ];

    protected $casts = [
        'activo' => 'boolean',
        'fecha' => 'datetime',
        'total' => 'float'
    ];

    public $timestamps = false;

    // Relación con Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'fk_id_cliente', 'id_cliente');
    }

    // Relación con Servicios (corregida)
    public function servicios()
    {
        return $this->belongsToMany(
            Servicio::class,
            'detalle_servicio_venta',
            'fk_id_venta',
            'fk_id_servicio',
            'id', // Clave local en Venta (asumiendo que es 'id')
            'id_servicio' // Clave en Servicio (según tu modelo Servicio)
        )->withPivot(['cantidad', 'precio_unitario', 'subtotal']);
    }

    // Relación con Accesorios (corregida)
    public function accesorios()
    {
        return $this->belongsToMany(
            Accesorio::class,
            'detalle_venta_accesorio',
            'fk_id_venta',
            'fk_id_accesorio',
            'id', // Clave local en Venta
            'id_accesorios' // Asumiendo que Accesorio usa id_accesorio como PK
        )->withPivot(['cantidad', 'precio_unitario', 'subtotal']);
    }

    // Métodos para estado (mejorados)
    public function estaActiva(): bool
    {
        return $this->activo === true;
    }

    public function getEstadoAttribute(): string
    {
        return $this->estaActiva() ? 'Activo' : 'Inactivo';
    }

    public function getEstadoBadgeAttribute(): string
    {
        return sprintf(
            '<span class="badge %s">%s</span>',
            $this->estaActiva() ? 'bg-success' : 'bg-secondary',
            $this->estado
        );
    }

    // Scopes (optimizados)
    public function scopeActivas($query)
    {
        return $query->where('activo', true);
    }

    public function scopeInactivas($query)
    {
        return $query->where('activo', false);
    }

    public function scopeConDetalles($query)
    {
        return $query->with([
            'cliente',
            'servicios' => function($query) {
                $query->select([
                    'servicio.id_servicio',
                    'servicio.descripcion_servicio',
                    'detalle_servicio_venta.cantidad',
                    'detalle_servicio_venta.precio_unitario',
                    'detalle_servicio_venta.subtotal'
                ]);
            },
            'accesorios' => function($query) {
                $query->select([
                    'accesorios.id_accesorio',
                    'accesorios.nombre',
                    'detalle_venta_accesorio.cantidad',
                    'detalle_venta_accesorio.precio_unitario',
                    'detalle_venta_accesorio.subtotal'
                ]);
            }
        ]);
    }
}