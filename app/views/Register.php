<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecBox | Registrate</title>
    <link rel="stylesheet" href="../../public/css/output.css">
</head>
<body class="flex items-center justify-center min-h-screen"
        style="background-image: url('../../public/img/TecBackground.jpg'); backdrop-filter: blur(10px);">
    <!-- Contenedor principal -->
    <div class="flex max-w-5xl mx-auto w-full bg-gray-800 rounded-lg overflow-hidden shadow-lg">
        <!-- Sección izquierda: Formulario -->
        <div class="w-1/2 bg-gray-900 p-8">
            <h2 class="text-3xl font-bold text-white mb-6">Regístrate</h2>
            <!-- Separador -->
            <div class="flex items-center my-6">
                <hr class="w-full border-gray-600">
                <hr class="w-full border-gray-600">
            </div>
            <!-- Formulario -->
            <form action="../controllers/registro.php" method="POST">
                <div class="mb-4">
                    <label for="name" class="block text-gray-400">Escribe tu nombre</label>
                    <input type="text" id="name" name="Username" placeholder="Emiliano Salgado"
                        class="w-full px-4 py-2 mt-1 text-white bg-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-400">Escribe tu email</label>
                    <input type="email" id="email" name="email" placeholder="residencia@tecmn.com"
                        class="w-full px-4 py-2 mt-1 text-white bg-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="PASSWORD" class="block text-gray-400">Escribe tu Contraseña</label>
                    <input type="PASSWORD" id="PASSWORD" name="PASSWORD" placeholder="********"
                        class="w-full px-4 py-2 mt-1 text-white bg-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Checkboxes -->
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Crea tu cuenta
                </button>
            </form>
            <p class="mt-6 text-sm text-gray-400">
                ¿Ya tienes una cuenta? <a href="../views/LogIn.php" class="text-blue-500 hover:underline">Inicia Sesión</a>
            </p>
        </div>
        <!-- Sección derecha: Información -->
        <div class="w-1/2 bg-blue-500 p-8 flex flex-col justify-center">
            <div>
                <h2 class="text-3xl font-bold text-white mb-4">Simplifica tu gestión con nuestra Bitácora Digital</h2>
                <p class="text-white mb-4">
                    TecBox es una plataforma creada para Instituto Tecnológico de Cancún, con el objetivo de facilitar la
                    gestión del almacen.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
