@extends('layouts.app')

@section('content')
    
<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-plus"></i>
            Cliente
        </div>                
    </div>
    <div class="portlet-body form">
        <form role="form" id="edit-customer-form" method="post" class="form-horizontal" action="{{ route('customer.update', $cat->id) }}">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="form-body">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Nombre<span class="required" aria-required="true">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" id="name" autocomplete="off" name="name" value="{{ old('name', $cat->name) }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Direccion</label>
                            <div class="col-sm-7">
                                <input type="text" id="address" autocomplete="off" name="address" value="{{ old('address', $cat->address) }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Municipio</label>
                            <div class="col-sm-7">
                                <input type="text" id="city" autocomplete="off" name="city" value="{{ old('city', $cat->city) }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Departamento</label>
                            <div class="col-sm-7">
                                <input type="text" id="department" autocomplete="off" name="department" value="{{ old('department', $cat->department) }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Empresa</label>
                            <div class="col-sm-7">
                                <input type="text" id="company_name" autocomplete="off" name="company_name" value="{{ old('company_name', $cat->company_name) }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-7">
                                <input type="text" id="email" autocomplete="off" name="email" value="{{ old('email', $cat->email) }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Telefono</label>
                            <div class="col-sm-7">
                                <input type="text" id="phone" autocomplete="off" name="phone" value="{{ old('phone', $cat->phone) }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">Fax</label>
                            <div class="col-sm-7">
                                <input type="text" id="fax" autocomplete="off" name="fax" value="{{ old('fax', $cat->fax) }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">NIT</label>
                            <div class="col-sm-7">
                                <input type="text" id="nit" autocomplete="off" name="nit" value="{{ old('nit', $cat->nit) }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">DUI</label>
                            <div class="col-sm-7">
                                <input type="text" id="dui" autocomplete="off" name="dui" value="{{ old('dui', $cat->dui) }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">GIRO</label>
                            <div class="col-sm-7">
                                <input type="text" id="giro" autocomplete="off" name="giro" value="{{ old('giro', $cat->giro) }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label">NRC</label>
                            <div class="col-sm-7">
                                <input type="text" id="nrc" autocomplete="off" name="nrc" value="{{ old('nrc', $cat->nrc) }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <a href="{{route('customer.index')}}" class="btn blue">Cancelar</a>
                <input type="button" id="btnSubmit" value="Salvar" class="btn blue" />
            </div>
        </form>
    </div>
</div>
@endsection

@section('additional_js')
    <script type="text/javascript" src="{{ asset('assets/js/customer.js') }}"></script>
@endsection