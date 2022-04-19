@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Duyệt đăng ký</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Duyệt đăng ký</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Duyệt đăng ký</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Người mượn</th>
                                    <th>Phòng</th>
                                    <th>Ngày giờ mượn</th>
                                    <th>Trạng thái</th>
                                    <th style="width:79px">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- all type room --}}
                                @if ($all)
                                    @foreach ($all as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->ten_nguoi_dung }}</td>
                                            <td>{{ $item->ten_phong }}</td>
                                            <td>{{ $item->thoi_gian_bat_dau_muon }}-{{ $item->thoi_gian_ket_thuc_muon }} {{ $item->ngay_muon }}</td>
                                            <td>{{ $item->trang_thai == 1 ? 'Đang chờ duyệt' : ''}}{{ $item->trang_thai == 2 ? 'Mượn thành công' : ''}}{{ $item->trang_thai == 3 ? 'Hủy bởi người dùng' : ''}}{{ $item->trang_thai == 4 ? 'Hủy bởi người quản trị' : ''}}</td>
                                            <td>
                                                <a style="float: left" href="{{ route('infor_signup_borrow_room', ['id' => $item->ma]) }}" title="Thông tin mượn phòng" class="btn btn-info mr-1">
                                                    <i class="fas fa-info-circle"></i>
                                                </a> 
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
