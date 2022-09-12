

var get_ID="";
var patient = new Object();
$code =''

var resultb64="";
var imagebase64="";
var stream;
$imageTemp="";
$hpidTemp='';
var geticdCode ="";
var constraint=0;
var modalIdentifier = "";
var cityUpdate="";
$patientInfo="";
$idsObject="";
$currentHPID="";
var dateDis;
var boolCheck= false;
var icdCode;
var icdDesc;
var finDiag;
var identifier
$tempHospID=[];


// var fname='';
// var lname='';



// function displayHello() {
//     $('#noofpatients').html($('#red').val());
// }

$(document).ready(function(){
    var getAdd=1;
    var getAddEmail=1;
    var getAddEmailUpdate=0;
    // var updateAdd=0;
    $getCount =0;

    $("#closeICD").click(function(){
        $("#icd10modal").modal("hide");

        if(modalIdentifier=="createVisit"){
            createVisit($patientInfo,$idsObject,$currentHPID);
        }else if(modalIdentifier=="viewVisit"){
            viewVisit();
        }
        
    });

    $("#emailType1Update").change(function(){
        if($("#emailType1Update").val()!=""){
            // alert("asd");
            $("#email1Update").prop("disabled",false);
            $("#noteEmail1Update").prop("disabled", false);
        }
    });
    $("#emailType2Update").change(function(){
        if($("#emailType2Update").val()!=""){
            // alert("asd");
            $("#email2Update").prop("disabled",false);
            $("#noteEmail2Update").prop("disabled", false);
        }
    });

    $("#emailType3Update").change(function(){
        if($("#emailType3Update").val()!=""){
            // alert("asd");
            $("#email3Update").prop("disabled",false);
            $("#noteEmail3Update").prop("disabled", false);
        }
    });

    $("#emailType4Update").change(function(){
        if($("#emailType4Update").val()!=""){
            // alert("asd");
            $("#email4Update").prop("disabled",false);
            $("#noteEmail4Update").prop("disabled", false);
        }
    });

    $('#Printthetable2').click(function() {
        $('#noofpatients1').html($('#red2').val());
        if($( "#byHospitals" ).val()!=""){
            $('#hospitalfil').html($( "#byHospitals" ).val());
        }
        else{
            $('#hospitalfil').html('All Hospitals');
        }
    });
    $('#viewrecords').click(function() {
        $('#noofpatients1').html($('#red2').val());
        if($( "#byHospitals" ).val()!=""){
            $('#hospitalfil').html($( "#byHospitals" ).val());
        }
        else{
            $('#hospitalfil').html('All Hospitals');
        }
    });
    $("#idreport").click(function(){
        $id=$("#hiddenInput").val();
        // alert($id);

        $.ajax({
            url: '/masterpatientrecord/'+$id,
            method: 'get',
            data: {'mpi':$id},
            success:function(data){

            }
        });

    });
    $("input").attr("Autocomplete","off");

    $("#closeAll1").click(function(){
        window.location.replace("/home");
    });
    $("#closeAll2").click(function(){
        window.location.replace("/home");
    });
    // $("#closeAll3").click(function(){
    //     window.location.replace("/home");
    // });
    $("#closeAll4").click(function(){
        window.location.replace("/home");
    });
    $("#closeAll5").click(function(){
        window.location.replace("/home");
    });

    $("#icd10Select").on("click", function(){
        // alert("asd");
       
    });
    
    $("#selectIDS").click(function(){

        $("#createVisitModal").modal("hide");
        modalIdentifier="createVisit";
        $("#icd10modal").modal("show");


    
    });

    // SET AS EMERGENCY CONTACT
    //FATHER
    $("#setEmergencyFather").change(function(){
        if(this.checked){
            // alert("asd");
            // alert($("#regFathersProvince").val());
            
            $("#setEmergencyMother").prop("checked", false);
            $("#setEmergencySpouse").prop("checked", false);

            // $("#regEmergencyCountry").empty();
            // $("#regEmergencyProvince").empty();
            // $("#regEmergencyMunicipality").empty();
            // $("#regEmergencyBarangay").empty();
            // $("#emergencyStreet").empty();
            // $("#emergencyPostal").empty();

            $("#relationToPatient").val("Father");
            $("#relationToPatient").css("pointer-events","none");

            $("#emergencyLastName").val($("#fatherLastName").val());
            $("#emergencyFirstName").val($("#fatherFirstName").val());
            $("#emergencyMiddleName").val($("#fatherMiddleName").val());
            $("#emergencyExtName").val($("#fatherExtName").val());
            $("#emergencyContactNo").val($("#fatherContactNo").val());
            $("#regEmergencyCountry").val($("#regFathersCountry").val());
            $("#regEmergencyProvince option:selected").val($("#regFathersProvince").val());
            $("#regEmergencyProvince option:selected").text($("#regFathersProvince").val());
            $("#regEmergencyMunicipality option:selected").val($("#regfathersMunicipality").val());
            $("#regEmergencyMunicipality option:selected").text($("#regfathersMunicipality").val());
            $("#regEmergencyBarangay option:selected").val($("#regFathersBarangay").val());
            $("#regEmergencyBarangay option:selected").text($("#regFathersBarangay").val());
            $("#emergencyStreet").val($("#fatherStreet").val());
            $("#regEmergencyPostal").val($("#regFathersPostal").val());
            // $("#emergencyLastName").val($("#regFathersProvince").val());
        }
        else{
            $("#relationToPatient").val("");
            $("#relationToPatient").css("pointer-events","auto");
            $("#setEmergencyMother").prop("disabled", false);
            $("#setEmergencySpouse").prop("disabled", false);

            $("#emergencyLastName").val('');
            $("#emergencyFirstName").val('');
            $("#emergencyMiddleName").val('');
            $("#emergencyExtName").val('');
            $("#emergencyContactNo").val('');
            $("#regEmergencyCountry").val('');
            $("#regEmergencyProvince option:selected").val('');
            $("#regEmergencyProvince option:selected").text('');
            $("#regEmergencyMunicipality option:selected").val('');
            $("#regEmergencyMunicipality option:selected").text('');
            $("#regEmergencyBarangay option:selected").val('');
            $("#regEmergencyBarangay option:selected").text('');
            $("#emergencyStreet").val('');
            $("#regEmergencyPostal").val('');
        }
    });

    // MOTHER
    $("#setEmergencyMother").change(function(){
        if(this.checked){
            // alert("asd");
            // alert($("#regFathersProvince").val());
            $("#relationToPatient").val("Mother");
            $("#relationToPatient").css("pointer-events","none");
            $("#setEmergencyFather").prop("checked", false);
            $("#setEmergencySpouse").prop("checked", false);
            $("#emergencyLastName").val($("#motherLastName").val());
            $("#emergencyFirstName").val($("#motherFirstName").val());
            $("#emergencyMiddleName").val($("#motherMiddleName").val());
            $("#emergencyExtName").val($("#motherExtName").val());
            $("#emergencyContactNo").val($("#motherContactNo").val());
            $("#regEmergencyCountry").val($("#regMothersCountry").val());
            $("#regEmergencyProvince option:selected").val($("#regMothersProvince").val());
            $("#regEmergencyProvince option:selected").text($("#regMothersProvince").val());
            $("#regEmergencyMunicipality option:selected").val($("#regMothersMunicipality").val());
            $("#regEmergencyMunicipality option:selected").text($("#regMothersMunicipality").val());
            $("#regEmergencyBarangay option:selected").val($("#regMothersBarangay").val());
            $("#regEmergencyBarangay option:selected").text($("#regMothersBarangay").val());
            $("#emergencyStreet").val($("#motherStreet").val());
            $("#regEmergencyPostal").val($("#regmothersPostal").val());
            // $("#emergencyLastName").val($("#regFathersProvince").val());
        }
        else{
            $("#relationToPatient").val("");
            $("#relationToPatient").css("pointer-events","auto");
            $("#setEmergencyFather").prop("disabled", false);
            $("#setEmergencySpouse").prop("disabled", false);

            $("#emergencyLastName").val('');
            $("#emergencyFirstName").val('');
            $("#emergencyMiddleName").val('');
            $("#emergencyExtName").val('');
            $("#emergencyContactNo").val('');
            $("#regEmergencyCountry").val('');
            $("#regEmergencyProvince option:selected").val('');
            $("#regEmergencyProvince option:selected").text('');
            $("#regEmergencyMunicipality option:selected").val('');
            $("#regEmergencyMunicipality option:selected").text('');
            $("#regEmergencyBarangay option:selected").val('');
            $("#regEmergencyBarangay option:selected").text('');
            $("#emergencyStreet").val('');
            $("#regEmergencyPostal").val('');
        }
    });

    // SPOUSE
    $("#setEmergencySpouse").change(function(){
        if(this.checked){
            $("#relationToPatient").val("Spouse");
            $("#relationToPatient").css("pointer-events","none");
            // alert("asd");
            // alert($("#regFathersProvince").val());
            $("#setEmergencyFather").prop("checked", false);
            $("#setEmergencyMother").prop("checked", false);
            $("#emergencyLastName").val($("#spouseLastName").val());
            $("#emergencyFirstName").val($("#spouseFirstName").val());
            $("#emergencyMiddleName").val($("#spouseMiddleName").val());
            $("#emergencyExtName").val($("#spouseExtName").val());
            $("#emergencyContactNo").val($("#spouseContactNo").val());
            $("#regEmergencyCountry").val($("#regSpousesCountry").val());
            $("#regEmergencyProvince option:selected").val($("#regSpousesProvince").val());
            $("#regEmergencyProvince option:selected").text($("#regSpousesProvince").val());
            $("#regEmergencyMunicipality option:selected").val($("#regSpousesMunicipality").val());
            $("#regEmergencyMunicipality option:selected").text($("#regSpousesMunicipality").val());
            $("#regEmergencyBarangay option:selected").val($("#regSpousesBarangay").val());
            $("#regEmergencyBarangay option:selected").text($("#regSpousesBarangay").val());
            $("#emergencyStreet").val($("#spouseStreet").val());
            $("#regEmergencyPostal").val($("#regSpousesPostal").val());
            // $("#emergencyLastName").val($("#regFathersProvince").val());
        }
        else{
            $("#relationToPatient").val("");
            $("#relationToPatient").css("pointer-events","auto");
            $("#setEmergencyFather").prop("disabled", false);
            $("#setEmergencyMother").prop("disabled", false);

            $("#emergencyLastName").val('');
            $("#emergencyFirstName").val('');
            $("#emergencyMiddleName").val('');
            $("#emergencyExtName").val('');
            $("#emergencyContactNo").val('');
            $("#regEmergencyCountry").val('');
            $("#regEmergencyProvince option:selected").val('');
            $("#regEmergencyProvince option:selected").text('');
            $("#regEmergencyMunicipality option:selected").val('');
            $("#regEmergencyMunicipality option:selected").text('');
            $("#regEmergencyBarangay option:selected").val('');
            $("#regEmergencyBarangay option:selected").text('');
            $("#emergencyStreet").val('');
            $("#regEmergencyPostal").val('');
        }
    });

    // END SET AS EMERGENCY CONTACT


    $("#selectICDUpdate").click(function(){

        $("#viewVisitModal").modal("hide");
        // disDate = $("#dateDischargedUpdate").val();
        // alert(disDate)
        modalIdentifier="viewVisit";
        $("#icd10modal").modal("show");
        // viewVisit();

    
    });


    $("#closeVisit").click(function(){
        $("#createVisitModal").modal("hide");
        $("#createVisitModal").find("select").val('');
        $("#createVisitModal").find("input").val('');
        $("#createVisitModal").find("textarea").val('');
        viewRecord($code,"img/profile.png");
    });
    $("#closeViewVisit").click(function(){
        $("#viewVisitModal").modal("hide");
        viewRecord($code,"img/profile.png");
    });

    // $initialCount=0
    // $("#contact1Add, #contact2Add,#contact3Add, #contact4Add, #contact1,#contact2,#contact3,#contact4").on('input paste',function(e){
    //     // alert("asd");
    //     var key = e.charCode || e.keyCode || 0;
    //    $text = $(this); 
    //    if (key !== 8 && key !== 9) {
    //        if ($text.val().length === 4) {
    //            $text.val($text.val() + '-');
    //        }
    //        if ($text.val().length === 8) {
    //            $text.val($text.val() + '-');
    //        }

    //    }

    //    return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
    // });

    // create visit disable button
    $("#dateArrival").on('change keyup', function(){
        // if($("#dateArrival").val()!=null){
        //    constraint=constraint+1;
        // }
        checkContent();
    });
    $("#chiefComplaint").on('input', function(){
        checkContent();
    });
    $("#dateDischarged").on('change keyup', function(){
        checkContent();
    });


    // view visit discharge button
    $("#dateDischargedUpdate").on('change keyup', function(){
        // disDate=$("#dateDischargedUpdate").val();
        // alert(disDate);
        checkVisitContent();
    });
    $("#icdCodeUpdate").on('change keyup', function(){
        checkVisitContent();
    });
    $("#icdDescUpdate").on('change keyup', function(){
        checkVisitContent();
    });
    $("#FinalDiagnosisUpdate").on('change keyup', function(){
        checkVisitContent();
    });

    

    $("#idreport").click(function(){
        $ids=$("#hiddenInput").val();
        window.location.href = "/myPDF/"+$ids;
    });
       

    $(".viewReportModal").click(function(){
        $('#reportModal').modal('show');
    });
    $("#closeAddImageModal").click(function(){
        $('#addImageModal').modal('hide');
    });

    $("#resetFilter").on('click', function(){
        $("input[type=date]").val("");
    });

    $("#resetFilter").on("click", function(){
        // alert("asd0");
        // $("#HPI").val("");
        // $("#HPI").text("");
    });

     // ADD REMOVE CONTACT REGISTRATION

    $("#addaContact").click(function(){
        
        if(!(getAdd>=4)){
            getAdd++;
        }
        else if(getAdd=4){
            getAdd=getAdd;
            $("#addaContact").addClass("hidden");
        }
        // $("#countContact").val(getAdd+1);
        $("#countContact").val(getAdd);
        $('.cols'+getAdd).removeClass("hidden");

        
        
    });

    $("#removeaContact").click(function(){
        $('.cols'+getAdd).addClass("hidden");
        if(!(getAdd<=1)){
            getAdd--;    
        }
        
        $getCount=$("#countContact").val(getAdd);
        // if(!(getAdd<=0)){
        //     getAdd=1;
        //     $getCount=1;
        //     // alert(getAdd);
        // }
    });
    // END ADD REMOVE CONTACT REGISTRATION
    //  ADD EMAIL REGISTRATION
    $("#addaEmail").click(function(){
        
        if(!(getAddEmail>=4)){
            getAddEmail++;
        }
        else if(getAddEmail=4){
            getAddEmail=getAddEmail;
        }
        // $("#countContact").val(getAdd+1);
        // $("#countContact").val(getAddEmail);
        $('.emails'+getAddEmail).removeClass("hidden");
        $("#hiddenEmailCount").val(getAddEmail);
        
        
    });

    // END EMAIL REGISTRATION
    // START EMAIL UPDATE 
    $("#addaEmailUpdate").click(function(){
        
        if(!(getAddEmailUpdate>=4)){
            getAddEmailUpdate++;
        }
        else if(getAddEmail=4){
            getAddEmailUpdate=getAddEmailUpdate;
        }
        // $("#countContact").val(getAdd+1);
        // $("#countContact").val(getAddEmail);
        $("#hiddenEmailCountUpdate").val(getAddEmailUpdate);
        $('.emailsUpdate'+getAddEmailUpdate).removeClass("hidden");
        
        
    });
    // START ADD REMOVE CONTACT UPDATE
    $("#addaContactUpdate").click(function(){
        

        // alert(updateAdd);
            
        if(!(updateAdd>=4)){
            updateAdd++;
            $("#countContactUpdate").val(updateAdd);
        }
        else if(updateAdd=4){
            updateAdd=updateAdd;
            // alert("asd");
            
        }
        // $("#countContact").val(getAdd+1);
        // $("#countContactupdate").val(updateAdd);
        $('.colsUpdate'+updateAdd).removeClass("hidden");
        
        
    });
    // remove contact on update
    $("#removeaContactUpdate").click(function(){
        if(updateAdd==initialCount){
            updateAdd=initialCount;
        }else if(updateAdd>initialCount){
            // alert(updateAdd);
            updateAdd--;
            $("#countContactUpdate").val(updateAdd);
            
        }else if(updateAdd==0&&initialCount==0){
            updateAdd=0;
            // $('.colsUpdate'+updateAdd).addClass("hidden");
        }
        else{
            updateAdd=initialCount;
            // alert(updateAdd)
        }
        switch(updateAdd){
            case 0:
                $('.colsUpdate1').addClass("hidden");
                $('.colsUpdate2').addClass("hidden");
                $('.colsUpdate3').addClass("hidden");
                $('.colsUpdate4').addClass("hidden");
                break;
            case 1:
                $('.colsUpdate2').addClass("hidden");
                $('.colsUpdate3').addClass("hidden");
                $('.colsUpdate4').addClass("hidden");
                break;
            case 2:
                $('.colsUpdate3').addClass("hidden");
                $('.colsUpdate4').addClass("hidden");
                break;
            case 3:
                $('.colsUpdate4').addClass("hidden");
                break
            default:
    
        }
        

        // $getCount=$("#countContact").val(getAdd);
        // if(!(getAdd<=0)){
        //     getAdd=1;
        //     $getCount=1;
        //     // alert(getAdd);
        // }
    });

    // END ADD REMOVE CONTACT UPDATE

    // ADD/REMOVE CONTACT UPADTE
   


    // FOR SHOWING MODAL
    $("#addingPatient").click(function(){
        $('#studentModal').modal('show');
    });
    // $("#addingImage").click(function(){
    //     $('#viewPatientModal').modal('hide');
    //     $('#addImageModal').modal('show');
    // });



    $("#closeAddImageModal").click(function(){
        $('#addImageModal').modal('hide');
    });

    // $("#addPicture").click(function(){
    //     $('#addImageModal').modal('show');
    // });
    // $("#U_FIRSTNAME").focusout(function(){
    //     fname=document.getElementById('U_FIRSTNAME').value;
    // });
    // $("#U_LASTNAME").focusout(function(){
    //     fname=document.getElementById('U_FIRSTNAME').value;
    // });
    
    $("#bday11").on('change',function(){
        var bday = document.getElementById('bday11').value;
        var fname=document.getElementById('addFirstName').value;
        var lname=document.getElementById('addLastName').value;
        // alert(fname+lname);
        // var lname = document.getElementById('U_LASTNAME').value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/show_teams",
            data:{
                bday,
                fname,
                lname
            },
 
            success: function(response) {
                
              //console.log(data.msg);
              //show success modal
              if (response.msg=="Patient Already Exist."){
                alert(response.msg);
                $('#studentModal').modal('hide');

                $obj2=JSON.stringify(response.getRecord);
                $hispatients1 = JSON.parse($obj2);
                
                viewRecord($hispatients1.CODE,"img/profile.png");

                }
                else{
                    // carry on
                }
            }
             
          });

         
        
    });

    // START SELECT2 ADD PATIENT
    // $("#regCountry").select2({
    //     dropdownParent: $('#studentModal'),
    //     // width: 'resolve',
    //     // height: 'resolve'
    // });

    // $("#regProvince").select2({
    //     dropdownParent: $('#studentModal'),
    //     // width: 'resolve',
    //     // height: 'resolve'
    // });

    // $("#regMunicipality").select2({
    //     dropdownParent: $('#studentModal'),
    //     // width: 'resolve',
    //     // height: 'resolve'
    // });
    // $("#regBarangay").select2({
    //     dropdownParent: $('#studentModal'),
    //     // width: 'resolve',
    //     // height: 'resolve'
    // });

    //    $("#regReligion").select2({
    //     dropdownParent: $('#studentModal'),
    //     // width: 'resolve',
    //     // height: 'resolve'
    // });

  
    $("#regCountry").on('change',function(){
        
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/provinces',
            method: 'get',
            data: {'country': $(this).val()},
            success:function(data){


                if(data){
                    //alert (data); return false;
                // alert(data);
                // prompt('',data); return false;
                // alert(data.length);
                    $("#regProvince").empty();
                    $("#regMunicipality").empty();
                    $("#regBarangay").empty();
                    if (data.length == 0){
                        $("#regProvince").append('<option value=" ">--</option>');
                        $("#regMunicipality").prepend('<option value=" ">--</option>');
                        $("#regBarangay").prepend('<option value=" ">--</option>');
                    }
                    else{
                        $("#province").append('<option value=" ">Select Province</option>');
                        $("#regProvince").attr("disabled", false);
                    }
                    for (var n=0; n<data.length; n++) {
                        $("#regProvince").append("<option>"+data[n]['province']+"</option>");
                    }
                }

            }
        });
    });

    $("#regProvince").on('change',function(){
        // alert('asd');
        $("#regMunicipality").attr("disabled", false);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/municipalities',
            method: 'get',
            data: {'province': $(this).val()},
            success:function(data){
                // prompt('',data); return false;
                $("#regMunicipality").empty();
                $("#regMunicipality").append('<option value="">-Select Town/City-</option>');
                for (var n=0; n<data.length; n++) {
                    $("#regMunicipality").append("<option>"+data[n]['municipality']+"</option>");
                }
                $("#regBarangay").empty();
                $("#regBarangay").append('<option value="">-Select Barangay-</option>');
                $("#regPostal").val('');
            }
        });
    });

    $("#regMunicipality").on('change',function(){
        // alert('asd');
        $("#regBarangay").attr("disabled", false);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/brgys',
            method: 'get',
            data: {'municipality': $(this).val()},
            success:function(data){
                // prompt('',data); return false;
                $("#regBarangay").empty();
                $("#regBarangay").append('<option value="">-Select Barangay-</option>');
                for (var n=0; n<data.length; n++) {
                    $("#regBarangay").append("<option>"+data[n]['barangay']+"</option>");
                }
                $("#regPostal").val('');
            }
        });
    });
    $("#regBarangay").on('change',function(){
        // alert('asd');
        var city=$("#regMunicipality").val()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/postal',
            method: 'get',
            data: {'brgy': $(this).val(),
            'city':city},
            
            success:function(data){
                // prompt('',data); return false;
                $("#regPostal").empty();
                $("#regPostal").val(data[0]['zip_Code']);
            }
        });
    });

    // END SELECT2 ADD PATIENT

    //START  SELECT2 UPDATE PATIENT
    $("#regCountryUpdate").select2({
        dropdownParent: $('#viewPatientModal'),
        // width: 'resolve',
        // height: 'resolve'
    });

    $("#regProvinceUpdate").select2({
        dropdownParent: $('#viewPatientModal'),
        // width: 'resolve',
        // height: 'resolve'
    });

    $("#regMunicipalityUpdate").select2({
        dropdownParent: $('#viewPatientModal'),
        // width: 'resolve',
        // height: 'resolve'
    });
    $("#regBarangayUpdate").select2({
        dropdownParent: $('#viewPatientModal'),
        // width: 'resolve',
        // height: 'resolve'
    });


    $("#regCountryUpdate").on('change',function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/provincesUpdate',
            method: 'get',
            data: {'country': $(this).val()},
            success:function(data){


                if(data){
                    //alert (data); return false;
                // alert(data);
                // prompt('',data); return false;
                // alert(data.length);
                    $("#regProvinceUpdate").empty();
                    $("#regMunicipalityUpdate").empty();
                    $("#regBarangayUpdate").empty();
                    if (data.length == 0){
                        $("#regProvinceUpdate").append('<option value=" ">--</option>');
                        $("#regMunicipalityUpdate").prepend('<option value=" ">--</option>');
                        $("#regBarangayUpdate").prepend('<option value=" ">--</option>');
                    }
                    else{
                        $("#provinceUpdate").append('<option value=" ">Select Province</option>');
                        $("#regProvinceUpdate").attr("disabled", false);
                    }
                    for (var n=0; n<data.length; n++) {
                        $("#regProvinceUpdate").append("<option>"+data[n]['province']+"</option>");
                    }
                }

            }
        });
    });

    $("#regProvinceUpdate").on('change',function(){
        // alert('asd');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/municipalitiesUpdate',
            method: 'get',
            data: {'province': $(this).val()},
            success:function(data){
                // prompt('',data); return false;

                $("#regMunicipalityUpdate").empty();
                $("#regMunicipalityUpdate").attr("disabled", false);
                $("#regMunicipalityUpdate").append('<option value="">-Select Town/City-</option>');
                for (var n=0; n<data.length; n++) {
                    $("#regMunicipalityUpdate").append("<option>"+data[n]['municipality']+"</option>");
                }
                $("#regMunicipalityUpdate").prop("readonly", false);
                $("#regBarangayUpdate").empty();
                $("#regBarangayUpdate").append('<option value="">-Select Barangay-</option>');
                $("#regPostalUpdate").val('');
            }
        });
    });

    $("#regMunicipalityUpdate").on('change',function(){
        // alert('asd');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/brgysUpdate',
            method: 'get',
            data: {'municipality': $(this).val()},
            success:function(data){
                // prompt('',data); return false;
                $("#regBarangayUpdate").empty();
                $("#regBarangayUpdate").attr("disabled", false);
                // $("#regBarangayUpdate").append('<option value="">-Select Barangay-</option>');
                for (var n=0; n<data.length; n++) {
                    $("#regBarangayUpdate").append("<option>"+data[n]['barangay']+"</option>");
                }
                $("#regBarangayUpdate").prop("readonly", false);
                $("#regPostalUpdate").val('');
            }
        });
    });
    $("#regBarangayUpdate").on('change' ,function(){
        // alert('asd');
        cityUpdate=$("#regMunicipalityUpdate").val();
        // ealert(cityUpdate);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/postalUpdate',
            method: 'get',
            data: {'brgy': $(this).val(),
                    'city':cityUpdate        
            },
            success:function(data){
                // prompt('',data); return false;
                // $("#regPostal1").empty();
                // alert(data[0]['zip_Code']);
                $("#regPostalUpdate").val(data[0]['zip_Code']);
            }
        });
    });


    // FATHER ADDRESS
    $("#regFathersCountry").on('change',function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/provincesFather',
            method: 'get',
            data: {'country': $(this).val()},
            success:function(data){
                // prompt('',data); return false;
                // alert('as');
                // alert(data.length);
                if(data){
                    //alert (data); return false;
                // alert(data);
                // prompt('',data); return false;
                // alert(data.length);
                    $("#regFathersProvince").empty();
                    $("#regfathersMunicipality").empty();
                    $("#regFathersBarangay").empty();
                    if (data.length == 0){
                        $("#regFathersProvince").append('<option value=" ">--</option>');
                        $("#regfathersMunicipality").prepend('<option value=" ">--</option>');
                        $("#regFathersBarangay").prepend('<option value=" ">--</option>');
                    }
                    else{
                        $("#regFathersProvince").append('<option value=" ">Select Province</option>');
                        $("#regFathersProvince").attr("disabled", false);
                    }
                    for (var n=0; n<data.length; n++) {
                        $("#regFathersProvince").append("<option>"+data[n]['province']+"</option>");
                    }
                }

            }
        });
    });

    $("#regFathersProvince").on('change',function(){
        // alert('asd');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/municipalitiesFather',
            method: 'get',
            data: {'province': $(this).val()},
            success:function(data){
                // prompt('',data); return false;
                $("#regfathersMunicipality").empty();
                $("#regfathersMunicipality").append('<option value="">-Select Town/City-</option>');
                for (var n=0; n<data.length; n++) {
                    $("#regfathersMunicipality").append("<option>"+data[n]['municipality']+"</option>");
                }
                $("#regFathersBarangay").empty();
                $("#regFathersBarangay").append('<option value="">-Select Barangay-</option>');
                $("#regFathersPostal").val('');
            }
        });
    });

    $("#regfathersMunicipality").on('change',function(){
        // alert('asd');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/brgysFather',
            method: 'get',
            data: {'municipality': $(this).val()},
            success:function(data){
                // prompt('',data); return false;
                $("#regFathersBarangay").empty();
                $("#regFathersBarangay").append('<option value="">-Select Barangay-</option>');
                for (var n=0; n<data.length; n++) {
                    $("#regFathersBarangay").append("<option>"+data[n]['barangay']+"</option>");
                }
                $("#regFathersPostal").val('');
            }
        });
    });
    $("#regFathersBarangay").on('change' ,function(){
        // alert('asd');
        var cityUpdateFather=$("#regfathersMunicipality").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/postalFather',
            method: 'get',
            data: {'brgy': $(this).val(),
            'city':cityUpdateFather },
            success:function(data){
                // prompt('',data); return false;
                // $("#regPostal1").empty();
                // alert(data[0]['zip_Code']);
                $("#regFathersPostal").val(data[0]['zip_Code']);
            }
        });
    });


    // MOTHER ADDRESS
    $("#regMothersCountry").on('change',function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/provincesMother',
            method: 'get',
            data: {'country': $(this).val()},
            success:function(data){
                // prompt('',data); return false;
                // alert('as');
                // alert(data.length);
                if(data){
                    //alert (data); return false;
                // alert(data);
                // prompt('',data); return false;
                // alert(data.length);
                    $("#regMothersProvince").empty();
                    $("#regMothersMunicipality").empty();
                    $("#regMothersBarangay").empty();
                    if (data.length == 0){
                        $("#regMothersProvince").append('<option value=" ">--</option>');
                        $("#regMothersMunicipality").prepend('<option value=" ">--</option>');
                        $("#regMothersBarangay").prepend('<option value=" ">--</option>');
                    }
                    else{
                        $("#regMothersProvince").append('<option value=" ">Select Province</option>');
                        $("#regMothersProvince").attr("disabled", false);
                    }
                    for (var n=0; n<data.length; n++) {
                        $("#regMothersProvince").append("<option>"+data[n]['province']+"</option>");
                    }
                }

            }
        });
    });

    $("#regMothersProvince").on('change',function(){
        // alert('asd');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/municipalitiesMother',
            method: 'get',
            data: {'province': $(this).val()},
            success:function(data){
                // prompt('',data); return false;
                $("#regMothersMunicipality").empty();
                $("#regMothersMunicipality").append('<option value="">-Select Town/City-</option>');
                for (var n=0; n<data.length; n++) {
                    $("#regMothersMunicipality").append("<option>"+data[n]['municipality']+"</option>");
                }
                $("#regMothersBarangay").empty();
                $("#regMothersBarangay").append('<option value="">-Select Barangay-</option>');
                $("#regmothersPostal").val('');
            }
        });
    });

    $("#regMothersMunicipality").on('change',function(){
        // alert('asd');
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/brgysMother',
            method: 'get',
            data: {'municipality': $(this).val()},
            success:function(data){
                // prompt('',data); return false;
                $("#regMothersBarangay").empty();
                $("#regMothersBarangay").append('<option value="">-Select Barangay-</option>');
                for (var n=0; n<data.length; n++) {
                    $("#regMothersBarangay").append("<option>"+data[n]['barangay']+"</option>");
                }
                $("#regmothersPostal").val('');
            }
        });
    });
    $("#regMothersBarangay").on('change' ,function(){
        // alert('asd');
        var cityUpdateMother=$("#regMothersMunicipality").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/postalMother',
            method: 'get',
            data: {'brgy': $(this).val(),
            'city':cityUpdateMother },
            success:function(data){
                // prompt('',data); return false;
                // $("#regPostal1").empty();
                // alert(data[0]['zip_Code']);
                $("#regmothersPostal").val(data[0]['zip_Code']);
            }
        });
    });

    // SPOUSE
    $("#regSpousesCountry").on('change',function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/provincesSpouse',
            method: 'get',
            data: {'country': $(this).val()},
            success:function(data){
                // prompt('',data); return false;
                // alert('as');
                // alert(data.length);
                if(data){
                    //alert (data); return false;
                // alert(data);
                // prompt('',data); return false;
                // alert(data.length);
                    $("#regSpousesProvince").empty();
                    $("#regSpousesMunicipality").empty();
                    $("#regSpousesBarangay").empty();
                    if (data.length == 0){
                        $("#regSpousesProvince").append('<option value=" ">--</option>');
                        $("#regSpousesMunicipality").prepend('<option value=" ">--</option>');
                        $("#regSpousesBarangay").prepend('<option value=" ">--</option>');
                    }
                    else{
                        $("#regSpousesProvince").append('<option value=" ">Select Province</option>');
                        $("#regSpousesProvince").attr("disabled", false);
                    }
                    for (var n=0; n<data.length; n++) {
                        $("#regSpousesProvince").append("<option>"+data[n]['province']+"</option>");
                    }
                }

            }
        });
    });

    $("#regSpousesProvince").on('change',function(){
        // alert('asd');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/municipalitiesSpouse',
            method: 'get',
            data: {'province': $(this).val()},
            success:function(data){
                // prompt('',data); return false;
                $("#regSpousesMunicipality").empty();
                $("#regSpousesMunicipality").append('<option value="">-Select Town/City-</option>');
                for (var n=0; n<data.length; n++) {
                    $("#regSpousesMunicipality").append("<option>"+data[n]['municipality']+"</option>");
                }
                $("#regSpousesBarangay").empty();
                $("#regSpousesBarangay").append('<option value="">-Select Barangay-</option>');
                $("#regSpousesPostal").val('');
            }
        });
    });

    $("#regSpousesMunicipality").on('change',function(){
        // alert('asd');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/brgysSpouse',
            method: 'get',
            data: {'municipality': $(this).val()},
            success:function(data){
                // prompt('',data); return false;
                $("#regSpousesBarangay").empty();
                $("#regSpousesBarangay").append('<option value="">-Select Barangay-</option>');
                for (var n=0; n<data.length; n++) {
                    $("#regSpousesBarangay").append("<option>"+data[n]['barangay']+"</option>");
                }
                $("#regSpousesPostal").val('');
            }
        });
    });
    $("#regSpousesBarangay").on('change' ,function(){
        // alert('asd');
        var cityUpdateSpouse=$("#regSpousesBarangay").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/postalSpouse',
            method: 'get',
            data: {'brgy': $(this).val(),
            'city':cityUpdateSpouse },
            success:function(data){
                // prompt('',data); return false;
                // $("#regPostal1").empty();
                // alert(data[0]['zip_Code']);
                $("#regSpousesPostal").val(data[0]['zip_Code']);
            }
        });
    });

    // EMERGENCY CONTACT AJAX
    $("#regEmergencyCountry").on('change',function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/provincesEmergency',
            method: 'get',
            data: {'country': $(this).val()},
            success:function(data){
                // prompt('',data); return false;
                // alert('as');
                // alert(data.length);
                if(data){
                    //alert (data); return false;
                // alert(data);
                // prompt('',data); return false;
                // alert(data.length);
                    $("#regEmergencyProvince").empty();
                    $("#regEmergencyMunicipality").empty();
                    $("#regEmergencyBarangay").empty();
                    if (data.length == 0){
                        $("#regEmergencyProvince").append('<option value=" ">--</option>');
                        $("#regEmergencyMunicipality").prepend('<option value=" ">--</option>');
                        $("#regEmergencyBarangay").prepend('<option value=" ">--</option>');
                    }
                    else{
                        $("#regEmergencyProvince").append('<option value=" ">Select Province</option>');
                        $("#regEmergencyProvince").attr("disabled", false);
                    }
                    for (var n=0; n<data.length; n++) {
                        $("#regEmergencyProvince").append("<option>"+data[n]['province']+"</option>");
                    }
                }

            }
        });
    });

    $("#regEmergencyProvince").on('change',function(){
        // alert('asd');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/municipalitiesEmergency',
            method: 'get',
            data: {'province': $(this).val()},
            success:function(data){
                // prompt('',data); return false;
                $("#regEmergencyMunicipality").empty();
                $("#regEmergencyMunicipality").append('<option value="">-Select Town/City-</option>');
                for (var n=0; n<data.length; n++) {
                    $("#regEmergencyMunicipality").append("<option>"+data[n]['municipality']+"</option>");
                }
                $("#regEmergencyBarangay").empty();
                $("#regEmergencyBarangay").append('<option value="">-Select Barangay-</option>');
                $("#regEmergencyPostal").val('');
            }
        });
    });

    $("#regEmergencyMunicipality").on('change',function(){
        // alert('asd');
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/brgysEmergency',
            method: 'get',
            data: {'municipality': $(this).val()},
            
            success:function(data){
                // prompt('',data); return false;
                $("#regEmergencyBarangay").empty();
                $("#regEmergencyBarangay").append('<option value="">-Select Barangay-</option>');
                for (var n=0; n<data.length; n++) {
                    $("#regEmergencyBarangay").append("<option>"+data[n]['barangay']+"</option>");
                }
                $("#emergencyPostal").val('');
            }
        });
    });

    $("#regEmergencyBarangay").on('change' ,function(){
        // alert('asd');
        var cityUpdateEmergency=$("#regEmergencyMunicipality").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/postalEmergency',
            method: 'get',
            data: {'brgy': $(this).val(),
            'city':cityUpdateEmergency },
            success:function(data){
                // prompt('',data); return false;
                // $("#regPostal1").empty();
                // alert(data[0]['zip_Code']);
                $("#regEmergencyPostal").val(data[0]['zip_Code']);
            }
        });
    });


    





    // ADD CONTACT
    // $("#addContact").on('click',function(){
    //     document.getElementById("#addContact").style.display = inline-block;
    // });
    

    // $("#addContact").on("click", function() {
    //     // alert("as");
    //     $('#addingContact').addClass("hidden");
    //     $('#addingContact1').removeClass("hidden");
    //     $('#anotherContact').removeClass("hidden");
    //     $('#anotherContactType').removeClass("hidden");
    //     $('#addingContact1').removeClass("hidden");
    // });

    // $('#addContact1').on("click",function(){
    //     $('#addingContact1').addClass("hidden");
    //     $('#anotherContactType1').removeClass("hidden");
    //     $('#anotherContact1').removeClass("hidden");
    //     $('#addingContact2').removeClass("hidden");
    // });
    // $('#addContact2').on("click",function(){
    //     $('#addingContact2').addClass("hidden");
    //     $('#anotherContactType3').removeClass("hidden");
    //     $('#anotherContact3').removeClass("hidden");
    // });

    $('#closeAdd').on("click", function(){
        // alert('as');
        // $('#studentModal').modal('hide'); 
        $('#addingContact1').addClass("hidden");
        $('#addingContact').addClass("hidden");
    });


    // ADD PROVIDER
    $("#addAnotherProvider").click(function(){
        $("#anotherProvider1").removeClass("hidden");
        $("#addAnotherProvider").addClass("hidden");
    });


   
    $("#bday11").on('input',function(){
        this.type = 'text';
        var input = this.value;
        if (/\D\/$/.test(input)) input = input.substr(0, input.length - 3);
        var values = input.split('-').map(function(v) {
            return v.replace(/\D/g, '')
        });
        if (values[0]) values[0] = checkValue(values[0], 12);
        if (values[1]) values[1] = checkValue(values[1], 31);
        var output = values.map(function(v, i) {
            return v.length == 2 && i < 2 ? v + '-' : v;
        });
        this.value = output.join('').substr(0, 14);
    });
   
    //age calculation thru birthday
    $('#bday11').change(function () {
        var now = new Date();   //Current Date
        var past = new Date($('#bday11').val());  //Date of Birth
        // alert(past);
        if (past > now) {
            alert('Entered Date is Greater than Current Date');
            return false;
        }
        var nowYear = now.getFullYear();  //Get current year
        var pastYear = past.getFullYear();//Get Date of Birth year
        var age = nowYear - pastYear;  //calculate the difference
        $('#age1').val(age);
        // $('#age1').text(age+"years old");
    });
    

        $('.datepicker1').datepicker({
            dateFormat: 'mm-dd-yy',
            changeMonth: true,
            changeYear: true,
            autoclose: true,
            yearRange: "1800:2080"

        });

        $('#bday1').change(function() {
            var now = new Date();   //Current Date
            var past = new Date($('#bday1').val());  //Date of Birth
            // alert(now+past)
            if (past > now) {
                alert('Entered Date is Greater than Current Date');
                return false;
            }
            var nowYear = now.getFullYear();  //Get current year
            var pastYear = past.getFullYear();//Get Date of Birth year
            var age = nowYear - pastYear;  //calculate the difference
            $('#age').val(age);
            $('#age').text(age+"years old");
        });
        
    
            // $('.datepicker').datepicker({
            //     dateFormat: 'mm/dd/yy',
            //     changeMonth: true,
            //     changeYear: true,
            //     autoclose: true,
            //     yearRange: "1800:2080"
    
            // });

        $('#viewPatientModal').modal({
            show: false
          });

          
          
        

    $( "#updateBtn" ).click(function() {

        $('#regCountry1').empty();

    });

    $(".tabs").click(function(){
    
        $(".tabs").removeClass("active");
        $(".tabs h6").removeClass("font-weight-bold");    
        $(".tabs h6").addClass("text-muted");    
        $(this).children("h6").removeClass("text-muted");
        $(this).children("h6").addClass("font-weight-bold");
        $(this).addClass("active");
    
        current_fs = $(".active");
    
        next_fs = $(this).attr('id');
        next_fs = "#" + next_fs + "1";
    
        $("fieldset").removeClass("show");
        $(next_fs).addClass("show");
    
        current_fs.animate({}, {
            step: function() {
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({
                    'display': 'block'
                });
            }
        });
    });

    $(window).keydown(function(event){
        if(event.keyCode == 13) {
          event.preventDefault();
          return false;
        }
      });
    //   $("#relationMem").on('change',function(){
    //     var client_type = $('#relationMem').find(":selected").text();
    //    if(client_type == "Dependent"){
    //         $('#dependentProvider').removeClass('hidden');
           
    //    }
    //   });

      $("#providerName1").on('change',function() {
        
        if($("#providerName1").val()!=""){
            $("#memberLname1").val( $("#U_LASTNAME").val());
            $("#memberLname1").val( $("#U_LASTNAME").val());
            $("#memberFname1").val( $("#U_FIRSTNAME").val());
            $("#memberMname1").val( $("#U_MIDDLENAME").val());
            $("#memberEname1").val( $("#extensionName").val());
            
            $("#memberSex1").val( $("#updatesex").val());
            $("#memberSex1").css("pointer-events","none");
            $("#memberBDay1").val( $("#bday1").val()); 
        }else{
            $("#memberLname1").val('');
            $("#memberLname1").val('');
            $("#memberFname1").val('');
            $("#memberMname1").val('');
            $("#memberEname1").val('');
            
            $("#memberSex1").val('');
            $("#memberSex1").css("pointer-events","auto");;
            $("#memberBDay1").val(''); 
        }
        
        $("#relationMem").prop('readonly', false); //disable 
        $("#insMemTypeID").prop('readonly', false); //disable
        // alert($("#U_LASTNAME").val());

        if($("#providerName1").val()=="Others:Please Specify"){
            $('#otherHmo1').prop('readonly', false);
            // alert('s');
        }else {
            $("#relationMem").val('');
            $("#insMemTypeID").val('');
            // $("#insMemTypeID").text('');

        }

        if($("#relationMem1").val()=="Dependent"){
            $("#providerName3").val($("#providerName1").val());
        }
        else{
            $("#providerName3").val("");
        }

        // if( $('#dependentProvider').)
      });

      $("#relationMem1").on('change',function() {
        // alert(("#U_BIRTHDATE").val());
        if ($(this).val() == "Member") {
            $("#insMemTypeID1").attr("readonly", false);
            
            $("#insMemTypeID1").val("");
            $("#insMemTypeID1").css("pointer-events","auto");
            $('#dependentProvider').addClass('hidden');
            $("#providerName3").val("");
            $("#otherHmo3").val("");
            $("#providerName3").css("pointer-events","auto");
            $("#relationMem3").val("");
            $("#relationMem3").css("pointer-events","auto");

        }
        else if($(this).val() == "Dependent") {

            $("#insMemTypeID1").attr("readonly", true);
            $("#insMemTypeID1").val("Sponsored");
            $("#insMemTypeID1").css("pointer-events","none");
            $('#dependentProvider').removeClass('hidden');
            $("#providerName3").val($("#providerName1").val());
            $("#otherHmo3").val($("#otherHmo1").val());
            $("#providerName3").css("pointer-events","none");
            $("#relationMem3").val("Member");
            $("#relationMem3").css("pointer-events","none");

          }
         else {
            // $("#memberLname").prop('readonly', true); //disable 
        }
      });

      $("#relationMem2").on('change',function() {
        // alert(("#U_BIRTHDATE").val());
        if ($(this).val() == "Member") {
            $("#insMemTypeID2").attr("readonly", false);
            // $("#insMemTypeID2").attr("readonly", true);
            $("#insMemTypeID2").val();
            $("#insMemTypeID2").css("pointer-events","auto");
            $('#dependentProvider1').addClass('hidden');
            $("#otherHmo4").val('');
            $("#providerName4").val('');
            $("#providerName4").css("pointer-events","auto");
            $("#relationMem4").val('');
            $("#relationMem4").css("pointer-events","auto");
        }
        else if($(this).val() == "Dependent") {

            $("#insMemTypeID2").attr("readonly", true);
            $("#insMemTypeID2").val("Sponsored");
            $("#insMemTypeID2").css("pointer-events","none");
            $('#dependentProvider1').removeClass('hidden');
            $("#otherHmo4").val($("#otherHmo2").val());
            $("#providerName4").val($("#providerName2").val());
            $("#providerName4").css("pointer-events","none");
            $("#relationMem4").val("Member");
            $("#relationMem4").css("pointer-events","none");

          }
         else {
            
        }
      });


      $("#providerName2").on('change',function() {
        
        if($("#providerName2").val()!=""){
            $("#memberLname2").val( $("#U_LASTNAME").val());
            $("#memberLname2").val( $("#U_LASTNAME").val());
            $("#memberFname2").val( $("#U_FIRSTNAME").val());
            $("#memberMname2").val( $("#U_MIDDLENAME").val());
            $("#memberEname2").val( $("#extensionName").val());
            
            $("#memberSex2").val( $("#updatesex").val());
            $("#memberSex2").css("pointer-events","none");;
            $("#memberBDay2").val( $("#bday1").val()); 
        }else{
            $("#memberLname2").val('');
            $("#memberLname2").val('');
            $("#memberFname2").val('');
            $("#memberMname2").val('');
            $("#memberEname2").val('');
            
            $("#memberSex2").val('');
            $("#memberSex2").css("pointer-events","auto");;
            $("#memberBDay2").val(''); 
        }
        
        $("#relationMem").prop('readonly', false); //disable 
        $("#insMemTypeID").prop('readonly', false); //disable
        // alert($("#U_LASTNAME").val());

        if($("#providerName2").val()=="Others:Please Specify"){
            $('#otherHmo2').prop('readonly', false);
            // alert('s');
        }else {
            $("#relationMem").val('');
            $("#insMemTypeID").val('');
            // $("#insMemTypeID").text('');

        }

        if($("#relationMem2").val()=="Dependent"){
            $("#providerName4").val($("#providerName2").val());
        }
        else{
            $("#providerName4").val("");
        }
      });


    
      

        // SAME FATHER'S ADDRESS WITH PATIENT
        $("#sameFatherAddress").change(function() {
            if(this.checked) {
                // alert($("#regPostal2").val());
                $("#fatherHouseNo").val( $("#houseNo").val()); 
                // $("#fatherHouseNo").val( $("#houseNo").val()); 
                $("#fatherStreet").val( $("#street").val()); 
                $("#regFathersCountry").empty();
                $("#regFathersProvince").empty();
                $("#regfathersMunicipality").empty();
                $("#regFathersBarangay").empty();
                $("#regFathersPostal").empty();
                $("#regFathersCountry").prop('readonly', true);
                $("#regFathersProvince").prop('readonly', true);
                $("#regfathersMunicipality").prop('readonly', true);
                $("#regFathersBarangay").prop('readonly', true);
                $("#regFathersPostal").prop('readonly', true);
                $("#fatherHouseNo").prop('readonly', true);
                $("#fatherStreet").prop('readonly', true);
                // $("#regFathersCountry").text('<option value="'+$("#regCountry1").val()+'">'+ $("#regCountryUpdate").val()+'</option>');// '<option value="">-Select Barangay-</option>'

                $("#regFathersCountry").append('<option value="'+$("#regCountryUpdate").val()+'">'+ $("#regCountryUpdate").val()+'</option>');// '<option value="">-Select Barangay-</option>'
                $("#regFathersProvince").append('<option value="'+$("#regProvinceUpdate").val()+'">'+ $("#regProvinceUpdate").val()+'</option>');
                $("#regfathersMunicipality").append('<option value="'+$("#regMunicipalityUpdate").val()+'">'+ $("#regMunicipalityUpdate").val()+'</option>');
                $("#regFathersBarangay").append('<option value="'+$("#regBarangayUpdate").val()+'">'+ $("#regBarangayUpdate").val()+'</option>');
                $("#regFathersPostal").val( $("#regPostalUpdate").val()); 
                // alert($("#regCountry1").val());
                
            }
            else{
                $("#regFathersCountry").prop('readonly', false);
                $("#regFathersProvince").prop('readonly', false);
                $("#regfathersMunicipality").prop('readonly', false);
                $("#regFathersBarangay").prop('readonly', false);
                $("#regFathersPostal").prop('readonly', false);
                $("#fatherHouseNo").prop('readonly', false);
                $("#fatherStreet").prop('readonly', false);
                $("#fatherHouseNo").val(''); 

                
                $("#fatherHouseNo").val( $("#houseNo").val()); 
                $("#fatherStreet").val(''); 
                $("#regFathersCountry").val(''); 
                $("#regFathersCountry").text(''); 
                $("#regFathersProvince").val(''); 
                $("#regfathersMunicipality").val(''); 
                $("#regFathersBarangay").val(''); 
                $("#regFathersPostal").val(''); 
                identifier = document.getElementById("regFathersCountry");
                // alert(identifier);
                getAddress(identifier);
            }
        });

        // SAME MOTHERS'S ADDRESS WITH PATIENT
        $("#sameMotherAddress").change(function() {
            if(this.checked) {
                // alert($("#regPostal1").val());
                $("#motherHouseNo").val( $("#houseNo").val()); 
                // $("#motherHouseNo").val( $("#houseNo").val()); 
                $("#motherStreet").val( $("#street").val()); 
                $("#regMothersCountry").empty();
                $("#regMothersProvince").empty();
                $("#regMothersMunicipality").empty();
                $("#regMothersBarangay").empty();
                $("#regMothersPostal").empty();
                $("#regMothersCountry").prop('readonly', true);
                $("#regMothersProvince").prop('readonly', true);
                $("#regMothersMunicipality").prop('readonly', true);
                $("#regMothersBarangay").prop('readonly', true);
                $("#regMothersPostal").prop('readonly', true);
                $("#motherHouseNo").prop('readonly', true);
                $("#motherStreet").prop('readonly', true);
                $("#regMothersCountry").append('<option value="'+$("#regCountryUpdate").val()+'">'+ $("#regCountryUpdate").val()+'</option>');// '<option value="">-Select Barangay-</option>'
                $("#regMothersProvince").append('<option value="'+$("#regProvinceUpdate").val()+'">'+ $("#regProvinceUpdate").val()+'</option>');
                $("#regMothersMunicipality").append('<option value="'+$("#regMunicipalityUpdate").val()+'">'+ $("#regMunicipalityUpdate").val()+'</option>');
                $("#regMothersBarangay").append('<option value="'+$("#regBarangayUpdate").val()+'">'+ $("#regBarangayUpdate").val()+'</option>');
                $("#regmothersPostal").val( $("#regPostalUpdate").val()); 
            }
            else{
                $("#regMothersBarangay").prop('readonly', false);
                $("#regMothersProvince").prop('readonly', false);
                $("#regMothersMunicipality").prop('readonly', false);
                $("#regMothersBarangay").prop('readonly', false);
                $("#regmothersPostal").prop('readonly', false);
                $("#motherHouseNo").prop('readonly', false);
                $("#motherStreet").prop('readonly', false);
                $("#motherHouseNo").val(''); 
                $("#spouseStreet").val(''); 
                $("#regMothersCountry").val(''); 
                $("#regMothersCountry").text(''); 
                $("#regMothersProvince").val(''); 
                $("#regMothersMunicipality").val(''); 
                $("#regMothersBarangay").val(''); 
                $("#regMothersPostal").val(''); 
                identifier = document.getElementById("regMothersCountry");
                // alert(identifier);
                getAddress(identifier);
                // getAddress("regMothersCountry")
            }
        });

        // SAME SPOUSE'S ADDRESS WITH PATIENT
        $("#sameSpouseAddress").change(function() {
            if(this.checked) {
                // alert($("#regPostal1").val());
                $("#spouseHouseNo").val( $("#houseNo").val()); 
                // $("#fatherHouseNo").val( $("#houseNo").val()); 
                $("#spouseStreet").val( $("#street").val()); 
                $("#regSpousesCountry").empty();
                $("#regSpousesProvince").empty();
                $("#regSpousesMunicipality").empty();
                $("#regSpousesBarangay").empty();
                $("#regSpousesPostal").empty();
                $("#regSpousesCountry").prop('readonly', true);
                $("#regSpousesProvince").prop('readonly', true);
                $("#regSpousesMunicipality").prop('readonly', true);
                $("#regSpousesBarangay").prop('readonly', true);
                $("#regSpousesPostal").prop('readonly', true);
                $("#spouseHouseNo").prop('readonly', true);
                $("#spouseStreet").prop('readonly', true);
                // $("#regFathersCountry").text('<option value="'+$("#regCountry1").val()+'">'+ $("#regCountryUpdate").val()+'</option>');// '<option value="">-Select Barangay-</option>'

                $("#regSpousesCountry").append('<option value="'+$("#regCountryUpdate").val()+'">'+ $("#regCountryUpdate").val()+'</option>');// '<option value="">-Select Barangay-</option>'
                $("#regSpousesProvince").append('<option value="'+$("#regProvinceUpdate").val()+'">'+ $("#regProvinceUpdate").val()+'</option>');
                $("#regSpousesMunicipality").append('<option value="'+$("#regMunicipalityUpdate").val()+'">'+ $("#regMunicipalityUpdate").val()+'</option>');
                $("#regSpousesBarangay").append('<option value="'+$("#regBarangayUpdate").val()+'">'+ $("#regBarangayUpdate").val()+'</option>');
                $("#regSpousesPostal").val( $("#regPostalUpdate").val()); 
                // alert($("#regCountry1").val());
                
            }
            else{
                $("#regSpousesCountry").prop('readonly', false);
                $("#regSpousesProvince").prop('readonly', false);
                $("#regSpousesMunicipality").prop('readonly', false);
                $("#regSpousesBarangay").prop('readonly', false);
                $("#regSpousesPostal").prop('readonly', false);
                $("#spouseHouseNo").prop('readonly', false);
                $("#spouseStreet").prop('readonly', false);
                $("#spouseHouseNo").val(''); 
                $("#spouseStreet").val(''); 
                $("#regSpousesCountry").val(''); 
                $("#regSpousesCountry").text(''); 
                $("#regSpousesProvince").val(''); 
                $("#regSpousesMunicipality").val(''); 
                $("#regSpousesBarangay").val(''); 
                $("#regSpousesPostal").val(''); 
                identifier = document.getElementById("regSpousesCountry");
                // alert(identifier);
                getAddress(identifier);
            }
        });
        // SAME EMERGENCY'S ADDRESS WITH PATIENT
        $("#sameEmergencyAddress").change(function() {
            if(this.checked) {
                // alert($("#regPostal1").val());
                $("#fatherHouseNo").val( $("#houseNo").val()); 
                // $("#fatherHouseNo").val( $("#houseNo").val()); 
                $("#emergencyStreet").val( $("#street").val()); 
                $("#regEmergencyCountry").empty();
                $("#regEmergencyProvince").empty();
                $("#regEmergencyMunicipality").empty();
                $("#regEmergencyBarangay").empty();
                $("#regEmergencyPostal").empty();
                $("#regEmergencyCountry").prop('readonly', true);
                $("#regEmergencyProvince").prop('readonly', true);
                $("#regEmergencyMunicipality").prop('readonly', true);
                $("#regEmergencyBarangay").prop('readonly', true);
                $("#regEmergencyPostal").prop('readonly', true);
                // $("#fatherHouseNo").prop('readonly', true);
                $("#emergencyStreet").prop('readonly', true);
                // $("#regFathersCountry").text('<option value="'+$("#regCountry1").val()+'">'+ $("#regCountryUpdate").val()+'</option>');// '<option value="">-Select Barangay-</option>'

                // $("#regEmergencyCountry").append('<option value="'+$("#regCountryUpdate").val()+'">'+ $("#regCountryUpdate").val()+'</option>');// '<option value="">-Select Barangay-</option>'
                // $("#regEmergencyProvince").append('<option value="'+$("#regProvinceUpdate").val()+'">'+ $("#regProvinceUpdate").val()+'</option>');
                // $("#regEmergencyMunicipality").append('<option value="'+$("#regMunicipalityUpdate").val()+'">'+ $("#regMunicipalityUpdate").val()+'</option>');
                // $("#regEmergencyBarangay").append('<option value="'+$("#regBarangayUpdate").val()+'">'+ $("#regBarangayUpdate").val()+'</option>');

                // $("#regEmergencyCountry").text();
                // // $("#regEmergencyCountry option:selected").text($("#regCountryUpdate").val());
                // $("#regEmergencyProvince option:selected").val($("#regProvinceUpdate").val());
                // $("#regEmergencyProvince option:selected").text($("#regProvinceUpdate").val());
                // $("#regEmergencyMunicipality option:selected").val($("#regMunicipalityUpdate").val());
                // $("#regEmergencyMunicipality option:selected").text($("#regMunicipalityUpdate").val());
                // $("#regEmergencyBarangay").val($("#regBarangayUpdate").val());


                $("#regEmergencyCountry").val($("#regCountryUpdate").val());
                $("#regEmergencyProvince option:selected").val($("#regFathersProvince").val());
                $("#regEmergencyProvince option:selected").text($("#regFathersProvince").val());
                $("#regEmergencyMunicipality option:selected").val($("#regfathersMunicipality").val());
                $("#regEmergencyMunicipality option:selected").text($("#regfathersMunicipality").val());

                $("#emergencyPostal").val( $("#regPostalUpdate").val()); 
                // alert($("#regCountry1").val());
                
            }
            else{
                $("#regEmergencyCountry").prop('readonly', false);
                $("#regEmergencyProvince").prop('readonly', false);
                $("#regEmergencyMunicipality").prop('readonly', false);
                $("#regEmergencyBarangay").prop('readonly', false);
                $("#emergencyPostal").prop('readonly', false);
                $("#emergencyHouseNo").prop('readonly', false);
                $("#emergencyStreet").prop('readonly', false);
                $("#emergencyHouseNo").val(''); 

                
                $("#emergencyHouseNo").val( $("#houseNo").val()); 
                $("#emergencyStreet").val(''); 
                $("#regEmergencyCountry").val(''); 
                $("#regEmergencyCountry").text(''); 
                $("#regEmergencyProvince").val(''); 
                $("#regEmergencyMunicipality").val(''); 
                $("#regEmergencyBarangay").val(''); 
                $("#emergencyPostal").val(''); 
                identifier = document.getElementById("regEmergencyCountry");
                // alert(identifier);
                getAddress(identifier);
            }
        });

    //     $("#patientUpdate").click(function(){
    //     var getID=$("#hiddenInput").val();
    //     // alert(getID);
    //     viewRecord(getID);
    // });

    // ADD ANOTHER FIELD
    $("#addAnotherAllergy4").on('click',function(){
        $('#allegyField2').removeClass('hidden');
        $('#addAnotherAllergy4').addClass('hidden');
        $('#addAnotherAllergy5').removeClass('hidden');
        // alert('as');
    });

    $("#addAnotherAllergy5").on('click',function(){
        $('#allegyField3').removeClass('hidden');
        $('#addAnotherAllergy5').addClass('hidden');
        $('#addAnotherAllergy').removeClass('hidden');
        // alert('as');
    });

    $("#addAnotherAllergy").on('click',function(){
        $('#allegyField4').removeClass('hidden');
        $('#addAnotherAllergy').addClass('hidden');
        $('#addAnotherAllergy1').removeClass('hidden');
        // alert('as');
    });
    $("#addAnotherAllergy1").on('click',function(){
        $('#allegyField5').removeClass('hidden');
        $('#addAnotherAllergy1').addClass('hidden');
        $('#addAnotherAllergy2').removeClass('hidden');
        // alert('as');
    });
    $("#addAnotherAllergy2").on('click',function(){
        $('#allegyField6').removeClass('hidden');
        $('#addAnotherAllergy2').addClass('hidden');
        $('#addAnotherAllergy3').removeClass('hidden');
        // alert('as');
    });
    $("#addAnotherAllergy3").on('click',function(){
        $('#allegyField7').removeClass('hidden');
        $('#addAnotherAllergy3').addClass('hidden');
        
        // alert('as');
    });

    // $("#selectVisit").on("change", function(){

    // });


    // show view visit modal
    $("#viewVisit").click(function(){
        $("#viewPatientModal").modal("hide");
        viewVisit();

    });

    $("#dischargeButton").click(function(){
        var mpiUpdate = $("#mpiUpdate").val();
        var namePatient = $("#nameVisitUpdate").val();
        var mrnUpdate=$("#hpidVisitUpdate").val();
        var visitIDUpdate=$("#visitIDUpdate").val();
        var selectVisitUpdate = $("#selectVisitUpdate").val();
        var hospitalNameInputUpdate= $("#hospitalNameInputUpdate").val();
        var clerkUpdate=$("#clerkUpdate").val();
        var dateArrivalUpdate= $("#dateArrivalUpdate").val();
        var dateDischargedUpdate=$("#dateDischargedUpdate").val();
        var chiefComplaintUpdate=$("#chiefComplaintUpdate").val();
        var icdCodeUpdate=$("#icdCodeUpdate").val();
        var icdDescUpdate = $("#icdDescUpdate").val();
        var FinalDiagnosisUpdate=$("#FinalDiagnosisUpdate").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          
        $.ajax({
            type: "POST",
            url: "/dischargePatient/"+visitIDUpdate,
           
            data:{
                hospitalNameInputUpdate,
                selectVisitUpdate,
                visitIDUpdate,
                mrnUpdate,
                mpiUpdate,
                clerkUpdate,
                dateArrivalUpdate,
                dateDischargedUpdate,
                chiefComplaintUpdate,
                icdCodeUpdate,
                icdDescUpdate,
                FinalDiagnosisUpdate,
                // hospCode

            },
            success: function(response) {
                alert(response.msg);
                window.location.replace("/home");
            }
        });
    }); 

    $("#resetICDViewing").click(function(){
        $("#icdCodeUpdate").val('');
        $("#icdDescUpdate").val('');
        checkVisitContent()
    });

    $("#resetICDCreate").click(function(){
        $("#icdCode").val('');
        $("#icdDesc").val('');
        // checkVisitContent()
    });

    // required fields
    $("#addFirstName").on("keyup", function(){
        checkField();
    });
    $("#addLastName").on("keyup", function(){
        checkField();
    });
    $("#addMiddleName").on("keyup", function(){
        checkField();
    });
    $("#bday11").on("keyup change", function(){
        checkField();
    });
    $("#regCivilStatus").on("change", function(){
        checkField();
    });
    $("#regSex").on("change", function(){
        checkField();
    });
    $("#regCountry").on("change", function(){
        checkField();
    });
    $("#regProvince").on("change", function(){
        checkField();
    });
    $("#regMunicipality").on("change", function(){
        checkField();
    });
    $("#regBarangay").on("change", function(){
        checkField();
    });
    $("#regstreet").on("keyup", function(){
        checkField();
    });
    $("#regcontactType1").on("change", function(){
        checkField();
    });
    $("#contact1Add").on("keyup", function(){
        checkField();
    });



});


