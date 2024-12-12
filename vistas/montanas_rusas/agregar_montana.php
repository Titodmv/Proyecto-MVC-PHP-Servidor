<h2>Agregar Nueva Montaña Rusa</h2>
<form action="index.php?accion=agregar" method="POST">
    <label for="nombre">Nombre de la Montaña Rusa:</label>
    <input type="text" name="nombre" required><br>

    <label for="velocidad">Velocidad (km/h):</label>
    <input type="number" name="velocidad" required><br>

    <label for="altura">Altura (m):</label>
    <input type="number" name="altura" required><br>

    <label for="fabricante">Fabricante:</label>
    <input type="text" name="fabricante" required><br>

    <label for="tipo">Tipo:</label>
    <input type="text" name="tipo" required><br>

    <label for="ubicacion">Ubicación:</label>
    <input type="text" name="ubicacion" required><br>

    <label for="fecha_inauguracion">Fecha de Inauguración:</label>
    <input type="date" name="fecha_inauguracion" required><br>

    <button type="submit">Agregar Montaña Rusa</button>
</form>
