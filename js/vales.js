
document.addEventListener('DOMContentLoaded', function () {
    var idEmpleado = document.getElementById("id_empleado");
    var fecha = document.getElementById("dia");
    var filtro = document.getElementById("filtro");
    var excel = document.getElementById("excel");
    var dataOfTable = [];
    function handleInputChange() {
        if(fecha.value !== "" && idEmpleado.value !== ""){
            dataofTable(fecha.value, idEmpleado.value);
        }
       else{
        Swal.fire({
            title: 'Completa el formulario para filtrar datos',
            icon: 'info',
            confirmButtonText: 'OK'
          });
       }
    }

    filtro.addEventListener('click', handleInputChange);
    excel.addEventListener('click', printData);
    function dataofTable(fechaValue, idEmpleadoValue) {
        console.log("Fecha changed:", fechaValue);
        console.log("IdEmpleado changed:", idEmpleadoValue);

        var dataForm = new FormData();
        dataForm.append('accion', 'filtar_tbl');
        dataForm.append('idEmp', idEmpleadoValue);
        dataForm.append('fecha', fechaValue);
        
        fetch('../includes/functions.php',{
            method: 'POST',
            body: dataForm,
        }).then(response => response.json())
        .then(data => {
            if ($.fn.DataTable.isDataTable('#dataTable')) {
                $('#dataTable').DataTable().destroy();
              }
            $('#dataTable').DataTable({
                data: data,
                columns: [
                  { data: 'folio' },
                  { data: 'nombre', render: function(data, type, row) {
                      return data + ' ' + row.apellido; // Combine nombre and apellido for the "Empleado" column
                    }
                  },
                  { data: 'area' },
                  { data: 'puesto' },
                  { data: 'cantidad' },
                  { data: 'descripcion' },
                  { data: 'fecha' },
                  { 
                    data: null, // Use null for a custom column
                    render: function(data, type, row) {
                      return `
                        <td>
                          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal${row.id}">
                            <i class="fa fa-edit"></i>
                          </button>
                          <a href="#" class="btn btn-danger btn-del">
                            <i class="fa fa-trash"></i>
                          </a>
                        </td>`;
                    }
                  }
                ],
                rowCallback: function(row, data, index) {
                    // Attach click event to the delete button
                    $('a.btn-del', row).on('click', function(e) {
                      e.preventDefault(); // Prevent the default anchor tag behavior
          
                      // Use SweetAlert for confirmation
                      Swal.fire({
                        title: '¿Estás seguro?',
                        text: 'Esta acción eliminará el registro. ¿Deseas continuar? ',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          // If the user confirms, navigate to the delete URL
                          window.location.href = "../includes/eliminar_val.php?id=" + data.id;
                        }
                      });
                    });
                    $.get('editar_val.php?id=' + data.id, function(response) {
                        $(row).append(response);
                      });
                  }
              });
              
              //pasar datos a arreglo
              dataOfTable = [];
              var currentRow = 12;
              for (let i = 0; i < data.length; i++) {
                currentRow =  currentRow + i;
                dataOfTable.push({
                    row: currentRow,
                    data: data[i]
                })
              }
           
            });
    }
    function printData() { 
        fetch('../static/almacenForms.xlsx')
        .then(res => {
            if (!res.ok) {
                throw new Error(`Failed to fetch workbook (${res.status} ${res.statusText})`);
            }
            return res.arrayBuffer();
        })
        .then(ab => {
            const workbook = new ExcelJS.Workbook();
            return workbook.xlsx.load(ab).then(() => {
                // Use the accumulated data here
                var nombre =`${dataOfTable[0].data["nombre"]}, ${dataOfTable[0].data["apellido"]}`   ;
                var folio = dataOfTable[0].data["folio"]
                var puesto = dataOfTable[0].data["puesto"]
                var area = dataOfTable[0].data["area"]
                var fecha = dataOfTable[0].data["fecha"]
                dataOfTable.forEach((item, index) => {
                    const worksheet = workbook.getWorksheet('Vale de resguardo');
                    //header data
                    worksheet.getCell(`B7`).value = nombre;
                    worksheet.getCell(`H6`).value = folio;
                    worksheet.getCell(`B8`).value = puesto;
                    worksheet.getCell(`H8`).value = area;
                    worksheet.getCell(`H7`).value = fecha;
                    //datos
                    worksheet.getCell(`A${item.row}`).value = item.data["cantidad"];
                    worksheet.getCell(`B${item.row}`).value = item.data["descripcion"];
                    workbook.eachSheet(sheet => {
                        if (sheet !== worksheet) {
                          workbook.removeWorksheet(sheet.id);
                        }
                      });
                });
           
                return workbook.xlsx.writeBuffer();
            });
        }).then(buffer => {
            var startDate = new Date($("#start").val());
            var endDate = new Date(startDate);
            endDate.setDate(endDate.getDate() + 7);
            var formattedEndDate = endDate.toLocaleDateString();
            const blob = new Blob([buffer], {
                type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            });
            const downloadLink = document.createElement('a');
            downloadLink.href = URL.createObjectURL(blob);
            downloadLink.download = `ReporteVales-${$("#start").val()}.xlsx`;
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle the error, e.g., display an error message to the user
        });

     }
});





