<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Azkernia</title>
</head>
<body>
    <h1>Login</h1>
    <form action="index.php?controller=user&action=login" method="post">
        <label for="name">Nombre: </label>
        <input type="text" name="username" id="name-id" placeholder="nombre de usuario">
        <br><br>
        <label for="password">Contraseña: </label>
        <input type="password" name="password" id="password-id" placeholder="contraseña">
        <br><br>
        <p>¿No tiene una cuenta? 
        <a href="http://localhost/Azkernia/public/index.php?controller=user&action=register">Cree una cuenta</a>
        Cree una cuenta</a>
        </p>
        <input type="submit" value="Ingresar" id="boton-ingresar">
    </form>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
</body>
</html>
