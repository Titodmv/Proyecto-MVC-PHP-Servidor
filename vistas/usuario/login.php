<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Montañas Rusas</title>
</head>
<body>
<h2>Iniciar Sesión</h2>
<form action="index.php?accion=login" method="POST">
    <label for="nombreUsuario">Nombre de Usuario:</label>
    <input type="text" name="nombreUsuario" required><br>

    <label for="contrasena">Contraseña:</label>
    <input type="password" name="contrasena" required><br>

    <button type="submit">Iniciar Sesión</button>
    <a href="index.php?accion=registrar">¿No tienes cuenta? Regístrate aquí</a>

</form>
</body>
</html>