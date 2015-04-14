<?php

require_once('include/CestaCompra.php');
// Incluimos la librería Xajax
require_once('include/xajax_core/xajax.inc.php');
require_once('include/DB.php');
// Recuperamos la información de la sesión
session_start();
// Creamos el objeto xajax
$xajax = new xajax();

// Registramos la función que vamos a llamar desde JavaScript
$xajax->register(XAJAX_FUNCTION, "alaCesta");
$xajax->register(XAJAX_FUNCTION, "vaciarCesta");
$xajax->register(XAJAX_FUNCTION, "mostrarCesta");

// El método processRequest procesa las peticiones que llegan a la página
// Debe ser llamado antes del código HTML
$xajax->processRequest();

function vaciarCesta() {
    // borramos la sesión
    unset($_SESSION['cesta']);
    $cesta = new CestaCompra();
    $respuesta = new xajaxResponse();
    return $respuesta;
}

function alaCesta($producto) {
    error_log("DEBUG: a la cesta va " . $producto);
    // Recuperamos la cesta de la compra
    $cesta = CestaCompra::carga_cesta();
    $cesta->nuevo_articulo($producto);
    $cesta->guarda_cesta();
    $respuesta = new xajaxResponse();
    return $respuesta;
}

function mostrarCesta() {
    error_log("DEBUG: mostrarCesta");
    // Recuperamos la cesta de la compra
    $cesta = CestaCompra::carga_cesta();
    $respuesta = new xajaxResponse();
    if ($cesta->vacia()) {
        $respuesta->assign("botonVaciarCesta", "value", "Cesta Vacia");
        $respuesta->assign("botonVaciarCesta", "disabled", true);
        $respuesta->assign("comprarCesta", "disabled", true);
        $respuesta->assign("listaCesta", "innerHTML", '<p>Cesta vacía</p>');
    } else {
        $respuesta->assign("botonVaciarCesta", "value", "Vaciar cesta");
        $respuesta->assign("botonVaciarCesta", "disabled", false);
        $respuesta->assign("comprarCesta", "disabled", false);
        $productos = $cesta->get_productos();
        error_log("DEBUG: la cesta tiene  " . count($productos) . " productos");
        $texto = '';
        foreach ($cesta->get_productos() as $producto) {
            $texto = $texto . "<p>" . $producto->getCodigo() . "</p>";
        }
        $respuesta->assign("listaCesta", "innerHTML", $texto);
    }

    error_log("DEBUG:la cesta antes del for tiene  " . count($cesta));
    // recuperamos los productos de la cesta
    return $respuesta;
}
?>