// END DOCUMENT READY
function resetInput(){
    $('#viewPatientModal').modal('hide');

    $("#patientImage").attr("src",'img/profile.png');
    $(".active").removeClass("active");
    $("#tab01").addClass("active");
    $(".show").removeClass("show");
    $("#tab011").addClass("show");
    // $(".tabs").removeClass("active");
    $(".tabs h6").removeClass("font-weight-bold");    
    $(".tabs h6").addClass("text-muted");    
    $("#tab01").children("h6").removeClass("text-muted");
    $("#tab01").children("h6").addClass("font-weight-bold");
    
    $("#hospitalIdtable").empty();

    $("input").val("");
    $("#addaContactUpdate").removeClass("hidden");
    // $("#colsUpdate1").removeClass("hidden");
    // $("#colsUpdate2").removeClass("hidden");
    // $("#colsUpdate3").removeClass("hidden");
    // $("#closeReset").find("input, select").attr('value', '');
    for(var x=1; x<=4;x++){
        $("#contact"+x).val('');
        $("#contactType"+x+" option:selected").val('');
        $("#contactType"+x+" option:selected").text('');
        $("#noteContact"+x).val('');
    }

    $(".colsUpdate1").addClass("hidden");
    $(".colsUpdate2").addClass("hidden");
    $(".colsUpdate3").addClass("hidden");
    $(".colsUpdate4").addClass("hidden");
    updateAdd = 0;
    
    // $(this).addClass("active");
    
   
}

