@extends('home')
@section('content_home')
    @php
        //Giá trị ban đầu
        
        $ngay_bd = date_format(date_create($time_start),"d");
        $thang_bd = date_format(date_create($time_start),"m");
        $nam_bd = date_format(date_create($time_start),"Y");

        $ngay_kt = date_format(date_create($time_end),"d");
        $thang_kt = date_format(date_create($time_end),"m");
        $nam_kt = date_format(date_create($time_end),"Y");

        $ngay_thang_nam_db = date('d-m-Y', mktime(0, 0, 0, $thang_bd, $ngay_bd, $nam_bd));
        $ngay_thang_nam_kt = date('d-m-Y', mktime(0, 0, 0, $thang_kt, $ngay_kt, $nam_kt));

        // Tính toán về thứ
        $thu_ngay_bat_dau = date('l', mktime(0, 0, 0, $thang_bd, $ngay_bd, $nam_bd));
        $thu_ngay_ket_thuc = date('l', mktime(0, 0, 0, $thang_kt, $ngay_kt, $nam_kt));
        
        $ngaythangnam_bd = mktime(0, 0, 0, $thang_bd, $ngay_bd, $nam_bd);
        $ngaythangnam_kt = mktime(0, 0, 0, $thang_kt, $ngay_kt, $nam_kt);
    
        if($thu_ngay_bat_dau == "Monday"){
            $thu_hai_cua_tuan_bd = mktime(0, 0, 0, $thang_bd, $ngay_bd, $nam_bd);
        }elseif ($thu_ngay_bat_dau == "Tuesday") {
            $thu_hai_cua_tuan_bd = mktime(0, 0, 0, $thang_bd, $ngay_bd - 1, $nam_bd);
        }elseif ($thu_ngay_bat_dau == "Wednesday") {
            $thu_hai_cua_tuan_bd = mktime(0, 0, 0, $thang_bd, $ngay_bd - 2, $nam_bd);
        }elseif ($thu_ngay_bat_dau == "Thursday") {
            $thu_hai_cua_tuan_bd = mktime(0, 0, 0, $thang_bd, $ngay_bd - 3, $nam_bd);
        }elseif ($thu_ngay_bat_dau == "Friday") {
            $thu_hai_cua_tuan_bd = mktime(0, 0, 0, $thang_bd, $ngay_bd - 4, $nam_bd);
        }elseif ($thu_ngay_bat_dau == "Saturday") {
            $thu_hai_cua_tuan_bd = mktime(0, 0, 0, $thang_bd, $ngay_bd - 5, $nam_bd);
        }elseif ($thu_ngay_bat_dau == "Sunday") {
            $thu_hai_cua_tuan_bd = mktime(0, 0, 0, $thang_bd, $ngay_bd - 6, $nam_bd);
        }
        $ngay_dau_tien = date("d", $thu_hai_cua_tuan_bd);
        $thang_dau_tien = date("m", $thu_hai_cua_tuan_bd);
        $nam_dau_tien = date("Y", $thu_hai_cua_tuan_bd);
        $ngaythangnam_dau_tien = date("d-m-Y", $thu_hai_cua_tuan_bd);
        $ngaythangnam_CN_dau_tien = date("d-m-Y", mktime(0, 0, 0, $thang_dau_tien, $ngay_dau_tien + 6, $nam_dau_tien));

        if($thu_ngay_ket_thuc == "Monday"){
            $chu_nhat_cua_tuan_kt = mktime(0, 0, 0, $thang_kt, $ngay_kt + 6, $nam_kt);
        }elseif ($thu_ngay_ket_thuc == "Tuesday") {
            $chu_nhat_cua_tuan_kt = mktime(0, 0, 0, $thang_kt, $ngay_kt + 5, $nam_kt);
        }elseif ($thu_ngay_ket_thuc == "Wednesday") {
            $chu_nhat_cua_tuan_kt = mktime(0, 0, 0, $thang_kt, $ngay_kt + 4, $nam_kt);
        }elseif ($thu_ngay_ket_thuc == "Thursday") {
            $chu_nhat_cua_tuan_kt = mktime(0, 0, 0, $thang_kt, $ngay_kt + 3, $nam_kt);
        }elseif ($thu_ngay_ket_thuc == "Friday") {
            $chu_nhat_cua_tuan_kt = mktime(0, 0, 0, $thang_kt, $ngay_kt + 2, $nam_kt);
        }elseif ($thu_ngay_ket_thuc == "Saturday") {
            $chu_nhat_cua_tuan_kt = mktime(0, 0, 0, $thang_kt, $ngay_kt + 1, $nam_kt);
        }elseif ($thu_ngay_ket_thuc == "Sunday") {
            $chu_nhat_cua_tuan_kt = mktime(0, 0, 0, $thang_kt, $ngay_kt, $nam_kt);
        }

        $ngay_cuoi_cung = date("d", $chu_nhat_cua_tuan_kt);
        $thang_cuoi_cung = date("m", $chu_nhat_cua_tuan_kt);
        $nam_cuoi_cung = date("Y", $chu_nhat_cua_tuan_kt);
        $ngaythangnam_cuoi_cung = date("d-m-Y", $chu_nhat_cua_tuan_kt);

    // Tính toán về tuần
        $ngay_bat_dau = date_create($ngay_dau_tien.'-'.$thang_dau_tien.'-'.$nam_dau_tien);
        $ngay_ket_thuc = date_create($ngay_cuoi_cung.'-'.$thang_cuoi_cung.'-'.$nam_cuoi_cung);

        $khoang_cach_ngay = date_diff($ngay_bat_dau, $ngay_ket_thuc)->format('%a');

        $tong_so_tuan = ceil($khoang_cach_ngay/7);

    @endphp
    <br>
    @php
        $ngay_trong_tuan = 0; //1 tuần có 7 ngày, khởi tạo giá trị mặc định là 0
    @endphp

    
    <div class="container bgcolor-while pb-5 padding-tb-50" style="margin-bottom: -15px">
        
        <h3 class="title" style="margin-bottom: -15px">Lịch mượn phòng từ ngày {{ $ngaythangnam_dau_tien }} đến ngày {{ $ngaythangnam_cuoi_cung }}
            
        </h3>
        <br>
        <h4 style="color: black; margin-top: 10px">Tuần:</h4>
        <ul class="pagination pagination-primary" style="display:block !important; margin-left: 20px;">
            @for ($i = 1; $i <= $tong_so_tuan; $i++)
                @php
                    $thu_hai_cua_tuan_nay = date("d-m-Y", mktime(0, 0, 0, $thang_dau_tien, $ngay_dau_tien + $ngay_trong_tuan, $nam_dau_tien));
                    $chu_nhat_cua_tuan_nay = date("d-m-Y", mktime(0, 0, 0, $thang_dau_tien, $ngay_dau_tien + $ngay_trong_tuan + 6, $nam_dau_tien));
                    $ngay_trong_tuan += 7; 

                @endphp
                <li class="page-item" style=" float: left !important; margin-bottom: 5px">
                    <form action="{{ route('paging_date_search_room') }}" method="POST">
                        @csrf
                        <input type="hidden" name="search_name_room" value="{{isset($search_name_room) ? $search_name_room : null}}">

                        <input type="hidden" name="search_type_room" value="{{isset($search_type_room) ? $search_type_room : null}}">

                        @if(isset($search_uses))
                            @foreach ($search_uses as $key => $item)
                                <input type="hidden"  name="search_uses[{{$key}}]" value="{{ $item }}">
                            @endforeach
                        @endif
                        @if(isset($search_device))
                            @foreach ($search_device as $key => $item)
                                <input type="hidden"  name="search_device[{{$key}}]" value="{{ $item }}">
                            @endforeach
                        @endif

                        @if (isset($time_open_semester))
                            <input type="hidden" name="ma_time_open_semester" value={{$time_open_semester->ma}}>
                        @endif
                        <input type="hidden" name="date_start" value={{ $thu_hai_cua_tuan_nay }}>
                        <input type="hidden" name="date_end" value={{ $chu_nhat_cua_tuan_nay }}>
                        <a style="text-decoration: none" title="Từ ngày {{$thu_hai_cua_tuan_nay}} đến ngày {{$chu_nhat_cua_tuan_nay}}">
                            @if ($i == 1 && !isset($paging_ngay_bd) || ( isset($paging_ngay_bd) && $paging_ngay_bd == $thu_hai_cua_tuan_nay))
                                <button type="submit" class="page-link active-paging">Tuần {{$i}}</button>
                            @else
                                <button type="submit" class="page-link">Tuần {{$i}}</button>
                            @endif
                            
                        </a>
                    </form>
                </li>
            @endfor
            <div style="clear: left"></div>
        </ul>
        
        <div class="row">
            <div class="col-12 col-md-4 pt-3">

                    <span style="color: blue;">
                        @if (!isset($paging_ngay_bd) && !isset($paging_ngay_kt))
                            Từ ngày <span style="color: red;">{{ $ngaythangnam_dau_tien }}</span>
                            đến ngày <span style="color: red">{{ $ngaythangnam_CN_dau_tien }}</span>
                        @else
                            Từ ngày <span style="color: red">{{ $paging_ngay_bd }}</span>
                            đến ngày <span style="color: red">{{ $paging_ngay_kt }}</span>
                        @endif
                    </span>

            </div>
            
            <div class="col-12 col-md-8">
                <form>
                    @csrf
                    <a data-toggle="modal" data-target="#signupBorrowRoom" data-id="{{Auth::guard('nguoi_dung')->check() ? Auth::guard('nguoi_dung')->user()->ma_vai_tro: null}}" class="btn btn-danger search-and-borrow-room signup-borrow-room" style="color: white">Mượn phòng</a>
                </form>
                <a><button data-toggle="modal" data-target="#searchRoom" class="btn btn-success search-and-borrow-room">Bộ tìm kiếm</button></a>
                <button data-toggle="modal" data-target="#timeOpenSemester" class="btn btn-info search-and-borrow-room">{{ $time_open_semester->ten_hoc_ky }} năm {{ $time_open_semester->nam_dau }} - {{ $time_open_semester->nam_sau }}</button>
                <button data-toggle="modal" data-target="#timeOpenSignUp" class="btn btn-dark search-and-borrow-room">TG cho phép mượn</button>
                <a href="{{ route('download_pdf') }}">
                    <button class="btn btn-warning search-and-borrow-room">In lịch</button>
                </a>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Phòng</th>
                    @if(!isset($paging_ngay_bd) && !isset($paging_ngay_kt))
                        @for ($i = 0; $i <= 6; $i++) {{-- thứ 2 đến CN--}}
        
                            @php
                                $thu_tiep_theo = date("d-m-Y", mktime(0, 0, 0, $thang_dau_tien, $ngay_dau_tien + $i, $nam_dau_tien));
                                $thu[$i+2] = $thu_tiep_theo;
                            @endphp
        
                            @if ($i == 6)
                                <th>CN<br>{{ $thu_tiep_theo }}</th>
                            @else
                                <th>Thứ {{ $i + 2 }}<br>{{ $thu_tiep_theo }}</th>
                            @endif 
        
                        @endfor
                    @else
                        @php
                            $paging_ngay_dau_tien = date_create($paging_ngay_bd);
                            $paging_ngay_dt = date_format($paging_ngay_dau_tien,"d");
                            $paging_thang_dt = date_format($paging_ngay_dau_tien,"m");
                            $paging_nam_dt = date_format($paging_ngay_dau_tien,"Y");
                        @endphp
                        @for ($i = 0; $i <= 6; $i++) {{-- thứ 2 đến CN--}}
            
                            @php
                                $thu_tiep_theo = date("d-m-Y", mktime(0, 0, 0, $paging_thang_dt, $paging_ngay_dt + $i, $paging_nam_dt));
                                $thu[$i+2] = $thu_tiep_theo;
                            @endphp

                            @if ($i == 6)
                                <th>CN<br>{{ $thu_tiep_theo }}</th>
                            @else
                                <th>Thứ {{ $i + 2 }}<br>{{ $thu_tiep_theo }}</th>
                            @endif 

                        @endfor
                    @endif
                </tr>
            </thead>
            <tbody>
                @php
                    $count_room = 0;
                @endphp
                @foreach ($list_room as $key => $item)
                    @php
                        $count_room ++;
                    @endphp
                    <tr>
                        <td class="room_style" data-label="Phòng">
                            <form>
                                @csrf
                                <a href="" data-toggle="modal" data-target="#informationRoom" class="get-infor-room" data-id="{{ $item->ma }}">
                                    <i class="fas fa-info-circle"></i> {{$item->ten}}
                                </a>
                            </form>
                        </td>
                        @if(!isset($paging_ngay_bd) && !isset($paging_ngay_kt))
                            @for ($i = 0; $i <= 6; $i++) {{-- thứ 2 đến CN--}}
            
                                @php
                                    $thu_tiep_theo = date("d-m-Y", mktime(0, 0, 0, $thang_dau_tien, $ngay_dau_tien + $i, $nam_dau_tien));
                                    $thu[$i+2] = $thu_tiep_theo;
                                @endphp
            
                                @if ($i == 6)
                                    <td data-label="CN">
                                        @include('pages.home.borrow_room.borrow_room')
                                    </td>
                                @else
                                    <td data-label="Thứ {{$i + 2}}">
                                        @include('pages.home.borrow_room.borrow_room')
                                    </td>
                                @endif 
            
                            @endfor
                        @else
                            @php
                                $paging_ngay_dau_tien = date_create($paging_ngay_bd);
                                $paging_ngay_dt = date_format($paging_ngay_dau_tien,"d");
                                $paging_thang_dt = date_format($paging_ngay_dau_tien,"m");
                                $paging_nam_dt = date_format($paging_ngay_dau_tien,"Y");
                            @endphp
                            @for ($i = 0; $i <= 6; $i++) {{-- thứ 2 đến CN--}}
                
                                @php
                                    $thu_tiep_theo = date("d-m-Y", mktime(0, 0, 0, $paging_thang_dt, $paging_ngay_dt + $i, $paging_nam_dt));
                                    $thu[$i+2] = $thu_tiep_theo;
                                @endphp
                                @if ($i == 6)
                                    <td data-label="CN">
                                        @include('pages.home.borrow_room.borrow_room')
                                    </td>
                                    @else
                                    <td data-label="Thứ {{$i + 2}}">
                                        @include('pages.home.borrow_room.borrow_room')
                                    </td>
                                @endif 
                            @endfor
                        @endif
                    </tr>
                @endforeach
                
                @if ($count_room == 0)
                    <tr>
                        <td colspan="8">Chưa có dữ liệu hoặc tìm phòng không thấy</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    @include('pages.home.borrow_room.infor_room')
    @include('pages.home.borrow_room.time_open_semester')
    @include('pages.home.borrow_room.time_open_signup')
    @include('pages.home.borrow_room.infor_user_borrow_room')
    @include('pages.home.borrow_room.search_room')
    @include('pages.home.borrow_room.signup_borrow_room')
