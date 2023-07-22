  $(document).ready(function () {
      $("#start").change(function () {
          $("input:not(.selector  )").val('');
          $("select:not(.selector  )").val('');
          removeDataTableRows()
          html = "";
          $("#status").css("background-color", "");
          $("#mant").css("background-color", "");
          $("#mant").css("color", "");
          $("#status").css("color", "");
      })

      $("#type").change(function () {
          $("input:not(#type  )").val('');
          $("select:not(#type  )").val('');
          removeDataTableRows()
          html = "";
          $("#start").val("");
          $("#fin").val("");
          $("#status").css("background-color", "");
          $("#status").css("color", "");
          $("#mant").css("background-color", "");
          $("#mant").css("color", "");
          var typeForm = $("#type").val();
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
          if (typeForm == "1") {
              today = yyyy + '-' + mm + '-' + dd;
              $("#start").attr("max", today);
          }
          if (typeForm == "2") {
              mm = parseInt(mm) + 1
              today = yyyy + '-' + ("0" + mm) + '-' + (dd - 7);
              $("#start").attr("max", today);
          }
          if (typeForm == "3") {
              mm = parseInt(mm) + 1
              today = yyyy + '-' + ("0" + mm) + '-' + dd;
              $("#start").attr("max", today);
          }
      });
      $("#start").change(function () {
          var endDate = new Date($("#start").val());
          //default config reporte mensual
          if ($("#type").val() == 1) {
            const currentMonth = endDate.getMonth() + 1; 
          
            let futureMonth = currentMonth + 1;
          
            const yearOffset = Math.floor((futureMonth - 1) / 12);
            const newYear = endDate.getFullYear() + yearOffset;
          
            futureMonth = ((futureMonth - 1) % 12) + 1;
          
            endDate.setMonth(futureMonth - 1); 
            endDate.setFullYear(newYear);
            //
            var month = futureMonth
              var year = endDate.getFullYear();
              var day = endDate.getDate() + 1;
          }
          //si el reporte es semanal
          if ($("#type").val() == 2) {

              const lastDayOfMonth = new Date(
                  endDate.getFullYear(),
                  endDate.getMonth() + 1,
                  0
              ).getDate();
              var dayact = endDate.getDate()
              var day = dayact + 8;
              if (day > lastDayOfMonth) {
                  // Adjust the date to the next month
                  endDate.setMonth(endDate.getMonth() + 1);
                  day -= lastDayOfMonth;
              }
              var year = endDate.getFullYear();
              var month = endDate.getMonth() + 1;
          }


          //si el reporte es diario
          if ($("#type").val() == 3) {
            const lastDayOfMonth = new Date(
                endDate.getFullYear(),
                endDate.getMonth() + 1,
                0
            ).getDate();
            var dayact = endDate.getDate()
            var day = dayact + 1;
            if (day > lastDayOfMonth) {
                // Adjust the date to the next month
                endDate.setMonth(endDate.getMonth() + 1);
                day -= lastDayOfMonth;
            }
              var month = endDate.getMonth() + 1;
              var year = endDate.getFullYear();
          }
          if (day < 10) {
              day = '0' + day;
          }
          if (month < 10) {
              month = '0' + month;
          }

          end = year + '-' + month + '-' + day
          console.log(year + '-' + month + '-' + day)
          $("#fin").val(end);
      })
      $("#pdfgen").click(function (e) {
          e.preventDefault();
          fecha1 = $("#start").val();
          fecha2 = $("#fin").val();
          id = $("#id").val();
          mant = $("#mant").val();
          console.log(fecha1, fecha2, id, mant);
          let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,
                            width=600,height=300,left=100,top=100`;
          open(`../includes/reporte.php?fecha1=${fecha1}&fecha2=${fecha2}&idm=${id}&mant=${mant}`, 'test', params);

      })
      function fillDataTable(data) {
        console.log(data)
        if(data != 0){
        const transformedData = data.map(e => [
           e.nombre,
           e.fecha,
            e.horas_t,
            e.horas_in,
            e.horometraje_i,
           e.horometraje_f, 
            e.lugar_t, 
            e.fallo,
            e.hora_paro,
            e.hora_reinicio,
            e.gastos_falla,
            e.observacion,
            `<button type="button" id="ida" class="list btn btn-warning" data-id="${e.id_operador}" data-row="${e.id}" data-toggle="modal" data-target="#editar">
            <i class="fa fa-edit"></i></button>
            <a href="../includes/eliminar_inv.php?id=${e.id}" class="btn btn-danger btn-del">
            <i class="fa fa-trash"></i>`
        ]);
       
        // Initialize the datatable with the transformed data
        $('#dataTable').DataTable({
            "bDestroy": true,
          data: transformedData,
          "columnDefs": [
            { className: "id", "targets": [ 0 ] },
            { className: "fecha", "targets": [ 1 ] },
            { className: "horas_t", "targets": [ 2 ] },
            { className: "horas_in", "targets": [ 3 ] },
            { className: "horometraje_i", "targets": [ 4 ] },
            { className: "horometraje_f", "targets": [ 5 ] },
            { className: "lugar_t", "targets": [ 6 ] },
            { className: "fallo", "targets": [ 7 ] },
            { className: "hora_paro", "targets": [ 8 ] },
            { className: "hora_reinicio", "targets": [ 9 ] },
            { className: "gastos_falla", "targets": [ 10 ] },
            { className: "observacion", "targets": [ 11 ] },


          ],
 
        });
        }
    
    if(data == 0){
        removeDataTableRows();
    }
      }
      
      function removeDataTableRows() {
        $('#dataTable').DataTable().clear().draw();
      }
      
      $("#id").change(function () {
          //validate that there's an selected report type and date rate
          if ($('#type').val() != "" && $('#type').val() != null && $('#start').val() != '') {
              console.log($('#start').val());
              var maquinaSeleccionada = $(this).val();

              $.ajax({
                  url: "obtener_maquina.php",
                  type: "POST",
                  data: {
                      id: maquinaSeleccionada
                  },
                  dataType: "json",
                  success: function (data) {
                      $("#modelo").val(data.modelo);
                      $("#serie").val(data.serie);
                      $("#ubicacion").val(data.ubicacion);
                      $("#status").val(data.status);
                      $("#mant").val(data.mantenimiento);
                      $("#horas_t").val(data.total_horas_activas); // Actualizado a $("#horas_a")
                      $("#horas_in").val(data.total_horas_inactivas); // Actualizado a $("#horas_p")

                      if (data.total_horas_activas === null || data.total_horas_activas === "") {
                          $("#horas_t").val("0");


                      }
                      if (data.total_horas_inactivas === null || data.total_horas_inactivas === "") {
                          $("#horas_in").val("0");

                      }
                      horasCero = parseInt($("#horas_t").val());
                      horasAcumiuladas = parseInt((data.total_horas_activas))
                      if (horasAcumiuladas < 150 || horasCero < 150) {
                          $("#mant").val("En buen estado")
                          $("#mant").css("background-color", "#50C878");
                          $("#mant").css("color", "white");
                      }
                      if (horasAcumiuladas > 150 && horasAcumiuladas < 180 || horasCero > 150 && horasCero < 180) {
                          $("#mant").val("Puede requerir mantenimiento")
                          $("#mant").css("background-color", "#FFA500");
                          $("#mant").css("color", "white");
                      }
                      if (horasAcumiuladas > 180 || horasCero > 180) {
                          $("#mant").val("Mantenimiento requerido")
                          $("#mant").css("background-color", "#ff0000");
                          $("#mant").css("color", "white");
                      }
                      if (data.status === "Inactivo") {
                          $("#status").css("background-color", "red");
                          $("#status").css("color", "white");
                      } else if (data.status === "Activo") {
                          $("#status").css("background-color", "#50C878");
                          $("#status").css("color", "white");
                      } else {
                          $("#status").css("background-color", "");
                          $("#status").css("color", "");
                      }
                      //consulta la parte de tabla
                      var accion = "table";
                      var datos = new FormData();
                      datos.append("table", accion)
                      datos.append("fecha1", $("#start").val())
                      datos.append("fecha2", $("#fin").val())
                      datos.append("idm", $("#id").val())
                      fetch('obtener_maquina.php', {
                              method: 'POST',
                              body: datos
                          }).then(response => response.json())
                          .then(response => {
                              if (response != "0") {
                                 fillDataTable(response)
                                
      

                                //   $("#dataTable tbody").html(html);
                                  $('.btn-del').on('click', function (e) {
                                      e.preventDefault();
                                      const href = $(this).attr('href')

                                      Swal.fire({
                                          title: 'Estas seguro de eliminar este registro?',
                                          text: "¡No podrás revertir esto!!",
                                          icon: 'warning',
                                          showCancelButton: true,
                                          confirmButtonColor: '#3085d6',
                                          cancelButtonColor: '#d33',
                                          confirmButtonText: 'Si, eliminar!',
                                          cancelButtonText: 'Cancelar!',
                                      }).then((result) => {
                                          if (result.value) {
                                              if (result.isConfirmed) {
                                                  Swal.fire(
                                                      'Eliminado!',
                                                      'El registro fue eliminado.',
                                                      'success'
                                                  )
                                              }

                                              document.location.href = href;
                                          }
                                      })

                                  })
                                  $(".list").click(function (e) {

                                      $("#id_operador").val(parseInt($(this).data('id')))
                                      $("#fecha").val($(e.target).closest('tr').find(".fecha").html())
                                      $("#horas_to").val($(e.target).closest('tr').find(".horas_t").html())
                                      $("#horas_ina").val($(e.target).closest('tr').find(".horas_in").html())
                                      $("#horometrajes_i").val($(e.target).closest('tr').find(".horometraje_i").html())
                                      $("#horometrajes_f").val($(e.target).closest('tr').find(".horometraje_f").html())
                                      $("#lugar_t").val($(e.target).closest('tr').find(".lugar_t").html())
                                      $("#fallo").val($(e.target).closest('tr').find(".fallo").html())
                                      $("#hora_paro").val($(e.target).closest('tr').find(".hora_paro").html())
                                      $("#hora_reinicio").val($(e.target).closest('tr').find(".hora_reinicio").html())
                                      $("#gastos_falla").val($(e.target).closest('tr').find(".gastos_falla").html())
                                      $("#observacion").val($(e.target).closest('tr').find(".observacion").html())
                                      $("#idrow").val($(this).data('row'))
                                  })
                              } else {
                                  html = "";
                                  $("#dataTable tbody").html(html);
                              }
                          })
                  }
              });
          } else {
              new swal({
                  title: "Información incompleta",
                  text: "Elige un tipo de reporte y fecha valida",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
              })
              fillDataTable(0)


          }
      });
      //

  });