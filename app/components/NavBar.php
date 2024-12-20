<?php //session_start(); // Inicia la sesión ?>
<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
        <a href="../views/Dashboard.php" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="../../public/img/TecBoxLogo.png" class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">TecBox</span>
        </a>
        <div class="flex items-center space-x-6 rtl:space-x-reverse">
            <?php if (isset($_SESSION['username'])): ?>
                <span class="text-sm text-white dark:text-white">Hola, <?= htmlspecialchars($_SESSION['username']); ?></span>
                <a href="../controllers/logout.php" class="text-sm text-white dark:text-white hover:text-slate-800 hover:underline">Cerrar Sesión</a>
            <?php else: ?>
                <a href="../views/LogIn.php" class="text-sm text-white dark:text-white hover:text-slate-800 hover:underline">Iniciar Sesión</a>
                <a href="../views/Register.php" class="text-sm text-white dark:text-white hover:text-slate-800 hover:underline">Regístrate</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Segunda barra de navegación -->
<?php if (isset($_SESSION['username'])): ?>
<nav class="bg-gray-50 dark:bg-gray-700">
    <div class="max-w-screen-xl px-4 py-3 mx-auto">
        <div class="flex items-center">
            <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                <li>
                    <a href="../views/Dashboard.php" class="text-gray-900 dark:text-white hover:underline">DashBoard</a>
                </li>
                <li>
                    <a href="../views/Producto.php" class="text-gray-900 dark:text-white hover:underline">Productos</a>
                </li>
                <li>
                    <a href="../views/AgregarProducto.php" class="text-gray-900 dark:text-white hover:underline">Agregar Producto</a>
                </li>
                <li>
                    <a href="../views/Movimientos.php" class="text-gray-900 dark:text-white hover:underline">Movimientos</a>
                </li>
                <li>
                    <a href="../views/AgregarMovimientos.php" class="text-gray-900 dark:text-white hover:underline">Agregar Movimientos</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php endif; ?>
