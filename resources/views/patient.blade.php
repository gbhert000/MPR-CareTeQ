@extends('layouts.app')

@section('content')
<div class="row">
    <!-- Datatables -->
    <div class="col-lg-12">
      <div class="card mb-4">
        <div class="table-responsive p-3">
          <livewire:patients-table />
        </div>
      </div>
    </div>
  </div>
  <!--Row-->

</div>
@endsection