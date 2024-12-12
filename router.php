<?php
// Iniciar la sesión para poder usar variables de sesión
session_start();

// Incluir los controladores
require_once __DIR__ . '/controladores/EventoControlador.php';
require_once __DIR__ . '/controladores/UsuarioControlador.php';
require_once __DIR__ . '/controladores/MontañaRusaControlador.php';

// Obtener la acción de la URL, por defecto es 'index'

$accion = $_GET['accion'] ?? 'index';
if (!isset($_SESSION['user']) && $accion != 'login' && $accion != 'registrar') {
    header('Location: /Proyecto%20MVC%20PHP%20Servidor/?accion=login');
    exit();
}
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
        (new UsuarioControlador())->registrar();
        break;
    case 'agregar_evento':
        (new EventoControlador())->agregar();
        break;
    case 'compartir_evento':
        (new EventoControlador())->compartir();
        break;
    case 'listar_eventos':
        // Acción para listar los eventos
        (new EventoControlador())->listar();
        break;
    case 'eliminar':
        // Acción para eliminar una nueva montaña rusa
        (new MontañaRusaControlador())->eliminar();
        break;
    case 'validar':
        // Acción para validar una nueva montaña rusa
        (new MontañaRusaControlador())->validar();
        break;
    case 'noAsistir':
        // Acción para eliminar una nueva montaña rusa
        (new EventoControlador())->eliminar();
        break;
    case 'asistir':
        // Acción para validar una nueva montaña rusa
        (new EventoControlador())->asistir();
        break;
    default:
        echo "Acción no reconocida.";  // Mensaje si la acción no está definida
        break;
}
