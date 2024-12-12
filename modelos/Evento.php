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

    public static function listar() {
        $data = Usuario::obtenerTodos();
        return $data[$_SESSION['user']['nombreUsuario']]['eventos'];
    }
}