@endsection

@section('script')
    <script src="{{ asset('home/assets/js/get-infor-user-borrow-room.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            
            $('.get-infor-room').click(function(){
                var id = $(this).data('id');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "ajax/get-infor-room",
                    method: 'post',
                    data: { id: id, _token: _token},
                    success:function(data){
                        $('.room_title').html(`<b>PHÒNG: ${data['ten']}</b>`);
                        $('.infor-room').html(`
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    - Tên phòng: ${data['ten']}<br>
                                    - Mô tả phòng: ${data['mo_ta'] ? data['mo_ta'] : 'Chưa có mô tả'}<br>
                                    - Loại phòng: ${data['ten_loai_phong']}<br>
                                    - Sức chứa: ${data['suc_chua']}<br>
                                    - Trạng thái: ${data['trang_thai'] == 1 ? 'Tốt':'Đang sửa chữa'}<br>
                                </div>  
                                <div class="col-12 col-lg-6">
                                    ${data['hinh_anh'] ? '<img src="admin/img/img_room/'+ data['hinh_anh'] +' " >' : 'Chưa có ảnh' }
                                    
                                </div>    
                            </div>
                            `);
                        uses_room = data.uses_room;
                        infor_uses = '';
                        i_uses = 0;
                        uses_room.forEach(uses => {
                            infor_uses += `${uses.mo_ta_chuc_nang ? '- '+ uses.ten_chuc_nang + ' -> ' + uses.mo_ta_chuc_nang+ '<br>': '- '+ uses.ten_chuc_nang + '<br>'}`;
                            i_uses++;
                        });
                        if(i_uses == 0){
                            infor_uses='Chưa cập nhật chức năng tại phòng này!';
                        }
                        $('.infor-uses-room').html(infor_uses);
                        device_room = data.device_room;
                        infor_device = '';
                        i_device = 0;
                        device_room.forEach(device => {
                            infor_device += `${device.mo_ta_thiet_bi ? '- '+ device.ten_thiet_bi + ' -> ' + device.mo_ta_thiet_bi+ '<br>': '- '+ device.ten_thiet_bi + '<br>'}`;
                            
                            infor_device += `<span class= 'ml-3'>Số lượng: ${device.so_luong}. Số lượng hư: ${device.so_luong_hu}<span> <br>`;
                            i_device++;
                        });
                        if(i_device == 0){
                            infor_device='Chưa cập nhật thiết bị tại phòng này!';
                        }
                        $('.infor-device-room').html(infor_device);
                        roles_borrow_room = data.role_borrow_room;
                        infor_role = '';
                        roles_borrow_room.forEach(role => {
                            switch (role.ma_vai_tro) {
                                case 1:
                                    switch (role.dang_ky_duyet) {
                                        case -1:
                                            infor_role += '- Admin: bị chặn quyền mượn <br>';
                                            break;
                                        case 0:
                                            infor_role += '- Admin: mượn không cần duyệt <br>';
                                            break;
                                        case 1:
                                            infor_role += '- Admin: mượn phải chờ duyệt <br>';
                                            break;
                                    
                                        default:
                                            break;
                                    }
                                    break;
                                case 2:
                                    switch (role.dang_ky_duyet) {
                                        case -1:
                                            infor_role += '- Thầy/cô: bị chặn quyền mượn <br>';
                                            break;
                                        case 0:
                                            infor_role += '- Thầy/cô: mượn không cần duyệt <br>';
                                            break;
                                        case 1:
                                            infor_role += '- Thầy/cô: mượn phải chờ duyệt <br>';
                                            break;
                                    
                                        default:
                                            break;
                                    }
                                    break;
                                case 3:
                                    switch (role.dang_ky_duyet) {
                                        case -1:
                                            infor_role += '- Sinh viên: bị chặn quyền mượn <br>';
                                            break;
                                        case 0:
                                            infor_role += '- Sinh viên: mượn không cần duyệt <br>';
                                            break;
                                        case 1:
                                            infor_role += '- Sinh viên: mượn phải chờ duyệt <br>';
                                            break;
                                    
                                        default:
                                            break;
                                    }
                                    break;
                                case 4:
                                    switch (role.dang_ky_duyet) {
                                        case -1:
                                            infor_role += '- Khác: bị chặn quyền mượn <br>';
                                            break;
                                        case 0:
                                            infor_role += '- Khác: mượn không cần duyệt <br>';
                                            break;
                                        case 1:
                                            infor_role += '- Khác: mượn phải chờ duyệt <br>';
                                            break;
                                    
                                        default:
                                            break;
                                    }
                                    break;
                            
                                default:
                                    break;
                            }
                            
                        });
                        $('.infor-role-room').html(infor_role);

                        manager_user_room = data.manager_role_room;
                        manager_user_room1 = "";
                        i_mana=0;
                        manager_user_room.forEach(mana => {
                            i_mana++;
                            manager_user_room1 += `
                                
                                - Tên người quản lý: ${mana.ten_nguoi_dung}<br>
                                - Email: ${mana.email_nguoi_dung}<br>
                                - Số điện thoại: ${mana.so_dien_thoai_nguoi_dung}
                            <br><br>`;
                        }); 
                        $('.manager-user-room').html(manager_user_room1);
                        //Phản hồi phòng
                        if (data.feed_back.length == 0) {
                            $('.feed-back-room').html(`Chưa có phản hồi`);
                        } else {
                            $feed_back = `<div class="row">`;
                            $fb_stt = 0;
                            data.feed_back.forEach(fb => {
                                $fb_stt ++;
                                $feed_back +=`
                                    <div class="col-lg-12">
                                        <b>STT: ${$fb_stt}</b><br>
                                    </div>
                                    <div class="col-lg-6">
                                        - Người phản hồi: ${fb.ten_nguoi_dung}<br>
                                    </div>
                                    <div class="col-lg-6">
                                        - Nội dung: ${fb.noi_dung}<br>
                                    </div>
                                    <div class="col-lg-6">
                                        - Trạng thái : ${fb.da_xu_ly == 1 ? 'Đang chờ xử lý' : fb.da_xu_ly == 2 ? "Đã xử lý" : 'Không cần xử lý'}<br>
                                    </div>
                                    <div class="col-lg-6">
                                        - Ngày phản hồi: ${fb.ngay_tao}<br>
                                    </div>
                                    ${fb.da_xu_ly != 1 ?
                                        '<div class="col-lg-6">- Hướng giải quyết: ' + fb.noi_dung_tra_loi + '<br></div>'
                                        + '<div class="col-lg-6">- Ngày xử lý:  ' + fb.ngay_xu_ly + '<br></div>'
                                        :
                                        ''}
                                `;
                                if($fb_stt < data.feed_back.length){
                                    $feed_back += "<br><br>";
                                }
                            });
                            $feed_back += `</div>`;
                            $('.feed-back-room').html($feed_back); 
                        }
                        
                    },
                });
            });

            id_one = 10000;
            $('.add-date-borrow').click(function(){
                id_one++;
                html = `
                    <div class="row">
                        <div class="col-12 col-md-4" id="clear_date_borrow">
                            <div class="form-group">
                                <label for="ngay_muon">Ngày mượn: (<span style="color: red">*</span>)</label>
                                <input type="date" class="fix-form-input form-control" name="ngay_muon[]" id="ngay_muon" min="${_ngay_hien_tai_mac_dinh}" max="${_ngay_max_dang_ky}" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label for="thoi_gian_bat_dau_muon">TG BD mượn: (<span style="color: red">*</span>)</label>
                                <input class="fix-form-input form-control" type="time" id="thoi_gian_bat_dau_muon" name="thoi_gian_bat_dau_muon[]" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label for="thoi_gian_ket_thuc_muon">TG KT mượn: (<span style="color: red">*</span>)</label>
                                <input class="fix-form-input form-control" type="time" id="thoi_gian_ket_thuc_muon" name="thoi_gian_ket_thuc_muon[]" required>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-2">
                            <div class="form-group" style="text-align:center;">
                            <br>
                                <i class="fas fa-eraser clear-date-borrow" style="font-size:20px; color: red; margin-top:15px"></i>
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="one-error one-error-date-time-${id_one}">
                                                                
                            </div>
                            <input type="hidden" value="${id_one}" name="index_one[]">
                        </div>
                    </div>
                    `;
                $('.add-date-borrow-html').append(html);
                $('.clear-date-borrow').click(function(e){
                    $(this).parent().parent().parent().remove();
                });
            });

            $('.signup-borrow-room').click(function(){
                html = '';
                
                var id = $(this).data('id');
                var _token = $('input[name="_token"]').val();
        
                if(id){
                    $.ajax({
                        url: "ajax/get-room-by-role-borrow",
                        method: 'post',
                        data: { id: id, _token: _token},
                        success:function(data){
                            
                            rooms = data.room;
                            role_borrow_rooms = data.role_borrow_room;
                            
                            option_room = '<label for="ma_phong">Phòng (<span style="color: red">*</span>):</label>';
                            option_room += '<select class="fix-form-input form-control select-uses-room" name="ma_phong" id="ma_phong">';
                            option_room += '<option value="" >Chọn phòng</option>';
                                                        
                            room_chose = $('#room_chose').val();
                                            
                            rooms.forEach(room => {
                                role_borrow_rooms.forEach(role => {
                                    if (room.ma == role.ma_phong) {
                                        if (role.dang_ky_duyet == -1 || room.trang_thai == false) {
                                            if (role.dang_ky_duyet == -1) {
                                                option_room += `<option disabled value="${room.ma}">${room.ten} -> ${room.mo_ta} (bị chặn quyền mượn)</option>`;
                                            } else if(room.trang_thai == false) {
                                                option_room += `<option disabled value="${room.ma}">${room.ten} -> ${room.mo_ta} (phòng đang sữa chữa)</option>`;
                                            }
                                        
                                        } else {
                                            if (room_chose == room.ma) {
                                                option_room += `<option selected value="${room.ma}">${room.ten} -> ${room.mo_ta}</option>`;
                                            } else {
                                                option_room += `<option value="${room.ma}">${room.ten} -> ${room.mo_ta}</option>`;
                                            }
                                            
                                        }
                                    }
                                });
                                
                            });
                            option_room += '</select>';
                            option_room += '<div class="one-error-message-id-room one-error" style="padding-left: 10px; color:red"></div>';
                            $('.borrow-room-by-room-id').html(option_room);
                            
                            $('.select-uses-room').click(function(){
                                val = $(this).val();
                                document.getElementById('room_chose').value = val;   
                                var _token = $('input[name="_token"]').val();
                                if(val){
                                    $.ajax({
                                        url: "ajax/get-uses-room",
                                        method: 'post',
                                        data: { id: val, _token: _token},
                                        success:function(data){
                                            
                                            html = `
                                                
                                                    <label for="ma_thiet_bi">Mượn phòng sử dụng chức năng gì:</label>
                                                    <select class="select2-multiple form-control " style="width: 100% !important" name="ma_thiet_bi[]" multiple="multiple" id="ma_thiet_bi">
                                            `;
                                                            
                                                data.forEach(uses => {
                                                    html+= `
                                                        <option selected value="${uses.ma_chuc_nang}">${uses.ten_chuc_nang}</option>
                                                    `;
                                                            
                                                });
                                                if(data.length ==0){
                                                    html+= `
                                                        <option value="0" selected >Chức năng rỗng</option>
                                                    `;
                                                }

                                            html += `
                                                    </select>
                                                    <div class="form-message"></div>
                                                
                                            `;
                                                $('.chuc_nang_su_dung').html(html);
                                                $('.select2-multiple').select2();
                                                
                                        },
                                    });
                                }
                            });

                            
                        },
                    });
                }
                _ngay_hien_tai_mac_dinh = $('#_ngay_hien_tai_mac_dinh').val();
                _ngay_max_dang_ky = $('#_ngay_max_dang_ky').val();
                date_borrow_1_hidden = $('#date_borrow_1_hidden').val();
                gio_bd_1_hidden = $('#gio_bd_1_hidden').val();
                gio_kt_1_hidden = $('#gio_kt_1_hidden').val();

                html1 = `
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="ngay_muon">Ngày mượn: (<span style="color: red">*</span>)</label>
                            <input type="date" class="fix-form-input form-control date_borrow_1_hidden" value="${date_borrow_1_hidden}" name="ngay_muon[]" id="ngay_muon" min="${_ngay_hien_tai_mac_dinh}" max="${_ngay_max_dang_ky}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="thoi_gian_bat_dau_muon">Thời gian bắt đầu mượn: (<span style="color: red">*</span>)</label>
                            <input class="fix-form-input form-control gio_bd_1_hidden" value="${gio_bd_1_hidden}" type="time" id="thoi_gian_bat_dau_muon" name="thoi_gian_bat_dau_muon[]" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="thoi_gian_ket_thuc_muon">Thời gian kết thúc mượn: (<span style="color: red">*</span>)</label>
                            <input class="fix-form-input form-control gio_kt_1_hidden" value="${gio_kt_1_hidden}" type="time" id="thoi_gian_ket_thuc_muon" name="thoi_gian_ket_thuc_muon[]" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="one-error one-error-date-time-10000">
                                                            
                        </div>
                        <input type="hidden" value="10000" name="index_one[]">
                    </div>
                </div>
                `;
                $('.ngay_muon_mac_dinh').html(html1);

                $('.date_borrow_1_hidden').change(function(){
                    document.getElementById('date_borrow_1_hidden').value = $(this).val();
                });
                $('.gio_bd_1_hidden').change(function(){
                    document.getElementById('gio_bd_1_hidden').value = $(this).val();
                });
                $('.gio_kt_1_hidden').change(function(){
                    document.getElementById('gio_kt_1_hidden').value = $(this).val();
                });

                
            });

            $('#submit_borrow_room').click(function(e){
                $(`.one-error`).html('');
                $(`.one-error-message-all`).html('');
                e.preventDefault();

                ma_phong = $('#ma_phong').val();

                ngay_muon = []
                $('input[name^="ngay_muon"]').each(function() {
                    $(this).val() ? ngay_muon.push($(this).val()) : ngay_muon.push("");  
                });

                index = []
                $('input[name^="index_one"]').each(function() {
                    $(this).val() ? index.push($(this).val()) : index.push("");  
                });

                thoi_gian_bat_dau_muon = []
                $('input[name^="thoi_gian_bat_dau_muon"]').each(function() {
                    $(this).val() ? thoi_gian_bat_dau_muon.push($(this).val()) : thoi_gian_bat_dau_muon.push("");
                });
                
                thoi_gian_ket_thuc_muon = []
                $('input[name^="thoi_gian_ket_thuc_muon"]').each(function() {
                    $(this).val() ? thoi_gian_ket_thuc_muon.push($(this).val()) : thoi_gian_ket_thuc_muon.push(""); 
                });

                var _token = $('input[name="_token"]').val();
                var ma_thiet_bi = $('#ma_thiet_bi').val();
                var ly_do_muon = $('#ly_do_muon').val();
                $.ajax({
                    url: "ajax/signup-borrow-room-one",
                    method: 'post',
                    data: { 
                        ma_phong: ma_phong,
                        ngay_muon: ngay_muon,
                        thoi_gian_bat_dau_muon: thoi_gian_bat_dau_muon,
                        thoi_gian_ket_thuc_muon: thoi_gian_ket_thuc_muon,
                        date_start: _ngay_hien_tai_mac_dinh,
                        date_end: _ngay_max_dang_ky,
                        ma_thiet_bi: ma_thiet_bi,
                        ly_do_muon: ly_do_muon,
                        index:index,
                        _token: _token
                    },
                    success:function(data){
                        
                        if(data.status != "success"){
                            $(`.one-error-message-all`).html(data.message);
                        }

                        if(data.status == "error_null_id_room"){
                            $(`.one-error-message-id-room`).html(data.message);
                        }

                        if(data.status == "error_null_time" || data.status == "error_time_today" || data.status == "error_time_end_big_time_start" || data.status == "error_time_server"){
                            $(`.one-error-date-time-${data.index}`).html(data.message);
                        }

                        if(data.status == "error_time_xen_ke"){
                            $(`.one-error-date-time-${data.index1}`).html(data.message1);
                            $(`.one-error-date-time-${data.index2}`).html(data.message1);
                        }
                        
                        if(data.status == "success"){
                            swal(
                                "Thành công!", 
                                data.message, 
                                "success", 
                                {
                                    buttons: {
                                        cancel: "Đóng",
                                    },
                                }
                            )
                            .then((value) => {
                                switch (value) {
                                    default:
                                    window.location.reload();
                                }
                            });
                        }
                    },
                });
            })

            id_many_chose = 1000;
            $('.add-borrow-many').click(function(){
                id_many_chose ++;
                var id = $(this).data('id');
                var _token = $('input[name="_token"]').val();
                _ngay_hien_tai_mac_dinh = $('#_ngay_hien_tai_mac_dinh').val();
                _ngay_max_dang_ky = $('#_ngay_max_dang_ky').val();
                if(id){
                    $.ajax({
                        url: "ajax/get-room-by-role-borrow",
                        method: 'post',
                        data: { id: id, _token: _token},
                        success:function(data){
                            rooms = data.room;
                            role_borrow_rooms = data.role_borrow_room;
                            
                            html= '<div class="row">';
                            html += '<div class="col-12 col-md-12">';
                            html += '<label for="many_ma_phong">Phòng (<span style="color: red">*</span>):</label>';
                            html += `<select class="fix-form-input form-control select-uses-room-many mb-2" name="many_ma_phong[]" data-id="${id_many_chose}" id="many_ma_phong">`;
                            html += '<option value="" >Chọn phòng</option>';
                                            
                            rooms.forEach(room => {
                                role_borrow_rooms.forEach(role => {
                                    if (room.ma == role.ma_phong) {
                                        if (role.dang_ky_duyet == -1 || room.trang_thai == false) {
                                            if (role.dang_ky_duyet == -1) {
                                                html += `<option disabled value="${room.ma}">${room.ten} -> ${room.mo_ta} (bị chặn quyền mượn)</option>`;
                                            } else if(room.trang_thai == false) {
                                                html += `<option disabled value="${room.ma}">${room.ten} -> ${room.mo_ta} (phòng đang sữa chữa)</option>`;
                                            }
                                        
                                        } 
                                        else {
                                            html += `<option value="${room.ma}">${room.ten} -> ${room.mo_ta}</option>`;
                                        }
                                    }
                                });
                                
                            });
                            html += '</select>';
                            html += `<div class="many-error many-error-message many-error-message-id-room-${id_many_chose}">`;
                            html += '</div>';
                            html += '</div>';
                            
                            html += `
                                
                                <div class="col-12 col-md-4" id="clear_date_borrow">
                                    <div class="form-group">
                                        <label for="many_ngay_muon">Ngày mượn: (<span style="color: red">*</span>)</label>
                                        <input type="date" class="fix-form-input form-control" name="many_ngay_muon[]" id="many_ngay_muon" min="${_ngay_hien_tai_mac_dinh}" max="${_ngay_max_dang_ky}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="many_thoi_gian_bat_dau_muon">TG BD mượn: (<span style="color: red">*</span>)</label>
                                        <input class="fix-form-input form-control" type="time" id="many_thoi_gian_bat_dau_muon" name="many_thoi_gian_bat_dau_muon[]" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="many_thoi_gian_ket_thuc_muon">TG KT mượn: (<span style="color: red">*</span>)</label>
                                        <input class="fix-form-input form-control" type="time" id="many_thoi_gian_ket_thuc_muon" name="many_thoi_gian_ket_thuc_muon[]" required>
                                    </div>
                                </div>

                                <div class="many-error many-error-message many-error-message-time-${id_many_chose}">
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label for="many_ly_do_muon">Lý do mượn: </label>
                                        <textarea class="fix-form-input form-control" name="many_ly_do_muon" id="many_ly_do_muon[]" rows="3" placeholder="Nhập lý do ..."></textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-group many_chuc_nang_su_dung_${id_many_chose}">
                            
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div style="text-align:left">
                                        <label class="cursor color-red clear-date-borrow-many" style="font-size: 14px">Xóa ngày mượn</label>
                                    </div>
                                </div>
                                `;
                            html+="<br><br></div>";
                            $('.borrow-room-many').append(html);
                            $('.clear-date-borrow-many').click(function(e){
                                $(this).parent().parent().parent().remove();
                            });

                            $('.select-uses-room-many').change(function(){
                                
                                val = $(this).val();
                                var id_many = $(this).data('id');
                                var _token = $('input[name="_token"]').val();
                                if(val){
                                    $.ajax({
                                        url: "ajax/get-uses-room",
                                        method: 'post',
                                        data: { id: val, _token: _token},
                                        success:function(data){
                                            
                                            html = `
                                                
                                                    <label for="many_ma_thiet_bi">Mượn phòng sử dụng chức năng gì:</label>
                                                    <select class="select2-multiple-${id_many} form-control " style="width: 100% !important" name="many_ma_thiet_bi[]" multiple="multiple" id="many_ma_thiet_bi${id_many}">
                                            `;
                                                            
                                                data.forEach(uses => {
                                                    html+= `
                                                        <option selected value="${uses.ma_chuc_nang}">${uses.ten_chuc_nang}</option>
                                                    `;
                                                            
                                                });
                                                if(data.length ==0){
                                                    html+= `
                                                        <option value="0" selected >Chức năng rỗng</option>
                                                    `;
                                                }

                                            html += `
                                                    </select>
                                                    <div class="form-message"></div>
                                                
                                            `;
                                            
                                                $(`.many_chuc_nang_su_dung_${id_many}`).html(html);
                                                $(`.select2-multiple-${id_many}`).select2();
                                                
                                        },
                                    });
                                }
                            });

                            
                        },
                    });
                }
            });

            $('#submit_borrow_room_many').click(function(e){
                $(`.many-error-message-all`).html('');
                $(`.many-error`).html('');
                
                e.preventDefault();
                
                ma_phong = []
                $('select[name^="many_ma_phong"]').each(function() {
                    $(this).val() ? ma_phong.push($(this).val()) : ma_phong.push("");  
                });

                index = []
                $('select[name^="many_ma_phong"]').each(function() {
                    $(this).data('id') ? index.push($(this).data('id')) : index.push("");  
                });

                ngay_muon = []
                $('input[name^="many_ngay_muon"]').each(function() {
                    $(this).val() ? ngay_muon.push($(this).val()) : ngay_muon.push("");  
                });

                thoi_gian_bat_dau_muon = []
                $('input[name^="many_thoi_gian_bat_dau_muon"]').each(function() {
                    $(this).val() ? thoi_gian_bat_dau_muon.push($(this).val()) : thoi_gian_bat_dau_muon.push("");
                });
                
                thoi_gian_ket_thuc_muon = []
                $('input[name^="many_thoi_gian_ket_thuc_muon"]').each(function() {
                    $(this).val() ? thoi_gian_ket_thuc_muon.push($(this).val()) : thoi_gian_ket_thuc_muon.push(""); 
                });

                ly_do_muon = []
                $('textarea[name^="many_ly_do_muon"]').each(function() {
                    $(this).val() ? ly_do_muon.push($(this).val()) : ly_do_muon.push(""); 
                });

                ma_thiet_bi = []
                $('select[name^="many_ma_thiet_bi"]').each(function() {
                    $(this).val() ? ma_thiet_bi.push($(this).val()) : ma_thiet_bi.push(""); 
                });

                var _token = $('input[name="_token"]').val();
                
                if(ma_phong.length > 0){
                    _ngay_hien_tai_mac_dinh = $('#_ngay_hien_tai_mac_dinh').val();
                    _ngay_max_dang_ky = $('#_ngay_max_dang_ky').val();
                    $.ajax({
                        url: "ajax/signup-borrow-room-many",
                        method: 'post',
                        data: { 
                            ma_phong: ma_phong,
                            ngay_muon: ngay_muon,
                            thoi_gian_bat_dau_muon: thoi_gian_bat_dau_muon,
                            thoi_gian_ket_thuc_muon: thoi_gian_ket_thuc_muon,
                            ly_do_muon: ly_do_muon,
                            ma_thiet_bi: ma_thiet_bi,
                            index: index,
                            date_start: _ngay_hien_tai_mac_dinh,
                            date_end: _ngay_max_dang_ky,
                            _token: _token
                        },
                        success:function(data){
                            if(data.status != "success"){
                                $(`.many-error-message-all`).html(data.message);
                            }
                            
                            if(data.status == "error_null_id_room" || data.status == "error_role" || data.status == "error_time_sever"){
                                $(`.many-error-message-id-room-${data.index}`).html(data.message);
                            }

                            if(data.status == "error_null_time" || data.status == "error_time_end_big_time_start" || data.status == "error_time_sever" || data.status == "error_time_today"){
                                $(`.many-error-message-time-${data.index}`).html(data.message);
                            }
                            
                            if(data.status == "error_time_xen_ke"){
                                $(`.many-error-message-time-${data.index1}`).html(data.message1);
                                $(`.many-error-message-time-${data.index2}`).html(data.message1);
                            }
                            
                            if(data.status == "success"){
                                swal(
                                    "Thành công!", 
                                    data.message, 
                                    "success", 
                                    {
                                        buttons: {
                                            cancel: "Đóng",
                                        },
                                    }
                                )
                                .then((value) => {
                                    switch (value) {
                                        default:
                                        window.location.reload();
                                    }
                                });
                            }
                            
                        },
                    });
                }else{
                    $(`.many-error-message-all`).html('Vui lòng thêm ngày mượn');
                }

            })
            
            if($('.add-borrow-many')){
                $('.add-borrow-many').click();
            }
        });
        
    </script>
@endsection

@section('link')
    <link href="{{ asset('home/assets/css/style-index-home.css') }}" rel="stylesheet">
@endsection