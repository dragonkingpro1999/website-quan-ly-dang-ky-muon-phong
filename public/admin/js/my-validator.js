
// Validator({
//     form: '#form-add-type-room',
//     formGroupSeletor: '.form-group',
//     errorSelector: '.form-message',
//     rules: [
//         Validator.minLength('#ten', 6),

//         Validator.isRequired('#tinh_thanh_pho'),
//         Validator.isRequired('input[name="gioi_tinh"]'),
//         Validator.isRequired('input[name="true_false"]'),
//         Validator.isEmail('#ten'),
//         Validator.isConfirmed('#ten', function () {
//             return document.querySelector('#form-add-type-room #mo_ta').value;
//         }, 'Mật khẩu nhập lại không chính xác'), /
//     ],
//     onSubmit: function (data) {
//         
//     }
// });

//Validator loại phòng
Validator({
    form: '#form-add-type-room',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#ten', 'Vui lòng nhập tên'),
        Validator.minLength('#ten', 1),
        Validator.maxLength('#ten', 50),
        Validator.callAjax('#ten', '../../validator/check-name-type-room-is-unique', 'Tên đã tồn tại'), //Kiểm tra tên có là unique
        Validator.maxLength('#mo_ta', 200),
    ],
});

Validator({
    form: '#form-edit-type-room',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#ten', 'Vui lòng nhập tên'),
        Validator.minLength('#ten', 1),
        Validator.maxLength('#ten', 50),
        Validator.callAjax('#ten', '../../../validator/check-name-type-room-is-unique', 'Tên đã tồn tại'), //Kiểm tra tên có là unique
        Validator.maxLength('#mo_ta', 200),
    ],
});

//Validator chức năng
Validator({
    form: '#form-add-uses',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#ten', 'Vui lòng nhập tên'),
        Validator.minLength('#ten', 1),
        Validator.maxLength('#ten', 50),
        Validator.callAjax('#ten', '../../validator/check-name-uses-is-unique', 'Tên đã tồn tại'), //Kiểm tra tên có là unique
        Validator.maxLength('#mo_ta', 200),
    ],
});

Validator({
    form: '#form-edit-uses',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#ten', 'Vui lòng nhập tên'),
        Validator.minLength('#ten', 1),
        Validator.maxLength('#ten', 50),
        Validator.callAjax('#ten', '../../../validator/check-name-uses-is-unique', 'Tên đã tồn tại'), //Kiểm tra tên có là unique
        Validator.maxLength('#mo_ta', 200),
    ],
});



//Validator thiết bị
Validator({
    form: '#form-add-device',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#ten', 'Vui lòng nhập tên'),
        Validator.minLength('#ten', 1),
        Validator.maxLength('#ten', 50),
        Validator.callAjax('#ten', '../../validator/check-name-device-is-unique', 'Tên đã tồn tại'), //Kiểm tra tên có là unique
        Validator.maxLength('#mo_ta', 200),
    ],
});

Validator({
    form: '#form-edit-device',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#ten', 'Vui lòng nhập tên'),
        Validator.minLength('#ten', 1),
        Validator.maxLength('#ten', 50),
        Validator.callAjax('#ten', '../../../validator/check-name-device-is-unique', 'Tên đã tồn tại'), //Kiểm tra tên có là unique
        Validator.maxLength('#mo_ta', 200),
    ],
});

//Validator phòng
Validator({
    form: '#form-add-room',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#ten', 'Vui lòng nhập tên'),
        Validator.minLength('#ten', 1),
        Validator.maxLength('#ten', 50),
        Validator.isRequired('#ma_loai_phong', 'Vui lòng chọn loại phòng'),
        Validator.isImage('#hinh_anh'),
        Validator.callAjax('#ten', '../../validator/check-name-room-is-unique', 'Tên đã tồn tại'), //Kiểm tra tên có là unique
        Validator.maxLength('#mo_ta', 200),
    ],
});

Validator({
    form: '#form-edit-room',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#ten', 'Vui lòng nhập tên'),
        Validator.minLength('#ten', 1),
        Validator.maxLength('#ten', 50),
        Validator.isRequired('#ma_loai_phong', 'Vui lòng chọn loại phòng'),
        Validator.isImage('#hinh_anh'),
        Validator.callAjax('#ten', '../../../validator/check-name-room-is-unique', 'Tên đã tồn tại'), //Kiểm tra tên có là unique
        Validator.maxLength('#mo_ta', 200),
    ],
});