function resetInputAdd(){
    $('#studentModal').modal('hide');
    $("#patientImageRegister").attr("src", "img/profile.png");
    // $(".cols1").addClass("hidden");
    $(".cols2").addClass("hidden");
    $(".cols3").addClass("hidden");
    $(".cols4").addClass("hidden");

    var elements = document.getElementsByTagName("input");
    var elementsSelect = document.getElementsByTagName("select");
    for (var ii=0; ii < elements.length; ii++) {
    if (elements[ii].type == "text") {
        elements[ii].value = "";
        // $("select").empty();
        // elementsSelect[ii].text="";
    }
    }
}
function closem(){
    // alert('as');
        // $('#studentModal').modal('hide');
        $('#addingContact').removeClass("hidden");
        $('#anotherContact1').addClass("hidden");
        $('#anotherContactType1').addClass("hidden");
        $('#anotherContactType').addClass("hidden");
        $('#anotherContact').addClass("hidden");
        $('#addingContact').addClass("hidden");
        $('#anotherContactType2').addClass("hidden");
        $('#anotherContact2').addClass("hidden");
        $('#addingContact2').addClass("hidden");
        // $('#addingContact').removeClass("hidden");

        
       
}
function closeModal(){
    ('#confirmModal').modal('hide');

    
}
function viewRecord($id,$img){
        $('#viewPatientModal').modal('show');
        // $("#countContactUpdate").val(updateAdd);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // alert($id);
        $('#titleError').text('');
        $('#descriptionError').text('');
        // $('#viewPatientModal').modal('show');
        $.ajax({
            url: `home/`+$id,
            method: "GET",
            success: function(response) {
                // alert(response.hmos);
                $obj=JSON.stringify(response.mpr);
                // alert($obj);
                $hispatients = JSON.parse($obj);

                $obj1=JSON.stringify(response.contacts);
                // alert($obj1);
                $cont = JSON.parse($obj1);
                // alert($cont);
                $obj2=JSON.stringify(response.hmos);
                // alert($obj2);
                $hmoObjects = JSON.parse($obj2);

                // alert($hmoObjects.length);

                $obj3=JSON.stringify(response.img);
                $imageObject = JSON.parse($obj3);

                $obj4=JSON.stringify(response.hospitalIDs);
                // alert($obj4.HOSPITALID);
                $idsObject = JSON.parse($obj4);

                $obj6=JSON.stringify(response.hpidCurrent);
                $currentHPID=JSON.parse($obj6);
                // alert($currentHPID)
                // alert($idsObject[0].HOSPITALID);
                // ale
                // alert($hmoObjects[0]['memberFname']);
                // alert($hispatients.countContacts);
                // alert($hmoObjects.memberFname);
            //    alert($o.NAME);
               
                // $patientCode=response.U_FIRSTNAME;
                // alert($patientCode);
                // alert($hmoObjects[0]['hmoName']);

                $obj5=JSON.stringify(response.hospitalProfiles);
                $profilesObject = JSON.parse($obj5);


                if(response.checkVisits!=null){
                    if(response.checkVisits.DOCSTATUS=="Active"){
                       $("#addVisit").prop("disabled", true);
                   }
                   else{
                       // $("#addVisit").prop("disabled", true);
                       $("#viewVisit").prop("disabled", true);
                       
                   }
               }else{
                // alert("asdr");
                $("#addVisit").prop("disabled", false);
                $("#viewVisit").prop("disabled", true);
            }



                // $obj7=JSON.stringify(response.icd10codes);
                // $icd10s=JSON.parse($obj7);

                
                if(response) {

                    // $("#").attr("href", "/masterpatientrecord/"+$hispatients.CODE);
                    
                    if($hispatients.U_GENDER=="M"){
                        $patientGender="MALE";
                    }else if($hispatients.U_GENDER=="F"){
                        $patientGender="FEMALE";
                    }else{
                        $patientGender="NON-BINARY";
                    }

                    // switch($hispatients.countContacts){
                    //     case 1:
                    //         $("#emailsUpdate1").removeClass("hidden");
                    //         break;
                    //     case 2:
                    //         $("#emailsUpdate1").removeClass("hidden");
                    //         $("#emailsUpdate2").removeClass("hidden");
                    //         break;
                    //     case 3:
                    //         $("#emailsUpdate1").removeClass("hidden");
                    //         $("#emailsUpdate2").removeClass("hidden");
                    //         $("#emailsUpdate3").removeClass("hidden");
                    //         break;
                    //     case 4:
                    //         $("#emailsUpdate1").removeClass("hidden");
                    //         $("#emailsUpdate2").removeClass("hidden");
                    //         $("#emailsUpdate3").removeClass("hidden");
                    //         $("#emailsUpdate4").removeClass("hidden");
                    //         break;

                    // }
                    
                    $patientIndex=$hispatients.CODE;
                    // personal information
                        updateAdd = $hispatients.countContacts;
                        initialCount = $hispatients.countContacts;
                        $initialCount=$hispatients.countContacts;
                        $("#countContactUpdate").val($hispatients.countContacts);
                        $("#hiddenInput").val($hispatients.CODE);
                        $("#CODE").val($hispatients.CODE);
                        $("#U_FIRSTNAME").val($hispatients.U_FIRSTNAME);
                        $("#U_MIDDLENAME").val($hispatients.U_MIDDLENAME);
                        $("#U_LASTNAME").val($hispatients.U_LASTNAME);
                        $("#extensionName").val($hispatients.U_EXTNAME);

                        var getDate = new Date($hispatients.U_BIRTHDATE);
                        $("#bday1").val($hispatients.U_BIRTHDATE);
                        $("#age").val($hispatients.U_AGE);
                        
                        $("#updatesex").val($hispatients.U_GENDER);
                        
                        $("#civilStat").val($hispatients.U_CIVILSTATUS);
                        $("#U_CIVILSTATUS").val($hispatients.U_CIVILSTATUS);
                        $("#U_BIRTHPLACE").val($hispatients.U_BIRTHPLACE);
                        // $("#U_NATIONALITY").text($hispatients.U_NATIONALITY);
                        $('#U_NATIONALITY option:selected').text($hispatients.U_NATIONALITY);
                        $('#U_NATIONALITY option:selected').val($hispatients.U_NATIONALITY);
                        $("#U_RELIGION").val($hispatients.U_RELIGION);
                        $("#U_OCCUPATION").val($hispatients.U_OCCUPATION);

                        $("#createdBy").val($hispatients.CREATEDBY);
                        $("#createdDate").val($hispatients.DATECREATED);

                        $("#idNumberUpdate").val($hispatients.idNumber);
                        $("#idTypeUpdate").val($hispatients.idType);


                
                        $("#regCountryUpdate").prepend("<option selected value='"+$hispatients.U_COUNTRY+"'>"+$hispatients.U_COUNTRY+"</option>");

                        //   $('#regCountryUpdate').trigger('change');
                        //   $('#regCountryUpdate').find(':selected').text($hispatients.U_COUNTRY);
                        
                        // $("#getProvince").text($hispatients.U_PROVINCE);
                        // alert($hispatients.U_PROVINCE);
                        // $('#regProvinceUpdate').trigger('change');
                        $("#regProvinceUpdate").append("<option selected value='"+$hispatients.U_PROVINCE+"'>"+$hispatients.U_PROVINCE+"</option>");
                        
                        // $("#getCity").text($hispatients.U_CITY);
                        $("#regMunicipalityUpdate").append("<option selected value='"+$hispatients.U_CITY+"'>"+$hispatients.U_CITY+"</option>");
                        $("#regBarangayUpdate").append("<option selected value='"+$hispatients.U_BARANGAY+"'>"+$hispatients.U_BARANGAY+"</option>");

                        // $("#getCity").val($hispatients.U_CITY);
                        // $('#getCity').trigger('change');
                        // // $("#getBrgy").text($hispatients.U_BARANGAY);
                        // $("#getBrgy").val($hispatients.U_BARANGAY);
                        // $('#getBrgy').trigger('change')
                       
                        $("#houseNo").val($hispatients.U_HOUSENO);
                        $("#street").val($hispatients.U_STREET);
                        $("#regPostalUpdate").val($hispatients.U_ZIP);
                        

                    

                    $("#fatherFirstName").val($hispatients.U_FATHERSFIRSTNAME);
                    $("#fatherLastName").val($hispatients.U_FATHERSLASTNAME);
                    $("#fatherMiddleName").val($hispatients.U_FATHERSMIDDLENAME);
                    $("#fatherExtName").val($hispatients.U_FATHERSEXTNAME);
                    $("#fatherContactNo").val($hispatients.U_FATHERTELNO);

                    $("#motherFirstName").val($hispatients.U_MOTHERSFIRSTNAME);
                    $("#motherLastName").val($hispatients.U_MOTHERSLASTNAME);
                    $("#motherMiddleName").val($hispatients.U_MOTHERSMIDDLENAME);
                    $("#motherExtName").val($hispatients.U_MOTHERSEXTNAME);
                    $("#motherContactNo").val($hispatients.U_MOTHERTELNO);

                        

                        $("#spouseFirstName").val($hispatients.U_SPOUSEFIRSTNAME);
                        $("#spouseLastName").val($hispatients.U_SPOUSELASTNAME);
                        $("#spouseMiddleName").val($hispatients.U_SPOUSEMIDDLENAME);
                        $("#spouseExtName").val($hispatients.U_SPOUSEEXTNAME);
                    $("#spouseContactNo").val($hispatients.U_SPOUSETELNO);
            
                  $('#regFathersCountry').val($hispatients.U_FATHERCOUNTRY);
                  $('#regFathersCountry').val($hispatients.U_FATHERCOUNTRY);
                  $('#getFathersProvince').text($hispatients.U_FATHERPROVINCE);
                  $('#getFathersProvince').val($hispatients.U_FATHERPROVINCE);
                  $('#getFathersProvince').val($hispatients.U_FATHERPROVINCE);
                  $('#getFathersProvince').text($hispatients.U_FATHERPROVINCE);
                  $('#getFathersMunicipality').val($hispatients.U_FATHERCITY);
                  $('#getFathersMunicipality').text($hispatients.U_FATHERCITY);
                  $('#getFathersBrgy').val($hispatients.U_FATHERBARANGAY);
                  $('#getFathersBrgy').text($hispatients.U_FATHERBARANGAY);
                  $('#regFathersPostal').val($hispatients.U_FATHERZIP);
                  $('#fatherHouseNo').val($hispatients.U_FATHERHOUSENO);
                  $('#fatherStreet').val($hispatients.U_FATHERSTREET);
                  $('#fatherContactNo').val($hispatients.U_FATHERTELNO);
                //   $('#regFathersMunicipality').val($hispatients.U_FATHERMUNICIPALITY);
                //   $('#regFathersBarangay option:selected').text($hispatients.U_FATHERBARANGAY);
                  $('#regMothersCountry').val($hispatients.U_MOTHERCOUNTRY);
                //   $('#regMothersCountry').val($hispatients.U_MOTHERCOUNTRY);
                  $('#getMotherProvince').text($hispatients.U_MOTHERPROVINCE);
                  $('#getMotherProvince').val($hispatients.U_MOTHERPROVINCE);
                  $('#getMotherCity').text($hispatients.U_MOTHERCITY);
                  $('#getMotherCity').val($hispatients.U_MOTHERCITY);
                  $('#getMotherBrgy').text($hispatients.U_MOTHERBARANGAY);
                  $('#getMotherBrgy').val($hispatients.U_MOTHERBARANGAY);
                  $('#regmothersPostal').val($hispatients.U_MOTHERZIP);
                  $('#motherHouseNo').val($hispatients.U_MOTHERHOUSENO);
                  $('#motherStreet').val($hispatients.U_MOTHERSTREET);



                  $('#regSpousesCountry').val($hispatients.U_SPOUSECOUNTRY);
                  
                  $('#getSpouseProvince').text($hispatients.U_SPOUSEPROVINCE);
                  $('#getSpouseProvince').val($hispatients.U_SPOUSEPROVINCE);
                  $('#getSpouseCity').val($hispatients.U_SPOUSECITY);
                  $('#getSpouseCity').text($hispatients.U_SPOUSECITY);
                  $('#getSpouseBrgy').text($hispatients.U_SPOUSEBARANGAY);
                  $('#getSpouseBrgy').val($hispatients.U_SPOUSEBARANGAY);
                  $('#getSpousesPostal').val($hispatients.U_SPOUSEBARANGAY);
                  $('#regSpousesPostal').val($hispatients.U_SPOUSEZIP);
                  $('#spouseHouseNo').val($hispatients.U_SPOUSEHOUSENO);
                  $('#spouseStreet').val($hispatients.U_SPOUSESTREET);



                    $("#emergencyLastName").val($hispatients.U_CONTACTLASTNAME);
                    $("#emergencyFirstName").val($hispatients.U_CONTACTFIRSTNAME);
                    $("#emergencyMiddleName").val($hispatients.U_CONTACTMIDDLENAME);
                    $("#emergencyExtName").val($hispatients.U_CONTACTEXTNAME);
                    $("#emergencyContactNo").val($hispatients.U_CONTACTTELNO);
                    $("#regEmergencyCountry").val($hispatients.U_CONTACTCOUNTRY);
                    $("#regEmergencyProvince option:selected").val($hispatients.U_CONTACTPROVINCE);
                    $("#regEmergencyProvince option:selected").text($hispatients.U_CONTACTPROVINCE);
                    $("#regEmergencyMunicipality option:selected").val($hispatients.U_CONTACTCITY);
                    $("#regEmergencyMunicipality option:selected").text($hispatients.U_CONTACTCITY);
                    $("#regEmergencyBarangay option:selected").val($hispatients.U_CONTACTBARANGAY);
                    $("#regEmergencyBarangay option:selected").text($hispatients.U_CONTACTBARANGAY);
                    $("#emergencyStreet").val($hispatients.U_CONTACTSTREET);
                    $("#regEmergencyPostal").val($hispatients.U_CONTACTZIP);
                    $("#relationToPatient").val($hispatients.U_CONTACTRELATIONSHIP);


                    // ALLERGY

                    // for($ss=1;$ss<=7;$ss++){
                    //     var allergy="U_ALLERGY1"+$ss;
                    //     // alert($hispatients.U_ALLERGY1);
                    //     $("#allergy"+$ss).val($hispatients.allergy);
                    // }

                    if($hispatients.U_ALLERGY1!=null){
                        $("#allergy1").val($hispatients.U_ALLERGY1);
                    }

                    if($hispatients.U_ALLERGY2!=null){
                        $("#addAnotherAllergy4").addClass("hidden");
                        $("#allegyField2").removeClass("hidden");
                        $("#allergy2").val($hispatients.U_ALLERGY2);
                    }

                    if($hispatients.U_ALLERGY3!=null){
                        $("#addAnotherAllergy5").addClass("hidden");
                        $("#allegyField3").removeClass("hidden");
                        $("#allergy3").val($hispatients.U_ALLERGY3);
                    }
                    if($hispatients.U_ALLERGY4!=null){
                        $("#addAnotherAllergy").addClass("hidden");
                        $("#allegyField4").removeClass("hidden");
                        $("#allergy4").val($hispatients.U_ALLERGY4);
                    }
                    if($hispatients.U_ALLERGY5!=null){
                        $("#addAnotherAllergy1").addClass("hidden");
                        $("#allegyField5").removeClass("hidden");
                        $("#allergy5").val($hispatients.U_ALLERGY5);
                    }
                    if($hispatients.U_ALLERGY6!=null){
                        $("#addAnotherAllergy2").addClass("hidden");
                        $("#allegyField6").removeClass("hidden");
                        $("#allergy6").val($hispatients.U_ALLERGY6);
                    }
                    if($hispatients.U_ALLERGY7!=null){
                        $("#addAnotherAllergy3").addClass("hidden");
                        $("#allegyField7").removeClass("hidden");
                        $("#allergy7").val($hispatients.U_ALLERGY7);
                    }
                //   alert($hispatients.U_SPOUSETELNO);
                  


                //   viewing of contact
                  if($cont!=""){
                    if($hispatients.countContacts>=1){
                        for(var x=1;x<=$hispatients.countContacts;x++){
                            $(".colsUpdate"+x).removeClass("hidden");
                            $("#contact"+x).val($cont[x-1]['contactNumber']);
                            $("#noteContact"+x).val($cont[x-1]['contactNote']);
                            $("#contactType"+x+" option:selected").val($cont[x-1]['contactType']);
                            $("#contactType"+x+" option:selected").text($cont[x-1]['contactType']);
                            $("#hideContact"+x).val($cont[x-1]['contactID']);
                            // $("#noteContact"+x).val($cont[x-1]['contactID']);
                            
                        }
                    }
                  }
                //   end viewing of contacts
                
                // alert(response.emails);
                // start viewing of emails
                  if(response.emails!=""){
                    if($hispatients.countEmail>=1){
                        for(var qq=1;qq<=$hispatients.countEmail;qq++){
                            $(".emailsUpdate"+qq).removeClass("hidden");
                            $("#email"+qq+"Update").val(response.emails[qq-1]['emailAddress']);
                            $("#noteEmail"+qq+"Update").val(response.emails[qq-1]['emailNote']);
                            $("#emailType"+qq+"Update option:selected").val(response.emails[qq-1]['emailType']);
                            $("#emailType"+qq+"Update option:selected").text(response.emails[qq-1]['emailType']);
                            $("#hiddenEmailId"+qq).val(response.emails[qq-1]['emailID']);
                            // $("#noteContact"+x).val($cont[x-1]['contactID']);
                            
                        }
                    }
                  }
                // if($hmoObjects!=""){
                //         $("#providerName").val($hmoObjects[0]['hmoName']);
                //         $("#memberID").val($hmoObjects[0]['hmoAccountID']);
                //         $("#relationMem").val($hmoObjects[0]['clientType']);
                //         $("#insMemTypeID").val($hmoObjects[0]['memberType']);
                //         $("#memberLname").val($hmoObjects[0]['memberLname']);
                //         $("#memberFname").val($hmoObjects[0]['memberFname']);
                //         $("#memberMname").val($hmoObjects[0]['memberMname']);
                //         $("#memberEname").val($hmoObjects[0]['memberEname']);
                //         $("#memberSex").val($hmoObjects[0]['memberSex']);
                //         $("#memberBDay").val($hmoObjects[0]['memberBDay']);
                    
                // }      
                
                if(response.firsthmo!=null){
                    $("#providerName1").val(response.firsthmo['hmoName']);
                    $("#otherHmo1").val(response.firsthmo['otherHmoName']);
                    $("#memberID1").val(response.firsthmo['hmoAccountID']);
                    $("#relationMem1").val(response.firsthmo['clientType']);
                    $("#insMemTypeID1").val(response.firsthmo['memberType']);
                    $("#memberLname1").val(response.firsthmo['memberLname']);
                    $("#memberFname1").val(response.firsthmo['memberFname']);
                    $("#memberMname1").val(response.firsthmo['memberMname']);
                    $("#memberEname1").val(response.firsthmo['memberEname']);
                    $("#memberSex1").val(response.firsthmo['memberSex']);
                    $("#memberBDay1").val(response.firsthmo['memberBDay']);
                }

                if(response.secondhmo!=null){
                    // alert(JSON.stringify(response.secondhmo));
                    $("#anotherProvider1").removeClass("hidden");
                    // providerName2 = document.getElementById("providerName2"); 
                    // displayField(providerName2,response.secondhmo['hmoName']);
                    $("#providerName2").val(response.secondhmo['hmoName']);
                    $("#otherHmo2").val(response.secondhmo['otherHmoName']);
                    $("#memberID2").val(response.secondhmo['hmoAccountID']);
                    $("#relationMem2").val(response.secondhmo['clientType']);
                    $("#insMemTypeID2").val(response.secondhmo['memberType']);
                    $("#memberLname2").val(response.secondhmo['memberLname']);
                    $("#memberFname2").val(response.secondhmo['memberFname']);
                    $("#memberMname2").val(response.secondhmo['memberMname']);
                    $("#memberEname2").val(response.secondhmo['memberEname']);
                    $("#memberSex2").val(response.secondhmo['memberSex']);
                    $("#memberBDay2").val(response.secondhmo['memberBDay']);
                }

                if(response.thirdhmo!=null){
                    $("#dependentProvider").removeClass("hidden");
                    $("#providerName3").val(response.thirdhmo['hmoName']);
                    $("#otherHmo3").val(response.thirdhmo['otherHmoName']);
                    $("#memberID3").val(response.thirdhmo['hmoAccountID']);
                    $("#relationMem3").val(response.thirdhmo['clientType']);
                    $("#insMemTypeID3").val(response.thirdhmo['memberType']);
                    $("#memberLname3").val(response.thirdhmo['memberLname']);
                    $("#memberFname3").val(response.thirdhmo['memberFname']);
                    $("#memberMname3").val(response.thirdhmo['memberMname']);
                    $("#memberEname3").val(response.thirdhmo['memberEname']);
                    $("#memberSex3").val(response.thirdhmo['memberSex']);
                    $("#memberBDay3").val(response.thirdhmo['memberBDay']);
                }

                if(response.fourthhmo!=null){
                    $("#dependentProvider1").removeClass("hidden");
                    $("#providerName4").val(response.fourthhmo['hmoName']);
                    $("#otherHmo4").val(response.fourthhmo['otherHmoName']);
                    $("#memberID4").val(response.fourthhmo['hmoAccountID']);
                    $("#relationMem4").val(response.fourthhmo['clientType']);
                    $("#insMemTypeID4").val(response.fourthhmo['memberType']);
                    $("#memberLname4").val(response.fourthhmo['memberLname']);
                    $("#memberFname4").val(response.fourthhmo['memberFname']);
                    $("#memberMname4").val(response.fourthhmo['memberMname']);
                    $("#memberEname4").val(response.fourthhmo['memberEname']);
                    $("#memberSex4").val(response.fourthhmo['memberSex']);
                    $("#memberBDay4").val(response.fourthhmo['memberBDay']);
                }
                // start viewing of emails
                // alert(JSON.stringify($hmoObjects));
                // alert($hmoObjects.identifier);
                
                $imageUrl = $("#storage").val();


                $arrayLen=$idsObject.length;
                $arrayLength=$profilesObject.length;
                if(response.medInfo!=null){
                    // alert(response.medInfo.U_HEIGHT_CM);
                    $("#centimeter").val(response.medInfo.U_HEIGHT_CM);
                    $("#inch").val(response.medInfo.U_HEIGHT_IN);
                    $("#kg").val(response.medInfo.U_WEIGHT_KG);
                    $("#lb").val(response.medInfo.U_WEIGHT_LB);
                    $("#bmi").val(response.medInfo.U_BMI);
                }
                // alert(JSON.stringify($currentHPID));
                if($currentHPID!=null){

                    // alert(JSON.stringify($currentHPID));
                    if($currentHPID.idSeries!=null){
                        // alert($currentHPID.idSerie);
                        $hpidcurr = $("#hpidUpdate").val($currentHPID.idSeries);
                        $("#hpidUpdate").prop("readonly", true);
                    }
                    else{
                        $("#hpidUpdate").prop("readonly", false );
                    }
                }
                
                // $hosID=

                $("#hospitalIdtable").empty();//prevent adding new row when closing create visit


                if($arrayLen!=0){
                    // alert(arrayLength);
                    for($l=0; $l<$arrayLen;$l++){
                    if($idsObject[$l].HOSPITALID==null){
                        $tempHospID[$l]="";
                    }else{
                        $tempHospID[$l]=$idsObject[$l].HOSPITALID;
                    }
                    $("#hospitalIdtable").append(
                        '<tr>'+
                        '<td>'+$hispatients.CODE+'</td>'+
                        '<td>'+$idsObject[$l].HOSPITALNAME+'</td>'+
                        '<td>'+$tempHospID[$l]+'</td>'+
                        '<td>'+$idsObject[$l].dateCreated+'</td>'+
                        // '<td>'+$idsObject[$l].note+'</td>'+
                        '</tr>'
                        );
                    } 
                }
                else{

                    // IF NO CURREMNT HOSPITAL ID
                
                    for($l=0; $l<$arrayLength;$l++){
                        $("#hospitalIdtable").append(
                            '<tr>'+
                            '<td>'+$hispatients.CODE+'</td>'+
                            '<td>'+$profilesObject[$l].HOSPITALNAME+'</td>'+
                            '<td>'+$profilesObject[$l].HOSPITALID+'</td>'+
                            '<td>'+$profilesObject[$l].dateCreated+'</td>'+
                            // '<td>'+$profilesObject[$l].EDITEDBY+'</td>'+

                            // '<td>'+$profilesObject[$l].note+'</td>'+
                            '</tr>'
                            );
                        }
                }
                
                // storage_path('app/uploads/');
                //  alert($imageObject.imageName);

                if($imageObject!=null&&$img=="img/profile.png"){
                    if($imageObject.imageName!=""){
                    // alert($imageObject.imageName);

                    $.get($("#storage").val()+'/'+$imageObject.imageName, function(textData, status) {
                        // var aLines = textData.split("\n")
                    
                        // alert(textData + '\nStatus = ' + status);   // this works, all lines
                        // alert(textData);
                        $("#patientImage").attr("src",textData);
                     }, 'text');
                    //  $imageTemp=
                  }//dito
                }else{
                    $("#patientImage").attr("src",$img);
                    $("#hiddenImage").val($img);
                    $imageTemp=$img;
                }
                $("#patientImage").attr("src",$img);

                
                // else{
                //     $("#patientImage").attr("src",$("#patientImage").attr('src')+'/profile.png');
                // }

                }

                // if(response.checkVisits.)
                // $checksV=JSON.stringify(response.checkVisits);
                // alert(response.checkVisits.DOCSTATUS);
                // alert(response.checkVisits);
                
               
                $code = $hispatients.CODE;
                //   ADD VISIT
                  $("#addVisit").click($code, function(){
                    // alert($code);
                    // $("#createVisitModal").modal("show");
                    modalIdentifier="createVisit";
                    createVisit($hispatients, $idsObject,$currentHPID,$img);
                });
            }  
          });
          $("#addingImage").on('click', function(){
            addImage($patientIndex);
          });   
          
       
    
}

