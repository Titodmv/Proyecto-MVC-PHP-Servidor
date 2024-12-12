<?php
require_once __DIR__ . '/Usuario.php';
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

    public static function eliminarEventosPasados()
    {
        $fechaActual = strtotime(date('Y-m-d'));

        // Limpiar eventos del usuario
        $dataUsuarios = Usuario::obtenerTodos();
        foreach ($dataUsuarios as &$usuario) {
            foreach ($usuario['eventos'] as $nombreEvento => $evento) {
                $fechaEvento = strtotime($evento['fecha']);
                if ($fechaEvento < $fechaActual) {
                    unset($usuario['eventos'][$nombreEvento]);
                }
            }
        }
        file_put_contents(__DIR__ . '/../data/usuarios.json', json_encode($dataUsuarios, JSON_PRETTY_PRINT));

        // Limpiar eventos generales
        $eventosGenerales = self::obtenerEventosGenerales();
        foreach ($eventosGenerales as $key => $evento) {
            $fechaEvento = strtotime($evento['fecha']);
            if ($fechaEvento < $fechaActual) {
                unset($eventosGenerales[$key]);
            }
        }
        file_put_contents(__DIR__ . '/../data/eventos.json', json_encode($eventosGenerales, JSON_PRETTY_PRINT));
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

    public static function listar()
    {
        $data = Usuario::obtenerTodos(); // Cargar todos los usuarios desde el JSON
    
        // Verificar si el usuario actual tiene eventos
        $usuarioActual = $_SESSION['user']['nombreUsuario'];
        if (isset($data[$usuarioActual]['eventos'])) {
            $eventos = $data[$usuarioActual]['eventos'];
        } else {
            $eventos = ["hola"]["hola"]; // Si no tiene eventos, devolver una lista vacía
        }
    
        return self::ordenarEventosPorFecha($eventos);
    }
    
// En obtenerEventosGenerales()
public static function obtenerEventosGenerales()
{
    $eventos = json_decode(file_get_contents(__DIR__ . '/../data/eventos.json'), true);
    return self::ordenarEventosPorFecha($eventos);
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
    private static function ordenarEventosPorFecha($eventos)
    {
        usort($eventos, function ($a, $b) {
            return strtotime($a['fecha']) - strtotime($b['fecha']);
        });
        return array_reverse($eventos); // Para que sea de más reciente a más tardío
    }
    
}
