<?php
class conexion {
    public static function conectar() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "newtecbox";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}
$conexion = conexion::conectar();
if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
} else {
    echo "";
}
?>
