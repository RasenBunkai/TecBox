<?php

include '../../config/database.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: Index.php");
    exit; // Evitar que el resto del código se ejecute
}
$conn = conexion::conectar(); // Usar el método conectar() de la clase conexion

// Obtener el ID del producto desde la URL
$id_producto = $_GET['ID_Producto'];

// Consulta para obtener los datos del producto
$query = "SELECT * FROM productos WHERE ID_Producto = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_producto);
$stmt->execute();
$result = $stmt->get_result();
$producto = $result->fetch_assoc();

$stmt->close();

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['Nombre'];
    $precio = $_POST['Precio'];
    $caracteristicas = $_POST['Caracteristicas'];
    $requisicion = $_POST['Requisicion'];
    $partida_presupuestal = $_POST['Partida_Presupuestal'];
    $hora_entrada = $_POST['Hora_Entrada'];

    // Actualizar los datos en la base de datos
    $queryUpdate = "UPDATE productos SET Nombre = ?, Precio = ?, Caracteristicas = ?, Requisicion = ?, Partida_Presupuestal = ?, Hora_Entrada = ? WHERE ID_Producto = ?";
    $stmt = $conn->prepare($queryUpdate);
    $stmt->bind_param("sdssssi", $nombre, $precio, $caracteristicas, $requisicion, $partida_presupuestal, $hora_entrada, $id_producto);

    if ($stmt->execute()) {
        echo "<p class='text-green-500'>Producto actualizado exitosamente.</p>";
    } else {
        echo "<p class='text-red-500'>Error al actualizar el producto: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecBox | Editar Producto</title>
    <link rel="stylesheet" href="../../public/css/output.css">
</head>
<style>
    body {
        background-color: #f3f4f6;
    }
</style>
<body>
    <?php require_once "../components/NavBar.php"; ?>
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl text-center text-font-semibold mb-5">Editar Producto</h1>
        <form action="" method="post" class="max-w-lg mx-auto bg-white p-8 rounded shadow-md">
            <div class="mb-4">
                <label for="Nombre" class="block text-gray-700">Nombre</label>
                <input type="text" id="Nombre" name="Nombre" class="w-full px-3 py-2 border rounded" value="<?php echo $producto['Nombre']; ?>" required>
            </div>
            <div class="mb-4">
                <label for="Precio" class="block text-gray-700">Precio</label>
                <input type="number" id="Precio" name="Precio" step="0.01" class="w-full px-3 py-2 border rounded" value="<?php echo $producto['Precio']; ?>" required>
            </div>
            <div class="mb-4">
                <label for="Caracteristicas" class="block text-gray-700">Características</label>
                <textarea id="Caracteristicas" name="Caracteristicas" class="w-full px-3 py-2 border rounded" required><?php echo $producto['Caracteristicas']; ?></textarea>
            </div>
            <div class="mb-4">
                <label for="Requisicion" class="block text-gray-700">Requisición</label>
                <input type="text" id="Requisicion" name="Requisicion" class="w-full px-3 py-2 border rounded" value="<?php echo $producto['Requisicion']; ?>" required>
            </div>
            <div class="mb-4">
                <label for="Partida_Presupuestal" class="block text-gray-700">Partida Presupuestal</label>
                <input type="text" id="Partida_Presupuestal" name="Partida_Presupuestal" class="w-full px-3 py-2 border rounded" value="<?php echo $producto['Partida_Presupuestal']; ?>" required>
            </div>
            <div class="mb-4">
                <label for="Hora_Entrada" class="block text-gray-700">Hora de Entrada</label>
                <input type="time" id="Hora_Entrada" name="Hora_Entrada" class="w-full px-3 py-2 border rounded" value="<?php echo $producto['Hora_Entrada']; ?>" required>
            </div>
            <button type="submit" class=" bg-blue-500 text-white px-4 py-2 rounded">Actualizar Producto</button>
        </form>
    </div>
</body>
</html>