<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;

class ProyectoController extends Controller
{
    // 2. Controlador para obtener los proyectos
    public function index()
    {
        $proyectos = Proyecto::obtenerDatosEstaticos();
        return view('proyectos.index', compact('proyectos'));
    }

    // 1. Controlador para crear un proyecto (Muestra el formulario)
    public function create()
    {
        return view('proyectos.create');
    }

    // Procesa la creación del proyecto (Simulado)
    public function store(Request $request)
    {
        // Aquí iría la lógica para guardar en BD. 
        // Como es estático, solo redirigimos a la lista con un mensaje de éxito.
        return redirect()->route('proyectos.index')->with('success', 'Proyecto creado exitosamente (Simulado).');
    }

    // 5. Controlador para obtener un proyecto por id
    public function show($id)
    {
        $proyectos = Proyecto::obtenerDatosEstaticos();
        $proyecto = $proyectos->firstWhere('id', $id);

        if (!$proyecto) {
            abort(404, 'Proyecto no encontrado');
        }

        return view('proyectos.show', compact('proyecto'));
    }

    // 3. Controlador para actualizar un proyecto por id (Muestra el formulario)
    public function edit($id)
    {
        $proyectos = Proyecto::obtenerDatosEstaticos();
        $proyecto = $proyectos->firstWhere('id', $id);

        if (!$proyecto) {
            abort(404, 'Proyecto no encontrado');
        }

        return view('proyectos.edit', compact('proyecto'));
    }

    // Procesa la actualización del proyecto (Simulado)
    public function update(Request $request, $id)
    {
        // Lógica simulada de actualización
        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado exitosamente (Simulado).');
    }

    // 4. Controlador para eliminar un proyecto por id
    public function destroy($id)
    {
        // Lógica simulada de eliminación
        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado exitosamente (Simulado).');
    }
}