@extends('layouts.app')

@section('content')
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Edit Categoria
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form role="form" id="edit-category-form" method="post" enctype="multipart/form-data" class="kt-form kt-form--label-right" action="{{ route('category.update', $cat->id) }}">
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
                <label for="category_name" class="col-2 col-form-label">Nombre * </label>
                <div class="col-7">
                    <input type="text" id="category_name" autocomplete="off" name="category_name" value="{{ old('category_name', $cat->name) }}" class="form-control" />
                </div>
            </div>
            <div class="form-group row">
                <label for="category_desc" class="col-2 col-form-label">Descripcion * </label>
                <div class="col-sm-7">
                    <input type="text" id="category_desc" autocomplete="off" name="category_desc" value="{{ old('category_desc', $cat->description) }}" class="form-control" />
                </div>
            </div>
            <div class="form-group row">
                <label for="category_image" class="col-2 col-form-label">Imagen</label>
                <div class="col-sm-7">
                    <img src="{{ asset(old('category_image', $cat->image)) }}" class="img-responsive" style="display:{{ ($cat->image) ? ('') : ('none') }};"/>
                    <input type="file" name="category_image" id="category_image" class="form-control" />
                </div>
            </div>
        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-10">
                        <button type="submit" class="btn btn-brand btn-elevate">{{trans('global.save')}}</button>
                        <a href="{{route('category.index')}}" class="btn btn-secondary">{{trans('global.cancel')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--end::Form-->
</div>

@endsection

@section('additional_js')
    <script type="text/javascript" src="{{ asset('assets/js/pages/category.js') }}"></script>
@endsection