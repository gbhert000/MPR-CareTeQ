{{-- NEED ILIPAT --}}
<style>
  i#Printthetable2, i#expexcel,i#qwerty, i#viewrecords{
  font-size: 260%;
  color: #387AC1;
  cursor: pointer;
}
th#registeredin1 {
  width: 10%;
}
  /* body {
      counter-reset: page;
  } */
  .tfoot1{
      display: none;
  }
  .columen {
position: relative;
top: 50%;
-webkit-transform: translateY(-50%);
-ms-transform: translateY(-50%);
transform: translateY(-50%);

}
/* .break{
  page-break-before: always;
} */
th{
text-align: center;
}
.footer {
position: fixed;
bottom: 0;
visibility: hidden;
}
button#Printthetable {
  left: 77%;
  position: absolute;
}
button#exportpdf {
  position: absolute;
  left: 84%;
}
#pageFooter1{
  visibility: hidden;
}
.table > :not(caption) > * > *{
  padding: 3px !important;
}
/* .break{
  page-break-before: always;
} */
#tfoot1,#tr1,#td1{
  border: none ;
}
th#addressth {
  width: 30%;
}
/*  */
</style>
<style type="text/css" media="print">

@media screen {
#printSection {
  display: none;
}
}
@media print {
  #printby{
      font-size: 10px;
  }
  #pageFooter1{
      font-size: 10px;
  }
  .table > :not(caption) > * > * {
  padding: 3px !important;
}
  #pageCounter{
      counter-increment: page;
  }
  th#registeredin1 {
  width: 40%;
}
th#fullnamein1 {
  width: 42%;
}

th#addressth {
  width: 30%;
}
  #tablelist{
      font-size: 1px !important;
  }
  @page {
size: A4;
margin: 11mm 17mm 17mm 17mm;

/* counter-reset: page !important; */
}
/* #tfoot1{
      counter-increment: page !important;
} */
#pageFooter1 {

/* counter-increment: page; */
}
/* #pageFooter1:after {

content: "Page " counter(page) " of "!important;
} */
.printsection thead, tbody{
  border: 1px solid black;
}

  #dataz1{
      border-bottom: 1px solid black;
  }
  #td1{
  border-left:  solid 1px white !important;
  border-bottom: solid 1px white !important;
  border-top: solid 1px black !important;
}


  /* tr{
  page-break-after: always;
  display: block;
} */

  td#fullnametd {
  padding: 3px;
}

