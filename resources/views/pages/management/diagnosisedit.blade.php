@extends('layouts.app')

@section('content')
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                {{ $diagnosis->id == 0 ? 'Nueva' : 'Nueva'  }} Diagnosis
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form role="form" id="edit-contact-form" method="post" enctype="multipart/form-data" class="kt-form kt-form--label-right" action="{{ route('diagnosis.update', $diagnosis->id) }}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="kt-portlet__body">
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
            <div class="form-group row">
                <label for="check_at" class="col-3 col-form-label">Check date</label>
                <div class="col-7">
                    <div class="input-group date">
                        <input type="text" class="form-control" readonly id="check_at" name="check_at" value="{{ old('check_at', $diagnosis->check_at) }}" />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-3 col-form-label">Orden</label>
                <div class="col-7">
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $diagnosis->name) }}" />
                </div>
            </div>
            <div class="form-group row">
                <label for="state" class="col-3 col-form-label">Estado</label>
                <div class="col-7">
                    <input type="text" class="form-control" id="state" name="state" value="{{ old('state', $diagnosis->state) }}" />
                </div>
            </div>
            <div class="form-group row">
                <label for="path" class="col-3 col-form-label">Adjuntar</label>
                <div class="col-7">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="path" name="path" />
                        <label class="custom-file-label" for="path" style="text-align: left">{{ old('path', $diagnosis->path) }}</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="url" class="col-3 col-form-label">URL</label>
                <div class="col-7">
                    <input type="text" class="form-control" id="url" name="url" value="{{ old('url', $diagnosis->url) }}" />
                </div>
            </div>
            <div class="form-group row">
                <label for="detail" class="col-3 col-form-label">Informacion</label>
                <div class="col-7">
                    <textarea class="form-control" id="detail" name="detail" style="height: 150px;">{{ old('detail', $diagnosis->detail) }}</textarea>
                </div>
            </div>

        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row pull-right">
                    <div class="col-12" style="margin-bottom: 25px;">
                        <button type="submit" class="btn btn-brand btn-elevate">{{trans('global.save')}}</button>&nbsp;&nbsp;
                        <a href="{{route('diagnosis.index')}}" class="btn btn-secondary">{{trans('global.cancel')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--end::Form-->
</div>

@endsection

@section('additional_js')
    <script type="text/javascript" src="{{ asset('assets/js/pages/diagnosis.js') }}"></script>
@endsection