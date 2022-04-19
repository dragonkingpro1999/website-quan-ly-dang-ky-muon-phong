$(document).ready(function () {
    $('.get-infor-user-borrow-room').click(function () {
        var id = $(this).data('id');
        var _token = $('input[name="_token"]').val();
        // document.getElementById('id-borrow-room').value = id;
        $.ajax({
            url: "../ajax/get-infor-user-borrow-room",
            method: 'post',
            data: { id: id, _token: _token },
            success: function (data) {
                console.log(data)
                if ($('input[name="ma_nguoi_dung"]')) {
                    var ma_nguoi_dung = $('input[name="ma_nguoi_dung"]').val();
                    if (ma_nguoi_dung != data.ma_nguoi_dung) {
                        $('#edit-borrow-room').hide();
                        $('#delete-borrow-room').hide();
                    } else {
                        $('#edit-borrow-room').show();
                        $('#delete-borrow-room').show();
                        today = new Date();
                        year = today.getFullYear();
                        month = today.getMonth() + 1;
                        day = today.getDate();
                        hour = today.getHours();
                        minute = today.getMinutes();

                        today1 = new Date(data.temp_ngay_muon);
                        year1 = today1.getFullYear();
                        month1 = today1.getMonth() + 1;
                        day1 = today1.getDate();

                        var index = data.thoi_gian_bat_dau_muon.indexOf(':');
                        var hour1 = data.thoi_gian_bat_dau_muon.slice(0, index);
                        var minute1 = data.thoi_gian_bat_dau_muon.slice(index + 1);

                        var d = new Date(year, month, day, hour, minute, 00, 00);
                        var d1 = new Date(year1, month1, day1, hour1, minute1, 00, 00);

                        if (d > d1 || data.trang_thai == 3 || data.trang_thai == 4) {
                            $('#edit-borrow-room').attr("disabled", true);
                            $('#delete-borrow-room').attr("disabled", true);
                            $('#edit-borrow-room').attr('title', `Bạn chỉ có thể cập nhật trước: ${data.thoi_gian_bat_dau_muon} ${data.ngay_muon} và trạng thái khác hủy`);
                            $('#delete-borrow-room').attr('title', `Bạn chỉ có thể hủy đăng ký trước: ${data.thoi_gian_bat_dau_muon} ${data.ngay_muon} và trạng thái khác hủy`);
                        } else {
                            $('#edit-borrow-room').attr("disabled", false);
                            $('#delete-borrow-room').attr("disabled", false);
                            $('#edit-borrow-room').attr('title', 'Cập nhật mượn phòng');
                            $('#delete-borrow-room').attr('title', 'Hủy đăng ký mượn phòng');
                        }
                    }
                }
                $('.title-borrow-room').html(`<b>CHI TIẾT THÔNG TIN MƯỢN PHÒNG:</b>`);
                $('.infor-user-borrow').html(`
                    - Tên: ${data['ten_nguoi_dung']}<br>
                    - Tài khoản: ${data['tai_khoan_nguoi_dung']}<br>
                    - Email: ${data['email_nguoi_dung']}<br>
                    - Vai trò: ${data['ten_vai_tro']} - ${data['mo_ta_vai_tro']}<br>
                    `);
                $('.infor-detail-borrow').html(`
                    ${data['mo_ta_phong'] ? '- Phòng mượn: ' + data['ten_phong'] + ' - ' + data['mo_ta_phong'] + '<br>' : '- Phòng mượn: ' + data['ten_phong'] + '<br>'}
                    - Ngày mượn: ${data['ngay_muon']}<br>
                    - Giờ mượn: ${data['thoi_gian_bat_dau_muon']} - ${data['thoi_gian_ket_thuc_muon']}<br>
                    - Ngày đăng ký mượn: ${data['ngay_tao']}<br>
                    - Trạng thái mượn: ${data['trang_thai'] == 1 ? 'Đang chờ duyệt' : ''}${data['trang_thai'] == 2 ? 'Mượn thành công' : ''}${data['trang_thai'] == 3 ? 'Hủy bởi người dùng' : ''}${data['trang_thai'] == 4 ? 'Hủy bởi nhà quản trị' : ''}<br>
                    ${data['ten_nguoi_duyet'] ? '- Thông tin người duyệt: ' + data['ten_nguoi_duyet'] + ' - ' + data['email_nguoi_duyet'] + '<br>' : '- Thông tin người duyệt: Chưa có hoặc không cần duyệt<br>'}
                    ${data['ly_do_huy'] ? '- Lý do hủy: ' + data['ly_do_huy'] + '<br>' : ''}
                    ${data['ngay_duyet'] ? '- Ngày duyệt: ' + data['ngay_duyet'] + '<br>' : ''}
                    - Lý do mượn: ${data['ly_do_muon'] ? data['ly_do_muon'] : 'Trống'}<br>
                    - Chức năng sử dụng: ${data['chuc_nang_su_dung'] ? data['chuc_nang_su_dung'] : 'Trống'}<br>
                    `);
                if (!data['feed_back']) {
                    $('.feed-back').html(`
                        Không có phản hồi
                    `);
                } else {
                    $('.feed-back').html(`
                    - Nội dung: ${data['feed_back']['noi_dung']}<br>
                    - Trạng thái : ${data['feed_back']['da_xu_ly'] == 1 ? 'Đang chờ xử lý' : data['feed_back']['da_xu_ly'] == 2 ? "Đã xử lý" : 'Không cần xử lý'}<br>
                    - Ngày phản hồi: ${data['feed_back']['ngay_tao']}<br>
                    
                    ${data['feed_back']['da_xu_ly'] != 1 ?
                            '- Hướng giải quyết: ' + data['feed_back']['noi_dung_tra_loi'] + '<br>'
                            + '- Ngày xử lý:  ' + data['feed_back']['ngay_xu_ly'] + '<br>'
                            :
                            ''}
                    `);
                }

            },
        });
    });
});