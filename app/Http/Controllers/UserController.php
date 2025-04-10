<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::query();
            return DataTables::of($users)
                ->addColumn('actions', function ($user) {
                    return view('users.partials.actions', compact('user'))->render();
                })
                ->rawColumns(['actions']) 
                ->toJson();
        }
    
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', '¡Usuario creado con éxito!');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required',
        ]);

        $user->update($request->all());

        return redirect()->route('users.index')->with('success','!Usuario actualizado!');
    }

    public function destroy(User $user)
    {
        // Usuario actualmente autenticado
        $currentUser = auth()->user();
        if ($currentUser->id === $user->id) {
            return redirect()
                ->route('users.index')
                ->with('warning', 'No puedes eliminar tu propia cuenta.');
        }
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', '¡Usuario eliminado con éxito!');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

}