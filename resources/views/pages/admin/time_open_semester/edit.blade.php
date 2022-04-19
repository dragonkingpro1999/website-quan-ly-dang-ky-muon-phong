@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cập nhật thời gian mở học kỳ</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('time_open_semester') }}">Thời gian mở học kỳ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cập nhật thời gian mở học kỳ</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Cập nhật thời gian mở học kỳ</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update_time_open_semester') }}" id="form-edit-time-open-semester">
                            @csrf
                            
                            <input type="hidden" name="ma" id="ma" value="{{ $edit->ma }}">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="ma_nam_hoc">Năm học (<span class="text-red">*</span>):</label>
                                    <select class="form-control"  name="ma_nam_hoc" id="ma_nam_hoc">
                                        <option value="">Chọn năm học</option>

                                        @foreach ($school_year as $key => $item)
                                            @if ($edit->ma_nam_hoc == $item->ma)
                                                <option selected value="{{ $item->ma }}">{{ $item->nam_dau }} - {{ $item->nam_sau }}</option>
                                                
                                            @else
                                                <option value="{{ $item->ma }}">{{ $item->nam_dau }} - {{ $item->nam_sau }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                    <div class="form-message"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="ma_hoc_ky">Học kỳ (<span class="text-red">*</span>):</label>
                                    <select class="form-control"  name="ma_hoc_ky" id="ma_hoc_ky">
                                        <option value="">Chọn học kỳ</option>

                                        @foreach ($semester as $key => $item)
                                            @if ($edit->ma_hoc_ky == $item->ma)
                                                <option selected value="{{ $item->ma }}">{{ $item->ten }} - {{ $item->mo_ta }}</option>
                                            @else
                                                <option value="{{ $item->ma }}">{{ $item->ten }} - {{ $item->mo_ta }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                    <div class="form-message clear-ma-hoc-ky"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="thoi_gian_bat_dau">Ngày bắt đầu (<span class="text-red">*</span>): </label>
                                    <input type="date" class="form-control" name="thoi_gian_bat_dau" id="thoi_gian_bat_dau" value="{{ $edit->thoi_gian_bat_dau }}">
                                    <div class="form-message"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="thoi_gian_ket_thuc">Ngày kết thúc (<span class="text-red">*</span>): </label>
                                    <input type="date" class="form-control" name="thoi_gian_ket_thuc" id="thoi_gian_ket_thuc" value="{{ $edit->thoi_gian_ket_thuc }}">
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
