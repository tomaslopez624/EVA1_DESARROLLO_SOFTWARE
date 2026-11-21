@extends('proyectos.layout')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Registro de Usuario</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre completo</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo electrónico</label>
                        <input type="email" name="correo" id="correo" class="form-control" value="{{ old('correo') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="clave" class="form-label">Contraseña (mínimo 6 caracteres)</label>
                        <input type="password" name="clave" id="clave" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Registrarme</button>
                </form>

                <div class="mt-3 text-center">
                    <small>¿Ya tienes cuenta? <a href="{{ route('login.form') }}">Inicia sesión aquí</a></small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection