@extends('proyectos.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Listado de Proyectos</h2>
    <a href="{{ route('proyectos.create') }}" class="btn btn-primary">Agregar Proyecto</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Responsable</th>
                    <th>Monto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proyectos as $proyecto)
                <tr>
                    <td>{{ $proyecto['id'] }}</td>
                    <td>{{ $proyecto['nombre'] }}</td>
                    <td><span class="badge bg-secondary">{{ $proyecto['estado'] }}</span></td>
                    <td>{{ $proyecto['responsable'] }}</td>
                    <td>${{ number_format($proyecto['monto'], 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('proyectos.show', $proyecto['id']) }}" class="btn btn-sm btn-info text-white">Ver</a>
                        <a href="{{ route('proyectos.edit', $proyecto['id']) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('proyectos.destroy', $proyecto['id']) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este proyecto?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection