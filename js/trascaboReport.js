

function saveReport(accion) {
    var selectedValues = [];

   var  accionSend = accion

    var radioGroups = document.querySelectorAll('#formTrascabo input[type="radio"]:checked');
    var inputsTxt = document.querySelectorAll('#formTrascabo input[type="text"]');
    var inputsNum = document.querySelectorAll('#formTrascabo input[type="number"]');
    var inputsSelect = document.querySelectorAll('#formTrascabo select');
    var inputsDate = document.querySelectorAll('#formTrascabo  input[type="date"]');

    radioGroups.forEach(function(radio) {
        selectedValues.push({
            name: radio.name,
            value: radio.value
          });
    });
    inputsTxt.forEach(function(input) {
        selectedValues.push({
          name: input.name,
          value: input.value
        });
      });
      inputsNum.forEach(function(input) {
        selectedValues.push({
          name: input.name,
          value: input.value
        });
      });
      inputsSelect.forEach(function(radio) {
        selectedValues.push({
            name: radio.name,
            value: radio.value
          });
    });
    inputsDate.forEach(function(radio) {
      selectedValues.push({
          name: radio.name,
          value: radio.value
        });
  })
      selectedValues.push({
        name: "accion",
        value: accionSend
      });
      var jsonString = JSON.stringify(selectedValues);
      var parsedValues = JSON.parse(jsonString);

    console.log('Selected Values:', parsedValues.find(item => item.name === 'fullName')?.value);
  
  
  

    fetch('../includes/trascaboValidations.php', {
        method: 'POST', 
        headers: {
          'Content-Type': 'application/json',
        },
        body: jsonString,
      })
        .then(response => response.json())
        .then(data => {
          if(data === "success"){
            Swal.fire({
              icon: 'success',
              title: 'Datos ingresados correctamente',
          }).then(() => {
              location.reload();
          });
          }
          if(data === "success_check"){
            Swal.fire({
              icon: 'success',
              title: 'Formulario actualizado',
          }).then(() => {
              window.location.assign("../views/trascabo_consultas.php");
          });
          }
          if(data === "registered"){
            Swal.fire({
              icon: 'warning',
              title: 'Datos registrados previamente',
          });
          }
          if(data === "error"){
            Swal.fire({
              icon: 'error',
              title: 'Ocurrió un error al ingresar los datos. Intente de nuevo o contacte al administrador',
          });
          }
        })
        .catch(error => {
          // Handle errors during the fetch request
          console.error('Error during fetch:', error);
        });

}
$("#updateData").click(function (e) { 
  e.preventDefault();
  var requiredFields = document.querySelectorAll('[required]');

  // Flag to check if the form is valid
  var isValid = true;

  // Check if any required field is empty
  requiredFields.forEach(function (field) {
      // Check if the field is a radio button
      if (field.type === 'radio') {
          // Check if at least one radio button in the group is selected
          var radioGroup = document.getElementsByName(field.name);
          var isRadioSelected = Array.from(radioGroup).some(function (radio) {
              return radio.checked;
          });

          if (!isRadioSelected) {
              isValid = false;
          }
      } else {
          // Check if the field has a value
          if (!field.value.trim()) {
              // If the field is empty, set isValid to false
              isValid = false;
              // You can also add styles or other indicators for the user
              field.style.border = '1px solid red';
          } else {
              // Reset the style in case the user corrects the input
              field.style.border = '';
          }
      }
  });

// Display success message if the form is valid
if (isValid) {
  saveReport("editTrascabo");
} else {
  // Display a static error message
  alert('There are empty fields. Please fill in all required fields.');
}



});
$("#saveData").click(function (e) { 
    e.preventDefault();

    var requiredFields = document.querySelectorAll('[required]');

    // Flag to check if the form is valid
    var isValid = true;

    // Check if any required field is empty
    requiredFields.forEach(function (field) {
        // Check if the field is a radio button
        if (field.type === 'radio') {
            // Check if at least one radio button in the group is selected
            var radioGroup = document.getElementsByName(field.name);
            var isRadioSelected = Array.from(radioGroup).some(function (radio) {
                return radio.checked;
            });

            if (!isRadioSelected) {
                isValid = false;
            }
        } else {
            // Check if the field has a value
            if (!field.value.trim()) {
                // If the field is empty, set isValid to false
                isValid = false;
                // You can also add styles or other indicators for the user
                field.style.border = '1px solid red';
            } else {
                // Reset the style in case the user corrects the input
                field.style.border = '';
            }
        }
    });

  // Display success message if the form is valid
  if (isValid) {
    saveReport("report_trascabo");
} else {
    // Display a static error message
    Swal.fire({
      icon: 'error',
      title: 'Completa todos los campos',
  });
}

  
   
});
$("#delData").click(function (e) { 
  e.preventDefault();
  saveReport("delTrascabo");
});
$("#exitForm").click(function (e) { 
  e.preventDefault();
  window.location.assign("../views/index.php");
});
$("#goReports").click(function (e) { 
  e.preventDefault();
  window.location.assign("../views/trascabo_consultas.php");
});