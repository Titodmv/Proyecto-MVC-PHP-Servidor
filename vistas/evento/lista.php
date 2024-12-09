<?php
    if (!isset($_COOKIE['logueado'])) {
       // header('Location: /vistas/usuario/login.php');
    }
?>
<h2>Lista de Eventos</h2>
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Descripción</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($eventos as $evento): ?>
            <tr>
                <td><?php echo $evento['nombre']; ?></td>
                <td><?php echo $evento['fecha']; ?></td>
                <td><?php echo $evento['descripcion']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="index.php?accion=agregar_evento">Agregar Nuevo Evento</a>
