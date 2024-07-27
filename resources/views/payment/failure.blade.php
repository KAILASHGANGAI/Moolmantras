@extends('layouts.app')
@section('content')
    @include('parts.nobanner-menu')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-center border-danger">
                    <div class="card-header bg-danger text-white">
                        Payment Failed
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Sorry, something went wrong.</h5>
                        <p class="card-text">Your transaction could not be completed. Please try again later.</p>
                        <a href="/" class="btn btn-danger">Return to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
