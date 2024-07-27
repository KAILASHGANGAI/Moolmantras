@extends('layouts.app')
@section('content')
    @include('parts.nobanner-menu')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-header bg-success text-white">
                        Payment Success
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Thank you for your payment!</h5>
                        <p class="card-text">Your transaction has been successfully completed.</p>
                        <a href="/" class="btn btn-primary">Return to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
@endsection
