function vaciarCesta() {
    console.log('en la funcion ');
    xajax_vaciarCesta();
    return false;
}
function alaCesta(codigo) {
    console.log('en la funcion alaCesta ' + codigo);
    // activamos los botones 
    xajax.$('botonVaciarCesta').disabled = false;
    xajax.$('comprarCesta').disabled = false;
    // llamada sincronizada
    // var respuesta = xajax.request({xjxfun:"alaCesta"}, {mode:'synchronous', parameters: [codigo]});
    // return respuesta;
    // llamada no sincronizada
    xajax_alaCesta(codigo);
    return false;
}