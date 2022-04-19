@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tất cả tin tức</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tất cả tin tức</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tất cả tin tức</h6>
                        <a href="{{ route('add_news') }}" title="Thêm mới" class="btn btn-success">
                            <i class="fas fa-plus-circle"></i>
                        </a>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Tiêu đề</th>
                                    <th>Hình ảnh</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th>Ngày cập nhật</th>
                                    <th style="width:78px">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- all type room --}}
                                @if ($all)
                                    @foreach ($all as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->tieu_de }}</td>
                                            @php
                                                $anh = "home/img_tin_tuc/". $item->hinh_anh
                                            @endphp
                                            <td><img src="{{ asset($anh)}} " alt="" width="70px"></td>
                                            <td>{{ $item->trang_thai == 1 ? 'Hiển thị': 'Ẩn' }}</td>
                                            <td>{{ $item->ngay_tao }}</td>
                                            <td>@if($ngay_cap_nhat = $item->ngay_cap_nhat) {{ $ngay_cap_nhat }} @else Chưa cập nhật @endif</td>
                                            <td>
                                                <form method="POST" action="{{ route('delete_news') }}">
                                                    @csrf
                                                <a style="float: left" href="{{ route('edit_news', ['id' => $item->ma]) }}" title="Cập nhật & Xem chi tiết" class="btn btn-info mr-1">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a style="float: left" title="Xóa">
                                                    <input type="hidden" name="id" value="{{ $item->ma }}">
                                                    <button class="btn btn-danger" onclick="return confirm('Bạn có thật sự muốn xóa không?')" type="submit"><i class="fas fa-trash-alt"></i></button>  
                                                </a>
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
