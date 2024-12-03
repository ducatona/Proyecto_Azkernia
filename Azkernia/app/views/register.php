<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h1>Formulario de Registro</h1>
    <form action="index.php?controller=user&action=register" method="post">
        <!-- Campo Nombre de Usuario -->
        <label for="username">Nombre de usuario:</label>
        <input type="text" name="username" id="username" required>
        <br><br>

        <!-- Campo Contraseña -->
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>
        <br><br>

        <!-- Campo Nombre -->
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre">
        <br><br>

        <!-- Campo Apellidos -->
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos">
        <br><br>

        <!-- Campo Email -->
        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" id="email">
        <br><br>

        <!-- Botón de envío -->
        <input type="submit" value="Registrar">
    </form>
</body>
</html>
