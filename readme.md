# Practica 7 DAWES php con javascript y ajax 

Parto del ejemplo de la tienda que tiene el login ya con ajax.
Ejemplo Tema 7: Login Tienda Web utilizando Xajax
C:\Users\Javier\Dropbox\CicloFormativoGradoSuperior\DAW_DWES\tema_7_WebDinamica_JavaScript\R20
En todas las pantallas hay que poner las librerias de xajax e inicializar el objeto xajax

1. login.php
   - Tengo que cambiar algunas cosas para evitar notice en el log que me gusta que el log quede limpio.

2. productos.php
   - Cambio el action del formulario de productos para que llame a una función javascript alaCesta que esta en fcesta.js
   - Cambio el botón de vaciar cesta para que llame a una función javascript vaciarCesta que esta en fcesta.js
   - Registro las funciones que voy a usar
   - Meto el javascript que necesito con printJavascript

3. fcesta.js
   - Las funciones llaman a las creadas por xajax que tienen nombre xajax_ y nombre de la función original
   - Ademas activan botones si es necesario
   - Estan las funciones del login y de productos
 
4. fcesta.php
   - Las funciones llaman a las creadas por xajax que tienen nombre xajax_ y nombre de la función original
   - Mostrar cesta se encarga de mostrar los productos y activar los botones
