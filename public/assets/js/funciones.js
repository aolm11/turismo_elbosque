function comprobarForm() {
  var ok = document.getElementById("idNombreRegistro").value != ""    &&
           document.getElementById("idApellidosRegistro").value != ""  &&
           document.getElementById("idTlfRegistro").value != ""    &&
           document.getElementById("idDniRegistro").value != ""    &&
           document.getElementById("idPasswordRegistro").value != ""    &&
           document.getElementById("idEmailRegistro").value != ""    &&
           document.getElementById("idLocalidadRegistro").value != "" &&
           document.getElementById("idPasswordRepeatRegistro").value != "" &&
           document.getElementById("idPasswordRegistro").value == document.getElementById("idPasswordRepeatRegistro").value; //TODO comprobar que las contraseñas coinciden
  if (ok) {
   document.getElementsByName("btnRegistro")[0].disabled = false;
 }else {
   document.getElementsByName("btnRegistro")[0].disabled = true;
 }
}

Array.prototype.getKeyValue = function(v) {
    for(var prop in this ) {
        if( this.hasOwnProperty( prop ) ) {
             if( this[prop] === v )
                 return prop;
        }
    }
}

//http://librosweb.es/libro/bootstrap_3/capitulo_5/estados_de_formulario.html

// Hacer esta funcion con id como parametro, y modificar la clase del div padre con parentNode.className
function comprobarInput(id){
  if (document.getElementById(id).value == "") {  // Compruebo nombre
    document.getElementById(id).parentNode.className = "form-group has-error";
    document.getElementById(id+"Ayuda").setAttribute("class", "help-block");
  }else {
    document.getElementById(id).parentNode.className = "form-group";
    document.getElementById(id+"Ayuda").setAttribute("class", "oculto");
  }

  if(id == "idPasswordRepeatRegistro"){

    if (document.getElementById("idPasswordRegistro").value != document.getElementById("idPasswordRepeatRegistro").value) {
      document.getElementById(id).parentNode.className = "form-group has-error";
      document.getElementById(id+"Ayuda").innerHTML = "Las contraseñas no coinciden";
      document.getElementById(id+"Ayuda").setAttribute("class", "help-block");

    }else {
      document.getElementById(id).parentNode.className = "form-group";
      document.getElementById(id+"Ayuda").setAttribute("class", "oculto");
    }

    if (document.getElementById(id).value == "") {
      document.getElementById(id+"Ayuda").innerHTML = "Debe repetir la contraseña";
    }
  }
  comprobarForm();
}
