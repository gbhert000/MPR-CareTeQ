<div>
    @include('livewire.addImageModal')
    @include('livewire.viewPatientModal')
    @include('livewire.addPatientModal')
    @include('livewire.createVisitModal')
    @include('livewire.icd10modal')
    @include('livewire.viewVisitModal')

    
   <div class="row patient-list">
    <div class="col-md-8 float-right">
        <label for="search">Search Patients:</label>
        <br>
        <input type="text" name="search"  id="search" placeholder="Enter Patient Name" class=" searchbar" wire:model="search" autocomplete="off" />
        <button class="btn btn-primary" id="addingPatient"> Add Patient</button> 
        
        {{-- <button  name="Add Picture" class="btn btn-primary" data-toggle="modal" data-target="#addImageModal" >Add Picture</button> --}}

    </div>
    {{-- {{$newVisitID}} --}}
    <div class="col-sm-2">
        <label for="itemPerPage">Patients per Page:</label>
        <select name="itemPerPage" id=""wire:model="perPage" class="form-control">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="40">40</option>
        </select>

    </div>
    {{-- {{($search)}} --}}
    <table class="mt-3 patient-list-table" id="patients">
        <thead>
                <th scope="col" class="table-code">
                    <span class="float-left text-sm" wire:click="sortBy('CODE')"> Master Patient Index
                        <i class="fa fa-arrow-up {{$sortColumnName ==='CODE' && $sortDirection ==='asc' ?'':'hidden '}} float-right pt-1"></i>
                        <i class="fa fa-arrow-down {{$sortColumnName ==='CODE' && $sortDirection ==='desc' ?'':'hidden '}} float-right pt-1"></i>
                       
                    </span>
                </th>
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
                <th>Birth Date</th>
                <th>
                    <span class="float-left text-sm table-name" wire:click="sortBy('U_GENDER')"> Sex
                        <i class="fa fa-arrow-up {{$sortColumnName ==='U_GENDER' && $sortDirection ==='asc' ?'':'hidden '}} float-right pt-1"></i>
                        <i class="fa fa-arrow-down {{$sortColumnName ==='U_GENDER' && $sortDirection ==='desc' ?'':'hidden '}} float-right pt-1"></i>
                    </span>
                </th>
                <th>No. of Visit</th>
                {{-- <th>Status</th> --}}

        </thead>
        <tbody>
            @foreach($patients as $item)
            <tr wire:key="{{ $item->CODE }}" id="patientUpdate"  ondblclick="viewRecord('{{ $item->CODE }}','img/profile.png')">
                <td >{{ $item->CODE }}</td>
                <td>{{ $item->U_LASTNAME }}</td>
                <td>{{ $item->U_FIRSTNAME }}</td>
                <td>{{ $item->U_MIDDLENAME }}</td>
                <td>{{ $item->U_EXTNAME }}</td>
                <td>{{ date('d/m/Y', strtotime($item->U_BIRTHDATE)) }}</td>
                <td>
                    {{ $item->U_GENDER }}</td>
                <td>{{ $item->U_VISITCOUNT }}</td>         
                {{-- <td>
                    @if($item->U_ACTIVE==1)
                        {{ ('Yes') }}
                    
                    @else
                        {{('No')}}
                    
                    @endif
                </td>          --}}
            </tr>
                    {{-- @empty --}}
            @endforeach
        </tbody>
    </table>
    <div class="row pagination-content mt-3">
        {{ $patients->links('pagination::bootstrap-5-custom') }}
    </div>

    
    <div class="row">
        
        <a  href="report" id="getreport"><img src="icon/printer.png" alt="" class="iconPrinter"></a>
    </div>

    
    {{-- <hr style="border-top: dotted 1px;" />    --}}
</div>
{{-- <script src="//code.jquery.com/jquery-1.12.3.js"></script> --}}
{{-- <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
    src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
    $('#patients').DataTable();

    });
</script> --}}

