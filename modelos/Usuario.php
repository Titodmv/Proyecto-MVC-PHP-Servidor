<?php

class Usuario {

    // Obtener todos los usuarios
    public static function obtenerTodos() {
        $usuarios = json_decode(file_get_contents(__DIR__ . '/../datos/usuarios.json'), true);
        return $usuarios['usuarios'];
    }

    // Guardar un nuevo usuario
    public static function guardar($usuario) {
        $usuarios = json_decode(file_get_contents(__DIR__ . '/../datos/usuarios.json'), true);
        $usuarios['usuarios'][] = $usuario;
        file_put_contents(__DIR__ . '/../datos/usuarios.json', json_encode($usuarios, JSON_PRETTY_PRINT));
    }

    // Verificar si el usuario existe
    public static function verificar($nombreUsuario, $contrasena) {
        $usuarios = self::obtenerTodos();
        foreach ($usuarios as $usuario) {
            if ($usuario['nombreUsuario'] === $nombreUsuario && $usuario['contrasena'] === $contrasena) {
                return true;
            }
        }
        return false;
    }
}
