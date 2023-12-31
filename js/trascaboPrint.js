 // imprimir valores en el excel 
 var date = "";
 $("#searchData").click(function (e) {
     e.preventDefault();

     data = new FormData();
     data.append('fecha', $("#start").val())
     data.append('maquina', $("#id_maquina").val())
     data.append('accion', 'fillTable')
     if ($("#start").val() === "" || $("#id_maquina").val() === "") {
         Swal.fire({
             icon: 'error',
             title: 'Error, datos incompletos',
             text: 'Rellene todos los campos antes de generar el informe semanal o quizas la fecha seleccionada no tiene los registros para generar reporte, se requieren todos los registros diarios de la semana para generar el reporte.',
         });
     } else {
         fetch("../includes/trascaboRegis.php", {
                 method: 'POST',
                 body: data,
             })
             .then(response => response.json())
             .then(data => {
                 if (data != "empty") {
                     $('#dataTable').DataTable().destroy();
                     $('#dataTable').DataTable({
                         data: data,
                         columns: [{
                                 data: 'date_register'
                             },
                             {
                                 render: function (data, type, row) {
                                     // Customize the content of the combined column with HTML
                                     return `${row.modelo} - ${row.name}`;
                                 }
                             },
                             {
                                 render: function (data, type, row) {
                                     // Customize the content of the 'test' column with HTML
                                     return `<button type="button" class="btn-edit btn btn-warning" data-toggle="modal" onclick="location.href='../views/trascabo_edit.php?id=${row.id}'"">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="btn-del btn btn-danger" data-toggle="modal" onclick="location.href='../includes/trascabo_delete.php?id=${row.id}'"">
                            <i class="fa fa-trash"></i>
                        </button>`;
                                 }
                             }
                             // Add more objects for each column in your data
                         ]
                     });
                 }
                 if (data === "empty") {
                     var dataTable = $('#dataTable').DataTable();

                     // Remove all rows except the first one (header row)
                     dataTable.clear().draw();;

                 }

             })
             .catch(error => {
                 // Handle errors during the fetch request
                 console.error('Error during fetch:', error);
             });

     }
 });
 $("#printExcel").click(function (e) {
     e.preventDefault();
     //verificar que la tabla tenga valores
     var dataTable = $('#dataTable').DataTable();
     // Check if DataTable has any rows
     if (dataTable.rows().count() >= 7) {
         //iniciar consultas para imprimir tablas
         data = new FormData();
         data.append('fecha', $("#start").val())
         data.append('maquina', $("#id_maquina").val())
         data.append('accion', "consultExcel");
         fetch("../includes/trascaboRegis.php", {
                 method: 'POST',
                 body: data,
             })
             .then(response => response.json())
             .then(data => {
                 const updatedData = [];

                 for (let i = 0; i < data.length; i++) {
                     for (const key in data[i]) {
                         if (data[i].hasOwnProperty(key)) {
                             data[i][key] = data[i][key] === "0" ? "✓" : data[i][key] === "1" ? "✗" : data[i][key];
                         }
                     }

                     const currentLetter = String.fromCharCode('D'.charCodeAt(0) + i);

                     // Add the updated data to the array
                     updatedData.push({
                         letter: currentLetter,
                         data: data[i]
                     });
                 }

                 return updatedData;
             })
             .then(updatedData => {
                 return fetch('../static/reporte.xlsx')
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
                             var name = updatedData[0].data["contractor_name"];
                             var serie = updatedData[0].data["serie"]
                             var modelo = updatedData[0].data["modelo"]
                             var month = updatedData[0].data["month"]
                             const monthName = getMonthName(parseInt(month));
                             var period = updatedData[0].data["period_date"]
                             var week = updatedData[0].data["week_number"]
                             updatedData.forEach((item, index) => {
                                 const worksheet = workbook.getWorksheet('TRASCABO');
                                 //header data
                                 // worksheet.getCell(`C6`).value = name;
                                 worksheet.getCell(`B8`).value = serie;
                                 worksheet.getCell(`K8`).value = modelo;
                                 worksheet.getCell(`B10`).value = monthName;
                                 worksheet.getCell(`J10`).value = period;
                                 worksheet.getCell(`D12`).value = `SEMANA: ${week}`;
                                 worksheet.getCell(`L2`).value = `${$("#start").val()}`;

                                 //FIRST
                                 worksheet.getCell(`${item.letter}15`).value = item.data["frontIntert"];
                                 worksheet.getCell(`K15`);
                                 worksheet.getCell(`${item.letter}16`).value = item.data["traTrab"];
                                 worksheet.getCell(`K16`);
                                 worksheet.getCell(`${item.letter}17`).value = item.data["dirDel"];
                                 worksheet.getCell(`K17`);
                                 worksheet.getCell(`${item.letter}18`).value = item.data["dirTra"];
                                 worksheet.getCell(`K18`);
                                 worksheet.getCell(`${item.letter}19`).value = item.data["stpTra"];
                                 worksheet.getCell(`K19`);

                                 //seccond
                                 worksheet.getCell(`${item.letter}21`).value = item.data["espLat"];
                                 worksheet.getCell(`K21`);
                                 worksheet.getCell(`${item.letter}22`).value = item.data["alarmRet"];
                                 worksheet.getCell(`K22`);
                                 worksheet.getCell(`${item.letter}23`).value = item.data["claxon"];
                                 worksheet.getCell(`K23`);
                                 worksheet.getCell(`${item.letter}24`).value = item.data["fserv"];
                                 worksheet.getCell(`K24`);
                                 worksheet.getCell(`${item.letter}25`).value = item.data["femer"];
                                 worksheet.getCell(`K25`);
                                 worksheet.getCell(`${item.letter}26`).value = item.data["dirSusp"];
                                 worksheet.getCell(`K26`);
                                 worksheet.getCell(`${item.letter}27`).value = item.data["cintSeg"];
                                 worksheet.getCell(`K27`);
                                 worksheet.getCell(`${item.letter}28`).value = item.data["vidFront"];
                                 worksheet.getCell(`K28`);
                                 worksheet.getCell(`${item.letter}29`).value = item.data["limpBris"];
                                 worksheet.getCell(`K29`);
                                 worksheet.getCell(`${item.letter}30`).value = item.data["extnt"];
                                 worksheet.getCell(`K30`);
                                 worksheet.getCell(`${item.letter}31`).value = item.data["asiento"];
                                 worksheet.getCell(`K31`);
                                 worksheet.getCell(`${item.letter}32`).value = item.data["indiHidra"];
                                 worksheet.getCell(`K32`);

                                 worksheet.getCell(`${item.letter}33`).value = item.data["motorRef"];
                                 worksheet.getCell(`K33`);

                                 worksheet.getCell(`${item.letter}34`).value = item.data["horometro"];
                                 worksheet.getCell(`K34`);

                                 worksheet.getCell(`${item.letter}35`).value = item.data["batCable"];
                                 worksheet.getCell(`K35`);


                                 worksheet.getCell(`${item.letter}37`).value = item.data["llantas"];
                                 worksheet.getCell(`K37`);


                                 worksheet.getCell(`${item.letter}39`).value = item.data["fugHidra"];
                                 worksheet.getCell(`K39`);


                                 worksheet.getCell(`${item.letter}40`).value = item.data["pasaSusp"];
                                 worksheet.getCell(`K40`);

                                 worksheet.getCell(`${item.letter}41`).value = item.data["fugAire"];
                                 worksheet.getCell(`K41`);

                                 worksheet.getCell(`${item.letter}42`).value = item.data["grapasAnc"];
                                 worksheet.getCell(`K42`);

                                 worksheet.getCell(`${item.letter}43`).value = item.data["cardam"];
                                 worksheet.getCell(`K43`);

                                 worksheet.getCell(`${item.letter}44`).value = item.data["AcoplesRap"];
                                 worksheet.getCell(`K44`);

                                 worksheet.getCell(`${item.letter}45`).value = item.data["mangueras"];
                                 worksheet.getCell(`K45`);

                                 worksheet.getCell(`${item.letter}46`).value = item.data["volco"];
                                 worksheet.getCell(`K46`);

                                 worksheet.getCell(`${item.letter}47`).value = item.data["gvolco"];
                                 worksheet.getCell(`K47`);

                                 worksheet.getCell(`${item.letter}48`).value = item.data["tCombu"];
                                 worksheet.getCell(`K48`);

                                 worksheet.getCell(`${item.letter}49`).value = item.data["mBomba"];
                                 worksheet.getCell(`K49`);

                             });

                             return workbook.xlsx.writeBuffer();
                         });
                     });
             })
             .then(buffer => {
                 var startDate = new Date($("#start").val());
                 var endDate = new Date(startDate);
                 endDate.setDate(endDate.getDate() + 7);
                 var formattedEndDate = endDate.toLocaleDateString();
                 const blob = new Blob([buffer], {
                     type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                 });
                 const downloadLink = document.createElement('a');
                 downloadLink.href = URL.createObjectURL(blob);
                 downloadLink.download = `reporteTrascabo-${$("#start").val()}.xlsx`;
                 document.body.appendChild(downloadLink);
                 downloadLink.click();
                 document.body.removeChild(downloadLink);
             })
             .catch(error => {
                 console.error('Error:', error);
                 // Handle the error, e.g., display an error message to the user
             });


     } else {
         // Replace the standard alert with SweetAlert
         Swal.fire({
             icon: 'error',
             title: 'Error, datos incompletos',
             text: 'La fecha seleccionada no tiene los registros para generar reporte, se requieren todos los registros diarios de la semana para generar el reporte',
         });

     }
 });


 function getMonthName(monthNumber) {
     switch (monthNumber) {
         case 1:
             return "enero";
         case 2:
             return "febrero";
         case 3:
             return "marzo";
         case 4:
             return "abril";
         case 5:
             return "mayo";
         case 6:
             return "junio";
         case 7:
             return "julio";
         case 8:
             return "agosto";
         case 9:
             return "septiembre";
         case 10:
             return "octubre";
         case 11:
             return "noviembre";
         case 12:
             return "diciembre";
         default:
             return "mes no válido"; // Return this if the month number is not 1-12
     }
 }
 $('.btn-del').on('click', function (e) {
     e.preventDefault();
 });
 $('.btn-edit').on('click', function (e) {
     e.preventDefault();
     var dataIdValue = this.getAttribute('data-id');

 });