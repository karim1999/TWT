@extends('layouts.app')

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col-auto w-50">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

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
                    <div class="col">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Send Password Reset Link') }}
                        </button>
                        <a class="btn btn-link pull-left" href="{{ route('login') }}">
                            {{ __('Login Now?') }}
                        </a>
                        <a class="btn btn-link pull-right" href="{{ route('register') }}">
                            {{ __('Sign Up Now?') }}
                        </a>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
