@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="">
            <div class="card">
                <div class="card-header">{{ __('Master Patient List') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @livewire('u-hispatients')
                    {{-- @if (Auth::user()->user_role ==0)

                    
                    @else
                        <livewire:u-hispatients/>
                    
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    window.addEventListener('close-modal', event => {

        $('#studentModal').modal('hide');
        $('#updateStudentModal').modal('hide');
        $('#deleteStudentModal').modal('hide');
    })
</script>
@endsection
