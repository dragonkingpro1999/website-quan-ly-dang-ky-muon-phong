@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tất cả tài khoản</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tất cả tài khoản</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tất cả tài khoản</h6>
                        <a href="{{ route('add_manager_user') }}" title="Thêm mới" class="btn btn-success">
                            <i class="fas fa-plus-circle"></i>
                        </a>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Tài khoản</th>
                                    <th>Tên</th>
                                    <th>Vai trò</th>
                                    <th>Đơn vị</th>
                                    <th>Ngày tạo</th>
                                    <th>Ngày cập nhật</th>
                                    <th style="width:146px">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- all type room --}}
                                @if ($all)
                                    @foreach ($all as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->tai_khoan }}</td>
                                            <td>{{ $item->ten }}</td>
                                            <td>{{ $item->ten_vai_tro }}</td>
                                            <td>{{ $item->ten_don_vi }}</td>
                                            <td>{{ $item->ngay_tao }}</td>
                                            <td>@if($ngay_cap_nhat = $item->ngay_cap_nhat) {{ $ngay_cap_nhat }} @else Chưa cập nhật @endif</td>
                                            <td>
                                                <form method="POST" action="{{ route('delete_manager_user') }}">
                                                    @csrf
                                                <a style="float: left" href="{{ route('edit_manager_user', ['id' => $item->ma]) }}" title="Cập nhật & Xem chi tiết" class="btn btn-info mr-1">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                @if ($item->ma != 1)
                                                <a style="float: left" title="Xóa" class="mr-1">
                                                    <input type="hidden" name="id" value="{{ $item->ma }}">
                                                    <button class="btn btn-danger" onclick="return confirm('Bạn có thật sự muốn xóa không?')" type="submit"><i class="fas fa-trash-alt"></i></button>  
                                                </a>
                                                @endif
                                                
                                                </form>
                                                <a href="{{ route('decentralization', ['id' => $item->ma]) }}">
                                                    <button type="button" title="Phân quyền" class="btn btn-secondary"><i class="fas fa-cogs"></i></button>
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
