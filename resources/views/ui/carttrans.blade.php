@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Cart Transactions') }}</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @livewire('carttrans', ['cart' => $cart])
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection