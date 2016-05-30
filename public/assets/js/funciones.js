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

function crearDatePickers(fechas){

    $( "#entrada" ).datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: new Date(),
        beforeShowDay: function(date){
            var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
            return [ fechas.indexOf(string) == -1 ]
        }
    });
    $( "#salida" ).datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: new Date((new Date()).valueOf() + 1000*3600*24),
        beforeShowDay: function(date){
            var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
            return [ fechas.indexOf(string) == -1 ]
        }
    });
}

function actualizaMinDateSalidas(fechas){
    $("#entrada").change(function () {
        var select = $("#entrada").val();
        var result = select.split('-');
        var fecha = result[2]+'-'+result[1]+'-'+result[0];
        fecha = new Date(fecha);
        var man = fecha.setDate(fecha.getDate() + 1);
        man = new Date(man);
        $('#salida').datepicker("destroy");
        $( "#salida" ).datepicker({
            dateFormat: 'dd-mm-yy',
            minDate: man,
            beforeShowDay: function(date){
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                return [ fechas.indexOf(string) == -1 ]
            }
        });
    });
}
