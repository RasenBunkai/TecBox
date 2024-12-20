<?php
    require_once '../../config/database.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password']; // Asegúrate de que el nombre del campo sea 'password'

        // Conexión a la base de datos
        $conn = conexion::conectar();

        // Consulta para verificar las credenciales del usuario
        $query = "SELECT * FROM Usuarios WHERE Email = ? ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && isset($user['PASSWORD']) && password_verify($password, $user['PASSWORD'])) {
            // Iniciar sesión
            $_SESSION['user_id'] = $user['ID_Usuario'];
            $_SESSION['username'] = $user['Username'];
            header("Location: Dashboard.php");
            exit();
        } else {
            $error = "Correo electrónico o contraseña incorrectos.";
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
    <title>TecBox | Inicia Sesión</title>
    <link rel="stylesheet" href="../../public/css/output.css">
</head>
<body class="flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('../../public/img/TecBackground.jpg'); backdrop-filter: blur(10px);">
    <!-- Contenedor principal -->
    <div class="flex max-w-4xl mx-auto w-full bg-gray-800 rounded-lg overflow-hidden shadow-lg">
        <!-- Sección izquierda: Formulario -->
        <div class="w-1/2 bg-gray-900 p-8">
            <h2 class="text-3xl font-bold text-white mb-6">¡Bienvenido 🗃️!</h2>
            <!-- Separador -->
            <div class="flex items-center my-6">
                <hr class="w-full border-gray-600">
                <hr class="w-full border-gray-600">
            </div>
            <!-- Formulario -->
            <form action="" method="POST">
                <div class="mb-4">
                    <label for="email" class="block text-gray-400">Email</label>
                    <input type="email" id="email" name="email" placeholder="Escribe tu email"
                        class="w-full px-4 py-2 mt-1 text-white bg-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-400">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="********"
                        class="w-full px-4 py-2 mt-1 text-white bg-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <?php if (isset($error)): ?>
                    <p class="text-red-500"><?php echo $error; ?></p>
                <?php endif; ?>
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Iniciar Sesión
                </button>
            </form>
            <p class="mt-6 text-sm text-gray-400">
                ¿No tienes cuenta? <a href="../views/Register.php" class="text-blue-500 hover:underline">Registrate</a>
            </p>
        </div>
        <!-- Sección derecha: Información -->
        <div class="w-1/2 bg-blue-500 p-8 flex flex-col justify-center">
            <div>
                <h2 class="text-3xl font-bold text-white mb-4">¿Qué es TecBox?</h2>
                <p class="text-white mb-4">
                    TecBox es una plataforma creada para Instituto Tecnológico de Cancún, con el objetivo de facilitar la
                    gestión del almacen.
                </p>
            </div>
        </div>
    </div>
</body>
</html>