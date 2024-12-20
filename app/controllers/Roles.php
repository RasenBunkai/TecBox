<?php
// include '../../config/database.php';
// $conn = conexion::conectar();
class RolesAndUsers {
    // Método para obtener todos los registros de la tabla RolesAndUsers
    public static function getAllRolesAndUsers($conexion, $ID_User) {
        try {
            $sqlSumaPrecios = "SELECT * FROM rolesandusers WHERE ID_User = $ID_User";
            $resultSumaPrecios = $conexion->query($sqlSumaPrecios);
            $resultSumaPrecios->fetch_assoc();
            return $resultSumaPrecios;
        } catch (PDOException $e) {
        
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return [];
        }
    }
}

            
?>