#pageFooter1{
  visibility: visible;
  position: fixed;
  bottom: 0px;
  right: 0;
}



  /* .print+.print {
  page-break-before: always;
} */
  /* html, body {
    height:100vh;
    margin: 0 !important;
    padding: 0 !important;
    overflow: hidden;
  } */

  #tablelist{
  background-color:rgb(177, 241, 241) !important;
   -webkit-print-color-adjust: exact;
}
body * {
  visibility:visible;

}
#printSection, #printSection * {
  visibility:visible;
}
#printSection {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  margin: 0;
padding: 0;
box-sizing: border-box;
}
#printme{
  display: block;
  margin-bottom: 5%;
}
}
td{
    font-size: 8px;
}
th{
    font-size: 10px;
}
#noin1,#masterpatientin1,#fullnamein1,#agein1,#addressth,#registeredin1,#visitsin1{
  font-size: 7px !important;
}
/* @media print {
  .pagebreak {
      clear: both;
      page-break-after: always;
  }
} */

 /* tr:nth-child(5) {
    visibility: hidden;
} */
</style>
<!-- Modal -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
<div class="modal-dialog modal-xl" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLongTitle">MASTER PATIENT LIST</h5>
    <button class="btn btn-primary" onclick="print5()" id="exportpdf">EXPORT TO PDF</button>
    <button type="button" class="btn-close" onclick="resetInput()" data-dismiss="modal" aria-label="Close">

    </button>
  </div>
  <div class="modal-body" id="printme">
      <div class="html-content">
          <div id="pageCounter">
          <table class="table table-bordered border border-dark printsection" id="html-contents">
                {{-- <div class="container" >
                  <div class="row border border-dark">
               </div>
                </div>toRegistered Patient/s:
                 <div class="container"> --}}

                  <thead class="tablerep">
                 <tr>
                    <th  rowspan="3 " colspan="2" id="imagepangath" style="    width: 18%;"><img src="img/panga.png" id="imagepanga" class="rounded mx-auto d-block"
                         style="    width: 90%;
                         margin-left: 5% !important;
                        "></th>

                  <th colspan="6" id="master"><center style="font-size: 20px; font-weight:bold;">MASTER PATIENT LIST</center></th>

                </tr>
                 <tr>
                 <th colspan="2" id="hospitalfil">Hospital Name</th>

                  <th  colspan="2">Patient/s for this cutoff:</th>
                   <th id="noofpatients1"></th>
                 </tr>
                   <tr>
                      @if ($startDate=="" )
                      @foreach ($oldest as $old)
                      <th colspan="2" >Period: from <span >{{ \Carbon\Carbon::parse($old)->format('F j, Y')}}</span> to <span >{{ \Carbon\Carbon::parse($endDate)->format('F j, Y')}}</span></th>
                      @endforeach

                      @else
                          <th colspan="2" >Period: from <span >{{ \Carbon\Carbon::parse($startDate)->format('F j, Y')}}</span> to <span >{{ \Carbon\Carbon::parse($endDate)->format('F j, Y')}}</span></th>

                  @endif
                  <th colspan="2">Total Patient/s:</th>
                  @if ($byHospitals=="")
                  <th>{{$pow}}</th>
                  @else
                  <th >{{$getallpatientsincom}}</th>
                  @endif
                 </tr>


                     <tr style="background-color:rgb(177, 241, 241);" id="tablelist">
                      <th scope="col" class="col" style="text-align: center" id="noin1">NO.</th>
                      <th scope="col"  class="col"style="text-align: center" id="masterpatientin1">Master Patient Index</th>
                      <th scope="col" class="col" style="text-align: center" id="fullnamein1">Full Name</th>
                      <th scope="col" class="col" style="text-align: center" id="agein1">Age</th>
                      <th scope="col" class="col" style="text-align: center" id="addressth">Address</th>
                      <th scope="col" class="col" style="text-align: center" id="registeredin1">Registered</th>
                      <th scope="col" class="col" style="text-align: center" id="visitsin1">Visits</th>

                    </tr>


              </thead>
              <tbody id="tbodyz">

                    {{-- SABI NI MANUEL PARA SA LAHAT --}}
                    @if ($startDate=="" && $endDate=="" && $byHospitals==""&& $search=="")

                    @php
                           $i=1;
                           echo('nofilters');
                            @endphp
                  @foreach($getallpatients as $item)
                <tr  wire:key="{{$item->id}}">
                  <th scope="row" style="text-align: center;">{{$i}}</th>
                  <td style="text-align: center;">{{$item->CODE}}</td>
                  <td >{{$item->NAME}}</td>
                  <td style="text-align: center;">{{$item->U_AGE}}</td>
                  <td style="text-align: center;">{{$item->U_CITY}}</td>
                  <td style="text-align: center;">{{ date('m-d-Y', strtotime($item->DATECREATED)) }}</td>
                  <td style="text-align: center;">{{ $item->U_VISITCOUNT }}</td>

                </tr>
                @php
                    $i++
                @endphp
                @endforeach


                   @elseif ($startDate=="" && $endDate=="" && $byHospitals!=""&& $search=="")
                   @php
                   $i=1;
                   echo('filterbyhospital');
                    @endphp
          @foreach($getallpatients2 as $item)
        <tr  wire:key="{{$item->id}}">
          <th scope="row" style="text-align: center;">{{$i}}</th>
          <td style="text-align: center;">{{$item->CODE}}</td>
          <td >{{$item->NAME}}</td>
          <td style="text-align: center;">{{$item->U_AGE}}</td>
          <td style="text-align: center;">{{$item->U_CITY}}</td>
          <td style="text-align: center;">{{ date('m-d-Y', strtotime($item->DATECREATED)) }}</td>
          <td style="text-align: center;">{{ $item->U_VISITCOUNT }}</td>

        </tr>
        @php
            $i++
        @endphp
        @endforeach
        @elseif ( $search=="" && $byHospitals!="" && $startDate!="" && $endDate!="")
                          @php
                          $i=1;
                          echo('filter by search and hospital');
                           @endphp
                  @foreach($getallpatients7 as $item)
                  <tr  wire:key="{{$item->id}}">
                  <th scope="row" style="text-align: center;">{{$i}}</th>
                  <td style="text-align: center;">{{$item->CODE}}</td>
                  <td >{{$item->NAME}}</td>
                  <td style="text-align: center;">{{$item->U_AGE}}</td>
                  <td style="text-align: center;">{{$item->U_CITY}}</td>
                  <td style="text-align: center;">{{ date('m-d-Y', strtotime($item->DATECREATED)) }}</td>
                  <td style="text-align: center;">{{ $item->U_VISITCOUNT }}</td>

                  </tr>
                  @php
                  $i++
                  @endphp
                  @endforeach
        @elseif ($startDate!="" && $endDate!="" && $search=="")
                          @php
                          $i=1;
                          echo('filter by date and null search');
                           @endphp
                  @foreach($getallpatients3 as $item)
                  <tr  wire:key="{{$item->id}}">
                  <th scope="row" style="text-align: center;">{{$i}}</th>
                  <td style="text-align: center;">{{$item->CODE}}</td>
                  <td >{{$item->NAME}}</td>
                  <td style="text-align: center;">{{$item->U_AGE}}</td>
                  <td style="text-align: center;">{{$item->U_CITY}}</td>
                  <td style="text-align: center;">{{ date('m-d-Y', strtotime($item->DATECREATED)) }}</td>
                  <td style="text-align: center;">{{ $item->U_VISITCOUNT }}</td>

                  </tr>
                  @php
                  $i++
                  @endphp
                  @endforeach
{{-- filter by dates and search --}}
                  @elseif ($startDate!="" && $endDate!="" && $search!="")
                          @php
                          $i=1;
                          echo('filter by dates and search');
                          @endphp
                  @foreach($getallpatients4 as $item)
                  <tr  wire:key="{{$item->id}}">
                  <th scope="row" style="text-align: center;">{{$i}}</th>
                  <td style="text-align: center;">{{$item->CODE}}</td>
                  <td >{{$item->NAME}}</td>
                  <td style="text-align: center;">{{$item->U_AGE}}</td>
                  <td style="text-align: center;">{{$item->U_CITY}}</td>
                  <td style="text-align: center;">{{ date('m-d-Y', strtotime($item->DATECREATED)) }}</td>
                  <td style="text-align: center;">{{ $item->U_VISITCOUNT }}</td>

                  </tr>
                  @php
                  $i++
                  @endphp
                  @endforeach
                  {{-- FILTER BY SEARCH --}}
                  @elseif ( $search!="" && $byHospitals=="" && $startDate=="" && $endDate=="")
                          @php
                          $i=1;
                          echo('filter by search');
                           @endphp
                  @foreach($getallpatients5 as $item)
                  <tr  wire:key="{{$item->id}}">
                  <th scope="row" style="text-align: center;">{{$i}}</th>
                  <td style="text-align: center;">{{$item->CODE}}</td>
                  <td >{{$item->NAME}}</td>
                  <td style="text-align: center;">{{$item->U_AGE}}</td>
                  <td style="text-align: center;">{{$item->U_CITY}}</td>
                  <td style="text-align: center;">{{ date('m-d-Y', strtotime($item->DATECREATED)) }}</td>
                  <td style="text-align: center;">{{ $item->U_VISITCOUNT }}</td>

                  </tr>
                  @php
                  $i++
                  @endphp
                  @endforeach

                  @elseif ( $search!="" && $byHospitals!="")
                          @php
                          $i=1;
                          echo('filter by search and hospital');
                           @endphp
                  @foreach($getallpatients6 as $item)
                  <tr  wire:key="{{$item->id}}">
                  <th scope="row" style="text-align: center;">{{$i}}</th>
                  <td style="text-align: center;">{{$item->CODE}}</td>
                  <td >{{$item->NAME}}</td>
                  <td style="text-align: center;">{{$item->U_AGE}}</td>
                  <td style="text-align: center;">{{$item->U_CITY}}</td>
                  <td style="text-align: center;">{{ date('m-d-Y', strtotime($item->DATECREATED)) }}</td>
                  <td style="text-align: center;">{{ $item->U_VISITCOUNT }}</td>

                  </tr>
                  @php
                  $i++
                  @endphp
                  @endforeach


                   @else
                        @php
                           $i=1;
                           echo('hello');
                           @endphp
                  @foreach($patients as $item)
                <tr  wire:key="{{$item->id}}">
                  <th scope="row" style="text-align: center;">{{$i}}</th>
                  <td style="text-align: center;">{{$item->CODE}}</td>
                  <td >{{$item->NAME}}</td>
                  <td style="text-align: center;">{{$item->U_AGE}}</td>
                  <td style="text-align: center;">{{$item->U_CITY}}</td>
                  <td style="text-align: center;">{{ date('m-d-Y', strtotime($item->DATECREATED)) }}</td>
                  <td style="text-align: center;">{{ $item->U_VISITCOUNT }}</td>

                </tr>
                @php
                    $i++
                @endphp
                @endforeach

                    @endif

                <input type="hidden" id="red2" value="{{$i-1}}">
              </tbody>
                 </div>
              <tfoot id="tfoot1" >
                  <tr id="tr1" >
                      <td  id="td1" >
                            <br><br><div id="date" class="footer">
                          {{-- <p class="page" id="printby">Printed By: {{Auth::user()->name}} &nbsp; Date Printed: {{ date('m/d/Y') }} </p> --}}
                          <p class="page" id="printby">Printed By: {{Auth::user()->name}}  </p>

                               </div>
                        <p id="pageFooter1" ></p></td>
                  </tr>
              </tfoot>
            </table>


               </div>






  </div>

        </div>


  <div class="modal-footer">
    {{-- <button type="button" class="btn btn-success" id="Printthetable">PRINT</button>
    <button class="btn btn-primary" onclick="print5()">EXPORT TO PDF</button> --}}
  </div>
</div>
</div>
</div>


{{-- END NEED ILIPAT --}}


















