{{-- <div class="modal fade" id="borrowRoomPendding" tabindex="-1" role="dialog" aria-labelledby="borrowRoomPenddingLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 1000px">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="borrowRoomPenddingLabel">Danh sách mượn phòng đang chờ duyệt</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách mượn phòng</h6>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover1">
                                <thead class="thead-light">
                                    <tr>
                                        <th>STT</th>
                                        <th style="width: 200px">Thông tin mượn phòng</th>
                                        <th style="width: 100px">Thông tin người nượn</th>
                                        <th>Trạng thái</th>
                                        <th>Chi tiết</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($borrow_room_pendding)
                                        @foreach ($borrow_room_pendding as $key => $item)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->ngay_muon }} {{ $item->thoi_gian_bat_dau_muon }} : {{ $item->thoi_gian_ket_thuc_muon }} {{ $item->ten_phong }}</td>
                                                <td>{{ $item->ten_nguoi_dung }}</td>
                                                <td>{{ $item->trang_thai == 1 ? 'Đang chờ duyệt' : ''}}{{ $item->trang_thai == 2 ? 'Mượn thành công' : ''}}{{ $item->trang_thai == 3 ? 'Hủy bởi người dùng' : ''}}{{ $item->trang_thai == 4 ? 'Hủy bởi người quản trị' : ''}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-warning get-infor-user-borrow-room" data-toggle="modal" data-target="#informationUserBorrowRoom" data-id="{{ $item->ma }}"><i class="fas fa-info-circle"></i></button>
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
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Đóng</button>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="borrowRoomSuccess" tabindex="-1" role="dialog" aria-labelledby="borrowRoomSuccessLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 1000px">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="borrowRoomSuccessLabel">Danh sách mượn phòng mượn thành công</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách mượn phòng</h6>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover2">
                                <thead class="thead-light">
                                    <tr>
                                        <th>STT</th>
                                        <th style="width: 200px">Thông tin mượn phòng</th>
                                        <th style="width: 100px">Thông tin người nượn</th>

                                        <th>Trạng thái</th>
                                        <th>Chi tiết</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($borrow_room_success)
                                        @foreach ($borrow_room_success as $key => $item)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->ngay_muon }} {{ $item->thoi_gian_bat_dau_muon }} : {{ $item->thoi_gian_ket_thuc_muon }} {{ $item->ten_phong }}</td>
                                                <td>{{ $item->ten_nguoi_dung }}</td>
                                                
                                                <td>{{ $item->trang_thai == 1 ? 'Đang chờ duyệt' : ''}}{{ $item->trang_thai == 2 ? 'Mượn thành công' : ''}}{{ $item->trang_thai == 3 ? 'Hủy bởi người dùng' : ''}}{{ $item->trang_thai == 4 ? 'Hủy bởi người quản trị' : ''}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-success get-infor-user-borrow-room" data-toggle="modal" data-target="#informationUserBorrowRoom" data-id="{{ $item->ma }}"><i class="fas fa-info-circle"></i></button>
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
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Đóng</button>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="borrowRoomDestroyByCustomer" tabindex="-1" role="dialog" aria-labelledby="borrowRoomDestroyByCustomerLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 1000px">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="borrowRoomDestroyByCustomerLabel">Danh sách mượn phòng hủy bởi người dùng</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách mượn phòng</h6>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover3">
                                <thead class="thead-light">
                                    <tr>
                                        <th>STT</th>
                                        <th style="width: 200px">Thông tin mượn phòng</th>
                                        <th style="width: 100px">Thông tin người nượn</th>

                                        <th>Trạng thái</th>
                                        <th>Chi tiết</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($borrow_room_destroy_by_customer)
                                        @foreach ($borrow_room_destroy_by_customer as $key => $item)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->ngay_muon }} {{ $item->thoi_gian_bat_dau_muon }} : {{ $item->thoi_gian_ket_thuc_muon }} {{ $item->ten_phong }}</td>
                                                <td>{{ $item->ten_nguoi_dung }}</td>
                                                
                                                <td>{{ $item->trang_thai == 1 ? 'Đang chờ duyệt' : ''}}{{ $item->trang_thai == 2 ? 'Mượn thành công' : ''}}{{ $item->trang_thai == 3 ? 'Hủy bởi người dùng' : ''}}{{ $item->trang_thai == 4 ? 'Hủy bởi người quản trị' : ''}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info get-infor-user-borrow-room" data-toggle="modal" data-target="#informationUserBorrowRoom" data-id="{{ $item->ma }}"><i class="fas fa-info-circle"></i></button>
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
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Đóng</button>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="borrowRoomDestroyByAdministrator" tabindex="-1" role="dialog" aria-labelledby="borrowRoomDestroyByAdministratorLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 1000px">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="borrowRoomDestroyByAdministratorLabel">Danh sách mượn phòng hủy bởi người quản trị</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách mượn phòng</h6>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover4">
                                <thead class="thead-light">
                                    <tr>
                                        <th>STT</th>
                                        <th style="width: 200px">Thông tin mượn phòng</th>
                                        <th style="width: 100px">Thông tin người nượn</th>

                                        <th>Trạng thái</th>
                                        <th>Chi tiết</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($borrow_room_destroy_by_administrator)
                                        @foreach ($borrow_room_destroy_by_administrator as $key => $item)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->ngay_muon }} {{ $item->thoi_gian_bat_dau_muon }} : {{ $item->thoi_gian_ket_thuc_muon }} {{ $item->ten_phong }}</td>
                                                <td>{{ $item->ten_nguoi_dung }}</td>
                                                
                                                <td>{{ $item->trang_thai == 1 ? 'Đang chờ duyệt' : ''}}{{ $item->trang_thai == 2 ? 'Mượn thành công' : ''}}{{ $item->trang_thai == 3 ? 'Hủy bởi người dùng' : ''}}{{ $item->trang_thai == 4 ? 'Hủy bởi người quản trị' : ''}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-danger get-infor-user-borrow-room" data-toggle="modal" data-target="#informationUserBorrowRoom" data-id="{{ $item->ma }}"><i class="fas fa-info-circle"></i></button>
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
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Đóng</button>
        </div>
        </div>
    </div>
</div> --}}


