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

// El método processRequest procesa las peticiones que llegan a la página
// Debe ser llamado antes del código HTML
$xajax->processRequest();

function vaciarCesta($valores) {
////    error_log("DEBUG: " . $valores['nombre']);
//    error_log("DEBUG: " . $valores);
    $respuesta = new xajaxResponse();
//    $error = false;
//
//
//    $respuesta->assign("enviar", "value", "Enviar");
//    $respuesta->assign("enviar", "disabled", false);
    unset($_SESSION['cesta']);
    $cesta = new CestaCompra();
    if ($cesta->vacia()) {
        $respuesta->assign("botonVaciarCesta", "value", "Cesta Vacia");
        $respuesta->assign("botonVaciarCesta", "disabled", true);
        $respuesta->assign("comprarCesta", "disabled", true);
        $respuesta->assign("listaCesta", "innerHTML", '<p>Cesta vacía</p>');
    } else {
        $respuesta->assign("botonVaciarCesta", "value", "Vaciar cesta... ");
        $respuesta->assign("botonVaciarCesta", "disabled", false);
        $respuesta->assign("comprarCesta", "disabled", false);
    }
    return $respuesta;
}

function alaCesta($producto) {
    error_log("DEBUG: " . $producto);
    // Recuperamos la cesta de la compra
    $cesta = CestaCompra::carga_cesta();
    $productos = $cesta->get_productos();
    error_log("DEBUG:la cesta tiene  " . count($cesta));
    error_log("DEBUG:la cesta tiene  " . count($productos));
    $respuesta = new xajaxResponse();
    $cesta->nuevo_articulo($producto);
    $cesta->guarda_cesta();
    if ($cesta->vacia()) {
        $respuesta->assign("botonVaciarCesta", "value", "Cesta Vacia");
        $respuesta->assign("botonVaciarCesta", "disabled", true);
        $respuesta->assign("comprarCesta", "disabled", true);
    } else {
        $respuesta->assign("botonVaciarCesta", "value", "Vaciar cesta... ");
    }
    if ($cesta->vacia()) {
//        print "<p>Cesta vacía</p>";
        $respuesta->assign("listaCesta", "innerHTML", 'Cesta vacía');
        $respuesta->assign("botonVaciarCesta", "disabled", false);
        $respuesta->assign("comprarCesta", "disabled", false);
    }
    //  y si no está vacía, mostramos su contenido
    else {
        $cesta = CestaCompra::carga_cesta();
        error_log("DEBUG:la cesta antes del for tiene  " . count($cesta));
        $productos = $cesta->get_productos();
        error_log("DEBUG:la cesta antes del for tiene  " . count($productos));
        $texto = '';
        foreach ($cesta->get_productos() as $producto) {
            $texto = $texto . "<p>" . $producto->getCodigo() . "</p>";
        }
    }
    $respuesta->assign("listaCesta", "innerHTML", $texto);
//    $respuesta->assign("listaCesta", "innerHTML", $producto);
//    $cesta->muestra();
//    $error = false;
    return $respuesta;
}
?>

