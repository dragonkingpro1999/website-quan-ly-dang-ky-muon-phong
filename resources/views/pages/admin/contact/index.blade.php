@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Liên hệ</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tất cả liên hệ</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tất cả liên hệ</h6>
                        
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width:20px">STT</th>
                                    <th style="width:200px">Họ tên - Email</th>
                                    <th>Chủ đề</th>
                                    <th style="width:150px">Ngày liên hệ</th>
                                    <th style="width:79px">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- all type room --}}
                                @if ($all)
                                    @foreach ($all as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->ten }} <br> {{ $item->email }}</td>
                                            <td>{{ $item->chu_de }}</td>
                                            <td>{{ $item->ngay_tao }}</td>
                                            <td>
                                                <a 
                                                    style="float: left" 
                                                    href="{{ route('edit_contact', ['id' => $item->ma]) }}"
                                                    title="Phản hồi" 
                                                    class="btn {{ !$item->noi_dung_nguoi_phan_hoi ? 'btn-info' : 'btn-success'}}">
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
