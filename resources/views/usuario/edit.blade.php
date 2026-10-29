<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar usuario</title>
</head>
<body>
    <h1>Editar usuario</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('usuarios.update', $usuario) }}"
          method="POST">
        @csrf
        @method('PUT')

        <label>Nombre:</label>
        <input type="text" name="nombre"
               value="{{ old('nombre', $usuario->nombre) }}" required>
        <br><br>

        <label>Email:</label>
        <input type="email" name="email"
               value="{{ old('email', $usuario->email) }}" required>
        <br><br>

        <label>Teléfono:</label>
        <input type="text" name="telefono"
               value="{{ old('telefono', $usuario->telefono) }}">
        <br><br>

        <button type="submit">Actualizar usuario</button>
    </form>

    <a href="{{ route('usuarios.index') }}">Volver</a>
</body>
</html>