function getreport($patients){
    alert($patients);
}


    
function getRecord($temp_array){
    // alert($temp_array);
}

function resetWebcam(){

    Webcam.reset("#my_camera");
    $('#addImageModal').modal('hide');
    $('#viewPatientModal').modal('show');
}

function createVisit($patientInfo,$idsObject,$currentHPID,$img){

    var hospCode;
    var visitType = "";
    $("#viewPatientModal").modal("hide");

    $("#createVisitModal").modal("show");
        // $("#countContactUpdate").val(updateAdd);
        // alert($idsObject[0].HOSPITALID);
        $("#mpi").val($patientInfo.CODE);
        $("#nameVisit").val($patientInfo.NAME);
        
        if($currentHPID!=null){
            if($currentHPID.idSeries!=null){
            $("#hpidVisit").val($currentHPID.HOSPITALID);
            }
            else{
                $("#hpidVisit").attr("readonly", false);
            }
        }
        
        $("#icdCode").change(function(){
            $id=$("#icdCode").val();
            // alert($id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
              
            $.ajax({
                url: `icd10/`+$id,
                method: "GET",
                success: function(response) {

                    $("#icdDesc").val(response.icdGet['DESCRIPTION']);
                }
            });
        });
        $("#selectVisit").change(function(){
            
            visitType = $("#selectVisit").val();
            if($("#selectVisit").val()=="inpatient"){
                $("#dateDischarged").prop("readonly", false);
                visitType = "inpatient";
                
            }else{
                $("#dateDischarged").prop("readonly", true);
                $("#dateDischarged").val($("#dateArrival").val());
                visitType = "outpatient";
            }

            checkContent();
        });
        $("#dateArrival").on('keyup change ',function(){
            // alert($("#dateArrival").val());
            // if($("#selectVisit").val()=="outpatient"){
            //     $("#dateDischarged").val($("#dateArrival").val());
            // }            
        });
        // if(visitType!=""){
        //     $("#createVisit").attr("disabled", false);
        // }
       
        $("#createVisit").click(function(){
            var mpi = $("#mpi").val();
            var nameVisit = $("#nameVisit").val();
            var hpidVisit = $("#hpidVisit").val();
            var hpidVisit = $("#hpidVisit").val();
            var dateDischarged = $("#dateDischarged").val();
            var visitID = $("#visitID").val();
            var selectVisit = $("#selectVisit").val();
            var chiefComplaint =$("#chiefComplaint").val();
            var icdCode = $("#icdCode").val();
            var icdDesc = $("#icdDesc").val();
            var FinalDiagnosis = $("#FinalDiagnosis").val()


            var dateArrival=$("#dateArrival").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
              
            $.ajax({
                type: "POST",
                url: "/createVisit",
               
                data:{
                    mpi,
                    nameVisit,
                    hpidVisit,
                    visitID,
                    selectVisit,
                    dateArrival,
                    chiefComplaint,
                    dateDischarged,
                    icdCode,
                    icdDesc,
                    FinalDiagnosis

                    // hospCode

                },
                success: function(response) {

                    // if(response.msg=="Visit Already Exist."){
                    //     alert(response.msg);
                    //     //  $('#addImageModal').modal('hide');
                    // }
                    alert(response.msg);
                    $("#createVisitModal").modal("hide");
                    viewRecord(mpi, $img);
                    // $("#createVisitModal").modal("hide");
                }
            });
});

        
}



