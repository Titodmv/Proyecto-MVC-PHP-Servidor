<?php
    if (!isset($_COOKIE['logueado'])) {
        //header('Location: /vistas/usuario/login.php');
    }
?>
<h2>Agregar Evento</h2>
<form action="index.php?accion=agregar_evento" method="POST">
    <label for="nombre">Nombre del Evento:</label>
    <input type="text" name="nombre" required><br>

    <label for="fecha">Fecha:</label>
    <input type="date" name="fecha" required><br>

    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" required></textarea><br>

    <button type="submit">Agregar Evento</button>
</form>
