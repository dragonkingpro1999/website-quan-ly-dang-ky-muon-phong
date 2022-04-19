<?php
    $_url = "$_SERVER[REQUEST_URI]";
    $_temp = "@@!!@@";
    $_url = "^^^^^^".$_temp.$_url;
?>
<div class="nav flex-column nav-pills menu-home-user" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <a class="nav-link @php if (strpos($_url, $_temp.'/thong-tin-tai-khoan')) {echo 'active';}@endphp" href="{{ route('infor_user_home') }}">Thông tin tài khoản</a>
    <a class="nav-link @php if (strpos($_url, $_temp.'/lich-su-dang-ky-muon-phong')) {echo 'active';}@endphp" href="{{ route('history_signup_borrow_room') }}">Lịch sử đăng ký mượn phòng</a>
    <a class="nav-link @php if (strpos($_url, $_temp.'/quyen-quan-tri-vien')) {echo 'active';}@endphp" href="{{ route('role_user_home') }}">Quản trị viên</a>
    <a class="nav-link" href="{{ route('logout') }}">Đăng xuất</a>
</div>
