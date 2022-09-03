$(document).ready(function(){

    //declaring of of the variables called for every funtions
    $("#centimeter").change(function(){

        calculateBMI();
     });
     $("#kg").change(function(){

        calculateBMI();
     });
     $("#kg").change(function(){

        convertionKilogramstoPounds();
     });

     $('#lb').change(function(){
        convertionPoundstoKilogram();
     });
     $('#centimeter').change(function(){
         convertionCentimeterstoInches();
     });
     $('#inch').change(function(){
         convertionInchestoCentimeter();
     });
     $('#lb').change(function(){
        convertionKilogramstoPounds();
     });
     $('#inch').change(function(){
        calculationBMI();
     });
     $('#lb').change(function(){
        calculationBMI();
     });
     $('#errorBtnOkay').click(function(){
        errorBtnOkay();
     });
     $('#sucessBtnOkay').click(function(){
        sucessBtnOkay();
     });
     $('#btnAttachment').click(function(){
        openAttachment();
     });
     $('#avatar').change(function(){
        fileSelected(this);
     });
     $('#btnUploadID').click(function(){
        openUploadID();
     });
     $('#upload_id').change(function(){
        photoSelected(this);
     });
     $('#upload_id').change(function () {
        filevalidate();
     });
     $('#avatar').change(function () {
        photoValidate();
     });

     function photoValidate() {
        $("#profile_error").html("");
        $(".demoInputBox").css("border-color","#F0F0F0");
        var file_size = $('#avatar')[0].files[0].size;
            if(file_size>1000000) {
                $("#profile_error").html("File size is greater than 1MB");
                $("#profile_error").css("color","#FF0000");
                return false;
            }

         return true;

}

     function filevalidate() {
        $("#file_error").html("");
        $(".demoInputBox").css("border-color","#F0F0F0");
        var file_size = $('#upload_id')[0].files[0].size;
            if(file_size>1000000) {
                $("#file_error").html("File size is greater than 1MB");
                $("#file_error").css("color","#FF0000");
                return false;
            }

         return true;

}

     //open file by calling id of the input
     function openAttachment() {
        document.getElementById('avatar').click();
      }

      //select a photo with displaying filename
      function fileSelected(input){
        document.getElementById('btnAttachment').value = "File: " + input.files[0].name
      }

      function openUploadID() {
        document.getElementById('upload_id').click();
      }

      function photoSelected(input){
        document.getElementById('btnUploadID').value = "File: " + input.files[0].name
      }

      //Close Success Dialog by clicking the okay button
      function sucessBtnOkay(){
        $('#successDialog').hide();
        window.location.href = "/home";
      }

     //Close Error Dialog by clicking the okay button
     function errorBtnOkay(){
       $('#errorDialog').hide();
     }

    //Automatic close the Dialog by 6 seconds
    //  window.setTimeout(function() {
    //     $(".alert").fadeTo(6000, 500).slideUp(1000, function(){
    //         $(this).remove();
    //     });
    // }, 2000);

 //calculation of cm and kg to BMI
 function calculateBMI () {
    var centimeter = $('#centimeter').val();
    var kg = $('#kg').val();
    var convertedbmi = parseFloat((kg/centimeter/centimeter) * 10000).toFixed(2);

     $('#bmi').val(convertedbmi);

}
     //convertion of Centimeter to Inches
     function convertionCentimeterstoInches () {
        var centimeter = $('#centimeter').val();

        if(centimeter >= 272){
            var convertedInches = parseFloat (272 / 2.54).toFixed(2);
        }
        if (centimeter <=272){
            var convertedInches = parseFloat (centimeter / 2.54).toFixed(2);
        }
        if(centimeter <=55){
            var convertedInches = parseFloat (55 / 2.54).toFixed(2);
        }
        $('#inch').val(convertedInches, 'inches');

    }

    //convertion of Inches to Centimeter
    function convertionInchestoCentimeter () {
        var inch = $('#inch').val();

        if(inch >= 107.09){
            var convertedcm = parseFloat (107.09 * 2.54 ).toFixed(2);
        }
        if(inch <= 107.09){
            var convertedcm = parseFloat (inch * 2.54 ).toFixed(2);
        }
        if(inch <= 21.65){
            var convertedcm = parseFloat (21.65 * 2.54 ).toFixed(2);
        }
        $('#centimeter').val(convertedcm);
    }

    //convertion of kilogram to pounds
    function convertionKilogramstoPounds () {
        var kg = $('#kg').val();
        var convertedlb = parseFloat(kg * 2.2046226218).toFixed(2);

        $('#lb').val(convertedlb);

    }

    //convertion of pounds to kilogram
    function convertionPoundstoKilogram () {
        var lb = $('#lb').val();
        var convertedkg = parseFloat(lb / 2.2046226218).toFixed(2);

        $('#kg').val(convertedkg);
    }
    //calcultion of inches and pounds in BMI
    function calculationBMI () {
        var lb = $('#lb').val();
        var inch = $('#inch').val();
        var calculationbmi = parseFloat((lb * 703) / (inch * inch)).toFixed(2);

        $('#bmi').val(calculationbmi);



    }



    //age calculation thru birthday
$('#bday').change(function () {
    var now = new Date();   //Current Date
    var past = new Date($('#bday').val());  //Date of Birth
    if (past > now) {
        alert('Entered Date is Greater than Current Date');
        return false;
    }
    var nowYear = now.getFullYear();  //Get current year
    var pastYear = past.getFullYear();//Get Date of Birth year
    var age = nowYear - pastYear;  //calculate the difference
    $('#age').val(age + " years old");
});

//toggle new and existing patient
$('#new_patient').change(function() {
    if($(this).is(":checked")){
      $('#existing_patient').attr('checked', false);
      $("#patient_id").hide();
      $("#patient_id1").hide();
    }
});

$('#existing_patient').change(function() {
    if($(this).is(":checked")){
      $('#new_patient').attr('checked', false);
      $("#patient_id").show();
      $("#patient_id1").show();

    }
    else{
        $("#patient_id").hide();
      $("#patient_id1").hide();
    }
});

//Search in a dropdown title
$(document).ready(function(){

    // Initialize select2
    $("#selTitle").select2();

    // Read selected option
    $('#but_read').click(function(){
      var title = $('#selTitle option:selected').text();
      var id = $('#selTitle').val();

      $('#result').html("id : " + id + ", name : " + title);

    });
  });

  //Search in a dropdown Gender
  $(document).ready(function(){

    // Initialize select2
    $("#selGender").select2();

    // Read selected option
    $('#but_read').click(function(){
      var title = $('#selGender option:selected').text();
      var id = $('#selGender').val();

      $('#result').html("id : " + id + ", name : " + name);

    });
  });

   //Search in a dropdown Country
   $(document).ready(function(){

    // Initialize select2
    $("#country").select2();

    // Read selected option
    $('#but_read').click(function(){
      var title = $('#country option:selected').text();
      var id = $('#country').val();

      $('#result').html("id : " + id + ", name : " + name);

    });
  });

  //Search in a dropdown Country
  $(document).ready(function(){

    // Initialize select2
    $("#hmo").select2();

    // Read selected option
    $('#but_read').click(function(){
      var title = $('#hmo option:selected').text();
      var id = $('#hmo').val();

      $('#result').html("id : " + id + ", name : " + name);

    });
  });

  //Search in a dropdown Province
  $(document).ready(function(){

    // Initialize select2
    $("#province").select2();

    // Read selected option
    $('#but_read').click(function(){
      var title = $('#province option:selected').text();
      var id = $('#province').val();

      $('#result').html("id : " + id + ", name : " + name);

    });
  });

   //Search in a dropdown Municipality
   $(document).ready(function(){

    // Initialize select2
    $("#municipality").select2();

    // Read selected option
    $('#but_read').click(function(){
      var title = $('#municipality option:selected').text();
      var id = $('#municipality').val();

      $('#result').html("id : " + id + ", name : " + name);

    });
  });

  //Search in a dropdown ID Type
  $(document).ready(function(){

    // Initialize select2
    $("#selID_Type").select2();

    // Read selected option
    $('#but_read').click(function(){
      var title = $('#selID_Type option:selected').text();
      var id = $('#selID_Type').val();

      $('#result').html("id : " + id + ", name : " + name);

    });
  });
  //Search in a dropdown ID Type
$(document).ready(function(){

    // Initialize select2
    $("#barangay").select2();

    // Read selected option
    $('#but_read').click(function(){
      var title = $('#barangay option:selected').text();
      var id = $('#barangay').val();
      var idno = $('#id_no').val;

      $('#result').html("id : " + id + ", name : " + name);
    //   $('#result').attr("placeholder" + idno_format);



    });
  });



  //Search in a dropdown Member Category
$(document).ready(function(){

    // Initialize select2
    $("#selMemberCategory").select2();

    // Read selected option
    $('#but_read').click(function(){
      var title = $('#selMemberCategory option:selected').text();
      var id = $('#selMemberCategory').val();
      var idno = $('#id_no').val;

      $('#result').html("id : " + id + ", name : " + name);
    //   $('#result').attr("placeholder" + idno_format);



    });
  });
});

