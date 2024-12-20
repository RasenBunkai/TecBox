<?php
// Conexión a la base de datos
include '../../config/database.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: Index.php");
    exit; // Evitar que el resto del código se ejecute
}

$conn = conexion::conectar(); // Usar el método conectar() de la clase conexion

// Consulta para obtener los datos de la tabla Entradas junto con los nombres de usuarios y productos
$query = "
    SELECT 
        e.ID_Usuarios, 
        u.Username, 
        e.ID_Productos, 
        p.Nombre, 
        e.Accion, 
        e.Fecha_Accion 
    FROM 
        Entradas e
    JOIN 
        Usuarios u ON e.ID_Usuarios = u.ID_Usuario
    JOIN 
        Productos p ON e.ID_Productos = p.ID_Producto
";

$result = $conn->query($query);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecBox | Movimientos</title>
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
        <h2 class="text-2xl text-center font-bold mb-4">Movimientos</h2>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2">Usuario</th>
                    <th class="py-2">Producto</th>
                    <th class="py-2">Acción</th>
                    <th class="py-2">Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td class="border px-4 py-2"><?php echo $row['Username']; ?></td>
                        <td class="border px-4 py-2"><?php echo $row['Nombre']; ?></td>
                        <td class="border px-4 py-2"><?php echo $row['Accion']; ?></td>
                        <td class="border px-4 py-2"><?php echo $row['Fecha_Accion']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>


<!-- Paginación -->
<div class="flex justify-center mt-4 mb-24">
    <?php
    // Número de resultados por página
    $results_per_page = 10;

    // Número total de resultados
    $total_results = $result->num_rows;

    // Número total de páginas
    $total_pages = ceil($total_results / $results_per_page);

    // Página actual
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Índice del primer resultado en la página actual
    $start_index = ($current_page - 1) * $results_per_page;

    // Consulta con límite para la paginación
    $query .= " LIMIT $start_index, $results_per_page";
    $result = $conn->query($query);

    // Mostrar enlaces de paginación
    for ($page = 1; $page <= $total_pages; $page++) {
        echo '<a href="?page=' . $page . '" class="mx-2 px-4 py-2 border rounded ' . ($page == $current_page ? 'bg-blue-500 text-white' : '') . '">' . $page . '</a>';
    }
    ?>
</div>
<?php include_once "../components/Footer.php"; ?>
</body>
</html>