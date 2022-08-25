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
                    {{-- @livewire('u-hispatients') --}}
                    <livewire:reports   />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

