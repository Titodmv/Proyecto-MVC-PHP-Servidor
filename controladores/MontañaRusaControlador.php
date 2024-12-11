<?php
require_once __DIR__ . '/../modelos/MontanaRusa.php';
class MontañaRusaControlador
{

    // Mostrar la lista de montañas rusas
    public function index()
    {
        MontanaRusa::mostrarListas();
    }

    // Agregar una nueva montaña rusa
    public function agregar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_SESSION["user"]["rol"]=="fabricante" || $_SESSION["user"]["rol"]=="administrador") {
                $valido = "Si";
            } else {
                $valido = "No";
            }
            $nuevaMontaña = [
                'nombre' => $_POST['nombre'],
                'velocidad' => $_POST['velocidad'],
                'altura' => $_POST['altura'],
                'fabricante' => $_POST['fabricante'],
                'tipo' => $_POST['tipo'],
                'ubicacion' => $_POST['ubicacion'],
                'fecha_inauguracion' => $_POST['fecha_inauguracion'],
                "Valido" => $valido
            ];
            
            MontanaRusa::guardar($nuevaMontaña);
        }

        // Mostrar el formulario para agregar una nueva montaña rusa
        require_once __DIR__ . '/../vistas/montanas_rusas/agregar_montana.php';
    }

    public function eliminar() {
        MontanaRusa::eliminar($_GET['atraccion']);
    }

     public function validar() {
        MontanaRusa::validar($_GET['atraccion']);
     }
}
