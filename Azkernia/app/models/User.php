<?php

class User
{
    private $db;

    public function __construct()
    {
        // Instanciar la clase Database
        $this->db = require '../config/database.php'; // Asegúrate de que la ruta sea correcta
    }

    /**
     * Buscar un usuario por su nombre de usuario.
     *
     * @param string $username Nombre de usuario a buscar
     * @return mixed La información del usuario o null si no se encuentra
     */
    public function findByUsername($username)
    {
        // Preparamos la consulta para buscar por nombre de usuario
        $sql = "SELECT * FROM usuarios WHERE username = :username";
        $this->db->query($sql);
        
        // Vinculamos el valor del nombre de usuario a la consulta
        $this->db->bind(':username', $username);
        
        // Ejecutamos la consulta y obtenemos el resultado
        $resultado = $this->db->single(); // Recupera un único resultado

        return $resultado;
    }

    /**
     * Crear un nuevo usuario en la base de datos.
     *
     * @param string $username Nombre de usuario
     * @param string $password Contraseña del usuario
     * @param string|null $nombre Nombre del usuario
     * @param string|null $apellidos Apellidos del usuario
     * @param string|null $email Email del usuario
     * @return bool Retorna true si el usuario fue creado, false si ocurrió un error
     */
    public function create($username, $password, $nombre = null, $apellidos = null, $email = null)
    {
        // Preparamos la consulta para insertar un nuevo usuario
        $sql = "INSERT INTO usuarios (username, contrasena, nombre, apellidos, email)
                VALUES (:username, :password, :nombre, :apellidos, :email)";
        $this->db->query($sql);

        // Ejecutamos la consulta con los valores proporcionados
        $this->db->bind(':username', $username);
        $this->db->bind(':password', password_hash($password, PASSWORD_BCRYPT)); // Aseguramos que la contraseña esté cifrada
        $this->db->bind(':nombre', $nombre);
        $this->db->bind(':apellidos', $apellidos);
        $this->db->bind(':email', $email);

        // Ejecutar y verificar si se insertó correctamente
        return $this->db->execute();
    }
}
?>
