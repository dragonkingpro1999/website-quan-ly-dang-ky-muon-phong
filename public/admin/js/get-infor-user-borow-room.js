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
                            $('#edit-borrow-room').attr('title', `B???n ch??? c?? th??? c???p nh???t tr?????c: ${data.thoi_gian_bat_dau_muon} ${data.ngay_muon} v?? tr???ng th??i kh??c h???y`);
                            $('#delete-borrow-room').attr('title', `B???n ch??? c?? th??? h???y ????ng k?? tr?????c: ${data.thoi_gian_bat_dau_muon} ${data.ngay_muon} v?? tr???ng th??i kh??c h???y`);
                        } else {
                            $('#edit-borrow-room').attr("disabled", false);
                            $('#delete-borrow-room').attr("disabled", false);
                            $('#edit-borrow-room').attr('title', 'C???p nh???t m?????n ph??ng');
                            $('#delete-borrow-room').attr('title', 'H???y ????ng k?? m?????n ph??ng');
                        }
                    }
                }
                $('.title-borrow-room').html(`<b>CHI TI???T TH??NG TIN M?????N PH??NG:</b>`);
                $('.infor-user-borrow').html(`
                    - T??n: ${data['ten_nguoi_dung']}<br>
                    - T??i kho???n: ${data['tai_khoan_nguoi_dung']}<br>
                    - Email: ${data['email_nguoi_dung']}<br>
                    - Vai tr??: ${data['ten_vai_tro']} - ${data['mo_ta_vai_tro']}<br>
                    `);
                $('.infor-detail-borrow').html(`
                    ${data['mo_ta_phong'] ? '- Ph??ng m?????n: ' + data['ten_phong'] + ' - ' + data['mo_ta_phong'] + '<br>' : '- Ph??ng m?????n: ' + data['ten_phong'] + '<br>'}
                    - Ng??y m?????n: ${data['ngay_muon']}<br>
                    - Gi??? m?????n: ${data['thoi_gian_bat_dau_muon']} - ${data['thoi_gian_ket_thuc_muon']}<br>
                    - Ng??y ????ng k?? m?????n: ${data['ngay_tao']}<br>
                    - Tr???ng th??i m?????n: ${data['trang_thai'] == 1 ? '??ang ch??? duy???t' : ''}${data['trang_thai'] == 2 ? 'M?????n th??nh c??ng' : ''}${data['trang_thai'] == 3 ? 'H???y b???i ng?????i d??ng' : ''}${data['trang_thai'] == 4 ? 'H???y b???i nh?? qu???n tr???' : ''}<br>
                    ${data['ten_nguoi_duyet'] ? '- Th??ng tin ng?????i duy???t: ' + data['ten_nguoi_duyet'] + ' - ' + data['email_nguoi_duyet'] + '<br>' : '- Th??ng tin ng?????i duy???t: Ch??a c?? ho???c kh??ng c???n duy???t<br>'}
                    ${data['ly_do_huy'] ? '- L?? do h???y: ' + data['ly_do_huy'] + '<br>' : ''}
                    ${data['ngay_duyet'] ? '- Ng??y duy???t: ' + data['ngay_duyet'] + '<br>' : ''}
                    - L?? do m?????n: ${data['ly_do_muon'] ? data['ly_do_muon'] : 'Tr???ng'}<br>
                    - Ch???c n??ng s??? d???ng: ${data['chuc_nang_su_dung'] ? data['chuc_nang_su_dung'] : 'Tr???ng'}<br>
                    `);
                if (!data['feed_back']) {
                    $('.feed-back').html(`
                        Kh??ng c?? ph???n h???i
                    `);
                } else {
                    $('.feed-back').html(`
                    - N???i dung: ${data['feed_back']['noi_dung']}<br>
                    - Tr???ng th??i : ${data['feed_back']['da_xu_ly'] == 1 ? '??ang ch??? x??? l??' : data['feed_back']['da_xu_ly'] == 2 ? "???? x??? l??" : 'Kh??ng c???n x??? l??'}<br>
                    - Ng??y ph???n h???i: ${data['feed_back']['ngay_tao']}<br>
                    
                    ${data['feed_back']['da_xu_ly'] != 1 ?
                            '- H?????ng gi???i quy???t: ' + data['feed_back']['noi_dung_tra_loi'] + '<br>'
                            + '- Ng??y x??? l??:  ' + data['feed_back']['ngay_xu_ly'] + '<br>'
                            :
                            ''}
                    `);
                }

            },
        });
    });
});