function checkValue(str, max) {
  if (str.charAt(0) !== '0' || str == '00') {
    var num = parseInt(str);
    if (isNaN(num) || num <= 0 || num > max) num = 1;
    str = num > parseInt(max.toString().charAt(0)) && num.toString().length == 1 ? '0' + num : num.toString();
  };
  return str;
};

function getICDS($code){
    // geticdCode = $(this).find(">:first-child").text();
    // var geticdDesc = $(this).children("td").eq(1).text();
    //    // alert(geticdDesc);
    // $("#viewPatientModal").modal("hide");
    // $("#viewPatientModal").modal("hide");
    // var dateDis = $("#dateDischargeUpdate").val();
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#icd10modal").modal("hide");
    if(modalIdentifier=="createVisit"){

        $("#createVisitModal").modal("show");

        $.ajax({
            url: `icd10/`+$code,
            method: "GET",
            success: function(response) {
                $("#icdCode").val(response.icdGet['icd10Code']);
                $("#icdDesc").val(response.icdGet['DESCRIPTION']);
                // $("#dateDischarged").val(disDate);
            }
        });
    }else{
        
        // alert(dateDis);
        // var visType = 
        // $("#dateDischargedUpdate").val(disDate);
        // alert($("#dateDischargedUpdate").val());
        viewVisit();   
                checkVisitContent();
        $.ajax({
            url: `icd10/`+$code,
            method: "GET",
            success: function(response) {
                // $("#dateDischargedUpdate").val(disDate);
                $("#icdCodeUpdate").val(response.icdGet['icd10Code']);
                $("#icdDescUpdate").val(response.icdGet['DESCRIPTION']);
                
                
                
                // alert(boolCheck);
            }
        });
    }   
    //    $("#icdCode").val(geticdCode);
    //    $("#icdDesc").val(geticdDesc);

    // $("#btn").attr("")
       
      
   
}
function checkContent(){
    $getVisit=$("#selectVisit").val();
    $getStart=$("#dateArrival").val();
    $getEnd=$("#dateDischarged").val();
    $getChiefComplaint=$("#chiefComplaint").val();

    // alert($getVisit);
    // alert($getStart);
    // alert($getEnd);
    var bools=false;
    if($getVisit=="outpatient"){
        if(($getStart&&$getChiefComplaint)!=""){
            bools=true;
        }
    }else if($getVisit=="inpatient"){
        if(($getVisit&&$getStart&&$getChiefComplaint)!=""){
            bools = true;
        }
    }else{
        bools=false;
    }

    if(bools){
        $("#createVisit").attr("disabled", false);

    }else{
        $("#createVisit").attr("disabled", true);
    }
    
}

