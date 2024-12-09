<?php

class UsuarioControlador
{

    // Mostrar el formulario de login
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuarios = json_decode(file_get_contents(__DIR__ . '/../data/usuarios.json'), true);
        
            foreach ($usuarios['usuarios'] as $usuario) {
                if ($usuario['nombreUsuario'] === $_POST['nombreUsuario'] && password_verify($_POST['contrasena'], $usuario['contrasena'])) {
                    $_SESSION['user'] = $usuario;
                    header('Location: index.php?accion=index');
                    exit();
                }
            }
            echo "Usuario o contraseña incorrectos.";
        }        

        require_once __DIR__ . '/../vistas/usuario/login.php'; // Mostrar formulario de login
    }

    // Logout (cerrar sesión)
    public function logout()
    {
        session_destroy();
        header('Location: index.php?accion=index');
        exit();
    }

    // Registrar un nuevo usuario
    public function registrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nuevoUsuario = [
                'nombreUsuario' => $_POST['nombreUsuario'],
                'contrasena' => password_hash($_POST['contrasena'], PASSWORD_DEFAULT),
                'rol' => $_POST['rol'],
                'eventos' => []
            ];

            // Obtener los usuarios existentes
            $usuarios = json_decode(file_get_contents(__DIR__ . '/../data/usuarios.json'), true);
            $usuarios['usuarios'][] = $nuevoUsuario;

            // Guardar los usuarios actualizados en el archivo JSON
            file_put_contents(__DIR__ . '/../data/usuarios.json', json_encode($usuarios, JSON_PRETTY_PRINT));

            echo "Usuario registrado con éxito.";
            //header('Location: index.php?accion=login'); // Redirigir al login
            //exit();
        }

        require_once __DIR__ . '/../vistas/usuario/registrar.php'; // Mostrar formulario de registro
    }
}
