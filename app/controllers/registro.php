<?php
// Incluir el archivo de conexión a la base de datos
include '../../config/database.php';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $username = $_POST['Username'];
    $email = $_POST['email'];
    $password = $_POST['PASSWORD'];

    // Validar que los campos no estén vacíos
    if (empty($username) || empty($email) || empty($password)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Encriptar la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO usuarios (Username, email, PASSWORD) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);

    // Vincular los valores y ejecutar la consulta
    if ($stmt) {
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            header("Location: ../views/LogIn.php");
            exit;
        } else {
            echo "Error al registrar el usuario: " . $conexion->error;
        }

        $stmt->close();
    } else {
        echo "Error en la consulta: " . $conexion->error;
    }
}

$conexion->close();
?>
