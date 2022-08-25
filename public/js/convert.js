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


     //maximum and minimum input of the height in centimeter with round off
    $('#centimeter').on('change', function () {
        $(this).val(Math.min('272', Math.max('55', $(this).val()).toFixed(2)));
      })

      //maximum and minimum input of the height in inches with round off
      $('#inch').on('change', function () {
        $(this).val(Math.min('107.09', Math.max('21.65', $(this).val()).toFixed(2)));
      })
});

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
        var convertedInches = parseFloat (centimeter / 2.54).toFixed(2);
        // var roundedCentimeter = centimeter.toFixed(2);

        $('#inch').val(convertedInches, 'inches');
        // $('#centimeter').val(roundedCentimeter);
    }

    //convertion of Inches to Centimeter
    function convertionInchestoCentimeter () {
        var inch = $('#inch').val();
        var convertedcm = parseFloat (inch * 2.54 ).toFixed(2);

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