// Sửa thiết bị phòng
Validator({
    form: '#form-update-device-room',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#update_so_luong', 'Vui nhập số lượng'),
        Validator.isRequired('#update_so_luong_hu', 'Vui nhập số lượng hư'),

        Validator.clear('#update_so_luong', 'clear-update_so_luong_hu'),
        Validator.isLessOrEqual('#update_so_luong_hu', function () {
            return document.querySelector('#form-update-device-room #update_so_luong').value;
        }, 'Số lượng hư phải bé hơn số lượng'),

        Validator.clear('#update_so_luong_hu', 'clear-update_so_luong'),
        Validator.isBigOrEqual('#update_so_luong', function () {
            return document.querySelector('#form-update-device-room #update_so_luong_hu').value;
        }, 'Số lượng phải lớn hơn số lượng hư'),
    ],
});

//Validator manager user
Validator({
    form: '#form-add-manager-user',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#tai_khoan', 'Vui lòng nhập tài khoản'),
        Validator.hasWhiteSpace('#tai_khoan', 'Tài khoản không được khoản trắng'),
        Validator.minLength('#tai_khoan', 1),
        Validator.maxLength('#tai_khoan', 50),
        Validator.callAjax('#tai_khoan', '../../validator/check-username-is-unique', 'Tài khoản đã tồn tại'), //Kiểm tra tên có là unique

        Validator.isRequired('#ma_vai_tro', 'Vui lòng chọn vai trò'),

        Validator.isRequired('#password', 'Vui lòng nhập mật khẩu'),
        Validator.hasWhiteSpace('#password', 'Mật khẩu không được khoản trắng'),
        Validator.minLength('#password', 6),
        Validator.maxLength('#password', 20),

        Validator.isRequired('#re_password', 'Vui lòng nhập lại mật khẩu'),
        Validator.hasWhiteSpace('#re_password', 'Mật khẩu nhập lại không được khoản trắng'),
        Validator.minLength('#re_password', 6),
        Validator.maxLength('#re_password', 20),

        Validator.clear('#password', 'clear-re_password'),
        Validator.isConfirmed('#re_password', function () {
            return document.querySelector('#form-add-manager-user #password').value;
        }, 'Mật khẩu nhập lại không chính xác'),

        Validator.clear('#re_password', 'clear-password'),
        Validator.isConfirmed('#password', function () {
            return document.querySelector('#form-add-manager-user #re_password').value;
        }, 'Mật khẩu không giống mật khẩu nhập lại'),

        Validator.isRequired('#ten', 'Vui lòng nhập tên'),
        Validator.minLength('#ten', 1),
        Validator.maxLength('#ten', 50),

        Validator.isEmail('#email'),
        Validator.isPhone('#so_dien_thoai'),

        Validator.callAjax('#email', '../../../validator/check-email-is-unique', 'Email đã tồn tại'),
        Validator.callAjax('#so_dien_thoai', '../../../validator/check-phone-is-unique', 'Số điện thoại đã tồn tại'),

    ],
});

Validator({
    form: '#form-edit-manager-user',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [

        Validator.isRequired('#ma_vai_tro', 'Vui lòng chọn vai trò'),

        Validator.isRequired('#ten', 'Vui lòng nhập tên'),
        Validator.minLength('#ten', 1),
        Validator.maxLength('#ten', 50),

        Validator.isEmail('#email'),
        Validator.isPhone('#so_dien_thoai'),
        Validator.callAjax('#email', '../../../validator/check-email-is-unique', 'Email đã tồn tại'),
        Validator.callAjax('#so_dien_thoai', '../../../validator/check-phone-is-unique', 'Số điện thoại đã tồn tại'),
    ],
});

Validator({
    form: '#form-change-password-manager-user',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#up_password', 'Vui lòng nhập mật khẩu'),
        Validator.hasWhiteSpace('#up_password', 'Mật khẩu không được khoản trắng'),
        Validator.minLength('#up_password', 6),
        Validator.maxLength('#up_password', 20),

        Validator.isRequired('#re_password', 'Vui lòng nhập lại mật khẩu'),
        Validator.hasWhiteSpace('#re_password', 'Mật khẩu nhập lại không được khoản trắng'),
        Validator.minLength('#re_password', 6),
        Validator.maxLength('#re_password', 20),

        Validator.clear('#up_password', 'clear-re_password'),
        Validator.isConfirmed('#re_password', function () {
            return document.querySelector('#form-change-password-manager-user #up_password').value;
        }, 'Mật khẩu nhập lại không chính xác'),

        Validator.clear('#re_password', 'clear-up_password'),
        Validator.isConfirmed('#up_password', function () {
            return document.querySelector('#form-change-password-manager-user #re_password').value;
        }, 'Mật khẩu không giống mật khẩu nhập lại'),


    ],
});

