var get_ID="";
var patient = new Object();
$code =''

// var fname='';
// var lname='';


$(document).ready(function(){
    var getAdd=1;
    // var updateAdd=0;
    $getCount =0;
    // $initialCount=0

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


    // START ADD REMOVE CONTACT UPDATE
    $("#addaContactUpdate").click(function(){
        

        // alert(updateAdd);
            
        if(!(updateAdd>=4)){
            updateAdd++;
            $("#countContactUpdate").val(updateAdd);
        }
        else if(updateAdd=4){
            updateAdd=updateAdd;
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
    
    $("#bday11").focusout(function(){
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
                
                viewRecord($hispatients1.CODE);

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
                    $("#regBarangay").append("<option>"+data[n]['brgy']+"</option>");
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
                $("#regPostal").val(data[0]['zipCode']);
            }
        });
    });

    // END SELECT2 ADD PATIENT

    //START  SELECT2 UPDATE PATIENT
    // $("#regCountryUpdate").select2({
    //     dropdownParent: $('#viewPatientModal'),
    //     // width: 'resolve',
    //     // height: 'resolve'
    // });

    // $("#regProvinceUpdate").select2({
    //     dropdownParent: $('#viewPatientModal'),
    //     // width: 'resolve',
    //     // height: 'resolve'
    // });

    // $("#regMunicipalityUpdate").select2({
    //     dropdownParent: $('#viewPatientModal'),
    //     // width: 'resolve',
    //     // height: 'resolve'
    // });
    // $("#regBarangayUpdate").select2({
    //     dropdownParent: $('#viewPatientModal'),
    //     // width: 'resolve',
    //     // height: 'resolve'
    // });


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
                $("#regProvinceUpdate").empty();
                // $("#regProvince1Update").append('<option value="">-Select Province-</option>');
                // $("#regProvinceUpdate").empty();
                for (var i=0; i<data.length; i++) {
                    
                    $("#regProvinceUpdate").append("<option>"+data[i]['province']+"</option>");
                }
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
                // $("#regMunicipalityUpdate").append('<option value="">-Select Town/City-</option>');
                for (var n=0; n<data.length; n++) {
                    $("#regMunicipalityUpdate").append("<option>"+data[n]['municipality']+"</option>");
                }
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
                // $("#regBarangayUpdate").append('<option value="">-Select Barangay-</option>');
                for (var n=0; n<data.length; n++) {
                    $("#regBarangayUpdate").append("<option>"+data[n]['brgy']+"</option>");
                }
                $("#regPostalUpdate").val('');
            }
        });
    });
    $("#regBarangayUpdate").on('change' ,function(){
        // alert('asd');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/postalUpdate',
            method: 'get',
            data: {'brgy': $(this).val()},
            success:function(data){
                // prompt('',data); return false;
                // $("#regPostal1").empty();
                // alert(data[0]['zipCode']);
                $("#regPostalUpdate").val(data[0]['zipCode']);
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
                $("#regFathersPostal").val(data[0]['zipCode']);
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


   

   
    //age calculation thru birthday
    $('#bday11').change(function () {
        var now = new Date();   //Current Date
        var past = new Date($('#bday11').val());  //Date of Birth
        if (past > now) {
            alert('Entered Date is Greater than Current Date');
            return false;
        }
        var nowYear = now.getFullYear();  //Get current year
        var pastYear = past.getFullYear();//Get Date of Birth year
        var age = nowYear - pastYear;  //calculate the difference
        $('#age1').val(age);
        $('#age1').text(age+"years old");
    });
    

        $('.datepicker1').datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            autoclose: true,
            yearRange: "1800:2080"

        });

        $('#bday1').change(function() {
            var now = new Date();   //Current Date
            var past = new Date($('#bday1').val());  //Date of Birth
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
            $("#memberSex").val( $("#regSex").val());
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
            alert( $("#memberLname").val());
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


});
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
    


    // $("input, select").val("");
    // $("#colsUpdate1").removeClass("hidden");
    // $("#colsUpdate2").removeClass("hidden");
    // $("#colsUpdate3").removeClass("hidden");
    // $("#closeReset").find("input, select").attr('value', '');
    for(var x=1; x<=4;x++){
        $("#contact"+x).val('');
        $("#contactType"+x).val('');
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
function viewRecord($id){
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
                // ale
                // alert($hmoObjects[0]['memberFname']);
                // alert($hispatients.countContacts);
                // alert($hmoObjects.memberFname);
            //    alert($o.NAME);
               
                // $patientCode=response.U_FIRSTNAME;
                // alert($patientCode);
                // alert($hmoObjects[0]['hmoName']);

                
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
                            break;
                        default:
                            alert($hispatients.countContacts);
    
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
                    
                        $('#regCountryUpdate option:selected').val($hispatients.U_COUNTRY);
                        $('#regCountryUpdate option:selected').text($hispatients.U_COUNTRY);
                        // alert($hispatients.U_COUNTRY);
                        
                        $("#getProvince").text($hispatients.U_PROVINCE);
                        $("#getProvince").val($hispatients.U_PROVINCE);
                        $("#getCity").text($hispatients.U_CITY);
                        $("#getCity").val($hispatients.U_CITY);
                        $("#getBrgy").text($hispatients.U_BARANGAY);
                        $("#getBrgy").val($hispatients.U_BARANGAY);
                       
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

                  if($cont!=""){
                    if($hispatients.countContacts>=1){
                        for(var x=1;x<=$hispatients.countContacts;x++){
                            $("#contact"+x).val($cont[x-1]['contactNumber']);
                            $("#contactType"+x).val($cont[x-1]['contactType']);
                            $("#hideContact"+x).val($cont[x-1]['contactID']);
                            // $("#noteContact"+x).val($cont[x-1]['contactID']);
                            
                        }
                    }
                  }
                //   alert( $("#hideContact1").val());
                //   HMOS
                //   alert($("#providerName option:selected").val());
                
                // alert($hmoObjects);
                if($hmoObjects!=""){
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

                $("#dateUpdated").text($hispatients.DATECREATED);
                $("#code").text($hispatients.CODE);
                // storage_path('app/uploads/');
                //  alert($imageObject.imageName);

                if($imageObject!=null){
                    if($imageObject.imageName!=""){
                    // alert($imageObject.imageName);
                    $("#patientImage").attr("src",$imageUrl+'/'+$imageObject.imageName);
                  }
                }

                
                // else{
                //     $("#patientImage").attr("src",$("#patientImage").attr('src')+'/profile.png');
                // }

                }
            }  
          });
          $("#addingImage").on('click', function(){
            addImage($patientIndex);

            // $.ajax({
            //     url: `home/`+$id,
            //     method: "GET",
            //     success: function(response) {

            //     }
            // });


          });
          
          
          
}
function addImage($patientIndex){

    $code=$patientIndex;
    // alert(fname+lname);
    
  Webcam.set({
      width: 490,
    //   width: 350,
      height: 350,
      image_format: 'jpeg',
      jpeg_quality: 90
  });
  
  Webcam.attach( '#my_camera' );
  
    $('#viewPatientModal').modal('hide');
    // alert("asd");
    $('#addImageModal').modal('show');

//   alert($patientIndex);

    $("#saveImage").click($code,function(){

        Webcam.reset( '#my_camera' )
        var image=document.getElementById('imageID').value;

        var fnameImage=document.getElementById('U_FIRSTNAME').value;
        var lnameImage=document.getElementById('U_LASTNAME').value;
        var mnameImage=document.getElementById('U_MIDDLENAME').value;
        var enameImage=document.getElementById('extensionName').value;
        // var lname=document.getElementById('addLastName').value;
        // $image1=JSON.stringify($code);
        var patientCode =$code;
        // alert($code);

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
            type: "POST",
            url: "/home/image/"+$code,
            data:{
                image,
                patientCode,
                lnameImage,
                fnameImage,
                mnameImage,
                enameImage,

            },
            success: function(response) {

                if(response.msg=="Uploaded Successfully"){
                     $('#addImageModal').modal('hide');
                viewRecord($code);
                }
               
            }
        });
        
    });


}
function take_snapshot() {
    Webcam.snap( function(data_uri) {
        $(".image-tag").val(data_uri);
        document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
    } );
}

