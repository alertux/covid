@extends('layouts.app')

@section('content')
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-database"></i>
                PRODUCTO LISTA
            </div>
            <div class="actions">
                <div class="col-md-1">
                <a class="btn blue" href="{{ route('product.create') }}">
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
                                        <input type="text" name="product_name" autocomplete="off" id="product_name" value="{{ $product_name }}" class="form-control" placeholder="Buscar en nombre del producto"/>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select name="category_id" id="category_id" class="form-control" >
                                            <option value="0"></option>
                                            @foreach ($category as $obj)
                                                <option value="{{ $obj->id }}" @if ( $cat_id == $obj->id ) selected @endif>{{ $obj->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <a class="btn blue add-data display-block" data-href="{{ route('product.index') }}" id="filter_btn" ><i class="fa fa-search"></i> Buscar </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-hover" id="product_table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Unidad</th>
                    <th>Categoria</th>
                    <th>Inventario</th>
                    <th>PrecioEn($)</th>
                    <th>PrecioFu($)</th>
                    <th>Activo</th>
                    <th>Creado en</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($product as $i => $obj)
                    <tr value="{{$obj->id}}">
                        <td>{{ ($product->currentPage() - 1) * $product->perPage() + $i + 1 }}</td>
                        <td>{{ $obj->barcode }}</td>
                        <td>{{ $obj->name }}</td>
                        <td>{{ $obj->description }}</td>
                        <td>{{ $obj->unit }}</td>
                        <td>{{ $obj->category_name }}</td>
                        <td>{{ $obj->inventary_min }}</td>
                        <td>{{ $obj->price_in }}</td>
                        <td>{{ $obj->price_out }}</td>
                        <td>{{ $obj->is_active }}</td>
                        <td>{{ $obj->created_at }}</td>
                        <td>
                            <a href="{{ route('product.edit', ['product_id' => $obj->id]) }}" class="btn btn-icon-only blue" title="Editar Producto"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-icon-only green fill-inventory" data-href="{{$i}}" title="Llenar Inventario"><i class="fa fa-inbox"></i></a>
                            <a class="btn btn-icon-only red delete-data" data-href="{{ route('product.destroy', ['product_id' => $obj->id]) }}"  data-toggle="modal" href="#delete-data-modal" ><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-5">
                    {{ $product->appends(request()->query())->links() }}
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
                        <h4 class="modal-title">Categoria Delete</h4>
                    </div>
                    <div class="modal-body">

                        The product will be deleted and all product's detail and info will be also deleted, are you sure?

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn red">Eliminar</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!--Inventory dialog-->
    <div class="modal fade  bs-modal-sm" id="inentory-data-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Llenar Inventario</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label">Codigo:</label>
                                    <div class="col-sm-7">
                                        <label class="control-label"><strong id="disp_code"></strong></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label">Nombre:</label>
                                    <div class="col-sm-7">
                                        <label class="control-label"><strong id="disp_name"></strong></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label">Inventario:</label>
                                    <div class="col-sm-7">
                                        <label class="control-label"><strong id="disp_inventory"></strong></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label">Rellenar:</label>
                                    <div class="col-sm-7">
                                        <input type="text" id="fill_inventory" autocomplete="off" value="" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="product_id" value=""/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Cancelar</button>
                        <button type="button" id="btn_fill_inventory" class="btn blue">Salvar</button>
                    </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection


@section('additional_js')
    <script type="text/javascript" src="{{ asset('assets/js/product.js') }}"></script>
@endsection