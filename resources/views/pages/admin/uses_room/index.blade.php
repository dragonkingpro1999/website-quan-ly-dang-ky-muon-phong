@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Chức năng phòng</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('room') }}">Tất cả phòng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chức năng phòng {{ $room->ten }}</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Chức năng phòng: {{ $room->ten }} -> {{ $room->mo_ta }}</h6>
                        <div>
                            <a href="" type="button" data-toggle="modal" data-target="#add_uses_room" id="#myBtn" title="Thêm mới" class="btn btn-success">
                                <i class="fas fa-plus-circle"></i>
                            </a>
                            <a href="" type="button" data-toggle="modal" data-target="#delete_uses_room" id="#myBtn" title="Xóa nhiều" class="btn btn-danger">
                                <i class="fas fa-eraser"></i>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                            <thead class="thead-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Mô tả</th>
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
                                            <td>{{ $item->ten_chuc_nang }}</td>
                                            <td>{{ $item->mo_ta_chuc_nang }}</td>
                                            <td>{{ $item->ngay_tao }}</td>
                                            {{-- <td>@if($ngay_cap_nhat = $item->ngay_cap_nhat) {{ $ngay_cap_nhat }} @else Chưa cập nhật @endif</td> --}}
                                            <td class="text-center">
                                                <form method="POST" action="{{ route('delete_uses_room') }}">
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
    <div class="modal fade" id="add_uses_room" tabindex="-1" role="dialog" aria-labelledby="addUsesRoomLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('insert_uses_room') }}" method="POST" id="form-add-uses-room">
                @csrf
                <input type="hidden" name="ma_phong" value={{ $room->ma }}>
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUsesRoomLabel">Thêm chức năng</h5>
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
                                        <label for="ma_chuc_nang">Chọn chức năng thêm:</label>
                                        <select class="select2-multiple form-control " style="width: 100% !important" name="ma_chuc_nang[]" multiple="multiple" id="ma_chuc_nang">
                                        
                                            @foreach ($uses as $key => $item)
                                                @php $temp=-999; @endphp
                                                @foreach ($all as $key_all => $item_all)

                                                    @if ($item->ma == $item_all->ma_chuc_nang)
                                                        {{-- <option disabled value={{ $item->ma }}>{{ $item->ten }}</option> --}}
                                                            @php $temp=$item->ma; @endphp
                                                        @break
                                                    @endif 

                                                @endforeach

                                                @if ($temp !=$item->ma)
                                                <option value={{ $item->ma }}>{{ $item->ten }}</option>
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
    <div class="modal fade" id="delete_uses_room" tabindex="-1" role="dialog" aria-labelledby="deleteUsesRoomLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('deletes_uses_room') }}" method="POST" id="form-deletes-uses-room">
                @csrf
                <input type="hidden" name="ma_phong" value={{ $room->ma }}>
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUsesRoomLabel">Xóa chức năng</h5>
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
                                        <label for="ma_chuc_nang_xoa">Chọn chức năng xóa:</label>
                                        <select class="select2-multiple form-control" style="width: 100% !important" name="ma_chuc_nang_xoa[]" multiple="multiple" id="ma_chuc_nang_xoa">
                                        
                                            @foreach ($uses as $key => $item)
                                                @php $temp=-999; @endphp
                                                @foreach ($all as $key_all => $item_all)

                                                    @if ($item->ma == $item_all->ma_chuc_nang)
                                                        <option value={{ $item->ma }}>{{ $item->ten }}</option>
                                                            @php $temp=$item->ma; @endphp
                                                        @break
                                                    @endif 

                                                @endforeach

                                                {{-- @if ($temp !=$item->ma)
                                                <option disabled value={{ $item->ma }}>{{ $item->ten }}</option>
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
