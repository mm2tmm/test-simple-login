@extends('app')
@section('content')
    <!-- Header-->
    <header class="masthead d-flex align-items-center">
        <div class="container px-4 px-lg-5 text-center">
            @auth
                <h2>Welcome to your area</h2>
                <h3>Regesterad phone: 
                    @php
                        echo \Auth::User()->phone;
                    @endphp
                </h3>
            @endauth
            <h1 class="mb-1">Test App</h1>

            <h3 class="mb-5"><em>Simple Login with OTP and change phone number</em></h3>

            <h4>Please check laravel.log file to view OTP</h4>
        </div>
    </header>
    <!-- About-->
    <section class="content-section bg-light" id="about">
        <div class="container px-4 px-lg-5 text-center">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <h4>I am so happy work with you :)</h4>
            </div>
        </div>
    </section>
@endsection