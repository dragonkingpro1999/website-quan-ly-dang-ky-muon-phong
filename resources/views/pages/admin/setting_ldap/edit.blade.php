@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cài đặt ldap</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cài đặt ldap</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Cài đặt ldap</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update_setting_ldap') }}" id="form-edit-setting_ldap">
                            @csrf
                            <input type="hidden" name="ma" value="{{ $edit->ma }}">
                            
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="hosts">Hosts (<span class="text-red">*</span>): </label>
                                    <input type="text" class="form-control" name="hosts" id="hosts" value="{{ $edit->hosts }}">
                                    <div class="form-message"></div>
                                </div>
                                
                                <div class="form-group col-lg-6">
                                    <label for="port">Port (<span class="text-red">*</span>): </label>
                                    <input type="number" class="form-control" min="0" name="port" id="port" value="{{ $edit->port }}">
                                    <div class="form-message"></div>
                                </div>
    
                                <div class="form-group col-lg-6">
                                    <label for="use_ssl">Use Ssl</label>
                                    <select class="form-control" name="use_ssl" id="use_ssl">
                                        @if ($edit->use_ssl == true)
                                            <option value="1" selected>True</option>
                                            <option value="0">False</option>
                                        @else
                                            <option value="1">True</option>
                                            <option value="0" selected>False</option>
                                        @endif
                                    </select>
                                    <div class="form-message"></div>
                                </div>
                                
                                <div class="form-group col-lg-6">
                                    <label for="use_tls">Use Tls</label>
                                    <select class="form-control" name="use_tls" id="use_tls">
                                        @if ($edit->use_tls == true)
                                            <option value="1" selected>True</option>
                                            <option value="0">False</option>
                                        @else
                                            <option value="1">True</option>
                                            <option value="0" selected>False</option>
                                        @endif
                                    </select>
                                    <div class="form-message"></div>
                                </div>
    
                                <div class="form-group col-lg-6">
                                    <label for="version">Version (<span class="text-red">*</span>): </label>
                                    <input type="number" class="form-control" min="0" name="version" id="version" value="{{ $edit->version }}">
                                    <div class="form-message"></div>
                                </div>
    
                                <div class="form-group col-lg-6">
                                    <label for="timeout">Timeout (<span class="text-red">*</span>): </label>
                                    <input type="number" class="form-control" min="0" name="timeout" id="timeout" value="{{ $edit->timeout }}">
                                    <div class="form-message"></div>
                                </div>
    
                                <div class="form-group col-lg-6">
                                    <label for="follow_referrals">Follow Referrals</label>
                                    <select class="form-control" name="follow_referrals" id="follow_referrals">
                                        @if ($edit->follow_referrals == true)
                                            <option value="1" selected>True</option>
                                            <option value="0">False</option>
                                        @else
                                            <option value="1">True</option>
                                            <option value="0" selected>False</option>
                                        @endif
                                    </select>
                                    <div class="form-message"></div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->
    </div>
    <!---Container Fluid-->
@endsection

