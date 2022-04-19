@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cập nhật đơn vị</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('unit') }}">Tất cả đơn vị</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cập nhật đơn vị</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Cập nhật đơn vị</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update_unit') }}" id="form-edit-unit">
                            @csrf
                            <input type="hidden" name="ma" value="{{ $edit->ma }}">
                            <div class="form-group">
                                <label for="ten">Tên (<span class="text-red">*</span>): </label>
                                <input type="text" class="form-control" name="ten" id="ten" value="{{ $edit->ten }}" placeholder="Nhập tên ...">
                                <div class="form-message"></div>
                            </div>
                            
                            <div class="form-group">
                                <label for="mo_ta">Mô tả:</label>
                                <textarea class="form-control" name="mo_ta" id="mo_ta" rows="3" placeholder="Nhập mô tả ...">{{ $edit->mo_ta }}</textarea>
                                <div class="form-message"></div>
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
