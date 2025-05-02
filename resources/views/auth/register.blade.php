@extends('layouts.app')

@section('title', 'Registrarse')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%;">
        <h2 class="text-center mb-4">Crear Cuenta</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre Completo</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Tu nombre completo" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="ejemplo@correo.com" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="********" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="********" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-modern btn-modern-primary">Registrarse</button>
            </div>
        </form>
        <div class="text-center mt-3">
            <p class="text-muted">¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-primary">Inicia Sesión</a></p>
        </div>
    </div>
</div>
@endsection