{{-- <div class="modal fade" id="chart_infor" tabindex="-1" role="dialog" aria-labelledby="chart_inforLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 1000px">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="chart_inforLabel">Tần suất sử dụng phòng (giờ)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách mượn phòng</h6>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover5">
                                <thead class="thead-light">
                                    <tr>
                                        <th>STT</th>
                                        <th style="width: 200px">Thông tin mượn phòng</th>
                                        <th style="width: 100px">Thông tin người nượn</th>

                                        <th>Trạng thái</th>
                                        <th>Chi tiết</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($borrow_room_success)
                                        @foreach ($borrow_room_success as $key => $item)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->ngay_muon }} {{ $item->thoi_gian_bat_dau_muon }} : {{ $item->thoi_gian_ket_thuc_muon }} {{ $item->ten_phong }}</td>
                                                <td>{{ $item->ten_nguoi_dung }}</td>
                                                
                                                <td>{{ $item->trang_thai == 1 ? 'Đang chờ duyệt' : ''}}{{ $item->trang_thai == 2 ? 'Mượn thành công' : ''}}{{ $item->trang_thai == 3 ? 'Hủy bởi người dùng' : ''}}{{ $item->trang_thai == 4 ? 'Hủy bởi người quản trị' : ''}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-success get-infor-user-borrow-room" data-toggle="modal" data-target="#informationUserBorrowRoom" data-id="{{ $item->ma }}"><i class="fas fa-info-circle"></i></button>
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
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Đóng</button>
        </div>
        </div>
    </div>
</div> --}}


