@extends('layouts.app')

@section('content')

<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Show User
            </h3>
        </div>
    </div>
    <form class="kt-form kt-form--label-right" action="{{ route('users.index') }}">
        <div class="kt-portlet__body">
            <div class="form-group row">
                <label for="first_name" class="col-2 col-form-label">{{trans('global.first_name')}} : </label>
                <div class="col-7">
                    <label class="col-sm-3 col-form-label text-left">{{ $user_data['first_name'] }}</label>
                </div>
            </div>
            <div class="form-group row">
                <label for="first_name" class="col-2 col-form-label">{{trans('global.sur_name')}} : </label>
                <div class="col-7">
                    <label class="col-sm-3 col-form-label text-left">{{ $user_data['sur_name'] }}</label>
                </div>
            </div>
            <div class="form-group row">
                <label for="first_name" class="col-2 col-form-label">{{trans('global.email')}} : </label>
                <div class="col-7">
                    <label class="col-sm-3 col-form-label text-left">{{ $user_data['email'] }}</label>
                </div>
            </div>
            <div class="form-group row">
                <label for="first_name" class="col-2 col-form-label">{{trans('global.username')}} : </label>
                <div class="col-7">
                    <label class="col-sm-3 col-form-label text-left">{{ $user_data['username'] }}</label>
                </div>
            </div>
        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-10">
                        <button type="submit" class="btn btn-brand btn-elevate">Ok</button>
                        <a href="{{route('users.edit', $user_data['id'])}}" class="btn btn-secondary">{{trans('global.edit')}}</a>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
@endsection

@section('additional_js')
<script type="text/javascript" src="{{ asset('assets/js/users.js')}}"></script>
@endsection