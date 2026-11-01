@extends('proyectos.layout')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Detalles del Proyecto #{{ $proyecto['id'] }}</h3>
        <a href="{{ route('proyectos.index') }}" class="btn btn-secondary btn-sm">Volver</a>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush mb-3">
            <li class="list-group-item"><strong>Nombre:</strong> {{ $proyecto['nombre'] }}</li>
            <li class="list-group-item"><strong>Fecha de Inicio:</strong> {{ $proyecto['fecha_inicio'] }}</li>
            <li class="list-group-item"><strong>Estado:</strong> {{ $proyecto['estado'] }}</li>
            <li class="list-group-item"><strong>Responsable:</strong> {{ $proyecto['responsable'] }}</li>
            <li class="list-group-item"><strong>Monto:</strong> ${{ number_format($proyecto['monto'], 0, ',', '.') }}</li>
        </ul>
        <a href="{{ route('proyectos.edit', $proyecto['id']) }}" class="btn btn-warning">Editar Proyecto</a>
    </div>
</div>
@endsection