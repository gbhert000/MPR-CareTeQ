{{-- PALAGAY AKO NETO KIER --}}
<div>
    @include('livewire.addImageModal')
    @include('livewire.viewPatientModal')
    @include('livewire.addPatientModal')
    @include('livewire.reportModal')

<div class="nonPrintable">
   <div class="row patient-list">
    <div class="row mb-2">

        <label for="">Check Data To Display</label>
        <br>
        {{-- <div class="col">
            <label for="MPI text-left">Master Patient Index</label>
        <input type="checkbox" name="MPI" id="MPI" wire:click="MPI">
        </div> --}}

        {{-- <div class="w-100"></div> --}}
        {{-- <div class="col">
            <label for="HPI">Hospital Patient Index</label>
        <input type="checkbox" name="HPI" id="HPI" value="HPI" wire:model="HPI">
        </div> --}}

        {{-- <div class="w-100"></div> --}}
        {{-- <div class="col">
            <label for="fullname">Fullname</label>
        <input type="checkbox" name="fullname" id="fullname" value="fullname" wire:model="fullname">
        </div> --}}

        {{-- <div class="w-100"></div> --}}
        {{-- <div class="col">
            <label for="noOfVisit">Number of Visit</label>
        <input type="checkbox" name="noOfVisit" id="noOfVisit" value="NumberOfVisit" wire:model="noOfVisit">
        </div> --}}

        <div class="col">
            <select name="byHospitals" id="byHospitals" wire:model="byHospitals">
                <option value="">Filter By Hospital</option>
                @foreach ($hospitals as $hospital)
                    <option value="{{$hospital->hospitalName}}">{{$hospital->hospitalName}}</option>
                @endforeach
            </select>
            <i class="bi bi-printer-fill" id="Printthetable2" style="margin-left: 61%;"></i>
            {{-- <i class="bi bi-file-pdf-fill viewReportModal"  id="viewrecords" ></i> --}}
            <i class="bi bi-file-pdf-fill "  id="qwerty" ></i>
            {{-- <button id="qwerty">EXPORT</button> --}}
            <i id="expexcel" class="bi bi-file-spreadsheet-fill" ></i>
            {{-- {{$byHospitals}} --}}
        </div>




