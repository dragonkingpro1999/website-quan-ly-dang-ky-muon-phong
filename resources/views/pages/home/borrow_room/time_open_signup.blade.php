<!-- Modal -->

<div class="modal fade" id="timeOpenSignUp">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" style="color: red">Khoảng thời gian mở đăng ký mượn phòng</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body mb-2">
                @if (isset($time_open_signup) && count($time_open_signup) > 0)
                    @foreach ($time_open_signup as $item)
                        <p>- Từ ngày {{$item->thoi_gian_bat_dau}} đến ngày {{$item->thoi_gian_ket_thuc}}</p>
                    @endforeach
                        <p><i class="far fa-star"></i> Lưu ý: </p>
                        <p style="text-indent: 10px">
                            + Ngày mượn phải nằm trong khoảng thời gian ở trên
                         </p>
                        <p style="text-indent: 10px">
                           + Và ngày mượn không thể nhỏ hơn ngày hiện tại
                        </p>
                        <p style="text-indent: 10px">
                           + Và nếu mượn cùng ngày hiện tại phải mượn trước {{ $setting_borrow_room->so_gio_cach_thoi_diem_hien_tai }} tiếng
                        </p>
                        <p style="text-indent: 10px">
                            + Và mượn ít nhất {{ $setting_borrow_room->so_phut_muon_it_nhat }} phút
                         </p>
                        
                @else
                    Chưa mở thời gian đăng ký, vui lòng liên hệ quản trị viên để hỏi thông tin chi tiết
                @endif
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" style="width: 120px" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>

        </div>
    </div>
</div>