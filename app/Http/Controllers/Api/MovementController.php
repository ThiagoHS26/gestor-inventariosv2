<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movement;

class MovementController extends Controller
{
    // Obtener todos los movimientos
    public function index()
    {
        $movements = Movement::all();
        return response()->json($movements, 200);
    }

    // Crear un nuevo movimiento
    public function store(Request $request)
    {
        $movement = Movement::create($request->all());
        return response()->json($movement, 201);
    }

    // Obtener un movimiento específico
    public function show($id)
    {
        $movement = Movement::find($id);

        if (!$movement) {
            return response()->json(['message' => 'Movimiento no encontrado'], 404);
        }

        return response()->json($movement, 200);
    }

    // Actualizar un movimiento existente
    public function update(Request $request, $id)
    {
        $movement = Movement::find($id);

        if (!$movement) {
            return response()->json(['message' => 'Movimiento no encontrado'], 404);
        }

        $movement->update($request->all());
        return response()->json($movement, 200);
    }

    // Eliminar un movimiento
    public function destroy($id)
    {
        $movement = Movement::find($id);

        if (!$movement) {
            return response()->json(['message' => 'Movimiento no encontrado'], 404);
        }

        $movement->delete();
        return response()->json(['message' => 'Movimiento eliminado con éxito'], 200);
    }
}