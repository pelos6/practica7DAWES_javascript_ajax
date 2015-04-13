<?php
require_once('include/DB.php');
require_once('include/CestaCompra.php');
// Incluimos la librería Xajax
require_once('include/xajax_core/xajax.inc.php');
//require_once('fcesta.php');
//// Creamos el objeto xajax
$xajax = new xajax('fcesta.php');
// Recuperamos la información de la sesión
session_start();

// Y comprobamos que el usuario se haya autentificado
if (!isset($_SESSION['usuario']))
    die("Error - debe <a href='login.php'>identificarse</a>.<br />");

// Recuperamos la cesta de la compra
$cesta = CestaCompra::carga_cesta();

// Comprobamos si se ha enviado el formulario de vaciar la cesta
if (isset($_POST['vaciar'])) {
    unset($_SESSION['cesta']);
    $cesta = new CestaCompra();
}

// Comprobamos si se quiere añadir un producto a la cesta
if (isset($_POST['enviar'])) {
    $cesta->nuevo_articulo($_POST['cod']);
    $cesta->guarda_cesta();
}

function creaFormularioProductos() {
    $productos = DB::obtieneProductos();
    foreach ($productos as $p) {
        //echo "<p><form id='" . $p->getcodigo() . "' action='productos.php' method='post'>";
        echo "<p><form id='" . $p->getcodigo() . "' action=\"javascript:void(null);\" onsubmit=\"alaCesta(this.id);\">";
        // Metemos ocultos los datos de los productos
        echo "<input type='hidden' name='cod' value='" . $p->getcodigo() . "'/>";
        echo "<input type='submit' name='enviar' value='Añadir'/>";
        echo $p->getnombrecorto() . ": ";
        echo $p->getPVP() . " euros.";
        echo "</form>";
        echo "</p>";
    }
}

function muestraCestaCompra($cesta) {
    echo "<h3><img src='cesta.png' alt='Cesta' width='24' height='21'> Cesta</h3>";
    echo "<hr/>";
    //$cesta->muestra();
    echo "<p id='listaCesta'>Cesta vacia.</p>";
//    echo "<form id='vaciar' action='productos.php' method='post'>";
    echo "<form id='vaciar' action=\"javascript:void(null);\" onsubmit=\"vaciarCesta();\">";
    echo "<input type='submit' id='botonVaciarCesta' name='botonVaciarCesta' value='Vaciar Cesta' ";
    if ($cesta->vacia())
        echo "disabled='true'";
    echo "/></form>";
    echo "<form id='comprar' action='cesta.php' method='post'>";
    echo "<input type='submit' id='comprarCesta' name='comprarCesta' value='Comprar' ";
    if ($cesta->vacia())
        echo "disabled='true'";
    echo "/></form>";
}

// Registramos la función que vamos a llamar desde JavaScript
$xajax->register(XAJAX_FUNCTION, "vaciarCesta");
$xajax->register(XAJAX_FUNCTION, "alaCesta");
// Y configuramos la ruta en que se encuentra la carpeta xajax_js
//$xajax->configure('javascript URI', './');
$xajax->configure('javascript URI', './include/');
//$xajax->configure('debug',true);
// El método processRequest procesa las peticiones que llegan a la página
// Debe ser llamado antes del código HTML
$xajax->processRequest();
/* fin para usar xajax */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 7 : Aplicaciones web dinámicas: PHP y Javascript -->
<!-- Ejercicio: Formulario de Login con Xajax: productos.php -->
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Ejercicio Tema 7: Listado de Productos utilizando Xajax</title>
        <link href="tienda.css" rel="stylesheet" type="text/css">
        <?php
        // Le indicamos a Xajax que incluya el código JavaScript necesario
        $xajax->printJavascript();
        ?>
        <script type="text/javascript" src="fcesta.js"></script>
    </head>

    <body class="pagproductos">

        <div id="contenedor">
            <div id="encabezado">
                <h1>Listado de productos</h1>
            </div>
            <!--para probar xajax-->
            <form id='datos' action="javascript:void(null);" onsubmit="vaciarCesta();">
                <input type='submit' id='enviar' name='enviar' value='Enviar' />
            </form>
            <!--fin para probar xajax-->
            <div id="cesta">
                <?php
                muestraCestaCompra($cesta);
                ?>
            </div>
            <div id="productos">
                <?php creaFormularioProductos(); ?>
            </div>
            <br class="divisor" />
            <div id="pie">
                <form action='logoff.php' method='post'>
                    <input type='submit' name='desconectar' value='Desconectar usuario <?php echo $_SESSION['usuario']; ?>'/>
                </form>        
            </div>
        </div>
    </body>
</html>
