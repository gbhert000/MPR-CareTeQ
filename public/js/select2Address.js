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