// thêm quyền phòng
Validator({
    form: '#form-add-role-room',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#ma_nguoi_dung', 'Vui lòng chọn tài khoản'),
    ],
});
// Xóa nhiều quyền phòng
Validator({
    form: '#form-deletes-role-room',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#ma_nguoi_dung_xoa', 'Vui lòng chọn tài khoản'),
    ],
});

// thêm thiết bị phòng
Validator({
    form: '#form-add-device-room',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#ma_thiet_bi', 'Vui lòng chọn thiết bị'),
    ],
});
// Xóa nhiều thiết bị phòng
Validator({
    form: '#form-deletes-device-room',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#ma_thiet_bi_xoa', 'Vui lòng chọn thiết bị'),
    ],
});

// thêm chức năng phòng
Validator({
    form: '#form-add-uses-room',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#ma_chuc_nang', 'Vui lòng chọn chức năng'),
    ],
});

// Xóa nhiều chức năng phòng
Validator({
    form: '#form-deletes-uses-room',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#ma_chuc_nang_xoa', 'Vui lòng chọn chức năng'),
    ],
});

//Validator form lọc ngày ở trang chủ
Validator({
    form: '#form-search-date-admin',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#date_start', 'Vui lòng chọn ngày'),
        Validator.isRequired('#date_end', 'Vui lòng chọn ngày'),

        Validator.clear('#date_start', 'clear-date-end'),
        Validator.isBigOrEqual('#date_end', function () {
            return document.querySelector('#form-search-date-admin #date_start').value;
        }, 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu'),

        Validator.clear('#date_end', 'clear-date-start'),
        Validator.isLessOrEqual('#date_start', function () {
            return document.querySelector('#form-search-date-admin #date_end').value;
        }, 'Ngày bắt đầu phải nhỏ hơn hoặc bằng ngày kết thúc'),
    ],
});

//Validator form liên hệ
Validator({
    form: '#form-edit-contact',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#noi_dung_nguoi_phan_hoi', 'Vui lòng nhập nội dung'),
    ],
});

//Validator form liên hệ
Validator({
    form: '#destroy_borrow_room',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#ly_do_huy', 'Vui lòng nhập lý do không cho mượn'),
    ],
});

//Validator học kỳ
Validator({
    form: '#form-add-semester',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#ten', 'Vui lòng nhập tên'),
        Validator.minLength('#ten', 1),
        Validator.maxLength('#ten', 50),
        Validator.callAjax('#ten', '../../../validator/check-name-semester-is-unique', 'Tên đã tồn tại'), //Kiểm tra tên có là unique
        Validator.maxLength('#mo_ta', 200),
    ],
});

Validator({
    form: '#form-edit-semester',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#ten', 'Vui lòng nhập tên'),
        Validator.minLength('#ten', 1),
        Validator.maxLength('#ten', 50),
        Validator.callAjax('#ten', '../../../../validator/check-name-semester-is-unique', 'Tên đã tồn tại'), //Kiểm tra tên có là unique
        Validator.maxLength('#mo_ta', 200),
    ],
});

//Validator năm học
Validator({
    form: '#form-add-school-year',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#nam_dau', 'Vui lòng nhập năm đầu'),
        Validator.isRequired('#nam_sau', 'Vui lòng nhập năm sau'),

        Validator.clear('#nam_dau', 'clear_nam_sau'),
        Validator.isLessOne('#nam_sau', function () {
            return document.querySelector('#form-add-school-year #nam_dau').value;
        }, 'Năm sau phải lớn hơn năm đầu 1 đơn vị'),
        Validator.clear('#nam_sau', 'clear_nam_dau'),
        Validator.isBigOne('#nam_dau', function () {
            return document.querySelector('#form-add-school-year #nam_sau').value;
        }, 'Năm đầu phải bé hơn năm sau 1 đơn vị'),

        Validator.callAjaxCheckYear('#nam_sau', '../../../validator/check-school-year-is-unique', 'Năm học đã tồn tại'), //Kiểm tra tên có là unique
    ],
});

