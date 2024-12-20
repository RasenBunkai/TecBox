<?php
include '../../config/database.php';
include '../controllers/Roles.php';
$conn = conexion::conectar(); // Usar el método conectar() de la clase conexion
$ID_ROL=0;
// Parámetros de búsqueda y paginación
$search = isset($_GET['search']) ? $_GET['search'] : '';
$limit = 8; // Número de productos por página
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: Index.php");
    exit; // Evitar que el resto del código se ejecute
}

if (isset($_SESSION['user_id'])) {
    $ID_Usuario = $_SESSION['user_id']; // Obtener el ID del usuario logueado
}
$RolesAndUsers = RolesAndUsers::getAllRolesAndUsers($conexion, $ID_Usuario);
foreach ($RolesAndUsers as $RolesAndUser) {
    $ID_ROL= $RolesAndUser['ID_ROL'];
}
// Consulta SQL con búsqueda y paginación
$sql = "SELECT * FROM productos WHERE Nombre LIKE '%$search%' LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar productos
    $card = '';
    while($row = $result->fetch_assoc()) {
        $card .= '<div class="mb-5 max-w-xs w-full bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="../../public/img/TEC.jpg" class="w-full h-56 object-cover" alt="Producto">
                <div class="p-4">
                    <h5 class="text-xl font-semibold text-gray-800 truncate">'.$row['Nombre'].'</h5>
                    <p class="text-gray-600 text-sm mb-2">'.$row['Caracteristicas'].'</p>
                    <p class="text-gray-800 font-semibold text-lg mb-4">Precio: $'.$row['Precio'].'</p>';
             if ($ID_ROL == 1) {
                $card .= '<a href="DetalleProducto.php?ID_Producto='.$row['ID_Producto'].'" class="inline-block bg-blue-500 text-white text-sm font-semibold rounded-lg py-2 px-4 hover:bg-blue-600 transition duration-300">
                    Editar
                </a>
                <form action="EliminarProducto.php" method="POST" class="mt-2">
                    <input type="hidden" name="ID_Producto" value="'.$row['ID_Producto'].'">
                    <button type="submit" class="bg-red-500 text-white text-sm font-semibold rounded-lg py-2 px-4 hover:bg-red-600 transition duration-300">
                        Eliminar
                    </button>
                </form>';
            }

            $card .= '</div>
                    </div>';

            // '</div>
            // </div>';
    }
} else {
    echo "<p class='col-span-4 text-center text-gray-500'>No se encontraron productos.</p>";
}

// Obtener el número total de productos para la paginación
$sql_total = "SELECT COUNT(*) as total FROM productos WHERE Nombre LIKE '%$search%'";
$result_total = $conn->query($sql_total);
$total_rows = $result_total->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecBox | Productos</title>
    <link rel="stylesheet" href="../../public/css/output.css">
</head>
<body>
    <?php require_once "../components/NavBar.php"; ?>

    <div class="container mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-4">Productos</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php echo $card; ?>
        </div>

        <!-- Paginación -->
        <div class="mt-4">
            <?php if ($total_pages > 1): ?>
                <ul class="flex justify-center">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="mx-1">
                            <a href="Producto.php?page=<?php echo $i; ?>&search=<?php echo $search; ?>" class="px-3 py-2 border rounded-lg <?php echo $i == $page ? 'bg-blue-500 text-white' : 'bg-white text-blue-500'; ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>