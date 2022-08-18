<?php

namespace App\Http\Livewire;

use App\Models\U_Hispatient;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;


class PatientsTable extends TableComponent
{
    // public function render()
    // {
    //     return view('livewire.patients-table');
    // }
    use HtmlComponents;
    public function columns(): array
    {
        return [
                Column::make('U_LASTNAME')
                ->sortable()
                ->searchable(),
                Column::make('U_LASTNAME')
                ->sortable()
                ->searchable(),
                Column::make('U_FIRSTNAME')
                ->sortable()
                ->searchable(),
                Column::make('U_MIDDLENAME')
                ->sortable()
                ->searchable(),
           
        ];
    }

    public function query(): Builder
    {
        return U_hispatient::query();
    }
}