///password complexity reg ex
function validatepass(){
    var pass = document.getElementById('password');
    var upper = document.getElementById('upper');
    var lower = document.getElementById('lower');
    var special_charater = document.getElementById('special_char');
    var num = document.getElementById('number');
    var len = document.getElementById('length');
    var passtck = true;


    //check if pass value contain a uppercase letter
    if (pass.value.match(/[A-Z]/)) {  //match the function which matches a regular expressions
        //password contain A to Z
        upper.style.color = 'green'
        // $("#btnSignUp").attr("disabled", false);

    }
    else {
        //otherwise
        upper.style.color = 'red'
        // $("#btnSignUp").attr("disabled", true);
    }

     //check if pass value contain a lowercase letter
     if (pass.value.match(/[a-z]/)) {  //match the function which matches a regular expressions
        //password contain a to z
        lower.style.color = 'green'
        // $("#btnSignUp").attr("disabled", false);

    }
    else {
        //otherwise
        lower.style.color = 'red'
        // $("#btnSignUp").attr("disabled", true);
    }

     //check if pass value contain a special character or symbol
     if (pass.value.match(/[!\@\$\%\^\&\*\(\)\_\-\?\=\+\<\>\.\,]/)) {  //match the function which matches a regular expressions
        //type all special character which you want to validate
        special_charater.style.color = 'green'
        // $("#btnSignUp").attr("disabled", false);

    }
    else {
        //otherwise
        special_charater.style.color = 'red'
        // $("#btnSignUp").attr("disabled", true);
    }

    //check if pass value contain a number
    if (pass.value.match(/[0-9]/)) {  //match the function which matches a regular expressions
        //password contain 0 to 9 number then
        num.style.color = 'green'
        // $("#btnSignUp").attr("disabled", false);

    }
    else {
        //otherwise
        num.style.color = 'red'
        // $("#btnSignUp").attr("disabled", true);
    }

    //check if the lenght is greater than equal to 8
    if (pass.value.length < 8 ){
        //if the password is less than 8
        len.style.color = 'red'
        // $("#btnSignUp").attr("disabled", true);

    }
    else {
        //if the password is greater than or equal to 8
        len.style.color = 'green'
        // $("#btnSignUp").attr("disabled", false);

    }
}




