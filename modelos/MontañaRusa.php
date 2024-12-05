<?php

class MontañaRusa
{

    // Obtener todas las montañas rusas
    public static function obtenerTodas()
    {
        return json_decode(file_get_contents(__DIR__ . '/../datos/montanas_rusas.json'), true);
    }

    // Guardar una nueva montaña rusa
    public static function guardar($montañaRusa)
    {
        $montanas = self::obtenerTodas();
        $montanas[] = $montañaRusa;
        file_put_contents(__DIR__ . '/../datos/montanas_rusas.json', json_encode($montanas, JSON_PRETTY_PRINT));
    }
}
