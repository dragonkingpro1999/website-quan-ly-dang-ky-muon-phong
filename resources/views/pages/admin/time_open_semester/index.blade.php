@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tất cả thời gian mở học kỳ</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tất cả thời gian mở học kỳ</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tất cả thời gian mở học kỳ</h6>
                        <a href="{{ route('add_time_open_semester') }}" title="Thêm mới" class="btn btn-success">
                            <i class="fas fa-plus-circle"></i>
                        </a>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Năm học</th>
                                    <th>Học kỳ</th>
                                    <th>TG mở HK</th>
                                    <th>Ngày tạo</th>
                                    <th>Ngày cập nhật</th>
                                    <th style="width:90px">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- all type room --}}
                                @if ($all)
                                    @foreach ($all as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->nam_dau }} - {{ $item->nam_sau }}</td>
                                            <td>{{ $item->ten_hoc_ky }}</td>
                                            <td>{{ $item->thoi_gian_bat_dau }} <br> {{ $item->thoi_gian_ket_thuc }}</td>
                                            <td>{{ $item->ngay_tao }}</td>
                                            <td>@if($ngay_cap_nhat = $item->ngay_cap_nhat) {{ $ngay_cap_nhat }} @else Chưa cập nhật @endif</td>
                                            <td align="center">
                                                <form method="POST" action="{{ route('delete_time_open_semester') }}">
                                                    @csrf
                                                <a href="{{ route('edit_time_open_semester', ['id' => $item->ma]) }}" title="Cập nhật & Xem chi tiết" class="btn btn-info mb-1">
                                                    <i class="fas fa-pencil-alt fix-size-far"></i>
                                                </a>
                                                <a title="Xóa">
                                                    <input type="hidden" name="id" value="{{ $item->ma }}">
                                                    <button class="btn btn-danger mb-1" onclick="return confirm('Bạn có thật sự muốn xóa không?')" type="submit"><i class="fas fa-trash-alt fix-size-far"></i></button>
                                                     
                                                </a>
                                                </form>
                                                    <a href="{{ route('change_status_time_open_semester', ['id' => $item->ma]) }}">
                                                        @if ($item->trang_thai)
                                                            <button class="btn btn-success fix-size-btn" title="Chuyển sang đóng đăng ký"><i class="fas fa-check fix-size-far"></i></button>
                                                        @else
                                                            <button class="btn btn-dark fix-size-btn" title="Chuyển sang mở đăng ký"><i class="fas fa-check fix-size-far"></i></button>
                                                        @endif 
                                                    </a>
                                                    @if ($item->mac_dinh)
                                                        <button class="btn btn-success fix-size-btn" title="Đang làm mặc định"><i class="far fa-star fix-size-far"></i></button>
                                                    @else
                                                        <a href="{{ route('change_default_time_open_semester', ['id' => $item->ma]) }}">
                                                            <button class="btn btn-dark fix-size-btn" title="Đặt làm mặc định"><i class="far fa-star fix-size-far"></i></button>
                                                        </a>
                                                    @endif 

                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->
    </div>
    <!---Container Fluid-->
@endsection
