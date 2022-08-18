<div>
    <table class="mt-3 patient-list-table" id="patients">
        <thead>
                <th scope="col" class="table-code">
                    <span class="float-left text-sm" wire:click="sortBy('CODE')"> Patient ID
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
                <th>Status</th>

        </thead>
        <tbody>
                @foreach($patients as $item)
            <tr id="patientUpdate" data-bs-toggle="modal" data-bs-target="#viewPatientModal"  wire:click="edit('{{ $item->CODE }}')">
                            <td >{{ $item->CODE }}</td>
                            <td>{{ $item->U_LASTNAME }}</td>
                            <td>{{ $item->U_FIRSTNAME }}</td>
                            <td>{{ $item->U_MIDDLENAME }}</td>
                            <td>{{ $item->U_EXTNAME }}</td>
                            <td>{{ $item->U_BIRTHDATE }}</td>
                            <td>{{ $item->U_GENDER }}</td>
                            <td>{{ $item->U_VISITCOUNT }}</td>         
                            <td>
                                @if($item->U_ACTIVE==1)
                                    {{ ('Yes') }}
                                
                                @else
                                    {{('No')}}
                                
                                @endif
                                </td>         
                    </tr>
                    {{-- @empty --}}
                @endforeach</td>
        </tbody>
    </table>
</div>
