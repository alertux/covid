@extends('layouts.app')

@section('content')

<!--Products list-->
<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-database"></i>
            NOTA DE CREDITO LISTA
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-toolbar no-margin margin-top-10 margin-bottom-10">
            <div class="row">
                <div class="col-md-10">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="text" name="productcode" autocomplete="off" id="productcode" value="{{ $search_text }}" class="form-control" placeholder="Buscar en nombre de factura o nombre de cliente"/>
                                </div>
                            </div>
                            <div class="col-md-5">

                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <a class="btn blue add-data display-block" data-href="{{ route($page_url) }}" id="filter_btn" ><i class="fa fa-search"></i> Buscar </a>
                                </div>
                            </div>			
                        </div>    
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th width="20">#</th>
                    <th>Num. CREDITO </th>
                    <th>Estado</th>
                    <th>Num. Referencia</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Moneda</th>
                    <th>Cliente</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($notes as $i => $note)
                <tr>
                    <td>{{ ($pageObj->page - 1) * 15 + $i + 1 }}</td>
                    <td>{{ $note->creditnote_number }}</td>
                    <td>{{ $note->status }}</td>
                    <td>{{ $note->reference_number }}</td>
                    <td>{{ $note->date }}</td>
                    <td>{{ $note->total }}</td>
                    <td>{{ $note->currency_code }}</td>
                    <td>{{ $note->customer_name }}</td>
                    <td>
                        <a href="{{ route( ($page_type=='print') ? ('credit.edit') : ('validation.show') , ['creditnote_id' => $note->creditnote_id]) }}" class="btn btn-icon-only blue"><i class="fa fa-print"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if( $pageObj != null )
            @include("pages/partials/pagination")
        @endif
    </div>
</div>
@endsection


@section('additional_js')
    <script type="text/javascript" src="{{ asset('assets/js/credit.js')}}"></script>
@endsection