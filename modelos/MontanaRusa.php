<?php

class MontanaRusa
{
    // Obtener todas las montañas rusas
    public static function obtenerTodas()
    {
        return json_decode(file_get_contents(__DIR__ . '/../data/montanas_rusas.json'), true);
    }

    public static function  mostrarListas()
    {
        // Leer el archivo JSON
        $data = self::obtenerTodas();

        // Obtener las montañas rusas
        $montanasRusas = $data ?? [];


        // Pasar las montañas rusas a la vista
        if ($_SESSION['user']['rol'] == "fabricante") {
            require_once __DIR__ . '/../vistas/montanas_rusas/lista_fabricantes.php';
        } elseif ($_SESSION['user']['rol'] == "administrador") {
            require_once __DIR__ . '/../vistas/montanas_rusas/lista_administrador.php';
        } else {
            require_once __DIR__ . '/../vistas/montanas_rusas/lista_usuarios.php';
        }
    }

    // Guardar una nueva montaña rusa
    public static function guardar($nuevaMontaña)
    {
        // Leer las montañas rusas existentes
        $data = self::obtenerTodas();
        $data['montanas_rusas'][] = $nuevaMontaña;
        self::almacenar($data);
    }

    public static function almacenar($data)
    {
        // Guardar las montañas rusas actualizadas en el archivo JSON
        file_put_contents(__DIR__ . '/../data/montanas_rusas.json', json_encode($data, JSON_PRETTY_PRINT));

        // Redirigir a la lista de montañas rusas
        header('Location: index.php?accion=index');
        exit();
    }

    public static function eliminar($nombre)
    {
        $data = self::obtenerTodas();
        unset($data[$nombre]);
        self::almacenar($data);
    }

    public static function validar($nombre)
    {
        $data = self::obtenerTodas();
        $data[$nombre]['Valido'] = 'Si';
        self::almacenar($data);
    }
}
