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
        .header2{
           font-size:25px;
           font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
           font-weight:bolder;

        }
        #no,#patientindex,#name,#age,#city,#date2,#visit{
            font-size: 10px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;

}
        /* #footer { }
      position: fixed; left: 0px;
       #footer .page:after { content: "Page "counter(page, decimal) " of " counter(page, decimal) ; }
    @page { margin: 20px 30px 40px 50px; } */
    #date {position: fixed; left: 0px; bottom: -30px; text-align: center;font-size: 13px;}
    /* #test .page{
        counter-reset: total;
    } */
    @page { margin: 20px 30px 40px 50px;
        }
        footer {
     position: fixed; right: 0px; bottom: -30px; text-align: center;font-size: 13px;
     counter-increment: total;
           }
    /* #test .page:before { content: "Page "counter(page)" of ";}
    #test .page::after{content: counter(total);} */
    /* #test .page:before { content: "Page "counter(page);} */

    /* #test .page:after { content: counter(pageTotal);} */

table{
      width: 100% !important;
}
#masterpatientpdf{
    width: 18% !important;
}
#fullnamepdf{
    width: 40% !important;
}
#addresspdf{
    width: 20% !important;
}
     </style>
</head>

<body>

    <div id="date">
        <p class="page">   <p >Printed By: {{ Auth::user()->name }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date Printed: {{ date('m/d/Y') }}  </p>
     </p>
      </div>
   <main>
    <table id="tableforprint">
        <thead>
        <tr>
            <th colspan="2" rowspan="3" class="header">  <img src='data:image/jpeg;base64,{{$imageLogo}}' width="120px" height="120px"/></th>
            <th class="title"  colspan="5" class="header2" >Master Patient List</th>
         </tr>
         <tr>
            <th colspan="2" id="pdfhospital" class="header">{{$byHospitals}}
            </th>
            <th colspan="2" class="header">Patient/s for this cutoff:</th>
            <th colspan="1" id="noofpatients2" class="header">{{$patientstotal}}</th>
         </tr>
         <tr>
            <th colspan="2" class="header">Period: from <span >{{ \Carbon\Carbon::parse($sd)->format('F j, Y')}}</span>
          <span > to {{ \Carbon\Carbon::parse($ed)->format('F j, Y')}}</span>
        </th>
            <th colspan="2" class="header" >Total Patient/s</th>
            <th colspan="1" id="nooftotalpatients1" class="header">{{$pow}}</th>
         </tr>

         <tr style="background-color:rgb(177, 241, 241);">
            <th class="header" style="width:15px;">No.</th>
            <th class="header" id="masterpatientpdf"  >Master Patient Index</th>
            <th class="header" id="fullnamepdf" >Full Name</th>
            <th class="header" style="width: 15px;">Age</th>
            <th class="header" id="addresspdf">Address</th>
            <th class="header">Registered</th>
            <th class="header">Visit</th>

         </tr>
        </thead>
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
                <td id="date2" style="text-align: center;">{{ date('m-d-Y', strtotime($PatientInfos2->DATECREATED)) }}</td>
                <td id="visit" style="text-align: center;">{{ $PatientInfos2->U_VISITCOUNT }}</td>
            </tr>

         @php
              $i++
          @endphp
         @endforeach
        </tbody>
    </table></main> <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                if ($PAGE_COUNT > 1) {
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $size = 12;
                    $pageText = "Page " . $PAGE_NUM . " of " . $PAGE_COUNT;
                    $y = 15;
                    $x = 520;
                    $pdf->text($x, $y, $pageText, $font, $size);
                }
            ');
        }
        </script></body> </html>
