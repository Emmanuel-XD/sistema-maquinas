  $(document).ready(function () {
    $("#type").change(function(){
        $("input:not(#type  )").val('');
        $("select:not(#type  )").val('');
        $("#start").val("");
        $("#fin").val("");
        $("#status").css("background-color", "");
        $("#status").css("color", "");
        var  typeForm = $("#type").val();
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth(); //January is 0!
        var yyyy = today.getFullYear();

                if (dd < 10) {
                dd = '0' + dd;
                }

                if (mm < 10) {
                mm = '0' + mm;
                } 
        if(typeForm == "1"){
            today = yyyy + '-' + mm + '-' + dd;
          $("#start").attr("max", today);
        }
        if(typeForm == "2"){
            mm = parseInt(mm) + 1
            today = yyyy + '-' +("0" + mm) + '-' + (dd - 7);
            $("#start").attr("max", today);
        }
        if(typeForm == "3"){
            mm = parseInt(mm) + 1
            today =  yyyy + '-' + ("0" + mm)  + '-' + dd;
            $("#start").attr("max", today);
        }
        });
        $("#start").change(function () {
            
            var endDate =  new Date($("#start").val());
            //default config reporte mensual
            var month = endDate.getMonth() + 2;
            var year =  endDate.getFullYear();
            var day = endDate.getDate() + 1;
            //si el reporte es semanal
            if($("#type").val() == 2){
                var month = endDate.getMonth() + 1;
                var day = endDate.getDate() + 8;
            }
            //si el reporte es diario
            if($("#type").val() == 3){
                var month = endDate.getMonth() + 1;
            }
                if (day < 10) {
                    day = '0' + day;
                    }
                if (month < 10) {
                    month = '0' + month;
                    } 

            end = year + '-' + month + '-' + day
            $("#fin").val(end);
        })

        $("#id").change(function() {
            //validate that there's an selected report type and date rate
            if ($('#type').val( )!= "" && $('#type').val() != null && $('#start').val() != ''){
                console.log($('#start').val( ));
            var maquinaSeleccionada = $(this).val();
           
            $.ajax({
                url: "obtener_maquina.php",
                type: "POST",
                data: {
                    id: maquinaSeleccionada
                },
                dataType: "json",
                success: function(data) {
                    $("#modelo").val(data.modelo);
                    $("#serie").val(data.serie);
                    $("#lugar_t").val(data.lugar_t);
                    $("#status").val(data.status);
                    $("#mant").val(data.mantenimiento);
                    $("#horas_t").val(data.total_horas_activas); // Actualizado a $("#horas_a")
                    $("#horas_in").val(data.total_horas_inactivas); // Actualizado a $("#horas_p")

                    if (data.status === "Inactivo") {
                        $("#status").css("background-color", "red");
                        $("#status").css("color", "white");
                    } else if (data.status === "Activo") {
                        $("#status").css("background-color", "green");
                        $("#status").css("color", "white");
                    } else {
                        $("#status").css("background-color", "");
                        $("#status").css("color", "");
                    }
                    //consulta la parte de tabla
                    var accion = "table";
                    var datos = new FormData();
                    datos.append("table", accion) 
                    datos.append("idm", $("#id").val())
                    fetch('obtener_maquina.php',{
                        method: 'POST',
                        body: datos          
                    }).then(response => response.json())
                    .then(response => {
                        let html = ``;
                        response.map(function(e){
                            html += `
                            <tr>
                                <td>${e.nombre}</td>
                                <td>${e.fecha}</td>
                                <td>${e.horas_t}</td>
                                <td>${e.horas_in}</td>
                                <td>${e.horometraje_i}</td>
                                <td>${e.horometraje_f}</td>
                                <td>${e.lugar_t}</td>
                                <td>${e.fallo}</td>
                                <td>${e.hora_paro}</td>
                                <td>${e.hora_reinicio}</td>
                                <td>${e.gastos_falla}</td>
                                <td>${e.observacion}</td>
                                <td>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editar${e.id}">
                                <i class="fa fa-edit"></i>
                                 </button>
                                <a href="../includes/eliminar_inv.php?id=${e.id}" class="btn btn-danger btn-del">
                                    <i class="fa fa-trash"></i>
                                </a>
                                </td>
                            </tr>
                          
                            `;
                        });
                        $("#dataTable tbody").html(html);

                    })
                }
            });
        }
        else{
            alert("completa los campos!!")
            $("#filtro-form")[0].reset();

        }
        });
        
  });