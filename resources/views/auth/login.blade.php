@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
        <h2 class="text-center mb-4">Iniciar Sesión</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="ejemplo@correo.com" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="********" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-modern btn-modern-primary">Iniciar Sesión</button>
            </div>
        </form>
        <div class="text-center mt-3">
            <p class="text-muted">¿No tienes una cuenta? <a href="{{ route('register') }}" class="text-primary">Regístrate</a></p>
        </div>
    </div>
</div>
@endsection
