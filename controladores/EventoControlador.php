<?php
require_once __DIR__ . '/../modelos/Evento.php';
class EventoControlador
{

    // Mostrar la lista de eventos
    public function listar()
    {
        $eventos = json_decode(file_get_contents(__DIR__ . '/../datos/eventos.json'), true);
        require_once __DIR__ . '/../vistas/evento/lista.php'; // Mostrar los eventos
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
            ];

            Evento::guardar($_POST['nombre'], $nuevoEvento);
        }

        require_once __DIR__ . '/../vistas/evento/agregar.php'; // Mostrar formulario de agregar evento
    }
}