function viewVisit(){
    $("#viewVisitModal").modal("show");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // alert($code);
       
        // $('#viewPatientModal').modal('show');
        $.ajax({
            url: `/viewVisit/`+$code,
            method: "GET",
            success: function(response) {
                // alert('asd');
                // alert(response.visits.DOCNO);
                $visitsObj=response.visits;
                // alert($visitsObj.DOCNO);
                // alert($visitsObj.U_ICDCODE);
                if($visitsObj.MRN==null){
                    $("#hpidVisitUpdate").attr("readonly", false);
                }

                $("#mpiUpdate").val($visitsObj.U_PATIENTID);
                $("#nameVisitUpdate").val($visitsObj.U_PATIENTNAME);
                $("#hpidVisitUpdate").val($visitsObj.MRN);
                $("#visitIDUpdate").val($visitsObj.DOCNO);
                $("#selectVisitUpdate").val($visitsObj.VISITTYPE);
                $("#hospitalNameInputUpdate").val($visitsObj.COMPANY);
                $("#clerkUpdate").val($visitsObj.U_ASSISTEDBY);
                $("#dateArrivalUpdate").val($visitsObj.U_STARTDATE);
                $("#dateDischargedUpdate").val($visitsObj.U_ENDDATE);
                $("#chiefComplaintUpdate").val($visitsObj.CHIEFCOMPLAINT);
                $("#icdCodeUpdate").val($visitsObj.U_ICDCODE);
                $("#icdDescUpdate").val($visitsObj.U_ICDDESC);
                $("#FinalDiagnosisUpdate").val($visitsObj.NOTES);


            }
        });
}

