@extends('pages.home.user.index')
@section('content_home_user')
    <h3><b>Lịch sử đăng ký mượn phòng</b></h3>
    <div class="table-responsive">
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead class="thead-light">
                <tr>
                    <th style="width: 30px">STT</th>
                    <th>Ngày mượn</th>
                    <th>Giờ mượn</th>
                    <th>Phòng</th>
                    <th>Trạng thái</th>
                    <th style="width: 78px">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @if ($all)
                    @foreach ($all as $key => $item)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->ngay_muon }}</td>
                            <td>{{ $item->thoi_gian_bat_dau_muon }}-{{ $item->thoi_gian_ket_thuc_muon }}</td>
                            <td>{{ $item->ten_phong }}</td>
                            @php
                                $trang_thai = $item->trang_thai;
                            @endphp
                            <td>{{$trang_thai =='1' ? "Đang chờ duyệt" : ""}}{{$trang_thai =='2' ? "Mượn thành công" : ""}}{{$trang_thai =='3' ? "Hủy bởi người dùng" : ""}}{{$trang_thai =='4' ? "Hủy bởi người quản trị" : ""}}</td>
                            <td style="text-align: center">
                                <form method="POST" action="{{ route('delete_type_room') }}">
                                    @csrf
                                <a title="Thông tin chi tiết"
                                    data-toggle="modal" 
                                    data-target="#informationUserBorrowRoom" 
                                    class="btn btn-{{ $item->trang_thai == 1 ? 'warning' : ''}}{{ $item->trang_thai == 2 ? 'success' : ''}}{{ $item->trang_thai == 3 ? 'info' : ''}}{{ $item->trang_thai == 4 ? 'danger' : ''}} get-infor-user-borrow-room fix-btn" 
                                    data-id="{{ $item->ma }}">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    @include('pages.home.borrow_room.infor_user_borrow_room')
@endsection
@section('link')
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('script')
    <script src="{{ asset('home/assets/js/get-infor-user-borrow-room.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable(); // ID From dataTable 
            $('#dataTableHover').DataTable(); // ID From dataTable with Hover
           
        });
    </script>
@endsection