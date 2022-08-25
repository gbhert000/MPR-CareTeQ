<style>
  .columen {
position: relative;
top: 50%;
-webkit-transform: translateY(-50%);
-ms-transform: translateY(-50%);
transform: translateY(-50%);
}
</style>
<style type="text/css" media="print">
@media screen {
#printSection {
  display: none;
}
}
@media print {
body * {
  visibility:hidden;

}
#printSection, #printSection * {
  visibility:visible;
}
#printSection {
  position: absolute;;
  top: 0;
  left: 0;
  right: 0;
  margin: 0;
padding: 0;
box-sizing: border-box;
}
  /* @page {
scale: 100;
} */
}
</style>

<!-- Modal -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
<div class="modal-dialog modal-xl" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLongTitle">MASTER PATIENT LIST</h5>
    <button type="button" class="btn-close" onclick="resetInput()" data-dismiss="modal" aria-label="Close">

    </button>
  </div>
  <div class="modal-body" id="printThis">

      <div class="html-content">

          <table class="table table-bordered border border-dark printsection">
                {{-- <div class="container" >
                  <div class="row border border-dark">
               </div>
                </div>
                 <div class="container"> --}}
                  <thead>
                 <tr>
                  <th colspan="10"><center style="font-size: 20px; font-weight:bold;">MASTER PATIENT LIST</center></th>
                 </tr>
                 <tr>
                  <th  rowspan="3" colspan="2"><img src="img/panga.png" class="rounded mx-auto d-block" style="width: 60%;"></th>
                  <th colspan="2">HOSPITAL NAME</th>
                  @if($HPI!="" && $noOfVisit!="")
                  <th  colspan="1">PPH 1,GGH</th>
                  <th  colspan="3">REGISTERED PATIENT/S:</th>
                   <th>69</th>
                   <tr>
                      <th colspan="3" >PERIOD: FROM FEBRUARY 20 2022 TO APRIL 30 2022</th>
                      <th colspan="3">TOTAL REGISTERED PATIENT/S:</th>
                      <th >100</th>
                     </tr>

                   @elseif ($HPI!="" || $noOfVisit!="")
                   <th  colspan="1">PPH 1,GGH</th>
                   <th  colspan="2">REGISTERED PATIENT/S:</th>
                   <th>69</th>
                   <tr>
                      <th colspan="3" >PERIOD: FROM FEBRUARY 20 2022 TO APRIL 30 2022</th>
                      <th colspan="2">TOTAL REGISTERED PATIENT/S:</th>
                      <th >100</th>
                     </tr>

                   @else
                   <th  colspan="1">PPH 1,GGH</th>
                   <th  >REGISTERED PATIENT/S:</th>
                   <th>69</th>
                   <tr>
                      <th colspan="3" >PERIOD: FROM FEBRUARY 20 2022 TO APRIL 30 2022</th>
                      <th colspan="1">TOTAL REGISTERED PATIENT/S:</th>
                      <th >100</th>
                     </tr>

                   @endif
                 </tr>
                 {{-- <tr>
                  <th colspan="4" >PERIOD: FROM FEBRUARY 20 2022 TO APRIL 30 2022</th>
                  <th colspan="3">TOTAL REGISTERED PATIENT/S:</th>
                  <th >100</th>
                 </tr> --}}


              </thead>

              <tbody>
                  <tr>
                      <th scope="col" class="col" style="text-align: center">NO.</th>
                      <th scope="col"  class="col"style="text-align: center">Master Patient Index</th>
                      <th scope="col" class="col" style="text-align: center">Full Name</th>
                      <th scope="col" class="col" style="text-align: center">Ext</th>
                      <th scope="col" class="col" style="text-align: center">Registered</th>
                      <th scope="col" class="col" style="text-align: center">Address</th>
                      <th scope="col" class="col" style="text-align: center">Age</th>
                      @if($HPI!="")
                      <th scope="col" class="col" style="text-align: center">Hospital Patient Index</th>
                      @endif
                      @if($noOfVisit!="")
                      <th scope="col" class="col" style="text-align: center">Visits</th>
                      @endif
                    </tr>
                  @php $i=1 @endphp
                  @foreach($patients as $item)
                <tr>
                  <th scope="row" style="text-align: center;">{{$i}}</th>
                  <td style="text-align: center;">{{$item->CODE}}</td>
                  <td style="text-align: center;">{{$item->NAME}}</td>
                  <td style="text-align: center;">{{$item->U_EXTNAME}}</td>
                  <td style="text-align: center;">{{$item->DATECREATED}}</td>
                  <td style="text-align: center;">{{$item->U_CITY}}</td>
                  <td style="text-align: center;">{{$item->U_AGE}}</td>
                  @if($HPI!="")
                  <td></td>
              @endif
              @if($noOfVisit!="")
              <td>{{ $item->U_VISITCOUNT }}</td>
          @endif
                </tr>
                @php
                    $i++
                @endphp
                @endforeach
              </tbody>
            </table>

  </div>
  {{-- <button onclick="print2()">EXPORT TO PDF</button>
  <a onclick="functionPrint()">PRINT</a> --}}
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-success" id="Print">PRINT</button>
    <button class="btn btn-primary" onclick="print2()">EXPORT TO PDF</button>
  </div>
</div>
</div>
</div>


<script>
document.getElementById("Print").onclick = function () {
printElement(document.getElementById("printThis"));
};

function printElement(elem) {
var domClone = elem.cloneNode(true);

var $printSection = document.getElementById("printSection");

if (!$printSection) {
  var $printSection = document.createElement("div");
  $printSection.id = "printSection";
  document.body.appendChild($printSection);
}

// $printSection.innerHTML = "";
$printSection.appendChild(domClone);
window.print();
location.reload();
}
</script>
