<h2>Lista de Montañas Rusas</h2>
<?php if (empty($montanasRusas)): ?>
    <p>No hay montañas rusas disponibles.</p>
<?php else: ?>
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Velocidad (km/h)</th>
                <th>Altura (m)</th>
                <th>Fabricante</th>
                <th>Tipo</th>
                <th>Ubicación</th>
                <th>Fecha de Inauguración</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($montanasRusas as $montana): ?>
                <?php if ($montana['Valido'] == 'Si') : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($montana['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($montana['velocidad']); ?> km/h</td>
                        <td><?php echo htmlspecialchars($montana['altura']); ?> m</td>
                        <td><?php echo htmlspecialchars($montana['fabricante']); ?></td>
                        <td><?php echo htmlspecialchars($montana['tipo']); ?></td>
                        <td><?php echo htmlspecialchars($montana['ubicacion']); ?></td>
                        <td><?php echo htmlspecialchars($montana['fecha_inauguracion']); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<a href="index.php?accion=agregar">Agregar Nueva Montaña Rusa</a>