</div>


    <div class="col-xl-6  float-right">
        <label for="search">Search Patients:</label>
        <br>
        {{-- {{$HPI}} --}}
        <input type="text" name="search"  id="search" placeholder="Search Patient" class=" searchbarReport" wire:model="search" />
        <button class="btn btn-primary" id="addingPatient"> Add Patient</button>
        {{-- <button  name="Add Picture" class="btn btn-primary" data-toggle="modal" data-target="#addImageModal" >Add Picture</button> --}}

    </div>
    <div class="col-sm">
        <label for="startDate">Start</label>
        <input type="date" name="startDate" id="startDate" wire:model="startDate" class="form-control">

    </div>
    <div class="col-sm  ">
        <label for="endDate">End</label>
        <input type="date" name="endDate" id="endDate" wire:model="endDate" class="form-control">
    </div>

    <div class="col-sm">
        <label for="itemPerPage">per Page:</label>
        <select name="itemPerPage"  wire:model="perPage" class="form-control">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>

        </select>
    </div>
    <div class="col">
        <label for="resertFilter"></label>
        <br>
        <button class="btn btn-primary" id="resetFilter" wire:click="resetFilter()">Reset Filter</button>
    </div>
    <table class="mt-3 patient-list-table" id="patients">
        <thead>
                <th scope="col" class="table-number">
                    <span class="float-left text-sm"> No.</span>
                </th>
                <th scope="col" class="table-code">
                    <span class="float-left text-sm" wire:click="sortBy('CODE')"> Master Patient Index
                        <i class="fa fa-arrow-up {{$sortColumnName ==='CODE' && $sortDirection ==='asc' ?'':'hidden '}} float-right pt-1"></i>
                        <i class="fa fa-arrow-down {{$sortColumnName ==='CODE' && $sortDirection ==='desc' ?'':'hidden '}} float-right pt-1"></i>

                    </span>
                </th>

                @if($fullname!="")
                    <th class="table-name-fullname">
                        <span class="float-left" wire:click="sortBy('NAME')"> Full Name
                            <i class="fa fa-arrow-up {{$sortColumnName ==='NAME' && $sortDirection ==='asc' ?'':'hidden '}} float-right pt-1"></i>
                            <i class="fa fa-arrow-down {{$sortColumnName ==='NAME' && $sortDirection ==='desc' ?'':'hidden '}} float-right pt-1"></i>
                        </span>
                    </th>
                @else
                    <th class="table-name-lname">
                        <span class="float-left text-sm " wire:click="sortBy('U_LASTNAME')"> Last Name
                            <i class="fa fa-arrow-up {{$sortColumnName ==='U_LASTNAME' && $sortDirection ==='asc' ?'':'hidden '}} float-right pt-1"></i>
                            <i class="fa fa-arrow-down {{$sortColumnName ==='U_LASTNAME' && $sortDirection ==='desc' ?'':'hidden '}} float-right pt-1"></i>
                        </span>
                    </th>
                    <th class="table-name-fname">
                        <span class="float-left text-sm" wire:click="sortBy('U_FIRSTNAME')"> First Name
                        <i class="fa fa-arrow-up {{$sortColumnName ==='U_FIRSTNAME' && $sortDirection ==='asc' ?'':'hidden '}} float-right pt-1"></i>
                        <i class="fa fa-arrow-down {{$sortColumnName ==='U_FIRSTNAME' && $sortDirection ==='desc' ?'':'hidden '}} float-right pt-1"></i>
                    </span>
                    </th>
                    <th  class="table-name-mname">
                        <span class="float-left text-sm" wire:click="sortBy('U_MIDDLENAME')"> Middle Name
                        <i class="fa fa-arrow-up {{$sortColumnName ==='U_MIDDLENAME' && $sortDirection ==='asc' ?'':'hidden '}} float-right pt-1"></i>
                        <i class="fa fa-arrow-down {{$sortColumnName ==='U_MIDDLENAME' && $sortDirection ==='desc' ?'':'hidden '}} float-right pt-1"></i>
                    </span>
                    </th>
                    <th>Ext.</th>


                @endif

                <th>
                    <span class="float-left text-sm table-name" wire:click="sortBy('DATECREATED')">  Date Registered
                        <i class="fa fa-arrow-up {{$sortColumnName ==='DATECREATED' && $sortDirection ==='asc' ?'':'hidden '}} float-right pt-1"></i>
                        <i class="fa fa-arrow-down {{$sortColumnName ==='DATECREATED' && $sortDirection ==='desc' ?'':'hidden '}} float-right pt-1"></i>
                    </span>
                   </th>
                <th>
                    <span class="float-left text-sm table-name" wire:click="sortBy('U_CITY')"> Address
                    <i class="fa fa-arrow-up {{$sortColumnName ==='U_CITY' && $sortDirection ==='asc' ?'':'hidden '}} float-right pt-1"></i>
                    <i class="fa fa-arrow-down {{$sortColumnName ==='U_CITY' && $sortDirection ==='desc' ?'':'hidden '}} float-right pt-1"></i>
                </span>
                </th>

                <th>
                    <span class="float-left text-sm table-name" wire:click="sortBy('U_AGE')"> Age
                        <i class="fa fa-arrow-up {{$sortColumnName ==='U_AGE' && $sortDirection ==='asc' ?'':'hidden '}} float-right pt-1"></i>
                        <i class="fa fa-arrow-down {{$sortColumnName ==='U_AGE' && $sortDirection ==='desc' ?'':'hidden '}} float-right pt-1"></i>
                    </span>
                </th>

                    <th>
                        <span class="float-left text-sm table-name" wire:click="sortBy('U_VISITCOUNT')"> Visits
                            <i class="fa fa-arrow-up {{$sortColumnName ==='U_VISITCOUNT' && $sortDirection ==='asc' ?'':'hidden '}} float-right pt-1"></i>
                            <i class="fa fa-arrow-down {{$sortColumnName ==='U_VISITCOUNT' && $sortDirection ==='desc' ?'':'hidden '}} float-right pt-1"></i>
                        </span>
                    </th>

                {{-- <th>No. of Visit</th>
                <th>Status</th> --}}

        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach($patients as $item)
            <tr wire:key="{{ $item->CODE }}" id="patientUpdate"  ondblclick="viewRecord('{{ $item->CODE }}')">
                <td >{{ $i }}</td>
                <td >{{ $item->CODE }}</td>

                @if($fullname!="")
                    <td>{{ $item->NAME }}</td>

                @else
                    <td>{{ $item->U_LASTNAME }}</td>
                    <td>{{ $item->U_FIRSTNAME }}</td>
                    <td>{{ $item->U_MIDDLENAME }}</td>
                    <td>{{ $item->U_EXTNAME }}</td>

                @endif

                <td>{{ $item->DATECREATED }}</td>
                <td>{{ $item->U_CITY }}</td>
                <td>{{ $item->U_AGE }}</td>

                    <td>{{ $item->U_VISITCOUNT }}</td>

                {{-- <td>
                    @if($item->U_ACTIVE==1)
                        {{ ('Yes') }}

                    @else
                        {{('No')}}

                    @endif
                </td>          --}}
            </tr>
            @php $i++ @endphp
                    {{-- @empty --}}
            @endforeach
        </tbody>
    </table>
    <div class="row pagination-content mt-3">
        {{ $patients->links('pagination::bootstrap-5-custom') }}
    </div>