function validate() {

    var valid = true;
    valid = checkEmpty($("#firstname"));
    valid = checkEmpty($("#lastname"));
    valid = checkEmpty($("#userName"));
    valid = checkEmpty($("#hospitalName"));

    // valid = valid && checkEmail($("#email"));



    $("#btnSignUp").attr("disabled",true);
    if(valid) {
        $("#btnSignUp").attr("disabled",false);
    }
}
function checkEmpty(obj) {
    var name = $(obj).attr("name");
    $("."+name+"-validation").html("");
    $(obj).css("border","");
    if($(obj).val() == "") {
        // $(obj).css("border","#FF0000 1px solid");
        // $("."+name+"-validation").html("Required");
        return false;
    }

    return true;
}
function checkEmail(obj) {
    var result = true;

    var name = $(obj).attr("name");
    $("."+name+"-validation").html("");
    $(obj).css("border","");

    result = checkEmpty(obj);

    if(!result) {
        // $(obj).css("border","#FF0000 1px solid");
        $("."+name+"-validation").html("Required");
        return false;
    }

    var email_regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,3})+$/;
    result = email_regex.test($(obj).val());

    if(!result) {
        $(obj).css("border","#FF0000 1px solid");
        $("."+name+"-validation").html("Invalid");
        return false;
    }

    return result;
}

