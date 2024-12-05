<?php

class EventoControlador {

    // Mostrar la lista de eventos
    public function listar() {
        $eventos = json_decode(file_get_contents(__DIR__ . '/../datos/eventos.json'), true);
        require_once __DIR__ . '/../vistas/evento/lista.php'; // Mostrar los eventos
    }

    // Agregar un nuevo evento
    public function agregar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recoger datos del formulario
            $nuevoEvento = [
                'nombre' => $_POST['nombre'],
                'fecha' => $_POST['fecha'],
                'descripcion' => $_POST['descripcion'],
            ];

            // Obtener los eventos existentes
            $eventos = json_decode(file_get_contents(__DIR__ . '/../datos/eventos.json'), true);
            $eventos[] = $nuevoEvento;

            // Guardar los eventos actualizados en el archivo JSON
            file_put_contents(__DIR__ . '/../datos/eventos.json', json_encode($eventos, JSON_PRETTY_PRINT));

            echo "Evento agregado con éxito.";
            header('Location: index.php?accion=listar_eventos'); // Redirigir a la lista de eventos
            exit();
        }

        require_once __DIR__ . '/../vistas/evento/agregar.php'; // Mostrar formulario de agregar evento
    }
}