<script>
    // $("#html-contents").print({
    //     	globalStyles: true,
    //     	mediaPrint: false,
    //     	stylesheet: null,
    //     	noPrintSelector: ".no-print",
    //     	iframe: true,
    //     	append: null,
    //     	prepend: null,
    //     	manuallyCopyFormValues: true,
    //     	deferred: $.Deferred(),
    //     	timeout: 750,
    //     	title: null,
    //     	doctype: '<!doctype html>'
    // });
    // $('#html-contents').printThis();


$('#Printthetable2').click(function() {
    // $('#html-contents').printThis();
    $("#html-contents").printThis({

footer:null ,               // postfix to html

});

    });

    $('#expexcel').click(function() {
        $("#tbodyz").table2excel({
  exclude:".noExl",
  name:"MasterPatientList",
  filename:"MasterpatientList",
  fileext:".xlxs",
  exclude_img:false,
  exclude_links:false,
  exclude_inputs:false
});
    });


</script>
{{-- END PALAGAY AKO NETO KIER --}}
<script>
    $('#startDate').val(new Date().toJSON().slice(0,10));
  $('#endDate').val(new Date().toJSON().slice(0,10));

$( "#qwerty" ).click(function() {
$startDate=$("#startDate").val();
$endDate=$("#endDate").val();
$("#pdfhospital").html($( "#byHospitals" ).val());
$('#noofpatients2').html($('#red3').val());
$byhospital = $("#byHospitals").val();


if($byhospital!="" && $startDate!="" && $endDate!=""){
    // alert("filtered by dates and hospital"+$byhospital);
        window.location.href = "/exporttopdf/"+$startDate+"/"+$endDate+"/"+$byhospital ;
}
else if($startDate!="" && $endDate!="" && $byhospital==""){
    $byhospital="All Hospitals";
    // alert('FILTERED BY DATE ONLY' +$byhospital);
   window.location.href = "/exporttopdf/"+$startDate+"/"+$endDate ;

}
else if($byhospital!="" && $startDate=="" && $endDate==""){
    // alert('FILTER BY HOSPITAL');

    window.location.href = "/exporttopdf/"+$byhospital ;
}
else{
    alert('NO FILTER!');
 //   window.location.href = "/exporttopdf";

}



});


</script>