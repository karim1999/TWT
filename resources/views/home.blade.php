@extends('layouts.app')

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-10 col-md-9 col-sm-10 col-xl-7">
            <h3 style="">See what’s happening in the world right now</h3>
            <h6 class="">Join TWTChat today.</h6>
            <div class="main-btn">
                <a href="{{ route('register') }}"><button class="btn btn-primary">Sign Up</button></a>
                <a href="{{ route('login') }}"><button class="btn btn-default">Log in</button></a>
            </div>
        </div>
    </div>
@endsection