Validator({
    form: '#form-edit-school-year',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#nam_dau', 'Vui lòng nhập năm đầu'),
        Validator.isRequired('#nam_sau', 'Vui lòng nhập năm sau'),

        Validator.clear('#nam_dau', 'clear_nam_sau'),
        Validator.isLessOne('#nam_sau', function () {
            return document.querySelector('#form-edit-school-year #nam_dau').value;
        }, 'Năm sau phải lớn hơn năm đầu 1 đơn vị'),
        Validator.clear('#nam_sau', 'clear_nam_dau'),
        Validator.isBigOne('#nam_dau', function () {
            return document.querySelector('#form-edit-school-year #nam_sau').value;
        }, 'Năm đầu phải bé hơn năm sau 1 đơn vị'),

        Validator.callAjaxCheckYear('#nam_sau', '../../../../validator/check-school-year-is-unique', 'Năm học đã tồn tại'),
    ],
});

//Validator Tgian mở học kỳ
Validator({
    form: '#form-add-time-open-semester',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#ma_nam_hoc', 'Vui lòng chọn năm học'),
        Validator.isRequired('#ma_hoc_ky', 'Vui lòng chọn học kỳ'),
        Validator.isRequired('#thoi_gian_bat_dau', 'Vui lòng chọn/nhập thời gian'),
        Validator.isRequired('#thoi_gian_ket_thuc', 'Vui lòng chọn/nhập thời gian'),

        Validator.clear('#thoi_gian_bat_dau', 'clear_thoi_gian_ket_thuc'),
        Validator.isBig('#thoi_gian_ket_thuc', function () {
            return document.querySelector('#form-add-time-open-semester #thoi_gian_bat_dau').value;
        }, 'Thời gian kết thúc phải lớn hơn thời gian bắt đầu'),

        Validator.clear('#thoi_gian_ket_thuc', 'clear_thoi_gian_bat_dau'),
        Validator.isLess('#thoi_gian_bat_dau', function () {
            return document.querySelector('#form-add-time-open-semester #thoi_gian_ket_thuc').value;
        }, 'Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc'),

        Validator.clear('#ma_nam_hoc', 'clear-ma-hoc-ky'),
        Validator.callAjaxCheckTimeOpenSemester('#ma_hoc_ky', '../../../../validator/check-school-year-and-semester-is-unique', 'Năm học, học kỳ đã tồn tại'),
    ],
});

Validator({
    form: '#form-edit-time-open-semester',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#ma_nam_hoc', 'Vui lòng chọn năm học'),
        Validator.isRequired('#ma_hoc_ky', 'Vui lòng chọn học kỳ'),
        Validator.isRequired('#thoi_gian_bat_dau', 'Vui lòng chọn/nhập thời gian'),
        Validator.isRequired('#thoi_gian_ket_thuc', 'Vui lòng chọn/nhập thời gian'),

        Validator.clear('#thoi_gian_bat_dau', 'clear_thoi_gian_ket_thuc'),
        Validator.isBig('#thoi_gian_ket_thuc', function () {
            return document.querySelector('#form-edit-time-open-semester #thoi_gian_bat_dau').value;
        }, 'Thời gian kết thúc phải lớn hơn thời gian bắt đầu'),

        Validator.clear('#thoi_gian_ket_thuc', 'clear_thoi_gian_bat_dau'),
        Validator.isLess('#thoi_gian_bat_dau', function () {
            return document.querySelector('#form-edit-time-open-semester #thoi_gian_ket_thuc').value;
        }, 'Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc'),

        Validator.clear('#ma_nam_hoc', 'clear-ma-hoc-ky'),
        Validator.callAjaxCheckTimeOpenSemester('#ma_hoc_ky', '../../../../../validator/check-school-year-and-semester-is-unique', 'Năm học, học kỳ đã tồn tại'),
    ],
});

//Validator đơn vị
Validator({
    form: '#form-add-unit',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#ten', 'Vui lòng nhập tên'),
        Validator.minLength('#ten', 1),
        Validator.maxLength('#ten', 50),
        Validator.callAjax('#ten', '../../../../validator/check-name-unit-is-unique', 'Tên đã tồn tại'), //Kiểm tra tên có là unique
        Validator.maxLength('#mo_ta', 200),
    ],
});

