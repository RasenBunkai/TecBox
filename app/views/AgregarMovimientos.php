<?php

include '../../config/database.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: Index.php");
    exit; // Evitar que el resto del código se ejecute
}
$conn = conexion::conectar(); // Usar el método conectar() de la clase conexion

// Consulta para obtener usuarios
$queryUsuarios = "SELECT ID_Usuario, Username FROM Usuarios";
$resultUsuarios = $conn->query($queryUsuarios);

// Consulta para obtener productos
$queryProductos = "SELECT ID_Producto, Nombre FROM Productos";
$resultProductos = $conn->query($queryProductos);

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ID_Usuarios = $_POST['ID_Usuarios'];
    $ID_Productos = $_POST['ID_Productos'];
    $Accion = $_POST['Accion'];
    $Fecha_Accion = $_POST['Fecha_Accion'];

    // Insertar datos en la base de datos
    $queryInsert = "INSERT INTO Entradas (ID_Usuarios, ID_Productos, Accion, Fecha_Accion) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($queryInsert);
    $stmt->bind_param("iiss", $ID_Usuarios, $ID_Productos, $Accion, $Fecha_Accion);

    if ($stmt->execute()) {
        echo "<script>alert('Movimiento agregado exitosamente');</script>";
    } else {
        echo "<script>alert('Error al agregar el movimiento');</script>";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecBox | Nuevos Movimientos</title>
    <link rel="stylesheet" href="../../public/css/output.css">
</head>
<style>
    body {
        background-color: #f3f4f6;
    }
</style>
<body>

    <?php require_once "../components/NavBar.php";?>
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl text-center text-font-semibold mb-5">Agregar Movimientos</h1>
        <form action="" method="post" class="max-w-lg mx-auto bg-white p-8 rounded shadow-md">
            <!-- Selección de Usuario -->
            <div class="mb-4">
                <label for="ID_Usuarios" class="block text-gray-700">Usuario</label>
                <select id="ID_Usuarios" name="ID_Usuarios" class="w-full px-3 py-2 border rounded" required>
                    <option value="" disabled selected>Seleccione un usuario</option>
                    <?php while ($usuario = $resultUsuarios->fetch_assoc()): ?>
                        <option value="<?php echo $usuario['ID_Usuario']; ?>">
                            <?php echo $usuario['Username']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <!-- Selección de Producto -->
            <div class="mb-4">
                <label for="ID_Productos" class="block text-gray-700">Producto</label>
                <select id="ID_Productos" name="ID_Productos" class="w-full px-3 py-2 border rounded" required>
                    <option value="" disabled selected>Seleccione un producto</option>
                    <?php while ($producto = $resultProductos->fetch_assoc()): ?>
                        <option value="<?php echo $producto['ID_Producto']; ?>">
                            <?php echo $producto['Nombre']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <!-- Campo de Acción -->
            <div class="mb-4">
                <label for="Accion" class="block text-gray-700">Acción</label>
                <select id="Accion" name="Accion" class="w-full px-3 py-2 border rounded" required>
                    <option value="" disabled selected>Seleccione una acción</option>
                    <option value="entrada">Entrada</option>
                    <option value="salida">Salida</option>
                </select>
            </div>
            <!-- Campo de Fecha de Acción -->
            <div class="mb-4">
                <label for="Fecha_Accion" class="block text-gray-700">Fecha de Acción</label>
                <input type="date" id="Fecha_Accion" name="Fecha_Accion" class="w-full px-3 py-2 border rounded" required>
            </div>
            <!-- Botón de envío -->
            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Agregar Movimiento</button>
            </div>
        </form>
    </div>
    <?php include_once "../components/Footer.php";?>
</body>
</html>
