@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tất cả mượn phòng</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tất cả mượn phòng</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tất cả mượn phòng</h6>
                        <button class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#searchThongKe" >Bộ tìm và lọc</button>
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
                                            <td>{{ $item->trang_thai == 1 ? 'Đang chờ duyệt' : ''}}{{ $item->trang_thai == 2 ? 'Mượn thành công' : ''}}{{ $item->trang_thai == 3 ? 'Hủy bởi người dùng' : ''}}{{ $item->trang_thai == 4 ? 'Hủy bởi nhà quản trị' : ''}}</td>
                                            <td>
                                                <a style="float: left" href="{{ route('infor_signup_borrow_room', ['id' => $item->ma]) }}" title="Thông tin mượn phòng"
                                                    class="btn btn-{{ $item->trang_thai == 1 ? 'warning' : ''}}{{ $item->trang_thai == 2 ? 'success' : ''}}{{ $item->trang_thai == 3 ? 'info' : ''}}{{ $item->trang_thai == 4 ? 'danger' : ''}} mr-1">
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
                            <form action="{{ route('change_date_checked_signup_borrow_room') }}" method="POST" id="form-search-date-admin">
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
@endsection
