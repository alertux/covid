@extends('layouts.app')

@section('content')
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-database"></i>
                CLIENTE LISTA
            </div>
            <div class="actions">
                <div class="col-md-1">
                <a class="btn blue" href="{{ route('customer.create') }}">
                    <i class="fa fa-plus"></i> Nueva
                </a>
                </div>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-toolbar no-margin margin-top-10 margin-bottom-10">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="customer_name" autocomplete="off" id="customer_name" value="{{ $customer_name }}" class="form-control" placeholder="Buscar en nombre del cliente"/>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <a class="btn blue add-data display-block" data-href="{{ route('customer.index') }}" id="filter_btn" ><i class="fa fa-search"></i> Buscar </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-hover" id="customer_table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Municipio</th>
                    <th>Departamento</th>
                    <th>Empresa</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Fax</th>
                    <th>NIT</th>
                    <th>DUI</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($customer as $i => $obj)
                    <tr value="{{$obj->id}}">
                        <td>{{ ($customer->currentPage() - 1) * $customer->perPage() + $i + 1 }}</td>
                        <td>{{ $obj->name }}</td>
                        <td>{{ $obj->address }}</td>
                        <td>{{ $obj->city }}</td>
                        <td>{{ $obj->department }}</td>
                        <td>{{ $obj->company_name }}</td>
                        <td>{{ $obj->email }}</td>
                        <td>{{ $obj->phone }}</td>
                        <td>{{ $obj->fax }}</td>
                        <td>{{ $obj->nit }}</td>
                        <td>{{ $obj->dui }}</td>
                        <td>
                            <a href="{{ route('customer.edit', ['customer_id' => $obj->id]) }}" class="btn btn-icon-only blue"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-icon-only red delete-data" data-href="{{ route('customer.destroy', ['customer_id' => $obj->id]) }}"  data-toggle="modal" href="#delete-data-modal" ><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-5">
                    {{ $customer->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
    <!--Delete dialog-->
    <div class="modal fade  bs-modal-sm" id="delete-data-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="post" action="#" id="delete-data-form" class="inline del-option-form">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Cliente Delete</h4>
                    </div>
                    <div class="modal-body">

                        The customer will be deleted and all customer's detail and info will be also deleted, are you sure?

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">{{ trans('global.cancel') }}</button>
                        <button type="submit" class="btn red">{{ trans('global.delete') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection


@section('additional_js')
    <script type="text/javascript" src="{{ asset('assets/js/customer.js') }}"></script>
@endsection