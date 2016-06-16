function comprobarForm() {
  var ok = document.getElementById("nombre").value != ""    &&
           document.getElementById("apellidos").value != ""  &&
           document.getElementById("telefono").value != ""    &&
           document.getElementById("email").value != ""    &&
           document.getElementById("password").value != "" &&
           document.getElementById("password2").value != "" &&
           document.getElementById("password").value == document.getElementById("password2").value;
}

function comprobarInput(id){
    var help = "#"+id+"Ayuda";
  if (document.getElementById(id).value == "") {
    document.getElementById(id).parentNode.className = "form-group has-error";
    $(help).fadeIn();
  }else {
    document.getElementById(id).parentNode.className = "form-group";
    $(help).fadeOut();
  }

  if(id == "password2"){

    if (document.getElementById("password").value != document.getElementById("password2").value) {

      document.getElementById(id).parentNode.className = "form-group has-error";
      document.getElementById(id+"Ayuda").innerHTML = "Las contraseñas no coinciden";
      $(help).fadeIn();

    }else {
      document.getElementById(id).parentNode.className = "form-group";
      $(help).fadeOut();
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

function alertas(){
    window.setTimeout(function () {
        $("#message").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 4000);

    var mensages = document.getElementsByClassName('message');
    var segundos = mensages.length * 3000;
    window.setTimeout(function () {
        $(".message").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, segundos);
}
