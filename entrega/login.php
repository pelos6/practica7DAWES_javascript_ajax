<?php
/**
 * Desarrollo Web en Entorno Servidor
 * Tema 7 : Aplicaciones web dinámicas: PHP y Javascript
 * Ejemplo Validación formulario con Xajax: form.php
 */

// Incluimos la librería Xajax
require_once('include/xajax_core/xajax.inc.php');

// Creamos el objeto xajax
$xajax = new xajax('include/valida.php');

// Registramos la función que vamos a llamar desde JavaScript
$xajax->register(XAJAX_FUNCTION,"validarLogin");

// Y configuramos la ruta en que se encuentra la carpeta xajax_js
$xajax->configure('javascript URI','./include/');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 7 : Aplicaciones web dinámicas: PHP y Javascript -->
<!-- Ejercicio: Formulario de Login con Xajax: login.php -->
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Ejemplo Tema 7: Login Tienda Web utilizando Xajax</title>
  <link href="tienda.css" rel="stylesheet" type="text/css">
  <!-- Incluimos el código JavaScript necesario -->
  <?php $xajax->printJavascript(); ?>
  <script type="text/javascript" src="fcesta.js"></script>
</head>

<body>
    <div id='login'>
    <!-- Cuando se vaya a enviar el formulario ejecutamos
           una función en JavaScript, que realiza la llamada a PHP -->
    <form id='datos' action='productos.php' method='post' onsubmit='return enviarFormulario();'>
    <fieldset >
        <legend>Login</legend>
        <!--para evitar un NOTICE en el error.log if (isset($error) ....-->
        <div><span class='error'><?php if (isset($error))echo $error; ?></span></div>
        <div class='campo'>
            <label for='usuario' >Usuario:</label><br/>
            <input type='text' name='usuario' id='usuario' maxlength="50" /><br/>
        </div>
        <div class='campo'>
            <label for='password' >Contraseña:</label><br/>
            <input type='password' name='password' id='password' maxlength="50" /><br/>
        </div>

        <div class='campo'>
            <!--para evitar equivocos con enviar de productos.php cambio enviar por enviarLogin-->
            <input type='submit' id='enviar' name='enviarLogin' value='Enviar' />
        </div>
    </fieldset>
    </form>
    </div>
</body>
</html>
