
<?php
    use App\Models\ManagerRoleRoom;
    $_url = "$_SERVER[REQUEST_URI]";
    $_temp = "@@!!@@";
    $_url = "^^^^^^".$_temp.$_url;
    $_temp= $_temp."/admin/";
    $role_menu = [];
    if (isset($roles_user)) {
        foreach ($roles_user as $key => $item) {
            $role_menu[$item->url] = $item->co_quyen;
        }
    }
    
?>

</h6>
<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion @php if (Session::get('_toggled')) echo 'toggled'; else ''; @endphp" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home_admin') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('admin/img/logo/logo1.png') }}">
        </div>
        <div class="sidebar-brand-text mx-3">Admin <?php echo Session::get('_toggled');?></div>
    </a>
    <hr class="sidebar-divider my-0">

    @if (isset($role_menu['trang-chu']) && $role_menu['trang-chu'] == '1')
        <li class="nav-item @php if ($_active = strpos($_url, $_temp.'trang-chu')) {echo 'active';}@endphp">
            <a class="nav-link" href="{{ route('home_admin') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Trang chủ</span></a>
        </li>
        
    @endif
    <hr class="sidebar-divider">
    @if (isset($role_menu) && isset($roles_user))
        <div class="sidebar-heading">
            Quản lý
        </div>
    @endif

    @if (isset($role_menu['loai-phong']) && $role_menu['loai-phong'] == '1')
        <li class="nav-item @php if ($_active = strpos($_url, $_temp.'loai-phong')) {echo 'active';}@endphp">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTypeRoom"
                aria-expanded="true" aria-controls="collapseTypeRoom">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Loại phòng</span>
            </a>
            <div id="collapseTypeRoom" class="collapse @php if ($_active && !Session::get('_toggled')) {echo 'show';}@endphp" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Loại phòng</h6>
                    @php if ($_active_item = strpos($_url, 'loai-phong/them-loai-phong'))@endphp
                    <a class="collapse-item @php if ($_active && $_active_item) {echo 'active';}@endphp" href="{{ route('add_type_room') }}">Thêm loại phòng</a>
                    <a class="collapse-item @php if ($_active && !$_active_item) {echo 'active';}@endphp" href="{{ route('type_room') }}">Tất cả loại phòng</a>
                </div>
            </div>
        </li>
    @endif
    
    @if (isset($role_menu['chuc-nang']) && $role_menu['chuc-nang'] == '1')
        <li class="nav-item @php if ($_active = strpos($_url, $_temp.'chuc-nang')) {echo 'active';}@endphp">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUses"
                aria-expanded="true" aria-controls="collapseUses">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Chức năng</span>
            </a>
            <div id="collapseUses" class="collapse @php if ($_active && !Session::get('_toggled')) {echo 'show';}@endphp" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Chức năng</h6>
                    @php if ($_active_item = strpos($_url, 'chuc-nang/them-chuc-nang'))@endphp
                    <a class="collapse-item @php if ($_active && $_active_item) {echo 'active';}@endphp" href="{{ route('add_uses') }}">Thêm chức năng</a>
                    <a class="collapse-item @php if ($_active && !$_active_item) {echo 'active';}@endphp" href="{{ route('uses') }}">Tất cả chức năng</a>
                </div>
            </div>
        </li>
    @endif

    @if (isset($role_menu['thiet-bi']) && $role_menu['thiet-bi'] == '1')
        <li class="nav-item @php if ($_active = strpos($_url, $_temp.'thiet-bi')) {echo 'active';}@endphp">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDevice"
                aria-expanded="true" aria-controls="collapseDevice">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Thiết bị</span>
            </a>
            <div id="collapseDevice" class="collapse @php if ($_active && !Session::get('_toggled')) {echo 'show';}@endphp" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Thiết bị</h6>
                    @php if ($_active_item = strpos($_url, 'thiet-bi/them-thiet-bi'))@endphp
                    <a class="collapse-item @php if ($_active && $_active_item) {echo 'active';}@endphp" href="{{ route('add_device') }}">Thêm thiết bị</a>
                    <a class="collapse-item @php if ($_active && !$_active_item) {echo 'active';}@endphp" href="{{ route('device') }}">Tất cả thiết bị</a>
                </div>
            </div>
        </li>
    @endif

    @if (isset($role_menu['phong']) && $role_menu['phong'] == '1')
        <li class="nav-item @php if ($_active = strpos($_url, $_temp.'phong')) {echo 'active';}@endphp">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRoom"
                aria-expanded="true" aria-controls="collapseRoom">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Phòng</span>
            </a>
            <div id="collapseRoom" class="collapse @php if ($_active && !Session::get('_toggled')) {echo 'show';}@endphp" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Phòng</h6>
                    @php if ($_active_item = strpos($_url, 'phong/them-phong'))@endphp
                    <a class="collapse-item @php if ($_active && $_active_item) {echo 'active';}@endphp" href="{{ route('add_room') }}">Thêm phòng</a>
                    <a class="collapse-item @php if ($_active && !$_active_item) {echo 'active';}@endphp" href="{{ route('room') }}">Tất cả phòng</a>
                </div>
            </div>
        </li>
    @endif

    {{-- @if (isset($role_menu['thoi-gian-mo-hoc-ky']) && $role_menu['thoi-gian-mo-hoc-ky'] == '1')
        <li class="nav-item @php if ($_active = strpos($_url, $_temp.'thoi-gian-mo-hoc-ky')) {echo 'active';}@endphp">
            <a class="nav-link collapsed" href="{{ route('time_open_semester') }}">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Quản</span>
            </a>
            
        </li>
    @endif --}}

    @if (isset($role_menu['thoi-gian-mo-hoc-ky']) && $role_menu['thoi-gian-mo-hoc-ky'] == '1')
        <li class="nav-item @php if ($_active = strpos($_url, $_temp.'thoi-gian-mo-hoc-ky')) {echo 'active';}@endphp">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCalander"
                aria-expanded="true" aria-controls="collapseCalander">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Thời gian mở học kì</span>
            </a>
            <div id="collapseCalander" class="collapse @php if ($_active && !Session::get('_toggled')) {echo 'show';}@endphp" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Quản lý</h6>
                    @php if ($_active_item_1 = strpos($_url, 'thoi-gian-mo-hoc-ky/nam-hoc'))@endphp
                    <a class="collapse-item @php if ($_active && $_active_item_1) {echo 'active';}@endphp" href="{{ route('school_year') }}">Năm học</a>
                    @php if ($_active_item_2 = strpos($_url, 'thoi-gian-mo-hoc-ky/hoc-ky'))@endphp
                    <a class="collapse-item @php if ($_active && $_active_item_2) {echo 'active';}@endphp" href="{{ route('semester') }}">Học kỳ</a>
                    <a class="collapse-item @php if ($_active && !$_active_item_1 && !$_active_item_2) {echo 'active';}@endphp" href="{{ route('time_open_semester') }}">Thời gian mở học kỳ</a>
                </div>
            </div>
        </li>
    @endif

    @if (isset($role_menu['quan-ly-tai-khoan']) && $role_menu['quan-ly-tai-khoan'] == '1')
        <li class="nav-item @php if ($_active = strpos($_url, $_temp.'quan-ly-tai-khoan')) {echo 'active';}@endphp">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseManagerUser"
                aria-expanded="true" aria-controls="collapseManagerUser">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Tài khoản hệ thống</span>
            </a>
            <div id="collapseManagerUser" class="collapse @php if ($_active && !Session::get('_toggled')) {echo 'show';}@endphp" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Tài khoản</h6>
                    @php if ($_active_item_1 = strpos($_url, 'quan-ly-tai-khoan/don-vi'))@endphp
                    <a class="collapse-item @php if ($_active && $_active_item_1) {echo 'active';}@endphp" href="{{ route('unit') }}">Đơn vị</a>
                    @php if ($_active_item_2 = strpos($_url, 'quan-ly-tai-khoan/them-tai-khoan'))@endphp
                    <a class="collapse-item @php if ($_active && $_active_item_2) {echo 'active';}@endphp" href="{{ route('add_manager_user') }}">Thêm tài khoản</a>
                    <a class="collapse-item @php if ($_active && !$_active_item_1 && !$_active_item_2) {echo 'active';}@endphp" href="{{ route('manager_user') }}">Tất cả tài khoản</a>
                </div>
            </div>
        </li>
    @endif

    @if ((isset($role_menu['duyet-dang-ky']) && $role_menu['duyet-dang-ky'] == '1' ) || ManagerRoleRoom::where('ma_nguoi_dung', Auth::guard('nguoi_dung')->user()->ma)->where('co_quyen', '1')->count() > 0)
        <li class="nav-item @php if ($_active = strpos($_url, $_temp.'duyet-dang-ky')) {echo 'active';}@endphp">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCheckSignUpBorrowRoom"
                aria-expanded="true" aria-controls="collapseCheckSignUpBorrowRoom">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Duyệt đăng ký</span>
            </a>
            <div id="collapseCheckSignUpBorrowRoom" class="collapse @php if ($_active && !Session::get('_toggled')) {echo 'show';}@endphp" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Duyệt đăng ký</h6>
                    @php if ($_active_item = strpos($_url, 'duyet-dang-ky/tat-ca'))@endphp
                    <a class="collapse-item @php if ($_active && !$_active_item) {echo 'active';}@endphp" href="{{ route('check_signup_borrow_room') }}">Chờ duyệt</a>
                    <a class="collapse-item @php if ($_active && $_active_item) {echo 'active';}@endphp" href="{{ route('checked_signup_borrow_room') }}">Tất cả</a>
                </div>
            </div>
        </li>
    @endif

    @if (isset($role_menu['phan-hoi-lien-he']) && $role_menu['phan-hoi-lien-he'] == '1')
        <li class="nav-item @php if ($_active = strpos($_url, $_temp.'phan-hoi-lien-he')) {echo 'active';}@endphp">
            <a class="nav-link collapsed" href="{{ route('contact') }}">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Liên hệ</span>
            </a>
            
        </li>
    @endif

    @if (isset($role_menu['cai-dat']) && $role_menu['cai-dat'] == '1')
        <li class="nav-item @php if ($_active = strpos($_url, $_temp.'cai-dat')) {echo 'active';}@endphp">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSetting"
                aria-expanded="true" aria-controls="collapseSetting">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Cài đặt website</span>
            </a>
            <div id="collapseSetting" class="collapse @php if ($_active && !Session::get('_toggled')) {echo 'show';}@endphp" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Cài đặt website</h6>
                    @php if ($_active_item_1 = strpos($_url, 'cai-dat/bang-ron'))@endphp
                    <a class="collapse-item @php if ($_active && $_active_item_1) {echo 'active';}@endphp" href="{{ route('edit_banner') }}">Băng rôn</a>
                    @php if ($_active_item_1 = strpos($_url, 'cai-dat/thanh-truot'))@endphp
                    <a class="collapse-item @php if ($_active && $_active_item_1) {echo 'active';}@endphp" href="{{ route('slider') }}">Thanh trượt</a>
                    @php if ($_active_item_1 = strpos($_url, 'cai-dat/gioi-thieu'))@endphp
                    <a class="collapse-item @php if ($_active && $_active_item_1) {echo 'active';}@endphp" href="{{ route('edit_introduce') }}">Giới thiệu</a>
                    @php if ($_active_item_1 = strpos($_url, 'cai-dat/lien-he'))@endphp
                    <a class="collapse-item @php if ($_active && $_active_item_1) {echo 'active';}@endphp" href="{{ route('edit_contact_setting') }}">Liên hệ</a>
                    @php if ($_active_item_1 = strpos($_url, 'cai-dat/thoi-gian-muon-phong'))@endphp
                    <a class="collapse-item @php if ($_active && $_active_item_1) {echo 'active';}@endphp" href="{{ route('edit_setting_borrow_room') }}">Thời gian mượn</a>
                    
                    @php if ($_active_item_1 = strpos($_url, 'cai-dat/mail'))@endphp
                    <a class="collapse-item @php if ($_active && $_active_item_1) {echo 'active';}@endphp" href="{{ route('edit_setting_mail') }}">Mail</a>

                    @php if ($_active_item_1 = strpos($_url, 'cai-dat/ldap'))@endphp
                    <a class="collapse-item @php if ($_active && $_active_item_1) {echo 'active';}@endphp" href="{{ route('edit_setting_ldap') }}">Ldap</a>
                </div>
            </div>
        </li>
    @endif
    
    @if (isset($role_menu['tin-tuc']) && $role_menu['tin-tuc'] == '1')
        <li class="nav-item @php if ($_active = strpos($_url, $_temp.'tin-tuc')) {echo 'active';}@endphp">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNews"
                aria-expanded="true" aria-controls="collapseNews">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Tin tức</span>
            </a>
            <div id="collapseNews" class="collapse @php if ($_active && !Session::get('_toggled')) {echo 'show';}@endphp" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Tin tức</h6>
                    @php if ($_active_item = strpos($_url, 'tin-tuc/them-tin-tuc'))@endphp
                    <a class="collapse-item @php if ($_active && $_active_item) {echo 'active';}@endphp" href="{{ route('add_news') }}">Thêm tin tức</a>
                    <a class="collapse-item @php if ($_active && !$_active_item) {echo 'active';}@endphp" href="{{ route('news') }}">Tất cả tin tức</a>
                </div>
            </div>
        </li>
    @endif

    @if (isset($role_menu['phan-hoi-phong']) && $role_menu['phan-hoi-phong'] == '1')
        <li class="nav-item @php if ($_active = strpos($_url, $_temp.'phan-hoi-phong')) {echo 'active';}@endphp">
            <a class="nav-link collapsed" href="{{ route('feed_back') }}">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Phản hồi phòng</span>
            </a>
            
        </li>
    @endif

</ul>
<!-- Sidebar -->


