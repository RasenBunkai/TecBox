<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecBox | Bienvenido </title>
    <link rel="stylesheet" href="../../public/css/output.css">
</head>
<style>
    body{background-color: #f3f4f6;}
</style>
<body>
    <?php require_once "../components/NavBarNoAuth.php";?>
    <h1 class="text-4xl text-center mt-7">Simplifica tu gestión con nuestra Bitácora Digital</h1>
    <h2 class="text-center mt-5 font-semibold text-lg">¿Qué puedes hacer con TecBox?</h2>
    <div class="flex container gap-5 mx-auto my-10">
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
            <img class="rounded-t-lg" src="../../public/img/Graduados.jpg" alt="" />
            <div class="p-5">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Registra entradas y salidas fácilmente</h5>       
                <p class="mb-3 font-normal text-gray-700">Mantén un control detallado de cada producto o artículo con un registro sencillo e intuitivo. Con nuestra plataforma, puedes capturar información como características del producto, precio, departamento solicitante, horarios y el nombre del responsable de manera rápida y sin complicaciones.</p>
            </div>
        </div>
          <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
            <img class="rounded-t-lg object-cover h-48 w-full" src="../../public/img/TEC.jpg" alt="" />
            <div class="p-5">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Crea perfiles y administra usuarios</h5>       
                <p class="mb-3 font-normal text-gray-700">Adapta la aplicación a tus necesidades específicas con opciones para gestionar usuarios de forma personalizada. Desde un perfil administrador, podrás crear y editar cuentas de usuarios, asignar roles y establecer niveles de acceso.</p>
            </div>
        </div>
          <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
            <img class="rounded-t-lg object-cover h-48 w-full" src="../../public/img/TecBackGround.jpg" alt="" />
            <div class="p-5">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Accede a registros en tiempo real</h5>       
                <p class="mb-3 font-normal text-gray-700">Consulta y supervisa toda la información de tu bitácora desde cualquier lugar y en cualquier momento. Nuestra herramienta te permite filtrar, buscar y visualizar los datos actualizados al instante, asegurando que siempre tengas la información más reciente al alcance de tus manos.</p>
            </div>
        </div>
    </div>
    <?php require_once "../components/Footer.php";?>

</body>
</html>