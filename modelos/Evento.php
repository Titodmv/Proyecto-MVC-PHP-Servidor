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

    public static function compartir($nEvetno, $nUsuario) {
        $data = Usuario::obtenerTodos();

        if (isset($data[$_SESSION['user']['nombreUsuario']]['eventos'][$nEvetno])) {
            if (isset($data[$nUsuario])) {

                $data[$nUsuario]['eventos'][$nEvetno] = $data[$_SESSION['user']['nombreUsuario']]['eventos'][$nEvetno];
                $data[$nUsuario]['eventos'][$nEvetno]['asistencia'] = false;
                
                file_put_contents(__DIR__ . '/../data/usuarios.json', json_encode($data, JSON_PRETTY_PRINT));
            }
            else {
                echo "El usuario no existe";
            }
        }
        else {
            echo "El evento no existe";
        }
    }

    public function listar()
    {
        Evento::eliminarEventosPasados(); // Eliminar eventos pasados
        $eventosUsuario = Evento::listar(); // Obtener eventos del usuario
        $eventosGenerales = Evento::obtenerEventosGenerales(); // Obtener eventos generales
    
        require_once __DIR__ . '/../vistas/evento/lista.php'; // Pasar ambas listas a la vista
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


    public static function eliminarEventosPasados()
{
    $data = Usuario::obtenerTodos();
    $fechaActual = strtotime(date('Y-m-d'));

    foreach ($data as $usuario => $infoUsuario) {
        foreach ($infoUsuario['eventos'] as $nombreEvento => $evento) {
            if (strtotime($evento['fecha']) < $fechaActual) {
                unset($data[$usuario]['eventos'][$nombreEvento]);
            }
        }
    }

    file_put_contents(__DIR__ . '/../data/usuarios.json', json_encode($data, JSON_PRETTY_PRINT));
}

public static function obtenerEventosGenerales()
{
    return json_decode(file_get_contents(__DIR__ . '/../datos/eventos_generales.json'), true);
}

        
}