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
    // Se cambia el botón de Enviar y se deshabilita
    //  hasta que llegue la respuesta
//    xajax.$('enviar').disabled = true;
//    xajax.$('enviar').value = "Un momento...";

    // Aquí se hace la llamada a la función registrada de PHP
//    xajax_validarFormulario1 (xajax.getFormValues("datos"));
    xajax_vaciarCesta();

    return false;

}
function alaCesta(codigo) {
    console.log('en la funcion alaCesta ' + codigo);
    xajax.$('botonVaciarCesta').disabled = false;
    xajax.$('comprarCesta').disabled = false;
    // Se cambia el botón de Enviar y se deshabilita
    //  hasta que llegue la respuesta
//    xajax.$('enviar').disabled=true;
//    xajax.$('enviar').value="Un momento...";

    // Aquí se hace la llamada a la función registrada de PHP
//    xajax_validarFormulario1 (xajax.getFormValues("datos"));
    // Aquí se hace la llamada a la función registrada de PHP
    // var respuesta = xajax.request({xjxfun:"validarLogin"}, {mode:'synchronous', parameters: [usuario, password]});
    // sincronizada
    // var respuesta = xajax.request({xjxfun:"alaCesta"}, {mode:'synchronous', parameters: [codigo]});
    // return respuesta;
    // no sincronizada
    xajax_alaCesta(codigo);
    return false;

}