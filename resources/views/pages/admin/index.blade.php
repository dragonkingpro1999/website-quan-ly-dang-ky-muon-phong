@extends('admin')
@section('content_admin')
@php
    use App\Models\NguoiDung;
    // use DB;
@endphp
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Trang chủ</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
            </ol>
        </div>

        <div class="row mb-3">
            
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card h-70">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ DB::table('vai_tro')->where('ma', 1)->first()->ten }}</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ NguoiDung::where('ma_vai_tro', 1)->count() }} <span style="font-size: 12px">tài khoản</span></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users-cog fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card h-70">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ DB::table('vai_tro')->where('ma', 2)->first()->ten }}</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ NguoiDung::where('ma_vai_tro', 2)->count() }} <span style="font-size: 12px">tài khoản</span></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-graduate fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card h-70">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ DB::table('vai_tro')->where('ma', 3)->first()->ten }}</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ NguoiDung::where('ma_vai_tro', 3)->count() }} <span style="font-size: 12px">tài khoản</span></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card h-70">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ DB::table('vai_tro')->where('ma', 4)->first()->ten }}</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ NguoiDung::where('ma_vai_tro', 4)->count() }} <span style="font-size: 12px">tài khoản</span></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            

            
            

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tần suất sử dụng phòng (giờ)</h6>
                        <div class="dropdown no-arrow">
                            @if (count($borrow_room_success) > 0 )
                            <a class="m-0 float-right btn btn-danger btn-sm" href="{{ route('home_admin_excel_borrow_room_frequency_of_room_use') }}">BC Tần suất SD <i class="fas fa-file-download"></i></a>
                            @else
                                <a class="m-0 float-right btn btn-danger btn-sm" href="#" onclick="return alert('Dữ liệu trống! Không thể xuất file excel!')"> BC Danh sách <i class="fas fa-file-download"></i></a>
                            @endif

                            @if (count($borrow_room_success) > 0 )
                            <a class="m-0 float-right btn btn-danger btn-sm mr-2" href="{{ route('home_admin_excel_borrow_room_success') }}">BC Danh sách <i class="fas fa-file-download"></i></a>
                            @else
                                <a class="m-0 float-right btn btn-danger btn-sm mr-2" href="#" onclick="return alert('Dữ liệu trống! Không thể xuất file excel!')"> BC Danh sách <i class="fas fa-file-download"></i></a>
                            @endif
                                <button class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#searchThongKe" >Bộ tìm và lọc</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="horizontalBar"></canvas>
                    </div>
                </div>
            </div>
            <!-- Pie Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tần suất mượn (lần)</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle btn btn-primary btn-sm" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               
                                Tổng số: {{ $sum_borrow_room }} <i class="fas fa-chevron-down"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item " data-toggle="modal" data-target="#borrowRoomPendding">Đang chờ duyệt: {{ $borrow_room_pendding->count() }} / {{ $sum_borrow_room }}</a>
                                <a class="dropdown-item " data-toggle="modal" data-target="#borrowRoomSuccess">Mượn thành công: {{ $borrow_room_success->count() }} / {{ $sum_borrow_room }}</a>
                                <a class="dropdown-item " data-toggle="modal" data-target="#borrowRoomDestroyByCustomer">Hủy bởi người dùng: {{ $borrow_room_destroy_by_customer->count() }} / {{ $sum_borrow_room }}</a>
                                <a class="dropdown-item " data-toggle="modal" data-target="#borrowRoomDestroyByAdministrator">Hủy bởi người quản trị: {{ $borrow_room_destroy_by_administrator->count() }} / {{ $sum_borrow_room }}</a>
                            </div>
                        </div>
                    </div>
                    @if ($sum_borrow_room > 0)
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-10">
                                    <div class="mb-3">
                                        <div class="small text-gray-500">Đang chờ duyệt
                                            <div class="small float-right"><b>{{ $borrow_room_pendding->count() }} / {{ $sum_borrow_room }}</b></div>
                                        </div>
                                        <div class="progress" style="height: 12px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $borrow_room_pendding->count() /  $sum_borrow_room * 100}}%"></div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="small text-gray-500">Mượn thành công
                                            <div class="small float-right"><b>{{ $borrow_room_success->count() }} / {{ $sum_borrow_room }}</b></div>
                                        </div>
                                        <div class="progress" style="height: 12px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $borrow_room_success->count() /  $sum_borrow_room * 100}}%"></div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="small text-gray-500">Hủy bởi người dùng
                                            <div class="small float-right"><b>{{ $borrow_room_destroy_by_customer->count() }} / {{ $sum_borrow_room }}</b></div>
                                        </div>
                                        <div class="progress" style="height: 12px;">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: {{ $borrow_room_destroy_by_customer->count() /  $sum_borrow_room * 100}}%"></div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="small text-gray-500">Hủy bởi người quản trị
                                            <div class="small float-right"><b>{{ $borrow_room_destroy_by_administrator->count() }} / {{ $sum_borrow_room }}</b></div>
                                        </div>
                                        <div class="progress" style="height: 12px;">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $borrow_room_destroy_by_administrator->count() /  $sum_borrow_room * 100}}%"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-lg-2">
                                    @if (count($borrow_room_pendding) > 0 )
                                        <a class="mb-3 float-right btn btn-warning btn-sm" href="{{ route('home_admin_excel_borrow_room_pendding') }}">BC Danh sách <i class="fas fa-file-download"></i></a>
                                    @else
                                        <a class="mb-3 float-right btn btn-warning btn-sm" href="#" onclick="return alert('Dữ liệu trống! Không thể xuất file excel!')"> BC Danh sách <i class="fas fa-file-download"></i></a>
                                    @endif

                                    @if (count($borrow_room_success) > 0 )
                                        <a class="mb-3 float-right btn btn-success btn-sm" href="{{ route('home_admin_excel_borrow_room_success') }}">BC Danh sách <i class="fas fa-file-download"></i></a>
                                    @else
                                        <a class="mb-3 float-right btn btn-success btn-sm" href="#" onclick="return alert('Dữ liệu trống! Không thể xuất file excel!')"> BC Danh sách <i class="fas fa-file-download"></i></a>
                                    @endif

                                    @if (count($borrow_room_destroy_by_customer) > 0 )
                                        <a class="mb-3 float-right btn btn-info btn-sm" href="{{ route('home_admin_excel_borrow_room_destroy_by_customer') }}">BC Danh sách <i class="fas fa-file-download"></i></a>
                                    @else
                                        <a class="mb-3 float-right btn btn-info btn-sm" href="#" onclick="return alert('Dữ liệu trống! Không thể xuất file excel!')"> BC Danh sách <i class="fas fa-file-download"></i></a>
                                    @endif

                                    @if (count($borrow_room_destroy_by_administrator) > 0 )
                                        <a class="mb-3 float-right btn btn-danger btn-sm" href="{{ route('home_admin_excel_borrow_room_destroy_by_administrator') }}">BC Danh sách <i class="fas fa-file-download"></i></a>
                                    @else
                                        <a class="mb-3 float-right btn btn-danger btn-sm" href="#" onclick="return alert('Dữ liệu trống! Không thể xuất file excel!')"> BC Danh sách <i class="fas fa-file-download"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    
                </div>
            </div>
            <!-- Invoice Example -->
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách tất cả mượn phòng</h6>
                        @if (count($borrow_room_all) > 0 )
                            <a class="m-0 float-right btn btn-danger btn-sm" href="{{ route('home_admin_excel_borrow_room_all') }}">BC Danh sách <i class="fas fa-file-download"></i></a>
                        @else
                            <a class="m-0 float-right btn btn-danger btn-sm" href="#" onclick="return alert('Dữ liệu trống! Không thể xuất file excel!')"> BC Danh sách <i class="fas fa-file-download"></i></a>
                        @endif
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover6">
                            <thead class="thead-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Thông tin mượn phòng</th>
                                    <th>Thông tin người mượn</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($borrow_room_all as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->ngay_muon }} {{ $item->thoi_gian_bat_dau_muon }} : {{ $item->thoi_gian_ket_thuc_muon }} {{ $item->ten_phong }}</td>
                                    <td>{{ $item->ten_nguoi_dung }}</td>
                                    <td>{{ $item->trang_thai == 1 ? 'Đang chờ duyệt' : ''}}{{ $item->trang_thai == 2 ? 'Mượn thành công' : ''}}{{ $item->trang_thai == 3 ? 'Hủy bởi người dùng' : ''}}{{ $item->trang_thai == 4 ? 'Hủy bởi người quản trị' : ''}}</td>
                                    <td>
                                        <button 
                                            type="button" 
                                            class="btn btn-{{ $item->trang_thai == 1 ? 'warning' : ''}}{{ $item->trang_thai == 2 ? 'success' : ''}}{{ $item->trang_thai == 3 ? 'info' : ''}}{{ $item->trang_thai == 4 ? 'danger' : ''}} get-infor-user-borrow-room" 
                                            data-toggle="modal" 
                                            data-target="#informationUserBorrowRoom" 
                                            data-id="{{ $item->ma }}"><i class="fas fa-info-circle"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
            
        </div>
        <!--Row-->



    </div>
    <!---Container Fluid-->
    @include('pages.admin.modal')
@endsection

@section('link')
    <link href="{{ asset('admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" >
    {{-- <link href="{{ asset('home/assets/css/now-ui-kit.css?v=1.3.0') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('admin/css/style-modal.css') }}" rel="stylesheet" /> --}}
@endsection

@section('script')
    <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>
    {{-- <script src="{{ asset('admin/js/demo/chart-area-demo.js') }}"></script> --}}
    <script src="{{ asset('admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/clock-picker/clockpicker.js') }}"></script>
    <script>
        $('#simple-date1 .input-group.date').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: 'linked',
            todayHighlight: true,
            autoclose: true,        
        });
        $('#simple-date2 .input-group.date').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: 'linked',
            todayHighlight: true,
            autoclose: true,        
        });
    </script>
    <script src="{{ asset('admin/js/chart-admin.js') }}"></script>

@endsection
