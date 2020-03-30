@extends('layouts.app')

@section('content')
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                Users
                <small> New, Edit and Delete a User</small>
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
                    <a data-href="{{ route('users.index') }}" class="btn btn-brand btn-elevate btn-icon-sm add-data" data-toggle="modal" href="#new-user-modal">
                        <i class="la la-plus"></i>
                        New
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet__body" style="padding-bottom: 0;"></div>
    <div class="kt-portlet__body">
        <!--begin: Datatable -->
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th width="30">#</th>
                <th>{{ trans('global.name') }}</th>
                <th>{{ trans('global.email') }}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $i => $userinfo)
                <tr>
                    <td>{{ ($users->currentPage() - 1) * $users->perPage() + $i + 1 }}</td>
                    <td><a href="{{ route('users.show', ['user' => $userinfo->id]) }}">{{ $userinfo->name }}</a> </td>
                    <td>{{ $userinfo->email }}</td>
                    <td>
                        <a href="{{ route('users.edit', ['user' => $userinfo->id]) }}" class="btn btn-sm btn-brand btn-success btn-icon btn-icon-md" title="View"><i class="la la-edit"></i></a>&nbsp;
                        <a class="btn btn-sm btn-brand btn-danger btn-icon btn-icon-md delete-data" data-href="{{ route('users.destroy', ['technician' => $userinfo->id]) }}"  data-toggle="modal" href="#delete-data-modal" ><i class="la la-trash"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="kt-portlet__space-x" >
        {{ $users->links() }}
    </div>


    <div id="new-user-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="create-user-form" method="post" class="inline del-option-form" action="{{ route('users.index') }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">User Create</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                <div class="modal-body">
                    {{ method_field('POST') }}
                    {{ csrf_field() }}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="form-group row">
                                    <label for="first_name" class="col-3 col-form-label">{{trans('global.first_name')}} * </label>
                                    <div class="col-sm-7">
                                        <input type="text" name="first_name" autocomplete="off" id="first_name" value="{{ old('first_name') }}" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">{{trans('global.sur_name')}}<span class="required" aria-required="true">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" name="sur_name" autocomplete="off" id="sur_name" value="{{ old('sur_name') }}" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{trans('global.email')}}<span class="required" aria-required="true">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" name="email" autocomplete="off" id="email" value="{{ old('email') }}" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{trans('global.username')}}<span class="required" aria-required="true">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" name="username" autocomplete="off" id="username" value="{{ old('username') }}" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{trans('global.password')}}<span class="required" aria-required="true">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="password" name="password" autocomplete="off" id="password" value="{{ old('password') }}" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{trans('global.password_confirmation')}}<span class="required" aria-required="true">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="password" autocomplete="off" name="password_confirmation" id="password_confirmation" value="" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-brand btn-elevate">{{ trans('global.save') }}</button>
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">{{ trans('global.cancel') }}</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--Delete dialog-->
    <div class="modal fade" id="delete-data-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="#" id="delete-data-form" class="inline del-option-form">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>The Technician will be deleted , are you sure?</p>
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
<script type="text/javascript" src="{{ asset('assets/js/pages/users.js')}}"></script>
@endsection