<div class="modal fade" id="informationUserBorrowRoom" tabindex="-1" role="dialog" aria-labelledby="chart_inforLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title title-borrow-room" style="color: red" id="informationRoomLabel"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <h6>Người mượn:</h6>
                <div class="infor-user-borrow ml-3"></div>
                <br>
                <h6>Chi tiết mượn:</h6>
                <div class="infor-detail-borrow ml-3"></div>
                <br>
                <h6>Phản hồi:</h6>
                <div class="feed-back ml-3"></div>
                <br>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">                
                <button type="button" style="width: 120px" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="searchThongKe" tabindex="-1" role="dialog" aria-labelledby="searchThongKe" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 800px">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" style="color: red">Bộ tìm và lọc</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="col-xl-12 col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Bộ tìm và lọc</h6>
                            {{-- <a class="m-0 float-right btn btn-danger btn-sm" href="{{ route('all_borrow_room') }}">Tất cả mượn phòng <i
                                    class="fas fa-chevron-right"></i></a> --}}
                        </div>
                        <form action="{{ route('change_date') }}" method="POST" id="form-search-date-admin">
                            @csrf
                            <div class="row pl-5 pr-5 pt-3">

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="date_start">Ngày bắt đầu mượn (<span class="text-red">*</span>): </label>
                                        <input type="date" class="form-control" name="date_start" id="date_start" value="{{ $date_start }}">
                                        <div class="form-message" id="clear-date-start"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="date_end">Ngày kết thúc mượn (<span class="text-red">*</span>): </label>
                                        <input type="date" class="form-control" name="date_end" id="date_end" value="{{ $date_end }}">
                                        <div class="form-message" id="clear-date-end"></div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="ma_nguoi_dung">Người mượn:</label>
                                        <select class="select2-multiple form-control " style="width: 100% !important" name="ma_nguoi_dung[]" multiple="multiple" id="ma_nguoi_dung">
                                        
                                            @foreach ($nguoi_dung as $key => $item)
                                                @php $temp=-999; @endphp
                                                @foreach ($ma_nguoi_dung as $key_all => $item_all)

                                                    @if ($item->ma == $item_all)
                                                        <option selected value={{ $item->ma }}>{{ $item->ten }}</option>
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
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="ma_nguoi_duyet">Người duyệt:</label>
                                        
                                        <select class="select2-multiple form-control " style="width: 100% !important" name="ma_nguoi_duyet[]" multiple="multiple" id="ma_nguoi_duyet">
                                        
                                            @foreach ($nguoi_dung as $key => $item)
                                                @php $temp=-999; @endphp
                                                @foreach ($ma_nguoi_duyet as $key_all => $item_all)

                                                    @if ($item->ma == $item_all)
                                                        <option selected value={{ $item->ma }}>{{ $item->ten }}</option>
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

                                  
    
                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="room_ids">Phòng:</label>
                                        <select class="select2-multiple form-control " style="width: 100% !important" name="room_ids[]" multiple="multiple" id="room_ids">
                                        
                                            @foreach ($room as $key => $item)
                                                @php $temp=-999; @endphp
                                                @foreach ($room_ids as $key_all => $item_all)

                                                    @if ($item->ma == $item_all)
                                                        <option selected value={{ $item->ma }}>{{ $item->ten }}</option>
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

                                
    
                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="uses_ids">Chức năng sử dụng:</label>
                                        <select class="select2-multiple form-control " style="width: 100% !important" name="uses_ids[]" multiple="multiple" id="uses_ids">
                                        
                                            @foreach ($uses as $key => $item)
                                                @php $temp=-999; @endphp
                                                @foreach ($uses_ids as $key_all => $item_all)

                                                    @if ($item->ma == $item_all)
                                                        <option selected value={{ $item->ma }}>{{ $item->ten }}</option>
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

                                

                                <div class="col-lg-4">
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="opacity: 0">Tìm và Lọc</label>
                                        <div>
                                            <button type="submit" class="btn btn-success" style="height: 43px; width: 100%">Tìm và Lọc</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">                
                <button type="button" style="width: 120px" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>

        </div>
    </div>
</div>


