@extends('layouts.app')

@section('content')
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                {{ $place->id == 0 ? 'Nueva' : 'Editar'  }} lugar
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form role="form" id="edit-place-form" method="post" enctype="multipart/form-data" class="kt-form kt-form--label-right" action="{{ route('places.update', $place->id) }}">
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
                <label for="visit_at" class="col-3 col-form-label">Fecha de visita</label>
                <div class="col-7">
                    <div class="input-group date">
                        <input type="text" class="form-control" readonly id="visit_at" name="visit_at" value="{{ old('visit_at', $place->visit_at) }}" />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="place_name" class="col-3 col-form-label">Lugar visitado</label>
                <div class="col-7">
                    <input type="text" class="form-control" id="place_name" name="place_name" value="{{ old('place_name', $place->place_name) }}" />
                </div>
            </div>
            <div class="form-group row">
                <label for="country" class="col-3 col-form-label">Municipio</label>
                <div class="col-7">
                    <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $place->country) }}" />
                </div>
            </div>
            <div class="form-group row">
                <label for="summary" class="col-3 col-form-label">Cuentanos que paso con tu visita</label>
                <div class="col-7">
                    <textarea class="form-control" id="summary" name="summary" style="height: 150px;">{{ old('summary', $place->summary) }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="persons" class="col-3 col-form-label">Menciona las personas con las que estuvistes</label>
                <div class="col-7">
                    <textarea type="text" class="form-control" id="persons" name="persons">{{ old('persons', $place->persons) }}</textarea>
                </div>
            </div>

        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row pull-right">
                    <div class="col-12" style="margin-bottom: 25px;">
                        <button type="submit" class="btn btn-brand btn-elevate">{{trans('global.save')}}</button>&nbsp;&nbsp;
                        <a href="{{route('places.index')}}" class="btn btn-secondary">{{trans('global.cancel')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--end::Form-->
</div>

@endsection

@section('additional_js')
    <script type="text/javascript" src="{{ asset('assets/js/pages/places.js') }}"></script>
@endsection