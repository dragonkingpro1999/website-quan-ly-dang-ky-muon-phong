@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tất cả phản hồi phòng</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tất cả phản hồi phòng</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tất cả phản hồi phòng</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Người dùng</th>
                                    <th>Phòng</th>
                                    <th>Nội dung</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th>Ngày cập nhật</th>
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
                                            <td>{{ $item->noi_dung }}</td>
                                            <td>{{ $item->da_xu_ly == 1 ? 'Đang chờ xử lý' : '' }} {{ $item->da_xu_ly == 2 ? 'Đã xử lý' : '' }} {{ $item->da_xu_ly == 3 ? 'Không cần xử lý':'' }}</td>
                                            <td>{{ $item->ngay_tao }}</td>
                                            <td>@if($ngay_cap_nhat = $item->ngay_cap_nhat) {{ $ngay_cap_nhat }} @else Chưa cập nhật @endif</td>
                                            <td>
                                                <a style="float: left" href="{{ route('edit_feed_back', ['id' => $item->ma]) }}" title="Trả lời" 
                                                    class="btn btn-{{ $item->da_xu_ly == 1 ? 'info' : 'success' }} mr-1">
                                                    <i class="fas fa-reply"></i>
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
