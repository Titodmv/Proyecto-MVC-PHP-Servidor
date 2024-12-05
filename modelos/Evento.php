<?php

class Evento {

    // Obtener todos los eventos
    public static function obtenerTodos() {
        return json_decode(file_get_contents(__DIR__ . '/../datos/eventos.json'), true);
    }

    // Guardar un nuevo evento
    public static function guardar($evento) {
        $eventos = self::obtenerTodos();
        $eventos[] = $evento;
        file_put_contents(__DIR__ . '/../datos/eventos.json', json_encode($eventos, JSON_PRETTY_PRINT));
    }
}
