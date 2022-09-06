<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table, th, td {
           border: 1px solid black;
           border-collapse: collapse;
        }
        .title{
           font-size: 25px;+
           font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
           font-weight:normal;
        }
        .header{
           font-size:12px;
           font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
           font-weight:bolder;

        }
        #no,#patientindex,#name,#age,#city,#date,#visit{
            font-size: 10px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;

}
        /* #footer { }
      position: fixed; left: 0px;
       #footer .page:after { content: "Page "counter(page, decimal) " of " counter(page, decimal) ; }
    @page { margin: 20px 30px 40px 50px; } */
    #date {position: fixed; left: 0px; bottom: -30px; text-align: center;font-size: 13px;}
    #test .page:after { content: "Page "counter(page, decimal) " of " counter(pages, decimal) ; }
    @page { margin: 11mm 17mm 17mm 17mm;}
    footer {
     position: fixed; right: 0px; bottom: -30px; text-align: center;font-size: 13px;
           }

     </style>
</head>

<body>

    <div id="date">
        <p class="page">   <p >Printed By: {{ Auth::user()->name }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date Printed: {{ date('m/d/Y') }} </p>
     </p>
      </div>
     <footer>

        <div id="test">

           <p class="page"></p>
        </div>
    </footer>
   <main>
    <table>

        <tr>
            <th colspan="2" rowspan="3">  <img src='data:image/jpeg;base64,{{$imageLogo}}' width="120px" height="120px"/></th>
            <th class="title"  colspan="5">Master Patient Record</th>
         </tr>
         <tr>
            <th colspan="2" id="pdfhospital">{{$byHospitals}}</th>
            <th colspan="2">Patient/s for this cutoff:</th>
            <th colspan="1" id="noofpatients2">{{$patientstotal}}</th>
         </tr>
         <tr>
            <th colspan="2" >Period: from <span >{{ \Carbon\Carbon::parse($sd)->format('F j, Y')}}</span> to <span >{{ \Carbon\Carbon::parse($ed)->format('F j, Y')}}</span></th>

            <th colspan="2">Total Patient/s</th>
            <th colspan="1" id="nooftotalpatients1">{{$pow}}</th>
         </tr>

         <tr style="background-color:rgb(177, 241, 241);">
            <th class="header" style="width:15px;">No.</th>
            <th class="header">Master Patient Index</th>
            <th class="header">Full Name</th>
            <th class="header" style="width: 15px;">Age</th>
            <th class="header">Address</th>
            <th class="header">Registered</th>
            <th class="header">Visit</th>

         </tr>
         @php
         $i=1;
        //  echo('filterbyhospital');
          @endphp
         @foreach ($PatientInfos2 as $PatientInfos2)
         <tbody>
            <tr wire:key="{{$PatientInfos2->id}}">
                <td id="no" style="text-align: center;">{{$i}}</td>
                <td id="patientindex" style="text-align: center;">{{ $PatientInfos2->CODE }}</td>
                <td id="name">{{ $PatientInfos2->NAME }}</td>
                <td id="age" style="text-align: center;">{{ $PatientInfos2->U_AGE }}</td>
                <td id="city" style="text-align: center;">{{ $PatientInfos2->U_CITY }}</td>
                <td id="date">{{ date('m-d-Y', strtotime($PatientInfos2->DATECREATED)) }}</td>
                <td id="visit" style="text-align: center;">{{ $PatientInfos2->U_VISITCOUNT }}</td>
            </tr>

         @php
              $i++
          @endphp
         @endforeach
        </tbody>
    </table>
   </main>
</body>
</html>
<script>

</script>
