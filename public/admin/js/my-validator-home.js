//Cập nhật user
Validator({
    form: '#form-edit-user-home',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
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
    form: '#form-change-password-user-home',
    formGroupSeletor: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('#password_old', 'Vui lòng nhập mật khẩu củ'),
        Validator.isRequired('#up_password', 'Vui lòng nhập mật khẩu mới'),
        Validator.isRequired('#re_password', 'Vui lòng nhập lại mật khẩu'),
        Validator.isNullOrLengthAndNoWhiteSpace('#up_password', 6, 20, 'Mật khẩu từ 6 đến 20 ký tự và không khoảng trống'),

        Validator.clear('#up_password', 'clear-re-password'),
        Validator.isConfirmed('#re_password', function () {
            return document.querySelector('#form-change-password-user-home #up_password').value;
        }, 'Mật khẩu nhập lại không chính xác'),
        Validator.clear('#re_password', 'clear-up-password'),
        Validator.isConfirmed('#up_password', function () {
            return document.querySelector('#form-change-password-user-home #re_password').value;
        }, 'Mật khẩu không trùng mật khẩu nhập lại'),

        Validator.callAjax('#password_old', '../../../validator/check-password-old', 'Mật khẩu củ không đúng'),
    ],
});