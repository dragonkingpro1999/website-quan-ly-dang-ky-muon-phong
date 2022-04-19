@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Phân quyền phòng</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('room') }}">Tất cả phòng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Phân quyền phòng {{ $room->ten }}</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Phân quyền phòng: {{ $room->ten }} -> {{ $room->mo_ta }}</h6>
                        <div>
                            <a href="" type="button" data-toggle="modal" data-target="#add_role_room" id="#myBtn" title="Thêm mới" class="btn btn-success">
                                <i class="fas fa-plus-circle"></i>
                            </a>
                            <a href="" type="button" data-toggle="modal" data-target="#delete_role_room" id="#myBtn" title="Xóa nhiều" class="btn btn-danger">
                                <i class="fas fa-eraser"></i>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Người quản lý</th>
                                    <th>Người cấp</th>
                                    <th>Ngày tạo</th>
                                    {{-- <th>Ngày cập nhật</th> --}}
                                    <th style="width:78px">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- all uses room --}}
                                @if ($all)
                                    @foreach ($all as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->tai_khoan_nguoi_dung }} - {{ $item->ten_nguoi_dung }}</td>
                                            <td>{{ $item->tai_khoan_nguoi_cap }} - {{ $item->ten_nguoi_cap }}</td>
                                            <td>{{ $item->ngay_tao }}</td>
                                            {{-- <td>@if($ngay_cap_nhat = $item->ngay_cap_nhat) {{ $ngay_cap_nhat }} @else Chưa cập nhật @endif</td> --}}
                                            <td class="text-center">
                                                <form method="POST" action="{{ route('delete_role_room') }}">
                                                    @csrf
                                                <a title="Xóa">
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
    {{-- Modal add--}}
    <div class="modal fade" id="add_role_room" tabindex="-1" role="dialog" aria-labelledby="addRoleRoomLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('insert_role_room') }}" method="POST" id="form-add-role-room">
                @csrf
                <input type="hidden" name="ma_phong" value={{ $room->ma }}>
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoleRoomLabel">Thêm Phân quyền</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                    <div class="row">
                        <div class="col-lg-12 col-xl-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">{{ $room->ten}} -> {{ $room->mo_ta }}</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group col-lg-12">
                                        <label for="ma_nguoi_dung">Chọn tài khoản thêm:</label>
                                        <select class="select2-multiple form-control " style="width: 100% !important" name="ma_nguoi_dung[]" multiple="multiple" id="ma_nguoi_dung">
                                        
                                            @foreach ($nguoi_dung as $key => $item)
                                                @php $temp=-999; @endphp
                                                @foreach ($all as $key_all => $item_all)

                                                    @if ($item->ma == $item_all->ma_nguoi_dung)
                                                        {{-- <option disabled value={{ $item->ma }}>{{ $item->tai_khoan }} - {{ $item->ten }}</option> --}}
                                                            @php $temp=$item->ma; @endphp
                                                        @break
                                                    @endif 

                                                @endforeach

                                                @if ($temp !=$item->ma)
                                                <option value={{ $item->ma }}>{{ $item->tai_khoan }} - {{ $item->ten }}</option>
                                                @endif
                                                
                                            @endforeach
                                                                        
                                        </select>
                                        <div class="form-message"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal delete --}}
    <div class="modal fade" id="delete_role_room" tabindex="-1" role="dialog" aria-labelledby="deleteRoleRoomLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('deletes_role_room') }}" method="POST" id="form-deletes-role-room">
                @csrf
                <input type="hidden" name="ma_phong" value={{ $room->ma }}>
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteRoleRoomLabel">Xóa phân quyền</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                    <div class="row">
                        <div class="col-lg-12 col-xl-12">
                            <div class="card mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">{{ $room->ten}} -> {{ $room->mo_ta }}</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group col-lg-12">
                                        <label for="ma_nguoi_dung_xoa">Chọn tài khoản xóa:</label>
                                        <select class="select2-multiple form-control" style="width: 100% !important" name="ma_nguoi_dung_xoa[]" multiple="multiple" id="ma_nguoi_dung_xoa">
                                        
                                            @foreach ($nguoi_dung as $key => $item)
                                                @php $temp=-999; @endphp
                                                @foreach ($all as $key_all => $item_all)

                                                    @if ($item->ma == $item_all->ma_nguoi_dung)
                                                        <option value={{ $item->ma }}>{{ $item->tai_khoan }} - {{ $item->ten }}</option>
                                                            @php $temp=$item->ma; @endphp
                                                        @break
                                                    @endif 

                                                @endforeach

                                                {{-- @if ($temp !=$item->ma)
                                                <option disabled value={{ $item->ma }}>{{ $item->tai_khoan }} - {{ $item->ten }}</option>
                                                @endif --}}
                                                
                                            @endforeach
                                                                        
                                        </select>
                                        <div class="form-message"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
                </div>
            </form>
        </div>
    </div>
    <!---Container Fluid-->
@endsection
