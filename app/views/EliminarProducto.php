<?php
// Incluir conexión
include '../../config/database.php';

// Verificar si se envió el ID_Producto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ID_Producto'])) {
    $ID_Producto = intval($_POST['ID_Producto']); // Asegurarse de que sea un entero

    // Crear conexión
    $conexion = conexion::conectar();

    // Consulta para eliminar el producto
    $query = "DELETE FROM productos WHERE ID_Producto = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('i', $ID_Producto);

    if ($stmt->execute()) {
        // Redirigir a la página de productos con un mensaje de éxito
        header('Location: Producto.php?mensaje=Producto eliminado exitosamente');
        exit();
    } else {
        // Redirigir con un mensaje de error
        header('Location: Producto.php?error=Error al eliminar el producto');
        exit();
    }
} else {
    // Redirigir si no se recibe el ID_Producto
    header('Location: Producto.php?error=Solicitud inválida');
    exit();
}
?>
