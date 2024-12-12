<?php
if (!isset($_COOKIE['logueado'])) {
    // header('Location: /vistas/usuario/login.php');
}
?>
<h2>Lista de Eventos</h2>
<table border="1">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Descripción</th>
            <th colspan="2">Funciones</th>
            <th>Días restantes</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataUsuario as $evento): ?>
            <tr>

                <td><?php echo $evento['nombre']; ?></td>
                <td><?php echo $evento['fecha']; ?></td>
                <td><?php echo $evento['descripcion']; ?></td>
                <?php if ($evento['asistencia'] == false) : ?>
                    <td><a href="index.php?accion=asistir&nombre=<?php echo htmlspecialchars($evento['nombre']); ?>"><button>Asistiré</button></a></td>
                <?php endif; ?>
                <td><a href="index.php?accion=noAsistir&nombre=<?php echo htmlspecialchars($evento['nombre']); ?>"><button>No asistiré</button></a></td>
                <td>
                <td>
                    <?php
                    $fechaEvento = strtotime($evento['fecha']);
                    $fechaActual = strtotime(date('Y-m-d'));
                    $diferencia = ($fechaEvento - $fechaActual) / (60 * 60 * 24);

                    if ($diferencia == 0) {
                        echo "HOY";
                    } elseif ($diferencia > 0) {
                        echo $diferencia . " días restantes";
                    } else {
                        echo "Pasado"; // Por si algún evento no se eliminó automáticamente
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h1>Eventos Generales</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Descripción</th>
                    <th>Días Restantes</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($eventosGenerales as $evento): ?>
                <tr>
                    <td><?php echo htmlspecialchars($evento['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($evento['fecha']); ?></td>
                    <td><?php echo htmlspecialchars($evento['descripcion']); ?></td>
                    <td>
                        <?php 
                        $fechaEvento = strtotime($evento['fecha']);
                        $fechaActual = strtotime(date('Y-m-d'));
                        $diferencia = ($fechaEvento - $fechaActual) / (60 * 60 * 24);

                        if ($diferencia == 0) {
                            echo "HOY";
                        } elseif ($diferencia > 0) {
                            echo $diferencia . " días restantes";
                        } else {
                            echo "Pasado"; 
                        }
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
<a href="index.php?accion=agregar_evento">Agregar Nuevo Evento</a><br>
<a href="index.php?accion=index">Mostrar montañas rusas</a>