function getreport($patients){
    alert($patients);
}


function print(){
    pdf();
    
    $('#reportModal').modal('hide');


  }
    function pdf(){
       var HTML_Width = $(".html-content").width();
               var HTML_Height = $(".html-content").height();
               var top_left_margin = 15;
               var PDF_Width = HTML_Width + (top_left_margin * 2);
               var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
               var canvas_image_width = HTML_Width;
               var canvas_image_height = HTML_Height;

               var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

               html2canvas($(".html-content")[0]).then(function (canvas) {
                   var imgData = canvas.toDataURL("image/jpeg", 1.0);
                   var pdf = new jsPDF('p','pt', [PDF_Width, PDF_Height]);
                   pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                   for (var i = 1; i <= totalPDFPages; i++) {
                       pdf.addPage(PDF_Width, PDF_Height);
                       pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                   }
                   pdf.save("MASTERPATIENTLIST.pdf");
                   //window.location = "/home"
                   $(".html-content").hide();
               });
    }
function getRecord($temp_array){
    // alert($temp_array);
}

function resetWebcam(){

    Webcam.reset( '#my_camera' );
    $('#addImageModal').modal('hide');
    $('#viewPatientModal').modal('show');
}
function print2(){
    pdf();

    $('#reportModal').modal('hide');


  }
    function pdf(){
       var HTML_Width = $(".html-content").width();
               var HTML_Height = $(".html-content").height();
               var top_left_margin = 15;
               var PDF_Width = HTML_Width + (top_left_margin * 4);
               var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
               var canvas_image_width = HTML_Width;
               var canvas_image_height = HTML_Height;

               var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

               html2canvas($(".html-content")[0]).then(function (canvas) {
                   var imgData = canvas.toDataURL("image/jpeg", 1.0);
                   var pdf = new jsPDF('p','pt', [PDF_Width, PDF_Height]);
                   pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                   for (var i = 1; i <= totalPDFPages; i++) {
                       pdf.addPage(PDF_Width, PDF_Height);
                       pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                   }
                   pdf.save("MASTERPATIENTLIST.pdf");
                   //window.location = "/home"
                   $(".html-content").hide();
               });
    }





