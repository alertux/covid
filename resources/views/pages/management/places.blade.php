@extends('layouts.app')

@section('content')
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <a href="{{ route('dashboard') }} " class="btn btn-brand btn-elevate btn-icon"><i class="la la-bank"></i></a>
        </div>
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Lugares
                <small>Lugares que he visitado o viajado</small>
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    <a href="{{ route('places.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-plus"></i>
                        Visitar
                    </a>
                    <a href="{{ route('trip.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-plus"></i>
                        Viaje
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet__body" style="padding-bottom: 0;">
        <!--begin: Search Form -->
        <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
            <div class="row align-items-center">
                <div class="col-8">
                    <div class="col-md-6 pull-right">
                        {{--<div class="kt-input-icon kt-input-icon--left">
                            <input type="text" class="form-control" readonly placeholder="Search..." value="{{ $visit_at }}" name="visit_at" id="visit_at">
                            <span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-search"></i></span></span>
                        </div>--}}
                        <div class="input-group date">
                            <input type="text" class="form-control" readonly id="visit_at" name="visit_at" value="{{ $visit_at }}" />
                            <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <a data-href="{{ route('places.index') }}" id="filter_btn" class="btn btn-default">
                        <i class="la la-search"></i> Buscar
                    </a>
                </div>
            </div>
        </div>
        <!--end: Search Form -->
    </div>
    <div class="kt-portlet__space-x">
        <!--begin: Datatable -->
        <table class="table table-striped table-bordered table-hover" id="places_table">
            <thead>
            <tr>
                <th width="30">#</th>
                <th width="25%;">Lugar</th>
                <th width="20%;">motivo</th>
                <th width="15%;">Municipio</th>
                <th width="15%;">Personas</th>
                <th width="15%;"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($places as $i => $place)
                <tr value="{{$place->id}}">
                    <td>{{ ($places->currentPage() - 1) * $places->perPage() + $i + 1 }}</td>
                    <td>{{ $place->place_name }}</td>
                    <td>{{ $place->country }}</td>
                    <td>{{ $place->summary }}</td>
                    <td>{{ $place->persons }}</td>
                    <td>
                        <a href="{{ route('places.edit', ['place_id' => $place->id]) }}" class="btn btn-sm btn-brand btn-success btn-icon btn-icon-md" title="View"><i class="la la-edit"></i></a>&nbsp;
                        <a class="btn btn-sm btn-brand btn-danger btn-icon btn-icon-md delete-data" data-href="{{ route('places.destroy', ['place_id' => $place->id]) }}"  data-toggle="modal" href="#delete-data-modal" ><i class="la la-trash"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="kt-portlet__space-x" >
        {{ $places->appends(request()->query())->links() }}
    </div>
    <br>
    <!--Delete dialog-->
    <div class="modal fade" id="delete-data-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="#" id="delete-data-form" class="inline del-option-form">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <p>El lugar será eliminado, ¿estás segura?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-brand btn-elevate">{{ trans('global.delete') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('global.cancel') }}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('additional_js')
    <script type="text/javascript" src="{{ asset('assets/js/pages/places.js') }}"></script>
@endsection