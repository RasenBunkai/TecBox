<?php
// Incluir el archivo de conexión
include '../../config/database.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: Index.php");
    exit; // Evitar que el resto del código se ejecute
}

if (isset($_SESSION['user_id'])) {
    $ID_Usuario = $_SESSION['user_id']; // Obtener el ID del usuario logueado
}

// Consulta 1: Contar productos
$sqlProductos = "SELECT COUNT(*) AS total_productos FROM productos";
$resultProductos = $conexion->query($sqlProductos);
$totalProductos = $resultProductos->fetch_assoc()['total_productos'] ?? 0;

// Consulta 2: Contar usuarios
$sqlUsuarios = "SELECT COUNT(*) AS total_Usuarios FROM usuarios";
$resultUsuarios = $conexion->query($sqlUsuarios);
$totalUsuarios = $resultUsuarios->fetch_assoc()['total_Usuarios'] ?? 0;

//Consulta 3: Sumar precios
$sqlSumaPrecios = "SELECT SUM(precio) AS total_precios FROM productos";
$resultSumaPrecios = $conexion->query($sqlSumaPrecios);
$totalPrecios = $resultSumaPrecios->fetch_assoc()['total_precios'] ?? 0;

// Consulta SQL para obtener datos de la tabla 'usuarios'
$sqlUsuarios = "SELECT Username, email, role FROM usuarios";
$resultUsuarios = $conexion->query($sqlUsuarios);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecBox | Dashboard</title>
    <link rel="stylesheet" href="../../public/css/output.css">
</head>
<style>
    body{background-color: #f3f4f6;}
</style>
<body>
    <?php require_once "../components/NavBar.php";?>
<div class="container mx-auto mt-10">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-3xl text-font-semibold mb-5">¡Bienvenido!</h1>
        <!-- Búsqueda -->
        <div class="relative w-full md:w-1/3">
            <input 
            type="text" 
            id="searchInput"
            placeholder="Buscar..." 
            class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <svg class="absolute right-3 top-3 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m2.35-7a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        
        <script>
            document.getElementById('searchInput').addEventListener('input', function() {
            var filter = this.value.toUpperCase();
            var rows = document.querySelectorAll('tbody tr');
            rows.forEach(function(row) {
                var cells = row.querySelectorAll('td');
                var match = false;
                cells.forEach(function(cell) {
                if (cell.textContent.toUpperCase().indexOf(filter) > -1) {
                    match = true;
                }
                });
                row.style.display = match ? '' : 'none';
            });
            });

            function filterTable(filter) {
            var rows = document.querySelectorAll('tbody tr');
            rows.forEach(function(row) {
                var cells = row.querySelectorAll('td');
                var match = false;
                cells.forEach(function(cell) {
                if (cell.textContent.indexOf(filter) > -1) {
                    match = true;
                }
                });
                row.style.display = match ? '' : 'none';
            });
            }
        </script>
    </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        <!-- Tarjeta 1 -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">Compras Totales</h3>
            <p class="text-3xl font-bold text-blue-600"><?= $totalPrecios; ?></p>
        </div>
        <!-- Tarjeta 2 -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">Usuarios registrados</h3>
            <p class="text-3xl font-bold text-green-600"><?= $totalUsuarios; ?></p>
        </div>
        <!-- Tarjeta 3 -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">Productos en Stock</h3>
            <p class="text-3xl font-bold text-yellow-600"> <?= $totalProductos; ?></p>
        </div>
    </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Usuario registrados</h2>
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 text-left">Nombre</th>
                <th class="px-4 py-2 text-left">Email</th>
                <th class="px-4 py-2 text-left">Rol</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Verificar si la consulta retornó resultados
            if ($resultUsuarios->num_rows > 0) {
                // Recorrer los resultados y mostrar cada fila en la tabla
                while ($row = $resultUsuarios->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='border px-4 py-2'>" . htmlspecialchars($row['Username']) . "</td>";
                    echo "<td class='border px-4 py-2'>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td class='border px-4 py-2'>" . htmlspecialchars($row['role']) . "</td>";
                    echo "</tr>";
                }
            } else {
                // Si no hay resultados, mostrar un mensaje
                echo "<tr><td colspan='3' class='text-center py-4'>No hay usuarios disponibles.</td></tr>";
            }
            ?>
        </tbody>
    </table>
        </div>
    </div>
</div>
 <?php require_once "../components/Footer.php"; ?>
</body>
</html>

