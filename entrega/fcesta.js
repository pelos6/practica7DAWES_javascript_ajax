function enviarFormulario() {
    var usuario = document.getElementById("usuario").value;
    var password = document.getElementById("password").value;
    console.log("en enviarFormulario");
    // Aquí se hace la llamada a la función registrada de PHP
    var respuesta = xajax.request({xjxfun: "validarLogin"}, {mode: 'synchronous', parameters: [usuario, password]});
    if (respuesta == false) {
        alert("Nombre de usuario y/o contraseña no válidos.");
    }
    return respuesta;
}
function vaciarCesta() {
    console.log('en la funcion ');
    xajax_vaciarCesta();
    xajax_mostrarCesta();
    return false;
}
function alaCesta(codigo) {
   // console.log('en la funcion alaCesta ' + codigo);
    // llamada sincronizada
    // var respuesta = xajax.request({xjxfun:"alaCesta"}, {mode:'synchronous', parameters: [codigo]});
    // return respuesta;
    // llamada no sincronizada
    xajax_alaCesta(codigo);
    xajax_mostrarCesta();
    return false;
}
function mostrarCesta() {
   // console.log('en la funcion mostrarCesta ');
    // llamada sincronizada
    // var respuesta = xajax.request({xjxfun:"alaCesta"}, {mode:'synchronous', parameters: [codigo]});
    // return respuesta;
    // llamada no sincronizada
    xajax_mostrarCesta();
    return false;
}