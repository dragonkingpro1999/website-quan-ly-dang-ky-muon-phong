@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Thêm năm học</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('school_year') }}">Năm học</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm năm học</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Thêm năm học</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('insert_school_year') }}" id="form-add-school-year">
                            @csrf
                            <div class="form-group">
                                <label for="nam_dau">Năm đầu (<span class="text-red">*</span>): </label>
                                <input type="number" class="form-control" name="nam_dau" min="1975" id="nam_dau">
                                <div class="form-message" id="clear_nam_dau"></div>
                            </div>
                            
                            <div class="form-group">
                                <label for="nam_sau">Năm sau (<span class="text-red">*</span>): </label>
                                <input type="number" class="form-control" name="nam_sau" min="1975" id="nam_sau">
                                <div class="form-message" id="clear_nam_sau"></div>
                            </div>

                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->
    </div>
    <!---Container Fluid-->
@endsection
