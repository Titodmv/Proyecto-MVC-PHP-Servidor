<?php

spl_autoload_register(function ($clase) {
    require_once __DIR__ . "/$clase.php";
});
class Evento
{

    // Obtener todos los eventos
    public static function obtenerTodos()
    {
        return json_decode(file_get_contents(__DIR__ . '/../datos/eventos.json'), true);
    }

    // Guardar un nuevo evento
    public static function guardar($nombreEvento, $evento)
    {
        $fechaEvento = strtotime($evento['fecha']);
        $fechaActual = strtotime(date('Y-m-d'));

        if ($fechaEvento < $fechaActual) {
            echo "No se pueden añadir eventos con fechas pasadas.";
            return;
        }

        $data = Usuario::obtenerTodos();
        $data[$_SESSION['user']['nombreUsuario']]['eventos'][$nombreEvento] = $evento;
        file_put_contents(__DIR__ . '/../data/usuarios.json', json_encode($data, JSON_PRETTY_PRINT));
    }

    public static function compartir($nEvetno, $nUsuario)
    {
        $data = Usuario::obtenerTodos();

        if (isset($data[$_SESSION['user']['nombreUsuario']]['eventos'][$nEvetno])) {
            if (isset($data[$nUsuario])) {

                $data[$nUsuario]['eventos'][$nEvetno] = $data[$_SESSION['user']['nombreUsuario']]['eventos'][$nEvetno];
                $data[$nUsuario]['eventos'][$nEvetno]['asistencia'] = false;

                file_put_contents(__DIR__ . '/../data/usuarios.json', json_encode($data, JSON_PRETTY_PRINT));
            } else {
                echo "El usuario no existe";
            }
        } else {
            echo "El evento no existe";
        }
    }

    public static function eliminar($nombre)
    {
        $data = Usuario::obtenerTodos();
        unset($data[$_SESSION['user']['nombreUsuario']]['eventos'][$nombre]);
        file_put_contents(__DIR__ . '/../data/usuarios.json', json_encode($data, JSON_PRETTY_PRINT));
        header('Location: index.php?accion=listar_eventos');
        exit();
    }

    public static function asistir($nombre)
    {
        $data = Usuario::obtenerTodos();
        $data[$_SESSION['user']['nombreUsuario']]['eventos'][$nombre]['asistencia'] = true;
        file_put_contents(__DIR__ . '/../data/usuarios.json', json_encode($data, JSON_PRETTY_PRINT));
        header('Location: index.php?accion=listar_eventos');
        exit();
    }


    public static function actualizarEventosUsuario()
    {
        $data = Usuario::obtenerTodos();
        $fechaActual = strtotime(date('Y-m-d'));
        $usuario = $_SESSION['user']['nombreUsuario'];

        foreach ($data[$usuario]['eventos'] as $key => $value) {
            if (strtotime($value['fecha']) < $fechaActual) {
                unset($data[$usuario]['eventos'][$key]);
            }
        }

        file_put_contents(__DIR__ . '/../data/usuarios.json', json_encode($data, JSON_PRETTY_PRINT));


        return $data[$usuario]['eventos'];
    }

    public static function obtenerEventosGenerales()
    {
        return json_decode(file_get_contents(__DIR__ . '/../data/eventos.json'), true);
    }
}
