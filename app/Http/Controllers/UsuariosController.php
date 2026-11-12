<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empresa = Empresa::all();

    return view('usuarios.create', compact('empresas'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'username' => 'required',
        'password' => 'required|min:8',
        'rol' => 'required',
        'activo' => 'required',
        'fecha_creacion' => 'required|date',
        'id_empresa' => 'required'
        ]);

        Usuario::create($request->validated());
   Usuario::create([
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'rol' => $request->rol,
        'activo' => $request->activo,
        'fecha_creacion' => $request->fecha_creacion,
        'id_empresa' => $request->id_empresa,
    ]);

    return redirect()->route('usuarios.index')
        ->with('success', 'Usuario registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuario = Usuario::findOrfail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuario,email,' . $id,
            'telefono' => 'nullable|string|max:20'
        ]);

        $usuario = Usuario::findOrfail($id);
        $usuario->update($request->all());
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = Usuario::findOrfail($id);
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
