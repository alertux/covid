@extends('layouts.app')

@section('content')
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                {{ $report->id == 0 ? 'Nueva' : 'Editar'  }} Alertar
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form role="form" id="edit-report-form" method="post" enctype="multipart/form-data" class="kt-form kt-form--label-right" action="{{ route('report.update', $report->id) }}">
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
                <label for="report_at" class="col-3 col-form-label">Alerta Fecha</label>
                <div class="col-7">
                    <div class="input-group date">
                        <input type="text" class="form-control" readonly id="report_at" name="report_at" value="{{ old('report_at', $report->report_at) }}" />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="complaint" class="col-3 col-form-label">Titulo de Alerta</label>
                <div class="col-7">
                    <input type="text" class="form-control" id="complaint" name="complaint" value="{{ old('complaint', $report->complaint) }}" />
                </div>
            </div>
            <div class="form-group row">
                <label for="other" class="col-3 col-form-label">Departamento</label>
                <div class="col-7">
                    <input type="text" class="form-control" id="other" name="other" value="{{ old('other', $report->other) }}" />
                </div>
            </div>
            <div class="form-group row">
                <label for="country" class="col-3 col-form-label">Municipio</label>
                <div class="col-7">
                    <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $report->country) }}" />
                </div>
            </div>
            <div class="form-group row">
                <label for="summary" class="col-3 col-form-label">Escribe tu Denuncia</label>
                <div class="col-7">
                    <textarea class="form-control" id="summary" name="summary" style="height: 150px;">{{ old('summary', $report->summary) }}</textarea>
                </div>
            </div>

        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row pull-right">
                    <div class="col-12" style="margin-bottom: 25px;">
                        <button type="submit" class="btn btn-brand btn-elevate">{{trans('global.save')}}</button>&nbsp;&nbsp;
                        <a href="{{route('report.index')}}" class="btn btn-secondary">{{trans('global.cancel')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--end::Form-->
</div>

@endsection

@section('additional_js')
    <script type="text/javascript" src="{{ asset('assets/js/pages/report.js') }}"></script>
@endsection