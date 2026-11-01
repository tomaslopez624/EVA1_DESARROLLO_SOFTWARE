@extends('proyectos.layout')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h3>Crear Nuevo Proyecto</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('proyectos.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nombre del Proyecto</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha de Inicio</label>
                <input type="date" name="fecha_inicio" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-select">
                    <option value="Planificado">Planificado</option>
                    <option value="En proceso">En proceso</option>
                    <option value="Finalizado">Finalizado</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Responsable</label>
                <input type="text" name="responsable" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Monto</label>
                <input type="number" name="monto" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection