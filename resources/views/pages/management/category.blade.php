@extends('layouts.app')

@section('content')
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Categoria LISTA
                <small>Datatable initialized from HTML table</small>
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    <div class="dropdown dropdown-inline">
                        <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="la la-download"></i> Export
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">
                                <li class="kt-nav__section kt-nav__section--first">
                                    <span class="kt-nav__section-text">Choose an option</span>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon la la-print"></i>
                                        <span class="kt-nav__link-text">Print</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon la la-copy"></i>
                                        <span class="kt-nav__link-text">Copy</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                        <span class="kt-nav__link-text">Excel</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon la la-file-text-o"></i>
                                        <span class="kt-nav__link-text">CSV</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                        <span class="kt-nav__link-text">PDF</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    &nbsp;
                    <a href="{{ route('category.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-plus"></i>
                        New
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet__body" style="padding-bottom: 0;">
        <!--begin: Search Form -->
        <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
            <div class="row align-items-center">
                <div class="col-xl-8 order-2 order-xl-1">
                    <div class="row align-items-center">
                        <div class="col-md-6 kt-margin-b-20-tablet-and-mobile">
                            <div class="kt-input-icon kt-input-icon--left">
                                <input type="text" class="form-control" placeholder="Search..." value="{{ $category_name }}" name="category_name" id="category_name">
                                <span class="kt-input-icon__icon kt-input-icon__icon--left"><span><i class="la la-search"></i></span></span>
                            </div>
                        </div>
                        <!--
                        <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                            <div class="kt-form__group kt-form__group--inline">
                                <div class="kt-form__label">
                                    <label>Status:</label>
                                </div>
                                <div class="kt-form__control">
                                    <select class="form-control bootstrap-select" id="kt_form_status">
                                        <option value="">All</option>
                                        <option value="1">Pending</option>
                                        <option value="2">Delivered</option>
                                        <option value="3">Canceled</option>
                                        <option value="4">Success</option>
                                        <option value="5">Info</option>
                                        <option value="6">Danger</option>
                                    </select>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                    <a data-href="{{ route('category.index') }}" id="filter_btn" class="btn btn-default">
                        <i class="la la-search"></i> Search
                    </a>
                </div>
            </div>
        </div>
        <!--end: Search Form -->
    </div>
    <div class="kt-portlet__space-x">
        <!--begin: Datatable -->
        <table class="table table-striped table-bordered table-hover" id="category_table">
            <thead>
            <tr>
                <th width="30">#</th>
                <th width="25%;">Nombre</th>
                <th width="40%;">Descripcion</th>
                <th width="15%;">Created</th>
                <th width="15%;"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($category as $i => $cat)
                <tr value="{{$cat->id}}">
                    <td>{{ ($category->currentPage() - 1) * $category->perPage() + $i + 1 }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->description }}</td>
                    <td>{{ $cat->created_at }}</td>
                    <td>
                        <a href="{{ route('category.edit', ['category_id' => $cat->id]) }}" class="btn btn-sm btn-brand btn-success btn-icon btn-icon-md" title="View"><i class="la la-edit"></i></a>&nbsp;
                        <a class="btn btn-sm btn-brand btn-danger btn-icon btn-icon-md delete-data" data-href="{{ route('category.destroy', ['category_id' => $cat->id]) }}"  data-toggle="modal" href="#delete-data-modal" ><i class="la la-trash"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="kt-portlet__space-x" >
        {{ $category->appends(request()->query())->links() }}
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
                    <h5 class="modal-title" id="exampleModalLabel">Category Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <p>The Category will be deleted and all Category's detail and info will be also deleted, are you sure?</p>
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
    <script type="text/javascript" src="{{ asset('assets/js/pages/category.js') }}"></script>
@endsection