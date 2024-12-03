<?php

class Database
{
    private $dbh;
    private $stmt;

    public function __construct()
    {
        // Conexión a la base de datos (ajusta los parámetros de conexión)
        $this->dbh = new PDO('mysql:host=localhost;dbname=azkernia', 'root', '');
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Prepara una consulta SQL
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Vincula un parámetro con la consulta preparada
    public function bind($param, $value)
    {
        $this->stmt->bindValue($param, $value);
    }

    // Ejecuta la consulta preparada
    public function execute()
    {
        return $this->stmt->execute();
    }

    // Obtiene un solo resultado
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC); // Devuelve el primer resultado como un array asociativo
    }

    // Método para obtener la conexión PDO
    public function getPDO()
    {
        return $this->dbh;
    }
}

return new Database();
?>
