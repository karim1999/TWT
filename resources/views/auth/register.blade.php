@extends('layouts.app')

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-10 col-md-9 col-sm-10 col-xl-7">
            @if(Session::has('alert'))

                <div class="alert alert-success">

                    {{ Session::get('alert') }}

                    @php

                        Session::forget('alert');

                    @endphp

                </div>

            @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name" class="col col-form-label text-md-left">{{ __('Name') }}</label>

                    <div class="col">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

                    <div class="col">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col col-form-label text-md-left">{{ __('Password') }}</label>

                    <div class="col">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="col col-form-label text-md-left">{{ __('Confirm Password') }}</label>

                    <div class="col">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                        <a class="btn btn-link pull-left" href="{{ route('login') }}">
                            {{ __('Already a member Login Now?') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
