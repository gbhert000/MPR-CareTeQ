//     var get_ID="";
//     var patient = new Object();
//     function editPost($id){
//         // alert($id);
//         $('#titleError').text('');
//         $('#descriptionError').text('');
//         $('#viewPatientModal').modal('show');
//         $.ajax({
//             url: `home/`+$id,
//             method: "GET",
//             success: function(response) {

//                 $patientCode=response.CODE;
//                 if(response) {
//                   console.log(response.data);
//                   $obj=JSON.stringify(response);
//                   $("#U_FIRSTNAME").val(response.U_FIRSTNAME);
//                 //   $("#U_LASTNAME").val(response.U_LASTNAME);
//                 //   $("#regCountry1val").val(response.U_COUNTRY);
//                   $("#U_MIDDLENAME").val(response.U_MIDDLENAME);
//                   $("#bday1").val(response.U_BIRTHDATE);
//                   $("#hiddenInput").val($patientCode);
//                   $("#U_MIDDLENAME").val(response.U_MIDDLENAME);
//                 //   $("#U_MIDDLENAME").val(response.U_MIDDLENAME);
//                 //   $("#U_MIDDLENAME").val(response.U_MIDDLENAME);
//                   $('#regCountry1 option:selected').text(response.U_COUNTRY);
//                   $('#regProvince1 option:selected').text(response.U_PROVINCE);
//                   $('#regMunicipality11 option:selected').text(response.U_CITY);
//                   $('#regBarangay1 option:selected').text(response.U_BARANGAY);
//                   get_ID=response.CODE;
//                    patient = {
//                     fname: response.U_FIRSTNAME,
//                     lname: response.U_LASTNAME,
//                     mname: response.U_MIDDLENAME,
//                     bday: response.U_BIRTHDATE,

                    
//                   }

//                   // $("#title").val(response.title);
//                   // $("#description").val(response.description);
                 
//                 }
//             }  
//           });
//     }

//     function updatePatient(){
//         // alert(get_ID);
//         var csrf = document.querySelector('meta[name="csrf-token"]').content;
//         $.ajax({
//             // alert('asd');
//             url:  '/update',
//             data: {page : get_ID, data: patient, '_token': csrf},
//             method: "POST",
// 			success: function(data) {
//                 // alert('as');
// 			}
//     });
// }


    
// $(document).ready(function(){
    
  

      

// });

        
