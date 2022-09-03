<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Components\GetLastCode;

class Icd10 extends Component
{
    use GetLastCode;
    public $searchICD;
    public $sortColumnName='icd10Code';
    public $sortDirection ='desc';

    public function render()
    {
        
        $searchICD=$this->searchICD;
        $getICDs=DB::table('u_hisicd10s')->where('DESCRIPTION','like','%'.$searchICD.'%')
            ->orwhere('icd10Code','like','%'.$searchICD.'%')->orderBy($this->sortColumnName,$this->sortDirection)->paginate(10);
        return view('livewire.icd10',['getICDs'=>$getICDs]);
    }
}
