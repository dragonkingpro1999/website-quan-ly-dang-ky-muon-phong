<strong style="font-size: 14px;">{{ $title }}</strong><br><br>
<strong>Phòng:</strong> {{$mo_ta_phong ? $ten_phong.' -> '.$mo_ta_phong :  $ten_phong}}<br>
<strong>Ngày mượn:</strong> {{$ngay_muon}}<br>
<strong>Thời gian mượn:</strong> {{$tg_bd_muon}} - {{$tg_kt_muon}}<br>
<strong>Trạng thái:</strong> {{$trang_thai =='1' ? "Đang chờ duyệt" : ""}}{{$trang_thai =='2' ? "Mượn thành công" : ""}}{{$trang_thai =='3' ? "Hủy bởi người dùng" : ""}}{{$trang_thai =='4' ? "Hủy bởi người quản trị" : ""}}<br>
<strong>Lý do mượn:</strong> {{$ly_do_muon ? $ly_do_muon : "Trống"}}<br>
<strong>Chức năng sử dụng:</strong> {{$chuc_nang_su_dung ? $chuc_nang_su_dung : "Trống"}}<br>
@if (isset($ly_do_huy))
<strong>Lý do hủy:</strong> {{$ly_do_huy ? $ly_do_huy : "Trống"}}<br>
@endif
