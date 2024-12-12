<?php
require_once __DIR__ . '/../modelos/Usuario.php'; 
class UsuarioControlador
{

    // Mostrar el formulario de login
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Usuario::verificar($_POST['nombreUsuario'], $_POST['contrasena']);
        }        

        require_once __DIR__ . '/../vistas/usuario/login.php'; // Mostrar formulario de login
    }

    // Logout (cerrar sesión)
    public function logout()
    {
        Usuario::logout();
    }

    // Registrar un nuevo usuario
    public function registrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
            Usuario::guardar($_POST['nombreUsuario'], $contrasena, $_POST['rol']);
        }

        require_once __DIR__ . '/../vistas/usuario/registrar.php'; // Mostrar formulario de registro
    }
}
