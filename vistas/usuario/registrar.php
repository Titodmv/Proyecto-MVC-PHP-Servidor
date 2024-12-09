<h2>Registrarse</h2>
<form action="index.php?accion=registrar" method="POST">
    <label for="nombreUsuario">Nombre de Usuario:</label>
    <input type="text" name="nombreUsuario" required><br>

    <label for="contrasena">Contraseña:</label>
    <input type="password" name="contrasena" required><br>

    <label for="rol">Rol</label>
    <select name="rol">
        <option value="fabricante">Fabricante</option>
        <option value="usuario">Usuario</option>
    </select>
    <br>
    <button type="submit">Registarse</button>
    <a href="/Proyecto%20MVC%20PHP%20Servidor/?accion=login">¿Ya tienes cuenta? Logueate aquí</a>
</form>
