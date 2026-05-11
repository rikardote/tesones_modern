$('#register').click(function(){
  
    var frmrfc = $('#rfc').val();
    var frmtipo = $('#tipo').val();
    var frmsexo = $('#sexo').val();
    var frmnombres = $('#nombres').val();
    var frmapellido1 = $('#apellido1').val();
    var frmapellido2 = $("#apellido2").val();
    var frmubicacion = $("#ubicacion").val();
    var frmcel = $("#cel").val();
    var frmphone = $("#phone").val();
    var frmaddress = $("#addresss").val();
    var frmbirth = $("#dob").val();
    var token = $("#token").val();

   
    
    var route = window.location+"/update";
    console.log(route);
    //var route = "http://192.168.1.95/incidencias/incidencias/capturar";
    //var route = "http://sistema.app/incidencias";
    //var route = "http://incidencias.app/incidencias/";
   //var route = "http://sissstema.com/incidencias";
    var dataString = 'codigo='+frmcodigo+'&empleado_id='+frmemployee+'&datepicker_inicial='+frmfecha_inicio+'&datepicker_final='+frmfecha_final+'&periodo_id='+frmperiodo+'&medico_id='+frmdmedico_id+'&diagnostico='+frmdiagnostico+'&datepicker_expedida='+frmexpedida+'&num_licencia='+frmnum_licencia+'&otorgado='+frmotorgado+'&pendientes='+frmpendientes; 
    $.ajax({
      url: route,
      headers: {'X-CSRF-TOKEN': token},
      type: 'POST',
      data: dataString,
           success: function(res) {
            console.log(res);
             moment.locale('es');
              $("#after_tr").empty();
              $(res).each(function(key, value){
                var finicio = moment(value.fecha_inicio);
                var ffinal = moment(value.fecha_final);

                if (value.periodo==null) {
                  tablaDatos.append("<tr><td>"+value.qna+"/"+value.qna_year+"</td><td>"+value.code+"</td><td>"+finicio.format("L")+"</td><td>"+ffinal.format("L")+"</td><td>"+value.total_dias+"</td><td></td><td><button class='fa fa-times fa-2x' value='"+value.token+"/"+value.num_empleado+"/"+value.id+"/destroy'  OnClick='Eliminar(this);'></button></td></tr>");                  
                }
                else{
                  tablaDatos.append("<tr><td>"+value.qna+"/"+value.qna_year+"</td><td>"+value.code+"</td><td>"+finicio.format("L")+"</td><td>"+ffinal.format("L")+"</td><td>"+value.total_dias+"</td><td>"+value.periodo+"/"+value.periodo_year+"</td><td><button class='fa fa-times fa-2x' value='"+value.token+"/"+value.num_empleado+"/"+value.id+"/destroy'  OnClick='Eliminar(this);'></button></td></tr>"); 
                };
              });
               //$('#periodo').hide();
               $('#msj-success').fadeIn();
               $('#msj-success').delay(2000).fadeOut(800);
            
           },
             error: function (res) {
               swal({
                title: "Error!!... ",   
                text: res.responseText,   
                type: "error",   
                confirmButtonColor: "#DD6B55",   
                closeOnConfirm: false,
                timer: 3000
               });
             }
        });
       
  }); 