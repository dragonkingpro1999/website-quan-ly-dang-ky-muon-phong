$(document).ready(function () {
    $('.get-infor-user-borrow-room').click(function () {
        var id = $(this).data('id');
        var _token = $('input[name="_token"]').val();
        document.getElementById('id-borrow-room').value = id;
        $.ajax({
            url: "ajax/get-infor-user-borrow-room",
            method: 'post',
            data: { id: id, _token: _token },
            success: function (data) {
                if (data['feed_back']) {
                    $('#content_feedback_hide').val(data['feed_back']['noi_dung']);
                } else {
                    $('#content_feedback_hide').val("");
                }
                if ($('input[name="ma_nguoi_dung"]')) {
                    var ma_nguoi_dung = $('input[name="ma_nguoi_dung"]').val();
                    if (ma_nguoi_dung != data.ma_nguoi_dung) {
                        $('.edit-borrow-room').hide();
                        $('.delete-borrow-room').hide();
                        $('.add-feed-back').hide();
                        $('.edit-feed-back').hide();
                        $('.delete-feed-back').hide();
                    } else {
                        $('.edit-borrow-room').show();
                        $('.delete-borrow-room').show();
                        $('.add-feed-back').show();
                        $('.edit-feed-back').show();
                        $('.delete-feed-back').show();
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

                        var index2 = data.thoi_gian_ket_thuc_muon.indexOf(':');
                        var hour2 = data.thoi_gian_ket_thuc_muon.slice(0, index2);
                        var minute2 = data.thoi_gian_ket_thuc_muon.slice(index2 + 1);

                        var d2 = new Date(year1, month1, day1, hour2, minute2, 00, 00);

                        if (d > d1 || data.trang_thai == 3 || data.trang_thai == 4) {
                            $('.edit-borrow-room').attr("disabled", true);
                            $('.delete-borrow-room').attr("disabled", true);
                            $('.edit-borrow-room').attr('title', `Bạn chỉ có thể cập nhật trước: ${data.thoi_gian_bat_dau_muon} ${data.ngay_muon} và trạng thái khác hủy`);
                            $('.delete-borrow-room').attr('title', `Bạn chỉ có thể hủy đăng ký trước: ${data.thoi_gian_bat_dau_muon} ${data.ngay_muon} và trạng thái khác hủy`);
                        } else {
                            $('.edit-borrow-room').attr("disabled", false);
                            $('.delete-borrow-room').attr("disabled", false);
                            $('.edit-borrow-room').attr('title', 'Cập nhật mượn phòng');
                            $('.delete-borrow-room').attr('title', 'Hủy đăng ký mượn phòng');
                        }

                        if (d1 <= d && d <= d2 && data.trang_thai != 3 && data.trang_thai != 4 && data.trang_thai != 1) {
                            $('.add-feed-back').attr("disabled", false);
                            $('.edit-feed-back').attr("disabled", false);
                            $('.delete-feed-back').attr("disabled", false);
                            if (data['feed_back']) {
                                $('.add-feed-back').attr("disabled", true);
                                $('.add-feed-back').attr('title', 'Bạn chỉ có thể thêm 1 lần vui lòng chọn cập nhật');
                            } else {
                                $('.edit-feed-back').attr("disabled", true);
                                $('.delete-feed-back').attr("disabled", true);
                                $('.edit-feed-back').attr('title', 'Chưa có nội dung sửa. Vui lòng thêm');
                                $('.delete-feed-back').attr('title', 'Chưa có nội dung xóa. Vui lòng thêm');
                            }
                        } else {
                            $('.add-feed-back').attr("disabled", true);
                            $('.edit-feed-back').attr("disabled", true);
                            $('.delete-feed-back').attr("disabled", true);
                            $('.add-feed-back').attr('title', `Chỉ có thể thêm khi đang sử dụng phòng (${data['ngay_muon']} ${data['thoi_gian_bat_dau_muon']} - ${data['thoi_gian_ket_thuc_muon']}) và trạng thái phải là mượn thành công`);
                            $('.edit-feed-back').attr('title', `Chỉ có thể sửa khi đang sử dụng phòng (${data['ngay_muon']} ${data['thoi_gian_bat_dau_muon']} - ${data['thoi_gian_ket_thuc_muon']}) và trạng thái phải là mượn thành công`);
                            $('.delete-feed-back').attr('title', `Chỉ có thể xóa khi đang sử dụng phòng (${data['ngay_muon']} ${data['thoi_gian_bat_dau_muon']} - ${data['thoi_gian_ket_thuc_muon']}) và trạng thái phải là mượn thành công`);
                        }


                    }
                }
                $('.title-borrow-room').html(`<b>CHI TIẾT THÔNG TIN MƯỢN PHÒNG:</b>`);
                $('.infor-user-borrow').html(`
                    - Tên: ${data['ten_nguoi_dung']}<br>
                    
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
                if (data['feed_back'] != null) {
                    $('.infor-feed-back').html(`
                        - Nội dung: ${data['feed_back']['noi_dung']}<br>
                        - Trạng thái : ${data['feed_back']['da_xu_ly'] == 1 ? 'Đang chờ xử lý' : data['feed_back']['da_xu_ly'] == 2 ? "Đã xử lý" : 'Không cần xử lý'}<br>
                        - Ngày phản hồi: ${data['feed_back']['ngay_tao']}<br>
                        
                        ${data['feed_back']['da_xu_ly'] != 1 ?
                            '- Hướng giải quyết: ' + data['feed_back']['noi_dung_tra_loi'] + '<br>'
                            + '- Ngày xử lý:  ' + data['feed_back']['ngay_xu_ly'] + '<br>'
                            :
                            ''}
                    `);
                } else {
                    $('.infor-feed-back').html(`
                        Chưa có phản hồi
                    `);
                }


            },
        });
    });
    $('.edit-borrow-room').click(function () {
        var id = $('#id-borrow-room').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "ajax/get-infor-update-borrow-room",
            method: 'post',
            data: { id: id, _token: _token },
            success: function (data100) {

                $("textarea#update_ly_do_muon").val(data100.ly_do_muon);
                var ma_vai_tro = $('#ma_vai_tro').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "ajax/get-room-by-role-borrow",
                    method: 'post',
                    data: { id: ma_vai_tro, _token: _token },
                    success: function (data) {

                        rooms = data.room;
                        role_borrow_rooms = data.role_borrow_room;

                        option_room = '<label for="update_ma_phong">Phòng (<span style="color: red">*</span>):</label>';
                        option_room += '<select class="fix-form-input form-control update-select-uses-room" name="update_ma_phong" id="update_ma_phong">';

                        room_chose = $('#room_chose').val();

                        rooms.forEach(room => {
                            role_borrow_rooms.forEach(role => {
                                if (room.ma == role.ma_phong) {
                                    if (role.dang_ky_duyet == -1 || room.trang_thai == false) {
                                        if (role.dang_ky_duyet == -1) {
                                            option_room += `<option disabled value="${room.ma}">${room.ten} - ${room.mo_ta} (bị chặn quyền mượn)</option>`;
                                        } else if (room.trang_thai == false) {
                                            option_room += `<option disabled value="${room.ma}">${room.ten} - ${room.mo_ta} (phòng đang sữa chữa)</option>`;
                                        }

                                    } else {
                                        if (data100.ma_phong == room.ma) {
                                            option_room += `<option selected value="${room.ma}">${room.ten} - ${room.mo_ta}</option>`;
                                        } else {
                                            option_room += `<option value="${room.ma}">${room.ten} - ${room.mo_ta}</option>`;
                                        }

                                    }
                                }
                            });

                        });
                        option_room += '</select>';
                        option_room += '<div class="error-room" style="padding-left: 10px; color:red"></div>';
                        $('.update-borrow-room-by-room-id').html(option_room);

                        $('.update-select-uses-room').click(function () {
                            val = $(this).val();
                            document.getElementById('update_room_chose').value = val;
                            var _token = $('input[name="_token"]').val();
                            if (val) {
                                $.ajax({
                                    url: "ajax/get-uses-room",
                                    method: 'post',
                                    data: { id: val, _token: _token },
                                    success: function (data) {

                                        html = `
                                            
                                                <label for="update_ma_thiet_bi">Mượn phòng sử dụng chức năng gì:</label>
                                                <select class="select2-multiple form-control " style="width: 100% !important" name="update_ma_thiet_bi[]" multiple="multiple" id="update_ma_thiet_bi">
                                        `;

                                        data.forEach(uses => {
                                            html += `
                                                    <option selected value="${uses.ma_chuc_nang}">${uses.ten_chuc_nang}</option>
                                                `;

                                        });
                                        if (data.length == 0) {
                                            html += `
                                                    <option value="0" selected >Chức năng rỗng</option>
                                                `;
                                        }

                                        html += `
                                                </select>
                                                <div class="form-message"></div>
                                            
                                        `;
                                        $('.update_chuc_nang_su_dung').html(html);
                                        $('.select2-multiple').select2();

                                    },
                                });
                            }
                        });
                    },
                });

                $.ajax({
                    url: "ajax/get-uses-room",
                    method: 'post',
                    data: { id: data100.ma_phong, _token: _token },
                    success: function (data) {
                        if (data100.chuc_nang) {
                            chuc_nang = data100.chuc_nang.split(',');
                        } else {
                            chuc_nang = [];
                        }

                        html = `
        
                                <label for="update_ma_thiet_bi">Mượn phòng sử dụng chức năng gì:</label>
                                <select class="select2-multiple form-control " style="width: 100% !important" name="update_ma_thiet_bi[]" multiple="multiple" id="update_ma_thiet_bi">
                        `;

                        data.forEach(uses => {
                            temp = -999;
                            for (let i = 0; i < chuc_nang.length; i++) {
                                if (uses.ma_chuc_nang == chuc_nang[i]) {
                                    html += `
                                        <option selected value="${uses.ma_chuc_nang}">${uses.ten_chuc_nang}</option>
                                    `;
                                    temp = chuc_nang[i];
                                    break;
                                }
                            }
                            if (temp != uses.ma_chuc_nang) {
                                html += `
                                    <option value="${uses.ma_chuc_nang}">${uses.ten_chuc_nang}</option>
                                `;
                            }
                        });
                        if (data.length == 0) {
                            html += `
                                    <option value="0" selected >Chức năng rỗng</option>
                                `;
                        }

                        html += `
                                </select>
                                <div class="form-message"></div>
        
                        `;
                        $('.update_chuc_nang_su_dung').html(html);
                        $('.select2-multiple').select2();
                    },
                });

                _ngay_hien_tai_mac_dinh = $('#_ngay_hien_tai_mac_dinh').val();
                _ngay_max_dang_ky = $('#_ngay_max_dang_ky').val();
                date_borrow_1_hidden = $('#date_borrow_1_hidden').val();
                gio_bd_1_hidden = $('#gio_bd_1_hidden').val();
                gio_kt_1_hidden = $('#gio_kt_1_hidden').val();

                html1 = `
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="update_ngay_muon">Ngày mượn: (<span style="color: red">*</span>)</label>
                            <input type="date" class="fix-form-input form-control date_borrow_1_hidden" value="${data100.ngay_muon}" name="update_ngay_muon" id="update_ngay_muon" min="${_ngay_hien_tai_mac_dinh}" max="${_ngay_max_dang_ky}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="update_thoi_gian_bat_dau_muon">Thời gian bắt đầu mượn: (<span style="color: red">*</span>)</label>
                            <input class="fix-form-input form-control gio_bd_1_hidden" value="${data100.thoi_gian_bat_dau_muon}" type="time" id="update_thoi_gian_bat_dau_muon" name="update_thoi_gian_bat_dau_muon" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="update_thoi_gian_ket_thuc_muon">Thời gian kết thúc mượn: (<span style="color: red">*</span>)</label>
                            <input class="fix-form-input form-control gio_kt_1_hidden" value="${data100.thoi_gian_ket_thuc_muon}" type="time" id="update_thoi_gian_ket_thuc_muon" name="update_thoi_gian_ket_thuc_muon" required>
                        </div>
                    </div>
                    
                </div>
                `;
                $('.update_ngay_muon_mac_dinh').html(html1);

            }
        });



    });

    $('.delete-borrow-room').click(function () {
        var cf = prompt("Bạn có thật sự muốn hủy đăng ký không? Hủy không thể khôi phục! Nhập lý do hủy của bạn: ");

        if (cf) {
            var id = $('#id-borrow-room').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "ajax/delete-borrow-room",
                method: 'post',
                data: {
                    id: id,
                    ly_do_huy: cf,
                    _token: _token
                },
                success: function (data) {

                    if (data.status == 'success') {
                        swal(
                            "Thành công!",
                            data.message,
                            "success",
                            {
                                buttons: {
                                    cancel: "Đóng",
                                },
                            }
                        ).then((value) => {
                            switch (value) {
                                default:
                                    window.location.reload();
                            }
                        });
                    } else if (data.status == 'error_time') {
                        swal(
                            "Thất bại!",
                            data.message,
                            "error",
                            {
                                buttons: {
                                    cancel: "Đóng",
                                },
                            }
                        ).then((value) => {
                            switch (value) {
                                default:
                                    window.location.reload();
                            }
                        });;
                    } else {
                        swal(
                            "Thất bại!",
                            data.message,
                            "error",
                            {
                                buttons: {
                                    cancel: "Đóng",
                                },
                            }
                        );
                    }
                },
            });
        } else if (cf == "") {
            alert("Hủy thất bại! Lý do hủy không được trống!");
        }

    });

    $('.update-borrow-room').click(function () {
        $('.update_error_time').html(' ');
        var ma = $('#id-borrow-room').val();
        var _token = $('input[name="_token"]').val();
        var ma_phong = $('#update_ma_phong').val();
        var ngay_muon = $('#update_ngay_muon').val();
        var thoi_gian_bat_dau_muon = $('#update_thoi_gian_bat_dau_muon').val();
        var thoi_gian_ket_thuc_muon = $('#update_thoi_gian_ket_thuc_muon').val();
        var ly_do_muon = $('#update_ly_do_muon').val();
        var ma_thiet_bi = $('#update_ma_thiet_bi').val();

        $.ajax({
            url: "ajax/update-borrow-room",
            method: 'post',
            data: {
                ma: ma,
                ma_phong: ma_phong,
                ngay_muon: ngay_muon,
                thoi_gian_bat_dau_muon: thoi_gian_bat_dau_muon,
                thoi_gian_ket_thuc_muon: thoi_gian_ket_thuc_muon,
                ly_do_muon: ly_do_muon,
                chuc_nang: ma_thiet_bi,
                _token: _token
            },
            success: function (data) {
                if (data.status == 'error_time') {
                    $('.update_error_time').html(data.message + ': ' + data.ngay_muon + ' ' + data.thoi_gian_bd + '-' + data.thoi_gian_kt)
                } else if (data.status == 'error_time_lt') {
                    $('.update_error_time').html(data.message)
                } else if (data.status == 'error_time_today') {
                    $('.update_error_time').html(data.message)
                } else if (data.status == 'error_time_null') {
                    $('.update_error_time').html(data.message)
                } else if (data.status == 'success') {
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
                } else {
                    swal(
                        "Thất bại!",
                        data.message,
                        "error",
                        {
                            buttons: {
                                cancel: "Đóng",
                            },
                        }
                    );
                }
            },
        });
    });

    $('.add-feed-back').click(function () {
        var cf = prompt("Nhập nội dung phản hồi: ");

        if (cf) {
            var id = $('#id-borrow-room').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "ajax/add-feed-back-room",
                method: 'post',
                data: {
                    id: id,
                    noi_dung: cf,
                    _token: _token
                },
                success: function (data) {
                    console.log(data)
                    if (data.status == 'success') {
                        swal(
                            "Thành công!",
                            data.message,
                            "success",
                            {
                                buttons: {
                                    cancel: "Đóng",
                                },
                            }
                        ).then((value) => {
                            switch (value) {
                                default:
                                    window.location.reload();
                            }
                        });
                    } else {
                        swal(
                            "Thất bại!",
                            data.message,
                            "error",
                            {
                                buttons: {
                                    cancel: "Đóng",
                                },
                            }
                        );
                    }
                },
            });
        } else if (cf == "") {
            alert("Phản hồi thất bại! Nội dung không được trống!");
        }

    });

    $('.delete-feed-back').click(function () {
        var cf = confirm("Bạn có chắc chắn muốn xóa không?");

        if (cf) {
            var id = $('#id-borrow-room').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "ajax/delete-feed-back-room",
                method: 'post',
                data: {
                    id: id,
                    noi_dung: cf,
                    _token: _token
                },
                success: function (data) {
                    console.log(data)
                    if (data.status == 'success') {
                        swal(
                            "Thành công!",
                            data.message,
                            "success",
                            {
                                buttons: {
                                    cancel: "Đóng",
                                },
                            }
                        ).then((value) => {
                            switch (value) {
                                default:
                                    window.location.reload();
                            }
                        });
                    } else {
                        swal(
                            "Thất bại!",
                            data.message,
                            "error",
                            {
                                buttons: {
                                    cancel: "Đóng",
                                },
                            }
                        );
                    }
                },
            });
        }
    });

    $('.edit-feed-back').click(function () {
        var cf = prompt("Nhập nội dung phản hồi: ", $('#content_feedback_hide').val());

        if (cf) {
            var id = $('#id-borrow-room').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "ajax/edit-feed-back-room",
                method: 'post',
                data: {
                    id: id,
                    noi_dung: cf,
                    _token: _token
                },
                success: function (data) {
                    console.log(data)
                    if (data.status == 'success') {
                        swal(
                            "Thành công!",
                            data.message,
                            "success",
                            {
                                buttons: {
                                    cancel: "Đóng",
                                },
                            }
                        ).then((value) => {
                            switch (value) {
                                default:
                                    window.location.reload();
                            }
                        });
                    } else {
                        swal(
                            "Thất bại!",
                            data.message,
                            "error",
                            {
                                buttons: {
                                    cancel: "Đóng",
                                },
                            }
                        );
                    }
                },
            });
        } else if (cf == "") {
            alert("Phản hồi thất bại! Nội dung không được trống!");
        }

    });
});