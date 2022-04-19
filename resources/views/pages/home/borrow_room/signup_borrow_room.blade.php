<!-- Modal -->

<div class="modal fade" id="signupBorrowRoom">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" style="color: red" id="signupBorrowRoomLabel">Mượn phòng</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body mb-2">
                @if (Auth::guard('nguoi_dung')->check() && Auth::guard('nguoi_dung')->user()->email != '')
                    <div class="container">
                        <div class="row">
                            <div class="card">
                                <div class="card-header">
                                    <ul class="nav nav-tabs nav-tabs-neutral justify-content-center" role="tablist" data-background-color="orange">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#borrow_room_one1" role="tab">Mượn 1 phòng</a>
                                        </li>
                                        <li class="nav-item" class="signup-borrow-room-many">
                                            <a class="nav-link" data-toggle="tab"  href="#borrow_room_many1" role="tab">Mượn nhiều phòng</a>
                                        </li>
                                        

                                    </ul>
                                </div>
                                <div class="card-body">
                                    <!-- Tab panes -->
                                    <form id="sign_up_borrow_room">
                                        @csrf
                                        <input type="hidden" name="room_chose" value="0" id="room_chose">
                                        <div class="tab-content text-center">
                                            <div class="tab-pane active" id="borrow_room_one1" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group borrow-room-by-room-id">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $_ngay_hien_tai_mac_dinh = date("Y-m-d");

                                                    $_ngay_hien_tai = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
                                                    $_ngay_min_dang_ky = $time_open_semester_can_min;
                                                    if($_ngay_hien_tai < $_ngay_min_dang_ky){
                                                        $_ngay_hien_tai_mac_dinh = $time_open_semester_can_min;
                                                    }

                                                    $_ngay_max_dang_ky = $time_open_semester_can_max;
                                                @endphp
                                                <input type="hidden" name="_ngay_hien_tai_mac_dinh" value="{{$_ngay_hien_tai_mac_dinh}}" id='_ngay_hien_tai_mac_dinh'>
                                                <input type="hidden" name="_ngay_max_dang_ky" value="{{$_ngay_max_dang_ky}}" id='_ngay_max_dang_ky'>
                                                <div class="ngay_muon_mac_dinh">

                                                </div>
                                                
                                                <input type="hidden" name="date_borrow_1_hidden" id="date_borrow_1_hidden">
                                                <input type="hidden" name="gio_bd_1_hidden" id="gio_bd_1_hidden">
                                                <input type="hidden" name="gio_kt_1_hidden" id="gio_kt_1_hidden">
                                                <div class="add-date-borrow-html">

                                                </div>
                                                <div class="one-error-date-time one-error" style="padding-left: 10px; color:red"></div>
                                                
                                                <div class="row">
                                                    <div class="col-12 col-md-12">
                                                        <div class="form-group">
                                                            <label for="ly_do_muon">Lý do mượn: </label>
                                                            <textarea class="fix-form-input form-control" name="ly_do_muon" id="ly_do_muon" rows="3" placeholder="Nhập lý do ..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-12">
                                                        <div class="form-group chuc_nang_su_dung">
                                                
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-12">
                                                        <div class="many-error-message one-error-message-all text-right">
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                <div style="text-align: right">
                                                    <button type="button" class="btn btn-info add-date-borrow">Thêm ngày mượn</button>
                                                    
                                                    <button type="button" class="btn btn-success" id='submit_borrow_room'>Mượn phòng</button>
                                                    <div style="color: red; font-size:13px">
                                                        <span class="error-borrow-room"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="tab-pane" id="borrow_room_many1" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group borrow-room-many">
                                                            
                                                        </div>
                                                        <div class="many-error-message many-error-message-all text-right">
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                <div style="text-align: right">
                                                    <button type="button" data-id="{{Auth::guard('nguoi_dung')->check() ? Auth::guard('nguoi_dung')->user()->ma_vai_tro: null}}" class="btn btn-info add-borrow-many">Thêm ngày mượn</button>
                                                    
                                                    <button type="button" class="btn btn-success" id='submit_borrow_room_many'>Mượn phòng</button>
                                                    <div style="color: red; font-size:13px">
                                                        <span class="error-borrow-room-many"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif(Auth::guard('nguoi_dung')->check() && Auth::guard('nguoi_dung')->user()->email == '')
                    Tài khoản chưa cập nhật email! <br>
                    Tất cả thông báo sẽ được gửi bằng mail <br>
                    Vui lòng cập nhật mail <br>
                    <a href="{{ route('infor_user_home') }}"><i class="fas fa-sign-in-alt"></i> Chuyển sang trang thông tin cá nhân</a>
                @else
                    Bạn chưa đăng nhập! Bạn cần phải đăng nhập để đăng ký mượn phòng! <br> <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Chuyển sang trang đăng nhập</a>
                @endif
                

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-submit" data-dismiss="modal">Đóng</button>
            </div>

        </div>
    </div>
</div>
