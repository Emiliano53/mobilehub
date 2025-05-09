@extends('layouts.app')

@section('title', 'Registrar Venta')
@section('content')

@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="container">
    <h1 class="text-center mb-4">Registrar Nueva Venta</h1>

    <form action="{{ route('catalogos.ventas.store') }}" method="POST" id="venta-form">
        @csrf
        <input type="hidden" name="cliente_opcion" value="nuevo">
        
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Información del Cliente</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Nombre del Cliente *</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <textarea name="direccion" id="direccion" class="form-control" rows="2"></textarea>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Detalles de la Venta</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha">Fecha *</label>
                            <input type="date" name="fecha" id="fecha" class="form-control" 
                                   value="{{ now()->format('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="total">Total</label>
                            <input type="text" name="total" id="total" class="form-control" 
                                   value="0.00" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                Servicios
                                <button type="button" id="agregar-servicio" class="btn btn-sm btn-light float-right">
                                    <i class="fas fa-plus"></i> Agregar
                                </button>
                            </div>
                            <div class="card-body">
                                <div id="servicios-container">
                                    <!-- Los servicios se agregarán aquí dinámicamente -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-secondary text-white">
                                Productos
                                <button type="button" id="agregar-producto" class="btn btn-sm btn-light float-right">
                                    <i class="fas fa-plus"></i> Agregar
                                </button>
                            </div>
                            <div class="card-body">
                                <div id="productos-container">
                                    <!-- Los productos se agregarán aquí dinámicamente -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg">
                <i class="fas fa-save"></i> Registrar Venta
            </button>
            <a href="{{ route('catalogos.ventas') }}" class="btn btn-secondary btn-lg">
                <i class="fas fa-times"></i> Cancelar
            </a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Variables para contadores
    let servicioCounter = 0;
    let productoCounter = 0;
    
    // Función para calcular el total
    function calcularTotal() {
        let total = 0;
        
        // Sumar servicios
        document.querySelectorAll('.servicio-item').forEach(item => {
            const precio = parseFloat(item.querySelector('[name^="servicios["][name$="[precio]"]').value) || 0;
            const cantidad = parseInt(item.querySelector('[name^="servicios["][name$="[cantidad]"]').value) || 0;
            const subtotal = precio * cantidad;
            item.querySelector('.subtotal').textContent = subtotal.toFixed(2);
            total += subtotal;
        });
        
        // Sumar productos
        document.querySelectorAll('.producto-item').forEach(item => {
            const precio = parseFloat(item.querySelector('[name^="productos["][name$="[precio]"]').value) || 0;
            const cantidad = parseInt(item.querySelector('[name^="productos["][name$="[cantidad]"]').value) || 0;
            const subtotal = precio * cantidad;
            item.querySelector('.subtotal').textContent = subtotal.toFixed(2);
            total += subtotal;
        });
        
        // Actualizar total general
        document.getElementById('total').value = total.toFixed(2);
    }
    
    // Agregar servicio
    document.getElementById('agregar-servicio').addEventListener('click', function() {
        servicioCounter++;
        const container = document.getElementById('servicios-container');
        const div = document.createElement('div');
        div.className = 'servicio-item mb-3 p-3 border rounded';
        div.innerHTML = `
            <div class="row">
                <div class="col-md-5">
                    <label>Servicio *</label>
                    <select name="servicios[${servicioCounter}][id]" class="form-control servicio-select" required>
                        <option value="">Seleccione un servicio</option>
                        @foreach($servicios as $servicio)
                        <option value="{{ $servicio->id_servicio }}" data-precio="{{ $servicio->costo }}">
                            {{ $servicio->descripcion_servicio }} - ${{ number_format($servicio->costo, 2) }}
                        </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="servicios[${servicioCounter}][precio]" value="0">
                </div>
                <div class="col-md-3">
                    <label>Cantidad *</label>
                    <input type="number" name="servicios[${servicioCounter}][cantidad]" 
                           class="form-control cantidad-servicio" value="1" min="1" required>
                </div>
                <div class="col-md-3">
                    <label>Subtotal</label>
                    <div class="subtotal">0.00</div>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-sm remove-item">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
        container.appendChild(div);
        
        // Evento para actualizar precios cuando se selecciona un servicio
        div.querySelector('.servicio-select').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const precio = selectedOption.dataset.precio || 0;
            div.querySelector('[name^="servicios["][name$="[precio]"]').value = precio;
            calcularTotal();
        });
        
        // Evento para actualizar al cambiar cantidad
        div.querySelector('.cantidad-servicio').addEventListener('input', calcularTotal);
        
        // Evento para eliminar item
        div.querySelector('.remove-item').addEventListener('click', function() {
            div.remove();
            calcularTotal();
        });
    });
    
    // Agregar producto
    document.getElementById('agregar-producto').addEventListener('click', function() {
        productoCounter++;
        const container = document.getElementById('productos-container');
        const div = document.createElement('div');
        div.className = 'producto-item mb-3 p-3 border rounded';
        div.innerHTML = `
            <div class="row">
                <div class="col-md-5">
                    <label>Producto *</label>
                    <select name="productos[${productoCounter}][id]" class="form-control producto-select" required>
                        <option value="">Seleccione un producto</option>
                        @foreach($productos as $producto)
                        <option value="{{ $producto->id_accesorios }}" 
                                data-precio="{{ $producto->precio }}" 
                                data-existencia="{{ $producto->existencia }}">
                            {{ $producto->nombre }} - ${{ number_format($producto->precio, 2) }} (Existencia: {{ $producto->existencia }})
                        </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="productos[${productoCounter}][precio]" value="0">
                </div>
                <div class="col-md-3">
                    <label>Cantidad *</label>
                    <input type="number" name="productos[${productoCounter}][cantidad]" 
                           class="form-control cantidad-producto" value="1" min="1" required>
                    <small class="text-danger existencia-msg d-none">No hay suficiente existencia</small>
                </div>
                <div class="col-md-3">
                    <label>Subtotal</label>
                    <div class="subtotal">0.00</div>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-sm remove-item">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
        container.appendChild(div);
        
        // Evento para actualizar precios cuando se selecciona un producto
        div.querySelector('.producto-select').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const precio = selectedOption.dataset.precio || 0;
            const existencia = selectedOption.dataset.existencia || 0;
            
            div.querySelector('[name^="productos["][name$="[precio]"]').value = precio;
            
            // Validar existencia
            const cantidadInput = div.querySelector('.cantidad-producto');
            cantidadInput.max = existencia;
            if (parseInt(cantidadInput.value) > existencia) {
                cantidadInput.value = existencia;
                div.querySelector('.existencia-msg').classList.remove('d-none');
            } else {
                div.querySelector('.existencia-msg').classList.add('d-none');
            }
            
            calcularTotal();
        });
        
        // Evento para actualizar al cambiar cantidad
        div.querySelector('.cantidad-producto').addEventListener('input', function() {
            const selectedOption = div.querySelector('.producto-select').options[div.querySelector('.producto-select').selectedIndex];
            const existencia = selectedOption ? selectedOption.dataset.existencia || 0 : 0;
            
            if (parseInt(this.value) > existencia) {
                this.value = existencia;
                div.querySelector('.existencia-msg').classList.remove('d-none');
            } else {
                div.querySelector('.existencia-msg').classList.add('d-none');
            }
            
            calcularTotal();
        });
        
        // Evento para eliminar item
        div.querySelector('.remove-item').addEventListener('click', function() {
            div.remove();
            calcularTotal();
        });
    });
    
    // Validación del formulario antes de enviar
    document.getElementById('venta-form').addEventListener('submit', function(e) {
        // Validar que al menos haya un servicio o producto
        const servicios = document.querySelectorAll('.servicio-item').length;
        const productos = document.querySelectorAll('.producto-item').length;
        
        if (servicios === 0 && productos === 0) {
            e.preventDefault();
            alert('Debe agregar al menos un servicio o producto');
            return false;
        }
        
        // Actualizar el campo total por si acaso
        calcularTotal();
        return true;
    });
});
</script>

@endsection