$(document).ready(function() {
    $("#idType").change(function(){
        var id_type = $(this).val();
        $("#idNumber").val('');
        if(id_type) {

              var url = window.location.origin+'/getIDTypes/'+ id_type;
                //alert(url); return false;
              $.ajaxSetup
              ({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
              });
              $.ajax({
                url: url,
                method: 'get',
                data: { 'idtypes': id_type }, // prefer use serialize method
                success:function(data)
                // alert(data); return false;
                {
                    //alert(data); return false;
                    if(data){
                        //alert (data[0]['idno_format']); return false;
                        var inputmask = new Inputmask(data[0]['id_typeformat']);
                        inputmask.mask($('[id*=idNumber]'));
                     }
                       else
                       {
                        $("#idNumber").attr('placeholder', data['idno_format']);
                       }
                    }
              })
            }
        });


        $("#idTypeUpdate").change(function(){
          var id_type = $(this).val();
          $("#idNumberUpdate").val('');
  
          if(id_type) {
  
                var url = window.location.origin+'/getIDTypes/'+ id_type;
                  //alert(url); return false;
                $.ajaxSetup
                ({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax({
                  url: url,
                  method: 'get',
                  data: { 'idtypes': id_type }, // prefer use serialize method
                  success:function(data)
                  // alert(data); return false;
                  {
                      //alert(data); return false;
                      if(data){
                          //alert (data[0]['idno_format']); return false;
                          var inputmask = new Inputmask(data[0]['id_typeformat']);
                          inputmask.mask($('[id*=idNumberUpdate]'));
                       }
                         else
                         {
                          $("#idNumberUpdate").attr('placeholder', data['idno_format']);
                         }
                      }
                })
              }
          });
    });
        // $(function(){
        //     $("#selID_Type").change(function(){
        //         var duplicate = $("#selID_Type option:selected").text();

        //         if (duplicate == $("#selID_Type option:selected").text()){
        //             var inputmask = new Inputmask("####-#####-##############");
        //             inputmask.mask($('[id*=id_no]'));
        //         }
        //         else {
        //             $("#id_no").attr('placeholder', duplicate);
        //         }
        //         // $("#selID_Type1").val(duplicate);
        //         // $("#id_no").attr('placeholder', duplicate);


        //     })
        // });

        //province start
$(document).ready(function() {
    $('#country').on('change', function()
    {
       var country = $(this).val();
       if(country) {
            //   alert(country); return false;
              var url = window.location.origin+'/getprovinces/'+country;
              //alert(url); return false;
              $.ajaxSetup
              ({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
              });
                $.ajax({
                    url: url,
                    method: 'get',
                    data: { 'country_name': country }, // prefer use serialize method
                    success:function(data)
                    {
                        // alert(data); return false;
                        //alert (data); return false;
                      if(data){
                         //alert (data); return false;
                         $("#province").empty();
                         $("#province").append('<option value=" ">Select Province</option>');
                        for(var n=0; n<data.length; n++) {
                           $("#province").append('<option>'+data[n]['province']+'</option>');
                        }
                        $("#municipality").empty();
                        $("#barangay").empty();
                        $("#zip_code").val('');
                      }

                        else
                        {
                          $('#province').empty();
                        }
                      }
              });
            }
    });
    //province end

    // municipality start
    $('#province').on('change', function()
    {
       var province = $(this).val();
       //alert(province); return false;
       if(province) {
              //alert(province); return false;
              var url = window.location.origin+'/getmunicipality/'+province;
              //alert(url); return false;
              $.ajaxSetup
              ({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
              });
                $.ajax({
                    url: url,
                    method: 'get',
                    data: { 'province': province }, // prefer use serialize method
                    success:function(data)
                    {
                        //alert (data); return false;
                      if(data){
                         //alert (data); return false;
                         $("#municipality").append('<option value=" ">Select Municipality</option>');
                        for(var n=0; n<data.length; n++) {
                           $("#municipality").append('<option>'+data[n]['municipality']+'</option>');
                        }
                      }

                        else
                        {
                          $('#municipality').empty();
                        }
                      }
              });
            }
    });
    //municipality end


     // barangay start
     $('#municipality').on('change', function()
     {
        var municipality = $(this).val();
        //alert(province); return false;
        if(municipality) {
               //alert(province); return false;
               var url = window.location.origin+'/getbarangays/'+province;
               //alert(url); return false;
               $.ajaxSetup
               ({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
               });
                 $.ajax({
                     url: url,
                     method: 'get',
                     data: { 'municipality': municipality }, // prefer use serialize method
                     success:function(data)
                     {
                         //alert (data); return false;
                       if(data){
                          //alert (data); return false;
                          $("#barangay").append('<option value=" ">Select Barangay</option>');
                         for(var n=0; n<data.length; n++) {
                            $("#barangay").append('<option>'+data[n]['barangay']+'</option>');

                         }
                       }

                         else
                         {
                           $('#barangay').empty();
                         }
                       }
               });
             }
     });
     //barangay end

     //zip code start
      $('#barangay').on('change', function()
     {
        var barangay = $(this).val();
        var province = $('#province').val();
        //alert(barangay); return false;
        if(barangay) {
               //alert(barangay); return false;
               var url = window.location.origin+'/getzipcode/'+barangay;
               //alert(url); return false;
               $.ajaxSetup
               ({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
               });
                 $.ajax({
                     url: url,
                     method: 'get',
                     data: { 'barangay': barangay, 'province': province }, // prefer use serialize method
                     success:function(data)
                     {
                         //alert (data); return false;
                       if(data){
                          //alert (data); return false;
                          $('#zip_code').val(data[0]['zip_code']);

                       }

                         else
                         {
                           $('#barangay').empty();
                         }
                       }
               });
             }
     });




     //province start - profile edit page
$(document).ready(function() {
    $('#countryname').on('change', function()
    {
       var countryname = $(this).val();
       if(countryname) {
            //   alert(country); return false;
              var url = window.location.origin+'/getprovinces/'+country;
              //alert(url); return false;
              $.ajaxSetup
              ({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
              });
                $.ajax({
                    url: url,
                    method: 'get',
                    data: { 'country_name': countryname }, // prefer use serialize method
                    success:function(data)
                    {
                        // alert(data); return false;
                        //alert (data); return false;
                      if(data){
                         //alert (data); return false;
                         $("#provincename").empty();
                         $("#provincename").append('<option value=" ">Select Province</option>');
                        for(var n=0; n<data.length; n++) {
                           $("#provincename").append('<option>'+data[n]['province']+'</option>');
                        }
                        $("#municipality").empty();
                        $("#barangay").empty();
                        $("#zip_code").val('');
                      }

                        else
                        {
                          $('#provincename').empty();
                        }
                      }
              });
            }
    });
    //province end - profile edit page


    // municipality start - profile edit page
    $('#provincename').on('change', function()
    {
       var provincename = $(this).val();
       //alert(province); return false;
       if(provincename) {
              //alert(province); return false;
              var url = window.location.origin+'/getmunicipality/'+provincename;
              //alert(url); return false;
              $.ajaxSetup
              ({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
              });
                $.ajax({
                    url: url,
                    method: 'get',
                    data: { 'province': provincename }, // prefer use serialize method
                    success:function(data)
                    {
                        //alert (data); return false;
                      if(data){
                         //alert (data); return false;
                         $("#municipalityname").append('<option value=" ">Select Municipality</option>');
                        for(var n=0; n<data.length; n++) {
                           $("#municipalityname").append('<option>'+data[n]['municipality']+'</option>');
                        }
                      }

                        else
                        {
                          $('#municipalityname').empty();
                        }
                      }
              });
            }
    });
    //municipality end - profile edit page

     // barangay start - profile edit page
     $('#municipalityname').on('change', function()
     {
        var municipalityname = $(this).val();
        //alert(province); return false;
        if(municipalityname) {
               //alert(province); return false;
               var url = window.location.origin+'/getbarangays/'+municipality;
               //alert(url); return false;
               $.ajaxSetup
               ({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
               });
                 $.ajax({
                     url: url,
                     method: 'get',
                     data: { 'municipality': municipalityname }, // prefer use serialize method
                     success:function(data)
                     {
                         //alert (data); return false;
                       if(data){
                          //alert (data); return false;
                          $("#brgyname").append('<option value=" ">Select Barangay</option>');
                         for(var n=0; n<data.length; n++) {
                            $("#brgyname").append('<option>'+data[n]['barangay']+'</option>');

                         }
                       }

                         else
                         {
                           $('#brgyname').empty();
                         }
                       }
               });
             }
     });


     //barangay end - profile edit page

    })
    //DATE PICKER
    $(document).ready(function () {
        $('.datepicker').datepicker({
            dateFormat: 'mm/dd/yy',
            changeMonth: true,
            changeYear: true,
            autoclose: true,
            yearRange: "1800:2080"

        });
    });

    //validation if the password match in confirm password
    $(document).ready(function() {
        $("#password_confirmation").on('keyup', function() {
          var password = $("#password").val();
          var confirmPassword = $("#password_confirmation").val();
          if (password != confirmPassword)
            // $("#password_confirmation").css("border","red 2px solid");
            $("#CheckPasswordMatch").html("Password does not match").css("color","red");
          else
            $("#CheckPasswordMatch").html("Password match").css("color","green");
        });
      });
      //validation of confirm function for reset
      $("#password-confirm").on('keyup', function() {
        var password = $("#password").val();
        var confirmPassword = $("#password-confirm").val();
        if (password != confirmPassword)
          // $("#password_confirmation").css("border","red 2px solid");
          $("#CheckPasswordMatchReset").html("Password does not match").css("color","red");
        else
          $("#CheckPasswordMatchReset").html("Password match").css("color","green");
      });
    });
  

      //show password
      $(document).ready(function(){

        $('#showPassword').on('click', function(){
          // alert("asd");
           var passInput=$("#password");
           if($("#password").attr('type')==='password')
             {
               passInput.attr('type','text');
            //  }
           }else{
              passInput.attr('type','password');
           }
       });
     });

      //show password register
      $(document).ready(function(){

        $('#showPasswordRegister').on('click', function(){
          // alert("asd");
           var passInput=$("#password");
           if($("#password").attr('type')==='password')
             {
               passInput.attr('type','text');
            //  }
           }else{
              passInput.attr('type','password');
           }
       });
     });
    //  show reset password
     $(document).ready(function(){
      $('#showPasswordReset').on('click', function(){
        // alert("asd");
         var passInput=$("#password");
         if($("#password").attr('type')==='password')
           {
             passInput.attr('type','text');
          //  }
         }else{
            passInput.attr('type','password');
         }
     });
     });

     //  show register password confirm
     $(document).ready(function(){
      $('#showConfirmPasswordregister').on('click', function(){
        var passInput=$("#password-confirm");
        if(passInput.attr('type')==='password')
          {
            passInput.attr('type','text');
        }
        else{
           passInput.attr('type','password');
        }
    });
     });

    //  show reset password confirm
     $(document).ready(function(){
      $('#showPasswordResetConfirm').on('click', function(){
        var passInput=$("#password-confirm");
        if(passInput.attr('type')==='password')
          {
            passInput.attr('type','text');
        }
        else{
           passInput.attr('type','password');
        }
    });
     });

     //show confirm password
     $(document).ready(function(){

        $('#showConfirmPassword').on('click', function(){
           var passInput=$("#password_confirmation");
           if(passInput.attr('type')==='password')
             {
               passInput.attr('type','text');
           }
           else{
              passInput.attr('type','password');
           }
       });


       $('#centimeter').on('change', function () {
          $(this).val(Math.min('272', Math.max('55', $(this).val()).toFixed(2)));
        });

      //maximum and minimum input of the height in inches with round off
      $('#inch').on('change', function () {
        $(this).val(Math.min('107.09', Math.max('21.65', $(this).val()).toFixed(2)));
      });



    }
);


     //maximum and minimum input of the height in centimeter with round off
   

// $(document).ready(function(){
//   $()
// });
