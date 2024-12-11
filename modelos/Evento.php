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

        $data['usuarios'][$_SESSION['user']['nombreUsuario']]['eventos'][$nombreEvento] = $evento;
        file_put_contents(__DIR__ . '/../datos/usuarios.json', json_encode($data, JSON_PRETTY_PRINT));
        //header('Location: index.php?accion=listar_eventos');
        //exit();
    }
}
