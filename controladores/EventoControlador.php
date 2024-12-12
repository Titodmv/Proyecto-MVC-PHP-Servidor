<?php
require_once __DIR__ . '/../modelos/Evento.php';
class EventoControlador
{

    // Mostrar la lista de eventos
    public function listar()
    {
        Evento::eliminarEventosPasados(); 
        $eventosUsuario = Evento::listar(); 
        $eventosGenerales = Evento::obtenerEventosGenerales(); 

        require_once __DIR__ . '/../vistas/evento/lista.php'; 
    }



    // Agregar un nuevo evento
    public function agregar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recoger datos del formulario
            $nuevoEvento = [
                'nombre' => $_POST['nombre'],
                'fecha' => $_POST['fecha'],
                'descripcion' => $_POST['descripcion'],
                'asistencia' => true
            ];

            Evento::guardar($_POST['nombre'], $nuevoEvento);
        }

        require_once __DIR__ . '/../vistas/evento/agregar.php'; // Mostrar formulario de agregar evento
    }

    public function compartir()
    {


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Evento::compartir($_POST['nombre'], $_POST['usuario']);
        }

        require_once __DIR__ . '/../vistas/evento/agregar.php'; // Mostrar formulario de agregar evento
    }

    public function asistir()
    {
        Evento::asistir($_GET['nombre']);
    }

    public function eliminar()
    {
        Evento::eliminar($_GET['nombre']);
    }
}
