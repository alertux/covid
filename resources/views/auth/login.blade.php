@extends('layouts.login')

@section('content')
<!-- begin::Page loader -->

<!-- end::Page Loader -->

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url({{ asset('assets/media/bg/bg-3.jpg')}});">
            <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                <div class="kt-login__container">
                    <div class="kt-login__logo">
                        <a href="#">
                            <img src="{{ asset('assets/img/COVID-19-1.png')}}">
                        </a>
                    </div>

                    <div class="kt-login__signin">
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">Registrarse</h3>
                        </div>

                        <!--begin::Options-->
                        <div class="kt-login__options">
                            <a href="#" class="btn btn-primary kt-btn">
                                <i class="fab fa-facebook-f"></i>
                                Facebook
                            </a>
                            <a href="#" class="btn btn-info kt-btn">
                                <i class="fab fa-twitter"></i>
                                Twitter
                            </a>
                            {{--<a href="#" class="btn btn-danger kt-btn">
                                <i class="fab fa-google"></i>
                                Google
                            </a>--}}
                        </div>
                        <!--end::Options-->

                        <!--begin::Divider-->
                        <div class="kt-login__divider">
                            <div class="kt-divider">
                                <span></span>
                                <span>O</span>
                                <span></span>
                            </div>
                        </div>
                        <!--end::Divider-->

                        <form class="kt-form" role="form" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off" value="{{ old('email') }}">
                            </div>
                            <div class="input-group">
                                <input class="form-control" type="password" placeholder="Password" name="password">
                            </div>
                            <div class="row kt-login__extra">
                                <div class="col">
                                    <label class="kt-checkbox">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ trans('auth.remember') }}
                                        <span></span>
                                    </label>
                                </div>
                                <div class="col kt-align-right">
                                    <a href="javascript:;" id="kt_login_forgot" class="kt-login__link">Contraseña olvidada ?</a>
                                </div>
                            </div>
                            <div class="kt-login__actions">
                                <button id="kt_login_signin_submit" class="btn btn-brand btn-elevate kt-login__btn-primary">Registrarse</button>
                            </div>
                        </form>
                    </div>
                    <div class="kt-login__forgot">
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">Contraseña olvidada ?</h3>
                            <div class="kt-login__desc">Ingrese su correo electrónico para restablecer su contraseña:</div>
                        </div>
                        <form class="kt-form" action="">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Email" name="email" id="kt_email" autocomplete="off">
                            </div>
                            <div class="kt-login__actions">
                                <button id="kt_login_forgot_submit" class="btn btn-brand btn-elevate kt-login__btn-primary">Request</button>&nbsp;&nbsp;
                                <button id="kt_login_forgot_cancel" class="btn btn-light btn-elevate kt-login__btn-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <div class="kt-login__account">
                        <span class="kt-login__account-msg">
                            ¿Aún no tienes una cuenta?
                        </span>
                        &nbsp;&nbsp;
                        <a href="{{route('register_win')}}" class="kt-login__account-link">¡Regístrate!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end:: Page -->
@endsection
