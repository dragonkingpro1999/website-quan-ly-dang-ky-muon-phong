@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Thiết bị phòng</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('room') }}">Tất cả phòng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thiết bị phòng {{ $room->ten }}</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Thiết bị phòng: {{ $room->ten }} -> {{ $room->mo_ta }}</h6>
                        <div>
                            <a href="" type="button" data-toggle="modal" data-target="#add_device_room" id="#myBtnAdd" title="Thêm mới" class="btn btn-success">
                                <i class="fas fa-plus-circle"></i>
                            </a>
                            <a href="" type="button" data-toggle="modal" data-target="#delete_device_room" id="#myBtnDeletes" title="Xóa nhiều" class="btn btn-danger">
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
                                    <th>Số lượng</th>
                                    <th>SL hư</th>
                                    <th>Ngày tạo</th>
                                    <th>Ngày cập nhật</th>
                                    <th style="width:78px">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- all device room --}}
                                @if ($all)
                                    @foreach ($all as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->ten_thiet_bi }}</td>
                                            <td>{{ $item->mo_ta_thiet_bi }}</td>
                                            <td>{{ $item->so_luong }}</td>
                                            <td>{{ $item->so_luong_hu }}</td>
                                            <td>{{ $item->ngay_tao }}</td>
                                            <td>@if($ngay_cap_nhat = $item->ngay_cap_nhat) {{ $ngay_cap_nhat }} @else Chưa cập nhật @endif</td>
                                            <td class="text-center">
                                                <form method="POST" action="{{ route('delete_device_room') }}">
                                                    @csrf
                                                    <a style="float: left" href="" type="button" data-toggle="modal" data-target="#update_device_room" id="#myBtnUpdate" title="Cập nhật & Xem chi tiết" class="btn btn-info mr-1 update-device-room" data-id="{{ $item->ma }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
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
    <div class="modal fade" id="add_device_room" tabindex="-1" role="dialog" aria-labelledby="addDeviceRoomLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('insert_device_room') }}" method="POST" id="form-add-device-room">
                @csrf
                <input type="hidden" name="ma_phong" value={{ $room->ma }}>
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDeviceRoomLabel">Thêm thiết bị</h5>
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
                                        <label for="ma_thiet_bi">Chọn thiết bị thêm:</label>
                                        <select class="select2-multiple form-control " style="width: 100% !important" name="ma_thiet_bi[]" multiple="multiple" id="ma_thiet_bi">
                                        
                                            @foreach ($device as $key => $item)
                                                @php $temp=-999; @endphp
                                                @foreach ($all as $key_all => $item_all)

                                                    @if ($item->ma == $item_all->ma_thiet_bi)
                                                        {{-- <option disabled value={{ $item->ma }}>{{ $item->ten }}</option> --}}
                                                            @php $temp=$item->ma; @endphp
                                                        @break
                                                    @endif 

                                                @endforeach

                                                @if ($temp !=$item->ma)
                                                <option value={{$item->ma}} name={{ $item->ten }} class={{ $item->ma }}>{{ $item->ten }}</option>
                                                @endif
                                                
                                            @endforeach
                                                                        
                                        </select>
                                        <div class="form-message"></div>
                                    </div>
                                    <div id="add_device_room_render_html"></div>
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
    <div class="modal fade" id="delete_device_room" tabindex="-1" role="dialog" aria-labelledby="deleteDeviceRoomLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('deletes_device_room') }}" method="POST" id="form-deletes-device-room">
                @csrf
                <input type="hidden" name="ma_phong" value={{ $room->ma }}>
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteDeviceRoomLabel">Xóa thiết bị</h5>
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
                                        <label for="ma_thiet_bi_xoa">Chọn thiết bị xóa:</label>
                                        <select class="select2-multiple form-control" style="width: 100% !important" name="ma_thiet_bi_xoa[]" multiple="multiple" id="ma_thiet_bi_xoa">
                                        
                                            @foreach ($device as $key => $item)
                                                @php $temp=-999; @endphp
                                                @foreach ($all as $key_all => $item_all)

                                                    @if ($item->ma == $item_all->ma_thiet_bi)
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

    {{-- Modal update--}}
    <div class="modal fade" id="update_device_room" tabindex="-1" role="dialog" aria-labelledby="updateDeviceRoomLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('update_device_room') }}" method="POST" id="form-update-device-room">
                @csrf
                <input type="hidden" name="ma" id="update_ma">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateDeviceRoomLabel">Cập nhật thiết bị phòng</h5>
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
                                        <label for="ten_thiet_bi">Tên thiết bị: </label>
                                        <input type="text" class="form-control" name="ten_thiet_bi" id="update_ten_thiet_bi" placeholder="Nhập tên ..." disabled>
                                        <div class="form-message"></div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label for="mo_ta_thiet_bi">Mô tả của thiết bị:</label>
                                        <textarea class="form-control" name="mo_ta_thiet_bi" id="update_mo_ta_thiet_bi" rows="3" placeholder="Nhập mô tả ..." disabled></textarea>
                                        <div class="form-message"></div>
                                    </div>
                                    
                                    <div class="form-group col-lg-12">
                                        <label for="so_luong">Số lượng: </label>
                                        <input type="number" class="form-control" name="so_luong" id="update_so_luong" min="0">
                                        <div class="form-message" id="clear-update_so_luong"></div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label for="so_luong_hu">Số lượng hư: </label>
                                        <input type="number" class="form-control" name="so_luong_hu" id="update_so_luong_hu" min="0">
                                        <div class="form-message" id="clear-update_so_luong_hu"></div>
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

@section('script')
    <script>
        $(document).ready(function(){
            $('#ma_thiet_bi').change(function(){
                var list_device = $(this).val();
                
                var html = "";
                list_device.forEach(item => {
                    
                    var id = item;

                    var input_name = item; 

                    var name_device = $(`#ma_thiet_bi .${id}`).text();

                    var qty = 0;
                    if($(`#${id}`)){
                        if($(`#${id}`).val()){
                            qty= $(`#${id}`).val();
                        }
                    }
                    html = html + 
                    `
                    <div class="form-group col-lg-12">
                            <label for="ten">Số lượng của thiết bị ${name_device}: </label>
                            <input type="number" class="form-control" name="${input_name}" id="${input_name}" min="0" value="${qty}">
                            <div class="form-message"></div>
                        </div>
                    `;

                });
                $("#add_device_room_render_html").html(html);
            });
            
            $('.update-device-room').click(function(){
                var id = $(this).data('id');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "ajax/get-device-room-by-id",
                    method: 'post',
                    data: { id: id, _token: _token},
                    success:function(data){
                        $('#update_ma').val(data.ma);
                        $('#update_ten_thiet_bi').val(data.ten_thiet_bi);
                        $('#update_mo_ta_thiet_bi').val(data.mo_ta_thiet_bi);
                        $('#update_so_luong').val(data.so_luong);
                        $('#update_so_luong_hu').val(data.so_luong_hu);
                    },
                });
            });
        });
        
    </script>
@endsection
