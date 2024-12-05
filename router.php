<?php
// Iniciar la sesión para poder usar variables de sesión
session_start();

// Incluir los controladores
require_once __DIR__ . '/controladores/EventoControlador.php';
require_once __DIR__ . '/controladores/UsuarioControlador.php';
require_once __DIR__ . '/controladores/MontañaRusaControlador.php';

// Obtener la acción de la URL, por defecto es 'index'
$accion = $_GET['accion'] ?? 'index';

// Procesar la acción con un switch
switch ($accion) {
    case 'index':
        // Acción de inicio: Muestra la lista de montañas rusas
        (new MontañaRusaControlador())->index();
        break;
    case 'agregar':
        // Acción para agregar una nueva montaña rusa
        (new MontañaRusaControlador())->agregar();
        break;
    case 'login':
        // Acción para mostrar el formulario de login
        (new UsuarioControlador())->login();
        break;
    case 'logout':
        // Acción de logout
        (new UsuarioControlador())->logout();
        break;
    case 'registrar':
        // Acción para registrar un nuevo usuario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new UsuarioControlador())->registrar();
        } else {
            require_once __DIR__ . '/vistas/usuario/registrar.php';
        }
        break;
    case 'agregar_evento':
        // Acción para agregar un evento
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new EventoControlador())->agregar();
        } else {
            require_once __DIR__ . '/vistas/evento/agregar.php';
        }
        break;
    case 'listar_eventos':
        // Acción para listar los eventos
        (new EventoControlador())->listar();
        break;
    default:
        echo "Acción no reconocida.";  // Mensaje si la acción no está definida
        break;
}
