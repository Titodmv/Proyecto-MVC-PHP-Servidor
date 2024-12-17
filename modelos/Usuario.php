<?php

class Usuario
{

    // Obtener todos los usuarios
    public static function obtenerTodos()
    {
        $usuarios = json_decode(file_get_contents(__DIR__ . '/../data/usuarios.json'), true);
        return $usuarios;
    }

    // Guardar un nuevo usuario
    public static function guardar($nombre, $contrsena, $rol)
    {
        $nuevoUsuario = [
            'nombreUsuario' => $nombre,
            'contrasena' => $contrsena,
            'rol' => $rol,
            'eventos' => []
        ];

        // Obtener los usuarios existentes
        $usuarios = self::obtenerTodos();

        $usuarios[$nombre] = $nuevoUsuario;

        // Guardar los usuarios actualizados en el archivo JSON
        file_put_contents(__DIR__ . '/../data/usuarios.json', json_encode($usuarios, JSON_PRETTY_PRINT));

        header('Location: index.php?accion=login');
        exit();
    }

    // Verificar si el usuario existe
    public static function verificar($nombre, $contrasena)
    {
        $usuarios = self::obtenerTodos();

        if (isset($usuarios[$nombre]) && password_verify($contrasena, $usuarios[$nombre]['contrasena'])) {
            $_SESSION['user'] = $usuarios[$nombre];
            header('Location: index.php?accion=index');
            exit();
        }

        echo "<p id='error'>Usuario o contraseña incorrecta<p>";
    }

    public static function logout(){
        session_destroy();
        header('Location: index.php?accion=login');
        exit();
    }
}
