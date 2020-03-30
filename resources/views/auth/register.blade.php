@extends('layouts.login')

@section('content')

<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signup" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url({{ asset('assets/media/bg/bg-3.jpg')}});">
            <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                <div class="kt-login__container">
                    <div class="kt-login__logo">
                        <a href="#">
                            <img src="{{ asset('assets/media/logos/logo-5.png')}}">
                        </a>
                    </div>
                    <div class="kt-login__signup">
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">Regístrate</h3>
                            <div class="kt-login__desc">Ingrese sus datos para crear su cuenta:</div>
                        </div>
                        <form class="kt-form" method="post" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            @if ($errors->has('email'))
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <div class="alert-text">{{ $errors->first('email') }}</div>
                                    <div class="alert-close">
                                        <i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>
                                    </div>
                                </div>
                            @endif

                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="User Name" name="username" value="{{ old('username') }}" autofocus>
                            </div>
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Email" name="email" value="{{ old('email') }}" autocomplete="off">
                            </div>
                            <div class="input-group">
                                <input class="form-control" type="password" placeholder="Password" id="password" name="password" value="{{ old('password') }}">
                            </div>
                            <div class="input-group">
                                <input class="form-control" type="password" placeholder="Confirm Password" name="password_confirmation" value="{{ old('password_confirmation') }}">
                            </div>
                            <div class="input-group">
                                <input class="form-control" type="date" placeholder="Birthday" name="birthday" value="{{ old('birthday') }}">
                            </div>
                            <div class="row kt-login__extra">
                                <div class="col kt-align-left">
                                    <label class="kt-checkbox">
                                        <input type="checkbox" name="agree" {{ old('agree') ? 'checked' : '' }}>Acepto el <a href="#" class="kt-link kt-login__link kt-font-bold">términos y Condiciones</a>.
                                        <span></span>
                                    </label>
                                    <span class="form-text text-muted"></span>
                                </div>
                            </div>
                            <div class="kt-login__actions">
                                <button id="kt_login_signup_submit" class="btn btn-brand btn-elevate kt-login__btn-primary">Regístrate</button>&nbsp;&nbsp;
                                <button id="kt_login_signup_cancel" class="btn btn-light btn-elevate kt-login__btn-secondary">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