Validator({
    form: '#form-edit-unit',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#ten', 'Vui lòng nhập tên'),
        Validator.minLength('#ten', 1),
        Validator.maxLength('#ten', 50),
        Validator.callAjax('#ten', '../../../../../validator/check-name-unit-is-unique', 'Tên đã tồn tại'), //Kiểm tra tên có là unique
        Validator.maxLength('#mo_ta', 200),
    ],
});

// Giới thiệu
Validator({
    form: '#form-edit-introduce',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#tieu_de', 'Vui lòng nhập tiêu đề'),
        // Validator.isRequired('#noi_dung', 'Vui lòng nhập nội dung'),
    ],
});

// Cài đặt liên hệ
Validator({
    form: '#form-edit-contact-setting',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#dia_chi', 'Vui lòng nhập địa chỉ'),
        Validator.isRequired('#email', 'Vui lòng nhập email'),
        Validator.isRequired('#so_dien_thoai', 'Vui lòng nhập số điện thoại'),
        Validator.isEmail('#email'),
        Validator.isPhone('#so_dien_thoai', 'Số điện thoại không đúng định dạng'),
    ],
});


// Cài đặt Băng rôn
Validator({
    form: '#form-edit-banner',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#tieu_de', 'Vui lòng nhập tiêu đề băng rôn'),
        Validator.isImage('#hinh_anh'),
    ],
});


//Cài đặt Thanh trượt
Validator({
    form: '#form-add-slider',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#hinh_anh', 'Vui lòng chọn ảnh'),
        Validator.isRequired('#tieu_de', 'Vui lòng nhập tiêu đề thanh trượt'),
        Validator.isImage('#hinh_anh'),
    ],
});

Validator({
    form: '#form-edit-slider',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#tieu_de', 'Vui lòng nhập tiêu đề thanh trượt'),
        Validator.isImage('#hinh_anh'),
    ],
});

//Cài đặt thời gian mượn
Validator({
    form: '#form-edit-setting_borrow_room',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#so_gio_cach_thoi_diem_hien_tai', 'Vui lòng không bỏ trống'),
        Validator.isRequired('#so_phut_muon_it_nhat', 'Vui lòng không bỏ trống'),
        Validator.isBig_number('#so_gio_cach_thoi_diem_hien_tai', 'Giá trị lớn hơn 1', 1),
        Validator.isBig_number('#so_phut_muon_it_nhat', 'Giá trị lớn hơn 10', 10),
    ],
});


//Cài đặt email
Validator({
    form: '#form-edit-setting_mail',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#email', 'Vui lòng không bỏ trống'),
        Validator.isEmail('#email'),
        Validator.isRequired('#password', 'Vui lòng không bỏ trống'),
        Validator.isRequired('#re_password', 'Vui lòng không bỏ trống'),
        Validator.isRequired('#ten', 'Vui lòng không bỏ trống'),

        Validator.clear('#password', 'clear-re_password'),
        Validator.isConfirmed('#re_password', function () {
            return document.querySelector('#form-edit-setting_mail #password').value;
        }, 'Mật khẩu nhập lại không chính xác'),

        Validator.clear('#re_password', 'clear-password'),
        Validator.isConfirmed('#password', function () {
            return document.querySelector('#form-edit-setting_mail #re_password').value;
        }, 'Mật khẩu không giống mật khẩu nhập lại'),
    ],
});


//Cài đặt thời gian mượn
Validator({
    form: '#form-add-news',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#hinh_anh', 'Vui lòng không bỏ trống'),
        Validator.isImage('#hinh_anh'),
        Validator.isRequired('#tieu_de', 'Vui lòng không bỏ trống'),
        // Validator.isRequired('#noi_dung', 'Vui lòng không bỏ trống'),
    ],
});

Validator({
    form: '#form-edit-news',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isImage('#hinh_anh'),
        Validator.isRequired('#tieu_de', 'Vui lòng không bỏ trống'),
        // Validator.isRequired('#noi_dung', 'Vui lòng không bỏ trống'),
    ],
});


//Cài đặt ldap
Validator({
    form: '#form-edit-setting_ldap',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#hosts', 'Vui lòng không bỏ trống'),
        Validator.isRequired('#port', 'Vui lòng không bỏ trống'),
        Validator.isRequired('#version', 'Vui lòng không bỏ trống'),
        Validator.isRequired('#timeout', 'Vui lòng không bỏ trống'),
    ],
});

//feed_back
Validator({
    form: '#form-edit-feed_back',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#da_xu_ly', 'Vui lòng chọn hành động'),
    ],
});
