<div class="modal fade" id="informationUserBorrowRoom">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title title-borrow-room" style="color: red" id="informationRoomLabel"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            

            <div class="modal-body mb-2">
                <div class="container">
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs nav-tabs-neutral justify-content-center" role="tablist" data-background-color="orange">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#borrow_room_one99" role="tab">Người mượn</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab"  href="#borrow_room_many88" role="tab">Chi tiết mượn</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab"  href="#borrow_room_many77" role="tab">Phản hồi</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="card-body">
                                <!-- Tab panes -->
                                <div class="tab-content text-center">
                                    <div class="tab-pane active" id="borrow_room_one99" role="tabpanel">
                                        <!-- Modal Header -->

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <h6>Người mượn:</h6>
                                            <div class="infor-user-borrow ml-3"></div>
                                            {{-- <br>
                                            <h6>Chi tiết mượn:</h6>
                                            <div class="infor-detail-borrow ml-3"></div>
                                            <br> --}}
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <input type="hidden" value="" name="id" id="id-borrow-room">
                                            
                                            <button type="button" style="width: 120px" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                            
                                            @if (Auth::guard('nguoi_dung')->check())
                                                <input type="hidden" value="{{ Auth::guard('nguoi_dung')->user()->ma }}" name="ma_nguoi_dung">
                                            @endif

                                            <button type="button" style="width: 120px" data-toggle="modal" data-target="#editUserBorrowRoom" class="btn btn-warning edit-borrow-room" id="edit-borrow-room">Cập nhật</button>
                                            <button type="button" style="width: 120px" class="btn btn-danger delete-borrow-room" id="delete-borrow-room">Hủy đăng ký</button> 
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="tab-pane" id="borrow_room_many88" role="tabpanel">
                                        <div class="modal-body">
                                            {{-- <h6>Người mượn:</h6>
                                            <div class="infor-user-borrow ml-3"></div>
                                            <br> --}}
                                            <h6>Chi tiết mượn:</h6>
                                            <div class="infor-detail-borrow ml-3"></div>
                                            {{-- <br> --}}
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <input type="hidden" value="" name="id" id="id-borrow-room">
                                            
                                            <button type="button" style="width: 120px" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                            
                                            @if (Auth::guard('nguoi_dung')->check())
                                                <input type="hidden" value="{{ Auth::guard('nguoi_dung')->user()->ma }}" name="ma_nguoi_dung">
                                            @endif

                                            <button type="button" style="width: 120px" data-toggle="modal" data-target="#editUserBorrowRoom" class="btn btn-warning edit-borrow-room" id="edit-borrow-room">Cập nhật</button>
                                            <button type="button" style="width: 120px" class="btn btn-danger delete-borrow-room" id="delete-borrow-room">Hủy đăng ký</button> 
                                            
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="borrow_room_many77" role="tabpanel">
                                        <div class="modal-body">
                                            <h6>Phản hồi về phòng tại thời điểm sử dụng:</h6>
                                            <div class="infor-feed-back ml-3"></div>
                                            {{-- <br>
                                            <h6>Chi tiết mượn:</h6>
                                            <div class="infor-detail-borrow ml-3"></div>
                                            <br> --}}
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" value="" name="content_feedback_hide" id="content_feedback_hide">
                                            <button type="button" style="width: 150px" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                            <button type="button" style="width: 150px" class="btn btn-info add-feed-back">Thêm phản hồi</button>
                                            <button type="button" style="width: 150px" class="btn btn-warning edit-feed-back">Sửa phản hồi</button>
                                            <button type="button" style="width: 150px" class="btn btn-danger delete-feed-back">Xóa phản hồi</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="editUserBorrowRoom">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <input type="hidden" value="{{Auth::guard('nguoi_dung')->check() ? Auth::guard('nguoi_dung')->user()->ma_vai_tro: null}}" id="ma_vai_tro">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" style="color: red" id="editUserBorrowRoomLabel">Cập nhật mượn phòng</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <h6>Người mượn:</h6>
                <div class="infor-user-borrow ml-3"></div>
                <br>
                <h6>Chi tiết mượn:</h6>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group update-borrow-room-by-room-id">
                            
                        </div>
                    </div>
                </div>
                <div class="update_ngay_muon_mac_dinh">

                </div>
                <div class="update_error_time" style="padding-left: 10px; color:red">

                </div>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-group">
                            <label for="update_ly_do_muon">Lý do mượn: </label>
                            <textarea class="fix-form-input form-control" name="update_ly_do_muon" id="update_ly_do_muon" rows="3" placeholder="Nhập lý do ..."></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="update_room_chose" value="0" id="update_room_chose">
                    <div class="col-12 col-md-12">
                        <div class="form-group update_chuc_nang_su_dung">
                            
                        </div>
                    </div>
                    
                </div>
                <br>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" style="width: 120px" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button style="width: 120px" type="button" class="btn btn-warning update-borrow-room">Cập nhật</button>
            </div>

        </div>
    </div>
</div>
