<div>
    <div class="row">
        <div class="w-50">
            <label for="searchICD">Search</label>
        <input type="text" wire:model="searchICD" class="form-control" placeholder="Search ICD10">
        </div>
        
    </div>
    <div class="row mt-3">
        <table class="icd10-list">
            <tr>
                <th>
                    <span class="float-left text-sm " wire:click="sortBy('icd10Code')">  CODE
                        <i class="fa fa-arrow-up {{$sortColumnName ==='icd10Code' && $sortDirection ==='asc' ?'':'hidden '}} float-right pt-1"></i>
                        <i class="fa fa-arrow-down {{$sortColumnName ==='icd10Code' && $sortDirection ==='desc' ?'':'hidden '}} float-right pt-1"></i>
                    </span>
                </th>
                <th>
                    <span class="float-left text-sm " wire:click="sortBy('DESCRIPTION')">  Description
                        <i class="fa fa-arrow-up {{$sortColumnName ==='DESCRIPTION' && $sortDirection ==='asc' ?'':'hidden '}} float-right pt-1"></i>
                        <i class="fa fa-arrow-down {{$sortColumnName ==='DESCRIPTION' && $sortDirection ==='desc' ?'':'hidden '}} float-right pt-1"></i>
                    </span>
                </th>
                <th>
                    <span class="float-left text-sm " wire:click="sortBy('GROUP')">  Group
                        <i class="fa fa-arrow-up {{$sortColumnName ==='GROUP' && $sortDirection ==='asc' ?'':'hidden '}} float-right pt-1"></i>
                        <i class="fa fa-arrow-down {{$sortColumnName ==='GROUP' && $sortDirection ==='desc' ?'':'hidden '}} float-right pt-1"></i>
                    </span>
                </th>
            </tr>
            <tbody>
                @foreach ($getICDs as $getICD)
                    <tr wire:key="{{$getICD->id}}" onclick="getICDS('{{$getICD->icd10Code}}')" >
                        <td id="icdCode" >{{$getICD->icd10Code}}</td>
                        <td id="icdDescription">{{$getICD->DESCRIPTION}}</td>
                        <td>{{$getICD->GROUP}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
