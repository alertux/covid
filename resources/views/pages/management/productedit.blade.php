@extends('layouts.app')

@section('content')
    
<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-plus"></i>
            Producto
        </div>                
    </div>
    <div class="portlet-body form">
        <form role="form" id="edit-product-form" method="post" enctype="multipart/form-data" class="form-horizontal" action="{{ route('product.update', $cat->id) }}">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="form-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Codigo<span class="required" aria-required="true">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" id="product_barcode" autocomplete="off" name="product_barcode" value="{{ old('product_barcode', $cat->barcode) }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Nombre<span class="required" aria-required="true">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" id="product_name" autocomplete="off" name="product_name" value="{{ old('product_name', $cat->name) }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Unidad<span class="required" aria-required="true">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" id="product_unit" autocomplete="off" name="product_unit" value="{{ old('product_unit', $cat->unit) }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Descripcion<span class="required" aria-required="true">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" id="product_desc" autocomplete="off" name="product_desc" value="{{ old('product_desc', $cat->description) }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Inventario<span class="required" aria-required="true">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" id="product_min" autocomplete="off" name="product_min" value="{{ old('product_min', $cat->inventary_min) }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Precio En($)<span class="required" aria-required="true">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" id="product_in" autocomplete="off" name="product_in" value="{{ old('product_in', $cat->price_in) }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Precio Fuera($)<span class="required" aria-required="true">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" id="product_out" autocomplete="off" name="product_out" value="{{ old('product_out', $cat->price_out) }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Presentacion<span class="required" aria-required="true">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" id="product_pre" autocomplete="off" name="product_pre" value="{{ old('product_pre', $cat->presentation) }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Categorio<span class="required" aria-required="true">*</span></label>
                            <div class="col-sm-7">
                                <select name="category" id="category" class="form-control" >
                                    @foreach ($category as $obj)
                                        <option value="{{ $obj->id }}" @if ( $cat->category_id == $obj->id ) selected @endif>{{ $obj->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Activo<span class="required" aria-required="true">*</span></label>
                            <div class="col-sm-7">
                                <select name="active" id="active" class="form-control" >
                                    <option value="1" @if ( $cat->is_active == 1 ) selected @endif>1</option>
                                    <option value="0" @if ( $cat->is_active == 0 ) selected @endif>0</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Imagen</label>
                            <div class="col-sm-6">
                                <img src="{{ asset(old('product_image', $cat->image)) }}" class="img-responsive" style="display:{{ ($cat->image) ? ('') : ('none') }};"/>
                                <input type="file" name="product_image" id="product_image" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-actions">
                <a href="{{route('product.index')}}" class="btn blue"> Cancelar </a>
                <input type="submit" name="submit" value=" Salvar " class="btn blue" />
            </div>
        </form>
    </div>
</div>
@endsection

@section('additional_js')
    <script type="text/javascript" src="{{ asset('assets/js/product.js') }}"></script>
@endsection