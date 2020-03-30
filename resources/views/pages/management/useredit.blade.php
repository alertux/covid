@extends('layouts.app')

@section('content')
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Edit User
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form role="form" id="create-user-form" method="post" class="kt-form kt-form--label-right" action="{{ route('users.update', $user_data['id']) }}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="kt-portlet__body">
            <!--
            <div class="form-group form-group-last kt-hide">
                <div class="alert alert-danger" role="alert" id="kt_form_1_msg">
                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                    <div class="alert-text">
                        Oh snap! Change a few things up and try submitting again.
                    </div>
                    <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="la la-close"></i></span>
                        </button>
                    </div>
                </div>
            </div>
            -->
            <div class="form-group row">
                <label for="first_name" class="col-2 col-form-label">{{trans('global.first_name')}} * </label>
                <div class="col-7">
                    <input type="text" id="first_name" autocomplete="off" name="first_name" value="{{ old('first_name', $user_data['first_name']) }}" class="form-control" />
                </div>
            </div>
            <div class="form-group row">
                <label for="sur_name" class="col-2 col-form-label">{{trans('global.sur_name')}} * </label>
                <div class="col-sm-7">
                    <input type="text" id="sur_name" autocomplete="off" name="sur_name" value="{{ old('first_name', $user_data['first_name']) }}" class="form-control" />
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-2 col-form-label">{{trans('global.email')}} * </label>
                <div class="col-sm-7">
                    <input type="text" id="email" autocomplete="off" name="email" value="{{ old('email', $user_data['email']) }}" class="form-control" />
                </div>
            </div>
            <div class="form-group row">
                <label for="username" class="col-2 col-form-label">{{trans('global.username')}} * </label>
                <div class="col-sm-7">
                    <input type="text" id="username" autocomplete="off" name="username" value="{{ old('username', $user_data['username']) }}" class="form-control" />
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-2 col-form-label">{{trans('global.password')}} * </label>
                <div class="col-sm-7">
                    <input type="password" id="password" autocomplete="off" name="password" value="" class="form-control" />
                </div>
            </div>
            <div class="form-group row">
                <label for="password_confirmation" class="col-2 col-form-label">{{trans('global.password_confirmation')}} * </label>
                <div class="col-sm-7">
                    <input type="password" id="password_confirmation" autocomplete="off" name="password_confirmation" value="" class="form-control" />
                </div>
            </div>
        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10">
                        <button type="submit" class="btn btn-brand btn-elevate">{{trans('global.save')}}</button>
                        <a href="{{route('users.index')}}" class="btn btn-secondary">{{trans('global.cancel')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--end::Form-->
</div>
@endsection

@section('additional_js')
<script type="text/javascript" src="{{ asset('assets/js/pages/users.js')}}"></script>
@endsection