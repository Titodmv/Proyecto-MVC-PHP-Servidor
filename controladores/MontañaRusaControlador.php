<?php

class MontañaRusaControlador
{

    // Mostrar la lista de montañas rusas
    public function index()
    {
        if (!isset($_COOKIE['logueado'])) {
            header('Location: /Proyecto%20MVC%20PHP%20Servidor/?accion=login');
        }
        // Leer el archivo JSON
        $data = json_decode(file_get_contents(__DIR__ . '/../data/montanas_rusas.json'), true);

        // Obtener las montañas rusas
        $montanasRusas = $data['montanas_rusas'] ?? [];

        // Pasar las montañas rusas a la vista
        require_once __DIR__ . '/../vistas/tarea/lista.php';
    }

    // Agregar una nueva montaña rusa
    public function agregar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recoger los data del formulario
            $nuevaMontaña = [
                'nombre' => $_POST['nombre'],
                'velocidad' => $_POST['velocidad'],
                'altura' => $_POST['altura'],
                'fabricante' => $_POST['fabricante'],
                'tipo' => $_POST['tipo'],
                'ubicacion' => $_POST['ubicacion'],
                'fecha_inauguracion' => $_POST['fecha_inauguracion']
            ];

            // Leer las montañas rusas existentes
            $data = json_decode(file_get_contents(__DIR__ . '/../data/montanas_rusas.json'), true);
            $data['montanas_rusas'][] = $nuevaMontaña;

            // Guardar las montañas rusas actualizadas en el archivo JSON
            file_put_contents(__DIR__ . '/../data/montanas_rusas.json', json_encode($data, JSON_PRETTY_PRINT));

            // Redirigir a la lista de montañas rusas
            header('Location: index.php?accion=index');
            exit();
        }

        // Mostrar el formulario para agregar una nueva montaña rusa
        require_once __DIR__ . '/../vistas/tarea/agregar.php';
    }
}
