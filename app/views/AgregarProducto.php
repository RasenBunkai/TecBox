<?php
include '../../config/database.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: Index.php");
    exit; // Evitar que el resto del código se ejecute
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['Nombre'];
    $precio = $_POST['Precio'];
    $caracteristicas = $_POST['Caracteristicas'];
    $requisicion = $_POST['Requisicion'];
    $partida_presupuestal = $_POST['Partida_Presupuestal'];
    $hora_entrada = $_POST['Hora_Entrada'];
    $hora_salida = $_POST['Hora_Salida'];
    $departamento_solicitante = $_POST['Departamento_Solicitante'];
    $responsable = $_POST['Responsable'];

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO productos (Nombre, Precio, Caracteristicas, Requisicion, Partida_Presupuestal, Hora_Entrada, Hora_Salida, Departamento_Solicitante, Responsable) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sdsssssss", $nombre, $precio, $caracteristicas, $requisicion, $partida_presupuestal, $hora_entrada, $hora_salida, $departamento_solicitante, $responsable);
    if ($stmt->execute()) {
        echo "<p class='text-green-500'>Producto agregado exitosamente.</p>";
    } else {
        echo "<p class='text-red-500'>Error al agregar el producto: " . $stmt->error . "</p>";
    }
    $stmt->close();
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecBox | Agregar Producto</title>
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
            <h1 class="text-3xl text-center text-font-semibold mb-5">Agregar Producto📦</h1>
            <form action="" method="post" class="max-w-lg mx-auto bg-white p-8 rounded shadow-md">
                <div class="mb-4">
                    <label for="Nombre" class="block text-gray-700">Nombre</label>
                    <input type="text" id="Nombre" name="Nombre" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label for="Precio" class="block text-gray-700">Precio</label>
                    <input type="number" id="Precio" name="Precio" step="0.01" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label for="Caracteristicas" class="block text-gray-700">Características</label>
                    <textarea id="Caracteristicas" name="Caracteristicas" class="w-full px-3 py-2 border rounded" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="Requisicion" class="block text-gray-700">Requisición</label>
                    <input type="text" id="Requisicion" name="Requisicion" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label for="Partida_Presupuestal" class="block text-gray-700">Partida Presupuestal</label>
                    <input type="text" id="Partida_Presupuestal" name="Partida_Presupuestal" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label for="Hora_Entrada" class="block text-gray-700">Hora de Entrada</label>
                    <input type="time" id="Hora_Entrada" name="Hora_Entrada" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label for="Hora_Salida" class="block text-gray-700">Hora de Salida</label>
                    <input type="time" id="Hora_Salida" name="Hora_Salida" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label for="Departamento_Solicitante" class="block text-gray-700">Departamento Solicitante</label>
                    <input type="text" id="Departamento_Solicitante" name="Departamento_Solicitante" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label for="Responsable" class="block text-gray-700">Responsable</label>
                    <input type="text" id="Responsable" name="Responsable" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Agregar Producto</button>
                </div>
            </form>
        </div>
<?php include_once "../components/Footer.php"; ?>
</body>
</html>