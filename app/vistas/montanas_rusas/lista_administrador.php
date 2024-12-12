<?php
session_start();

// Comprobar si el usuario tiene el rol de 'fabricante'
if (!isset($_SESSION['user']) || $_SESSION['user']['rol'] !== 'administrador') {
    echo "Acceso denegado. Necesitas ser administrador para acceder a esta página.";
    exit();
}

// Filtrar las montañas rusas generales por los parámetros recibidos en la URL
$filtrar = $_GET;  // Parámetros de filtro desde la URL
$montanasRusasGenerales = array_filter($montanasRusas, function ($montana) use ($filtrar) {
    foreach ($filtrar as $clave => $valor) {
        if (isset($montana[$clave])) {
            if (is_numeric($valor)) {
                // Si el filtro es numérico (altura, velocidad)
                if ($montana[$clave] < (int)$valor) {
                    return false;
                }
            }
        }
    }
    return true; // Solo si todos los filtros se cumplen
});
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Montañas Rusas - Panel de Fabricante</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .filtro {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h1>Panel de Montañas Rusas</h1>

    <!-- Tabla de montañas rusas creadas por el fabricante -->
    <h2>Montañas rusas por validar</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Velocidad</th>
                <th>Altura</th>
                <th>Tipo</th>
                <th>Ubicación</th>
                <th>Fecha de Inauguración</th>
                <th colspan="2">Funciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($montanasRusasGenerales as $montana) : ?>
                <tr>
                    <?php if ($montana['Valido'] == 'No') : ?>
                        <td><?php echo htmlspecialchars($montana['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($montana['velocidad']); ?> km/h</td>
                        <td><?php echo htmlspecialchars($montana['altura']); ?> m</td>
                        <td><?php echo htmlspecialchars($montana['tipo']); ?></td>
                        <td><?php echo htmlspecialchars($montana['ubicacion']); ?></td>
                        <td><?php echo htmlspecialchars($montana['fecha_inauguracion']); ?></td>
                        <td><a href="index.php?accion=eliminar&atraccion=<?php echo htmlspecialchars($montana['nombre']); ?>"><button>Eliminar</button></a></td>
                        <td><a href="index.php?accion=validar&atraccion=<?php echo htmlspecialchars($montana['nombre']); ?>"><button>Validar</button></a></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <?php
    $alturaFiltrada = isset($_GET['altura']) ? (int) $_GET['altura'] : null;

    // Filtrar montañas rusas si se proporciona un valor en el filtro
    if ($alturaFiltrada) {
        $montanasRusasGenerales = array_filter($montanasRusasGenerales, function ($montana) use ($alturaFiltrada) {
            return $montana['altura'] >= $alturaFiltrada;
        });
    }
    ?>
    <!-- Formulario de filtro para las montañas rusas generales -->
    <h2>Montañas Rusas Generales</h2>
    <form class="filtro" method="GET" action="">
        <label for="altura">Altura: </label>
        <input type="number" id="altura" name="altura" value="<?php echo htmlspecialchars($filtrar['altura'] ?? ''); ?>"><br>

        <button type="submit">Filtrar</button>
    </form>

    <!-- Tabla de montañas rusas generales filtradas -->
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Velocidad</th>
                <th>Altura</th>
                <th>Fabricante</th>
                <th>Tipo</th>
                <th>Ubicación</th>
                <th>Fecha de Inauguración</th>
                <th>Funciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($montanasRusasGenerales as $montana) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($montana['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($montana['velocidad']); ?> km/h</td>
                    <td><?php echo htmlspecialchars($montana['altura']); ?> m</td>
                    <td><?php echo htmlspecialchars($montana['fabricante']); ?></td>
                    <td><?php echo htmlspecialchars($montana['tipo']); ?></td>
                    <td><?php echo htmlspecialchars($montana['ubicacion']); ?></td>
                    <td><?php echo htmlspecialchars($montana['fecha_inauguracion']); ?></td>
                    <td><a href="index.php?accion=eliminar&atraccion=<?php echo htmlspecialchars($montana['nombre']); ?>"><button>Eliminar</button></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php?accion=agregar">Agregar Nueva Montaña Rusa</a>
<br>
<a href="index.php?accion=logout">Cerrar sesión</a>
<br>
<a href="index.php?accion=agregar_evento">Crear un evento o compartirlo</a><br>
<a href="index.php/?accion=listar_eventos">Ver eventos</a>
</body>

</html>