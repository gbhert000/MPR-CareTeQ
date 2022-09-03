

// function addImage($patientIndex){

//     $code=$patientIndex;
//     // alert($code);
   
//     $('#viewPatientModal').modal('hide');
//     // alert("asd");
//     $('#addImageModal').modal('show');

//     if (navigator.mediaDevices.getUserMedia) {
//         navigator.mediaDevices.getUserMedia({ video: true })
//         .then(function (stream) {
//         video.srcObject = stream;
//         })
//         .catch(function (err0r) {
//         console.log("Something went wrong!");
//         });
//     }

// //   alert($patientIndex);

//     $("#saveImage").click($code,function(){

//         // if (video.srcObject!=null) {
//         //     // alert("on");
//         //     navigator.getUserMedia({video: true},
//         //         function(stream) {
//         //             // can also use getAudioTracks() or getVideoTracks()
//         //             var track = video.srcObject.getTracks()[0];  // if only one media track
//         //             // ...
//         //             track.stop();
//         //         },
//         //         function(error){
//         //             console.log('getUserMedia() error', error);
//         //         });
//         // }

        

//         $('#addImageModal').modal('hide');
//         $('#viewPatientModal').modal('show');
          
//         var fnameImage=document.getElementById('U_FIRSTNAME').value;
//         var lnameImage=document.getElementById('U_LASTNAME').value;
//         var mnameImage=document.getElementById('U_MIDDLENAME').value;
//         var enameImage=document.getElementById('extensionName').value;
//         var patientCode =$code;

    
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });

//         $.ajax({
//             type: "POST",
//             url: "/home/image/"+$code,
//             data:{
//                 imagebase64, 
//                 patientCode,
//                 lnameImage,
//                 fnameImage,
//                 mnameImage,
//                 enameImage,
//             },
//             success: function(response) {
        
//                 if(response.msg=="Uploaded Successfully"){
//                     $('#addImageModal').modal('hide');
//                     viewRecord($code);
//                 }
            
//             }
//         });
//     });
// }

$(document).ready(function(){
    $("#saveImage").on('click',function(){
        Webcam.reset('#my_camera');
    });

    $("#addingImageRegister").click(function(){
        addImageRegister();
    });
});

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
  
       
    var image=document.getElementById('imageID').value;

    var fnameImage=document.getElementById('U_FIRSTNAME').value;
    var lnameImage=document.getElementById('U_LASTNAME').value;
    var mnameImage=document.getElementById('U_MIDDLENAME').value;
    var enameImage=document.getElementById('extensionName').value;
    // var lname=document.getElementById('addLastName').value;
    // $image1=JSON.stringify($code);
    var patientCode =$code;
    // alert("asd");
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
        //   alert("response.img");
            if(response.msg=="Uploaded Successfully"){
                 $('#addImageModal').modal('hide');
                 
            viewRecord($code,response.img);
            }
           
        }
    });
    
});

    // $("#saveImage").click($code,function(){

        
    //     var image=document.getElementById('imageID').value;

    //     var fnameImage=document.getElementById('U_FIRSTNAME').value;
    //     var lnameImage=document.getElementById('U_LASTNAME').value;
    //     var mnameImage=document.getElementById('U_MIDDLENAME').value;
    //     var enameImage=document.getElementById('extensionName').value;
    //     // var lname=document.getElementById('addLastName').value;
    //     // $image1=JSON.stringify($code);
    //     var patientCode =$code;
    //     // alert($code);

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     // alert($id);
    //     $('#titleError').text('');
    //     $('#descriptionError').text('');
    //     // $('#viewPatientModal').modal('show');
    //     $.ajax({
    //         type: "POST",
    //         url: "/home/image/"+$code,
    //         data:{
    //             image,
    //             patientCode,
    //             lnameImage,
    //             fnameImage,
    //             mnameImage,
    //             enameImage,

    //         },
    //         success: function(response) {

    //             if(response.msg=="Uploaded Successfully"){
    //                  $('#addImageModal').modal('hide');
    //             viewRecord($code);
    //             }
               
    //         }
    //     });
        
    // });


}

function addImageRegister(){
    Webcam.set({
        width: 490,
      //   width: 350,
        height: 350,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    
      Webcam.attach( '#my_camera' );
    
      $('#studentModal').modal('hide');
      // alert("asd");
      $('#addImageModal').modal('show');
  
  //   alert($patientIndex);
  
      $("#saveImage").click(function(){
  
       
          var image=document.getElementById('imageID').value;
  
          
          // var lname=document.getElementById('addLastName').value;
          // $image1=JSON.stringify($code);
          
        //   alert("asd");
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
              url: "/home/image",
              data:{
                  image,
              },
              success: function(response) {
                // alert("response.img");
                  if(response.msg=="Uploaded Successfully"){
                       $('#addImageModal').modal('hide');
                       addPatient(response.img);
                //   viewRecord($code,response.img);
                  }
                 
              }
          });
          
      });

      $("#saveImage").click(function(){
        document.getElementById('results').innerHTML='<img src=""/>';
        $("#saveImage").prop("disabled", true);
      });
}

function addPatient($img){
    $("#studentModal").modal("show");
    $("#patientImageRegister").attr("src",$img);
    $("#hiddenImageRegister").val($img);
}


// function capture() {   
        
//     $("#saveImage").prop("disabled", false);
//     var canvas = document.getElementById('canvas');     
//     var video = document.getElementById('video');
//     canvas.width = 490;
//     canvas.height = 350;
//     canvas.getContext('2d').drawImage(video, 0, 0, 490,350);
//     imagebase64 =canvas.toDataURL();

    
//     // document.getElementById("printresult").innerHTML = canvas.toDataURL(); 
//     // navigator.mediaDevices.getUserMedia({ video: false })
//     //     .then(function (stream) {
//     //       video.srcObject = "";
//     //     })
    
//  }




 function take_snapshot() {
    Webcam.snap( function(data_uri) {
        $(".image-tag").val(data_uri);
        document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
    } );
    $("#saveImage").prop("disabled", false);
}