function checkVisitContent(){
    disDate=$("#dateDischargedUpdate").val();
    icdCode =$("#icdCodeUpdate").val();
    icdDesc =$("#icdDescUpdate").val();
    finDiag = $("#FinalDiagnosisUpdate").val();
    // alert($("#dateDischargedUpdate").val());
    
    

    //alert(dateDis);
    if((disDate&&(icdCode&&icdDesc))!=""){
        boolCheck=true;
    }else if((disDate&&finDiag)!=""){
        boolCheck=true;
    }else if((disDate&&finDiag&&(icdCode&&icdDesc))!=""){
        boolCheck =true;
    }else{
        boolCheck=false;
    }


    if(boolCheck){
        $("#dischargeButton").attr("disabled", false);

    }else{
        $("#dischargeButton").attr("disabled", true);
    }
    return;
}

function getAddress(identifier){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    $.ajax({
        url: `/getCountry`,
        method: "GET",
        success: function(data) {
            $(identifier).empty();
            $(identifier).append('<option value="">-Select Province-</option>');
            for (var n=0; n<data.length; n++) {
                $(identifier).append("<option>"+data[n]['country']+"</option>");
            }
        }
    });
    return;

}
function checkField(){
    var addFirstName = $("#addFirstName").val();
    var addLastName = $("#addLastName").val();
    var U_MIDDLENAME = $("#addMiddleName").val();
    var U_BIRTHDATE = $("#bday11").val();
    var U_CIVILSTATUS = $("#regCivilStatus").val();
    var regSex = $("#regSex").val();
    var regCountry = $("#regCountry").val();
    var regProvince = $("#regProvince").val();
    var regMunicipality = $("#regMunicipality").val();
    var regBarangay = $("#regBarangay").val();
    var contactType1 = $("#regcontactType1").val();
    var contact1Add = $("#contact1Add").val();


    asdas = [
        addFirstName,
        addLastName,
        U_MIDDLENAME,
        U_BIRTHDATE,
        U_CIVILSTATUS,
        regSex,
        regCountry,
        regProvince,
        regMunicipality,
        regBarangay,
        contact1Add,
    ];
    // alert(asdas);
    var ifEmpty = false;

    if((addFirstName&&addLastName&&U_MIDDLENAME&&U_BIRTHDATE&&U_CIVILSTATUS&&regSex&&regCountry&&regProvince&&regMunicipality&&regBarangay&&contactType1&&contact1Add)!=""){
        ifEmpty=true;
    }else{
        ifEmpty=false;
    }
    // alert(ifEmpty);
    if(ifEmpty){
        $("#addPatient").attr("disabled", false);
    }else{
        $("#addPatient").attr("disabled", true);
    }
}
// displayField(providerName2,response.secondhmo, 'hmoName');
function displayField(id, nameObject){
    // alert(nameObject[fieldName]);
    if(nameObject==null){
       
    }else{
        $(id).val(nameObject);
    }
}






