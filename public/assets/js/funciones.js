function comprobarForm() {
  var ok = document.getElementById("nombre").value != ""    &&
           document.getElementById("apellidos").value != ""  &&
           document.getElementById("telefono").value != ""    &&
           document.getElementById("email").value != ""    &&
           document.getElementById("password").value != "" &&
           document.getElementById("password2").value != "" &&
           document.getElementById("password").value == document.getElementById("password2").value; //TODO comprobar que las contraseñas coinciden
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
    var help = "#"+id+"Ayuda";
  if (document.getElementById(id).value == "") {  // Compruebo nombre
    document.getElementById(id).parentNode.className = "form-group has-error";
    //document.getElementById(id+"Ayuda").setAttribute("class", "help-block");
    $(help).fadeIn();
  }else {
    document.getElementById(id).parentNode.className = "form-group";
    //document.getElementById(id+"Ayuda").setAttribute("class", "oculto");
    $(help).fadeOut();
  }

  if(id == "password2"){

    if (document.getElementById("password").value != document.getElementById("password2").value) {

      document.getElementById(id).parentNode.className = "form-group has-error";
      document.getElementById(id+"Ayuda").innerHTML = "Las contraseñas no coinciden";
      $(help).fadeIn();

        //document.getElementById(id+"Ayuda").setAttribute("class", "help-block");

    }else {
      document.getElementById(id).parentNode.className = "form-group";
      $(help).fadeOut();

        //document.getElementById(id+"Ayuda").setAttribute("class", "oculto");
    }

    if (document.getElementById(id).value == "") {
      document.getElementById(id+"Ayuda").innerHTML = "Debe repetir la contraseña";
    }
  }
  comprobarForm();
}
