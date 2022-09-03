

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


// var fname='';
// var lname='';

setInterval(displayHello, 1000);

function displayHello() {
    $('#noofpatients').html($('#red').val());
}

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
    $("#contact1Add, #contact2Add,#contact3Add, #contact4Add, #contact1,#contact2,#contact3,#contact4").on('input paste',function(e){
        // alert("asd");
        var key = e.charCode || e.keyCode || 0;
       $text = $(this); 
       if (key !== 8 && key !== 9) {
           if ($text.val().length === 4) {
               $text.val($text.val() + '-');
           }
           if ($text.val().length === 8) {
               $text.val($text.val() + '-');
           }

       }

       return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
    });

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
    $("#regCountry").select2({
        dropdownParent: $('#studentModal'),
        // width: 'resolve',
        // height: 'resolve'
    });

    $("#regProvince").select2({
        dropdownParent: $('#studentModal'),
        // width: 'resolve',
        // height: 'resolve'
    });

    $("#regMunicipality").select2({
        dropdownParent: $('#studentModal'),
        // width: 'resolve',
        // height: 'resolve'
    });
    $("#regBarangay").select2({
        dropdownParent: $('#studentModal'),
        // width: 'resolve',
        // height: 'resolve'
    });

  
    $("#regCountry").on('change',function(){
        
        $("#regProvince").attr("disabled", false);
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
                // alert(data);
                // prompt('',data); return false;
                $("#regProvince").empty();
                $("#regProvince").append('<option value="">-Select Province-</option>');
                for (var n=0; n<data.length; n++) {
                    $("#regProvince").append("<option>"+data[n]['province']+"</option>");
                }
                $("#regMunicipality").empty();
                $("#regMunicipality").append('<option value="">-Select Town/City-</option>');
                $("#regBarangay").empty();
                $("#regBarangay").append('<option value="">-Select Barangay-</option>');
                $("#regPostal").val('');

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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/postal',
            method: 'get',
            data: {'brgy': $(this).val()},
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
                // prompt('',data); return false;
                // alert('as');
                // alert(data.length);
                
                // $("#regProvinceUpdate").append('<option value="">-Select Province-</option>');
                $("#regProvinceUpdate").attr("disabled", false);
                if($("#regCountryUpdate").val()!="PHILIPPINES"){
                    $("#regProvinceUpdate").empty();
                }
                // $("#regProvinceUpdate").empty();
                for (var i=0; i<data.length; i++) {
                    
                    $("#regProvinceUpdate").append("<option>"+data[i]['province']+"</option>");
                }
                $("#regProvinceUpdate").prop("readonly", false);
                $("#regMunicipalityUpdate").empty();
                // $("#regMunicipalityUpdate").append('<option value="">-Select Town/City-</option>');
                $("#regBarangayUpdate").empty();
                // $("#regBarangayUpdate").append('<option value="">-Select Barangay-</option>');
                $("#regPostalUpdate").val('');

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
                    'cityUpdate':cityUpdate        
            },
            success:function(data){
                // prompt('',data); return false;
                // $("#regPostal1").empty();
                // alert(data[0]['zipCode']);
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
                $("#regFathersProvince").empty();
                $("#regFathersProvince").append('<option value="">-Select Province-</option>');
                // $("#regProvinceUpdate").empty();
                for (var i=0; i<data.length; i++) {
                    
                    $("#regFathersProvince").append("<option>"+data[i]['province']+"</option>");
                }
                $("#regfathersMunicipality").empty();
                // $("#regMunicipalityUpdate").append('<option value="">-Select Town/City-</option>');
                $("#regFathersBarangay").empty();
                // $("#regBarangayUpdate").append('<option value="">-Select Barangay-</option>');
                $("#regFathersPostal").val('');

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
                    $("#regFathersBarangay").append("<option>"+data[n]['brgy']+"</option>");
                }
                $("#regFathersPostal").val('');
            }
        });
    });
    $("#regFathersBarangay").on('change' ,function(){
        // alert('asd');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/postalFather',
            method: 'get',
            data: {'brgy': $(this).val()},
            success:function(data){
                // prompt('',data); return false;
                // $("#regPostal1").empty();
                // alert(data[0]['zipCode']);
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
                $("#regMothersProvince").empty();
                $("#regMothersProvince").append('<option value="">-Select Province-</option>');
                // $("#regProvinceUpdate").empty();
                for (var i=0; i<data.length; i++) {
                    
                    $("#regMothersProvince").append("<option>"+data[i]['province']+"</option>");
                }
                $("#regMothersMunicipality").empty();
                // $("#regMunicipalityUpdate").append('<option value="">-Select Town/City-</option>');
                $("#regMothersBarangay").empty();
                // $("#regBarangayUpdate").append('<option value="">-Select Barangay-</option>');
                $("#regmothersPostal").val('');

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
                    $("#regMothersBarangay").append("<option>"+data[n]['brgy']+"</option>");
                }
                $("#regmothersPostal").val('');
            }
        });
    });
    $("#regMothersBarangay").on('change' ,function(){
        // alert('asd');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/postalMother',
            method: 'get',
            data: {'brgy': $(this).val()},
            success:function(data){
                // prompt('',data); return false;
                // $("#regPostal1").empty();
                // alert(data[0]['zipCode']);
                $("#regmothersPostal").val(data[0]['zipCode']);
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
                $("#regSpousesProvince").empty();
                $("#regSpousesProvince").append('<option value="">-Select Province-</option>');
                // $("#regProvinceUpdate").empty();
                for (var i=0; i<data.length; i++) {
                    
                    $("#regSpousesProvince").append("<option>"+data[i]['province']+"</option>");
                }
                $("#regSpousesMunicipality").empty();
                // $("#regMunicipalityUpdate").append('<option value="">-Select Town/City-</option>');
                $("#regSpousesBarangay").empty();
                // $("#regBarangayUpdate").append('<option value="">-Select Barangay-</option>');
                $("#regSpousesPostal").val('');

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
                    $("#regSpousesBarangay").append("<option>"+data[n]['brgy']+"</option>");
                }
                $("#regSpousesPostal").val('');
            }
        });
    });
    $("#regSpousesBarangay").on('change' ,function(){
        // alert('asd');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/postalSpouse',
            method: 'get',
            data: {'brgy': $(this).val()},
            success:function(data){
                // prompt('',data); return false;
                // $("#regPostal1").empty();
                // alert(data[0]['zipCode']);
                $("#regSpousesPostal").val(data[0]['zipCode']);
            }
        });
    });


    





    // ADD CONTACT
    // $("#addContact").on('click',function(){
    //     document.getElementById("#addContact").style.display = inline-block;
    // });
    

    $("#addContact").on("click", function() {
        // alert("as");
        $('#addingContact').addClass("hidden");
        $('#addingContact1').removeClass("hidden");
        $('#anotherContact').removeClass("hidden");
        $('#anotherContactType').removeClass("hidden");
        $('#addingContact1').removeClass("hidden");
    });

    $('#addContact1').on("click",function(){
        $('#addingContact1').addClass("hidden");
        $('#anotherContactType1').removeClass("hidden");
        $('#anotherContact1').removeClass("hidden");
        $('#addingContact2').removeClass("hidden");
    });
    $('#addContact2').on("click",function(){
        $('#addingContact2').addClass("hidden");
        $('#anotherContactType3').removeClass("hidden");
        $('#anotherContact3').removeClass("hidden");
    });

    $('#closeAdd').on("click", function(){
        // alert('as');
        // $('#studentModal').modal('hide'); 
        $('#addingContact1').addClass("hidden");
        $('#addingContact').addClass("hidden");
    });


    // ADD PROVIDER
    $("#addAnotherProvider").click(function(){
        $("#anotherProvider").removeClass("hidden");
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
        
    
        //     $('.datepicker').datepicker({
        //         dateFormat: 'mm/dd/yy',
        //         changeMonth: true,
        //         changeYear: true,
        //         autoclose: true,
        //         yearRange: "1800:2080"
    
        //     });

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

      $("#providerName").on('change',function() {
        // alert($(this).val());
        // alert($("#bday1").val());
        // alert($("#providerName").val());
        $("#relationMem").prop('readonly', false); //disable 
        $("#insMemTypeID").prop('readonly', false); //disable
        // alert($("#U_LASTNAME").val());

        if ($("#providerName").val() == "Philhealth Care, lnc") {
            $("#memberLname").val('');
            $("#memberFname").val('');
            $("#memberMname").val('');
            $("#memberEname").val('');
            $("#memberSex").val('');
            $("#memberBDay").val('');
        }else if($("#providerName").val()=="Others:Please Specify"){
            $('#otherHmo').prop('readonly', false);
            // alert('s');
        }else {
            $("#relationMem").val('');
            $("#insMemTypeID").val('');
            // $("#insMemTypeID").text('');
            $("#relationMem").prop('readonly', true); //disable 
            $("#insMemTypeID").prop('readonly', true); //disable
            $("#memberLname").prop('readonly', true); //disable 
            $("#memberFname").prop('readonly', true); //disable 
            $("#memberMname").prop('readonly', true); //disable 
            $("#memberEname").prop('readonly', true); //disable 
            $("#memberBDay").prop('readonly', true); //disable
            $("#memberSex").prop('readonly', true); //disable

            
            $("#memberLname").val( $("#U_LASTNAME").val());
            $("#memberLname").val( $("#U_LASTNAME").val());
            $("#memberFname").val( $("#U_FIRSTNAME").val());
            $("#memberMname").val( $("#U_MIDDLENAME").val());
            $("#memberEname").val( $("#extensionName").val());
            $("#memberSex").val( $("#updatesex").val());
            // alert($("#updatesex").val());
            $("#memberSex").text( $("#updatesex").val());
            $("#memberBDay").val( $("#bday1").val());
        }
      });

      $("#relationMem").on('change',function() {
        // alert(("#U_BIRTHDATE").val());
        if ($(this).val() == "Member") {
            // $("#relationMem").prop('disabled', false); //disable 
            // $("#insMemTypeID").prop('disabled', true); //disable
            $("#memberLname").prop('readonly', true); //disable 
            $("#memberFname").prop('readonly', true); //disable 
            $("#memberMname").prop('readonly', true); //disable 
            $("#memberEname").prop('readonly', true); //disable 
            $("#memberBDay").prop('readonly', true); //disable 
            // alert($("#U_LASTNAME").val());
            $("#memberLname").val( $("#U_LASTNAME").val());
            $("#memberFname").val( $("#U_FIRSTNAME").val());
            $("#memberMname").val( $("#U_MIDDLENAME").val());
            $("#memberEname").val( $("#extensionName").val());
            // $("#memberSex").val( $("#updatesex option:selected").val());
            $("#memberSex").append('<option value="'+$("#updatesex option:selected").text()+'">'+$("#updatesex option:selected").text()+'</option>');
            $("#memberBDay").val( $("#bday1").val());
            // alert( $("#memberLname").val());
        }
        else if($(this).val() == "Dependent") {
            // $("#memberLname").prop('disabled', false); //disable
            // $("#relationMem").prop('disabled', false); //disable 
            // $("#insMemTypeID").prop('disabled', true); //disable
            $("#memberLname").prop('readonly', false); //disable 
            $("#memberFname").prop('readonly', false); //disable 
            $("#memberMname").prop('readonly', false); //disable 
            $("#memberEname").prop('readonly', false); //disable 
            $("#memberBDay").prop('readonly', false); //disable 
            $("#memberLname").val('');
            $("#memberFname").val('');
            $("#memberMname").val('');
            $("#memberEname").val('');
            $("#memberBDay").val('');
          }
         else {
            $("#memberLname").prop('readonly', true); //disable 
        }
      });


    
      

        // SAME FATHER'S ADDRESS WITH PATIENT
        $("#sameFatherAddress").change(function() {
            if(this.checked) {
                // alert($("#regPostal1").val());
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
                // $("#fatherHouseNo").val( $("#houseNo").val()); 
                $("#fatherStreet").val(''); 
                $("#regFathersCountry").val(''); 
                $("#regFathersCountry").text(''); 
                $("#regFathersProvince").val(''); 
                $("#regfathersMunicipality").val(''); 
                $("#regFathersBarangay").val(''); 
                $("#regFathersPostal").val(''); 
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
                $("#motherHouseNo").val(''); 
                $("#motherStreet").val('');
                $("#regMothersCountry").val(''); 
                $("#regMothersCountry").text(''); 
                $("#regMothersProvince").val(''); 
                $("#regMothersMunicipality").val(''); 
                $("#regMothersBarangay").val(''); 
                $("#regmothersPostal").val(''); 
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
            }
        });

    //     $("#patientUpdate").click(function(){
    //     var getID=$("#hiddenInput").val();
    //     // alert(getID);
    //     viewRecord(getID);
    // });

    // ADD ANOTHER FIELD
    $("#addAnotherAllergy").on('click',function(){
        $('#allegyField4').removeClass('hidden');
        $('#addAnotherAllergy').addClass('hidden');
        $('#addAnotherAllergy1').removeClass('hidden');
        // alert('as');
    });
    $("#addAnotherAllergy1").on('click',function(){
        $('#allegyField5').removeClass('hidden');
        $('#addAnotherAllergy1').addClass('hidden');
        // alert('as');
    });

    $("#regCountryaa").on('change',function(){

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
                // prompt('',data); return false;
                // alert('as');
                // alert(data.length);
                $("#regProvince1").empty();
                $("#regProvince1").append('<option value="">-Select Province-</option>');
                for (var i=0; i<data.length; i++) {
                    // alert('asd');
                    // alert(data[i]['province']);
                    $("#regProvince1").append("<option>"+data[i]['province']+"</option>");
                }
                $("#regMunicipality1").empty();
                $("#regMunicipality1").append('<option value="">-Select Town/City-</option>');
                $("#regBarangay1").empty();
                $("#regBarangay1").append('<option value="">-Select Barangay-</option>');
                // $("#regPostal1").val('');

            }
        });
    });


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
                    switch($hispatients.countContacts){

                        case 0:
                            // alert($cont.length);
                            // $(".colsUpdate0").addClass("hidden");
                            break;
                        case 1:
                            if($cont==""){
                                // break;
                            }else{
                                $(".colsUpdate1").removeClass("hidden");
                            }
                            
                            break;
                        case 2:
                            // alert($cont.length);
                            // $(".colsUpdate2").removeClass("hidden");
                            $(".colsUpdate1").removeClass("hidden");
                            $(".colsUpdate2").removeClass("hidden");
                            break;

                        case 3:
                            $(".colsUpdate1").removeClass("hidden");
                            $(".colsUpdate2").removeClass("hidden");
                            $(".colsUpdate3").removeClass("hidden");
                            break;
                        case 4:
                            $(".colsUpdate1").removeClass("hidden");
                            $(".colsUpdate2").removeClass("hidden");
                            $(".colsUpdate3").removeClass("hidden");
                            $(".colsUpdate4").removeClass("hidden");
                            // alert("asd");
                            $("#addaContactUpdate i").prop("hidden", true);
                            break;
                        default:
                            // alert($hispatients.countContacts);
    
                    }
                    switch($hispatients.countContacts){
                        case 1:
                            $("#emailsUpdate1").removeClass("hidden");
                            break;
                        case 2:
                            $("#emailsUpdate1").removeClass("hidden");
                            $("#emailsUpdate2").removeClass("hidden");
                            break;
                        case 3:
                            $("#emailsUpdate1").removeClass("hidden");
                            $("#emailsUpdate2").removeClass("hidden");
                            $("#emailsUpdate3").removeClass("hidden");
                            break;
                        case 4:
                            $("#emailsUpdate1").removeClass("hidden");
                            $("#emailsUpdate2").removeClass("hidden");
                            $("#emailsUpdate3").removeClass("hidden");
                            $("#emailsUpdate4").removeClass("hidden");
                            break;

                    }
                    
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


                
                        $("#regCountryUpdate").append("<option selected value='"+$hispatients.U_COUNTRY+"'>"+$hispatients.U_COUNTRY+"</option>");

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

                    $("#motherFirstName").val($hispatients.U_MOTHERSFIRSTNAME);
                    $("#motherLastName").val($hispatients.U_MOTHERSLASTNAME);
                    $("#motherMiddleName").val($hispatients.U_MOTHERSMIDDLENAME);
                    $("#motherExtName").val($hispatients.U_MOTHERSEXTNAME);

                        

                        $("#spouseFirstName").val($hispatients.U_SPOUSEFIRSTNAME);
                        $("#spouseLastName").val($hispatients.U_SPOUSELASTNAME);
                        $("#spouseMiddleName").val($hispatients.U_SPOUSEMIDDLENAME);
                        $("#spouseExtName").val($hispatients.U_SPOUSEEXTNAME);
            
                  $('#regFathersCountry').val($hispatients.U_FATHERCOUNTRY);
                  $('#getFathersProvince').text($hispatients.U_FATHERPROVINCE);
                  $('#getFathersProvince').val($hispatients.U_FATHERPROVINCE);
                  $('#getFathersProvince').val($hispatients.U_FATHERPROVINCE);
                  $('#getFathersMunicipality').val($hispatients.U_FATHERCITY);
                  $('#getFathersMunicipality').text($hispatients.U_FATHERCITY);
                  $('#getFathersBrgy').val($hispatients.U_FATHERBARANGAY);
                  $('#getFathersBrgy').text($hispatients.U_FATHERBARANGAY);
                  $('#regFathersPostal').val($hispatients.U_FATHERZIP);
                  $('#fatherHouseNo').val($hispatients.U_FATHERHOUSENO);
                  $('#fatherStreet').val($hispatients.U_FATHERSTREET);
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


                //   viewing of contact
                  if($cont!=""){
                    if($hispatients.countContacts>=1){
                        for(var x=1;x<=$hispatients.countContacts;x++){
                            $("#contact"+x).val($cont[x-1]['contactNumber']);
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

                // start viewing of emails
                // alert(JSON.stringify($hmoObjects));
                if($hmoObjects!=""){
                    // alert($hmoObjects);
                    $("#providerName").val($hmoObjects[0]['hmoName']);
                    $("#memberID").val($hmoObjects[0]['hmoAccountID']);
                    $("#relationMem").val($hmoObjects[0]['clientType']);
                    $("#insMemTypeID").val($hmoObjects[0]['memberType']);
                    $("#memberLname").val($hmoObjects[0]['memberLname']);
                    $("#memberFname").val($hmoObjects[0]['memberFname']);
                    $("#memberMname").val($hmoObjects[0]['memberMname']);
                    $("#memberEname").val($hmoObjects[0]['memberEname']);
                    $("#memberSex").val($hmoObjects[0]['memberSex']);
                    $("#memberBDay").val($hmoObjects[0]['memberBDay']);
                }
                

                $imageUrl = $("#storage").val();


                $arrayLen=$idsObject.length;
                $arrayLength=$profilesObject.length;
                // alert($arrayLength);
                // alert(JSON.stringify(response.medInfo.U_HEIGHT_CM));
                // if
                // alert($currentHPID);
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

                    alert(JSON.stringify($currentHPID));
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

                    $("#hospitalIdtable").append(
                        '<tr>'+
                        '<td>'+$hispatients.CODE+'</td>'+
                        '<td>'+$idsObject[$l].HOSPITALNAME+'</td>'+
                        '<td>'+$idsObject[$l].HOSPITALID+'</td>'+
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
            if($("#selectVisit").val()=="outpatient"){
                $("#dateDischarged").val($("#dateArrival").val());
            }
            
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
                    // hospCode

                },
                success: function(response) {

                    // if(response.msg=="Visit Already Exist."){
                    //     alert(response.msg);
                    //     //  $('#addImageModal').modal('hide');
                    // }
                    alert(response.msg);
                    window.location.replace("/home");
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
                $("#dateDischarged").val(disDate);
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
                $("#dateDischargedUpdate").val(disDate);
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






