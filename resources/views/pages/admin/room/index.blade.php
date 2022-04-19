@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tất cả phòng</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tất cả phòng</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tất cả phòng</h6>
                        <a href="{{ route('add_room') }}" title="Thêm mới" class="btn btn-success">
                            <i class="fas fa-plus-circle"></i>
                        </a>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Ảnh</th>
                                    <th>Loại phòng</th>
                                    <th>Sức chứa</th>
                                    <th>Mô tả</th>
                                    <th>Tình trạng</th>
                                    {{-- <th>Ngày tạo</th>
                                    <th>Ngày cập nhật</th> --}}
                                    <th style="width:146px">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- all type room --}}
                                @if ($all)
                                    @foreach ($all as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->ten }}</td>
                                            @if ($item->hinh_anh != "")
                                                @php
                                                $anh = "admin/img/img_room/". $item->hinh_anh
                                                @endphp
                                                <td><img src="{{ asset($anh)}} " alt="" width="70px"></td>
                                            @else
                                            <td>Chưa có ảnh</td>
                                            @endif
                                            <td>{{ $item->ten_loai_phong }}</td>
                                            <td>{{ $item->suc_chua }}</td>
                                            <td>{{ $item->mo_ta }}</td>
                                            <td class="text-center">
                                                @if ($item->trang_thai)
                                                    <span class="text-success">Tốt</span>
                                                @else
                                                    <span class="text-danger">Đang sửa chữa</span>
                                                @endif
                                                <br>
                                                @if ($item->hien_thi)
                                                    <span class="text-success">Hiển thị</span>
                                                @else
                                                    <span class="text-danger">Ẩn</span>
                                                @endif
                                            </td>
                                            {{-- <td>{{ $item->ngay_tao }}</td>
                                            <td>@if($ngay_cap_nhat = $item->ngay_cap_nhat) {{ $ngay_cap_nhat }} @else Chưa cập nhật @endif</td> --}}
                                            <td>
                                                <form method="POST" action="{{ route('delete_room') }}">
                                                    @csrf
                                                <a style="float: left" href="{{ route('edit_room', ['id' => $item->ma]) }}" title="Cập nhật & Xem chi tiết" class="btn btn-info mr-1">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a style="float: left" title="Xóa">
                                                    <input type="hidden" name="id" value="{{ $item->ma }}">
                                                    <button class="btn btn-danger mr-1" onclick="return confirm('Bạn có thật sự muốn xóa không?')" type="submit"><i class="fas fa-trash-alt"></i></button>
                                                </a>
                                                <div class="btn-group">
                                                    <button title="Quản lý" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      <i class="fas fa-cogs"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                      <a class="dropdown-item" title="Quản lý chức năng phòng" href="{{ route('uses_room', ['id' => $item->ma]) }}">Chức năng</a>
                                                      <a class="dropdown-item" title="Quản lý thiết bị phòng" href="{{ route('device_room', ['id' => $item->ma]) }}">Thiết bị</a>
                                                      {{-- <a class="dropdown-item" title="Quản lý quyền phòng" href="{{ route('role_room', ['id' => $item->ma]) }}">Quyền phòng</a> --}}
                                                    </div>
                                                </div> 
                                                </form>
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
