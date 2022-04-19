function Validator(options) {
    function getParent(element, selector) {
        while (element.parentElement) {
            if (element.parentElement.matches(selector)) {
                return element.parentElement;
            }
            element = element.parentElement;
        }
    }
    var selectorRules = {};

    //Hàm xử lý validate
    function validate(inputElement, rule) {
        // var errorElement = getParent(inputElement, 'form-group');
        var errorElement = getParent(inputElement, options.formGroupSeletor).querySelector(options.errorSelector);

        var errorMessage;
        //Lấy ra tất cả rules của selector
        var rules = selectorRules[rule.selector];
        //Lập qua từng rules
        for (var i = 0; i < rules.length; i++) {
            switch (inputElement.type) {
                case 'radio':
                case 'checkbox':
                    errorMessage = rules[i](
                        formElement.querySelector(rule.selector + ':checked')
                    );
                    break;
                default:
                    errorMessage = rules[i](inputElement.value);
            }

            if (errorMessage) break;
        }
        // var btn = document.getElementById("myBtn");
        if (errorMessage) {
            // inputElement.classList.remove('success-message');
            // inputElement.classList.add('error-message');
            errorElement.innerText = errorMessage;
            errorElement.classList.remove('text-success');
            errorElement.classList.add('text-error');
            // $('button[type="submit"]').addClass('disabled');
        } else {
            // inputElement.classList.remove('error-message');
            // inputElement.classList.add('success-message');
            errorElement.innerText = '';
            errorElement.classList.remove('text-error');
            errorElement.classList.add('text-success');
            // $('button[type="submit"]').removeClass('disabled');
        }
        return !errorMessage;
    }

    // Lấy element của form
    var formElement = document.querySelector(options.form);
    if (formElement) {
        formElement.onsubmit = function (e) {
            e.preventDefault();
            var isFormValid = true;
            options.rules.forEach(function (rule) {
                var inputElement = formElement.querySelector(rule.selector);
                var isValid = validate(inputElement, rule);
                if (!isValid) {
                    isFormValid = false;
                }
            });
            if (isFormValid) {
                if (typeof options.onSubmit === 'function') {
                    //:not([disabled])
                    var enableInputs = formElement.querySelectorAll('[name]');
                    var formValues = Array.from(enableInputs).reduce(function (values, input) {
                        switch (input.type) {
                            case 'radio':
                                values[input.name] = formElement.querySelector('input[name="' + input.name + '"]:checked').value;
                                break;
                            case 'checkbox':
                                if (!input.matches(':checked')) {
                                    values[input.name] = [];
                                    return values
                                };
                                if (!Array.isArray(values[input.name])) {
                                    values[input.name] = [];
                                }
                                values[input.name].push(input.value);
                                break;
                            case 'file':
                                values[input.name] = input.files; // Thoong tin file
                                break;
                            default:
                                values[input.name] = input.value;
                        }
                        return values;
                    }, {});
                    options.onSubmit(formValues);
                } else {
                    formElement.submit();
                }
            }
        }
        //Xử lý lập qua các ...
        options.rules.forEach(function (rule) {
            //Lưu lại các rules cho mỗi input
            if (Array.isArray(selectorRules[rule.selector])) {
                selectorRules[rule.selector].push(rule.test);
            } else {
                selectorRules[rule.selector] = [rule.test];
            }

            var inputElements = formElement.querySelectorAll(rule.selector);

            Array.from(inputElements).forEach(function (inputElement) {
                if (inputElement) { // cos the bo 
                    // Xử lý trường hợp blur ra khỏi input
                    inputElement.onblur = function () {
                        validate(inputElement, rule);
                    }
                    //Xử lý trường hợp khi người dùng nhập
                    inputElement.oninput = function () {
                        var errorElement = getParent(inputElement, options.formGroupSeletor).querySelector(options.errorSelector);
                        inputElement.classList.remove('is-invalid');
                        errorElement.innerText = '';
                    }
                }
            });
        });
    }
}

Validator.isRequired = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            return value ? undefined : message || 'Vui lòng không để trống trường này!'
        }
    };
}

Validator.isImage = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            if ($('#hinh_anh').val()) {
                var fsize = $('#hinh_anh')[0].files[0].size;
                var ftype = $('#hinh_anh')[0].files[0].type;
                var fname = $('#hinh_anh')[0].files[0].name;
                switch (ftype) {
                    case 'image/png':
                    case 'image/gif':
                    case 'image/jpeg':
                    case 'image/pjpeg':
                        break;
                    default:
                        return 'File phải thuộc loại: image/png, image/gif, image/jpeg, image/pjpeg'
                }

                if (fsize > 1048576 * 100) {
                    return 'Kích thước file dưới 100M'
                }

                if (fname.indexOf(' ') > 0) {
                    return 'Vui lòng đổi tên file không chứa khoảng trống'
                }
            }

            return undefined
        }
    };
}


Validator.hasWhiteSpace = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            return value.indexOf(' ') >= 0 ? message || 'Vui lòng không để trống trường này!' : undefined
        }
    };
}

Validator.isNullOrLengthAndNoWhiteSpace = function (selector1, min, max, message) {
    return {
        selector: selector1,
        test: function (value) {
            if (!value) {
                return undefined
            } else {
                return ((value.length >= min) && (value.length <= max) && !(value.indexOf(' ') >= 0)) ? undefined : message || `Giá trị phải lớn hơn ${min} và nhỏ hơn ${max} và không khoảng trống`
            }
        }
    };
}

Validator.isEmail = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            var regex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            return regex.test(value) ? undefined : message || 'Vui lòng nhập đúng định dạng email!';
        }
    };
}

Validator.isPhone = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            var regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
            return regex.test(value) ? undefined : message || 'Vui lòng nhập đúng định dạng số điện thoại!';
        }
    };
}

Validator.minLength = function (selector, min, message) {
    return {
        selector: selector,
        test: function (value) {
            return value.length >= min ? undefined : message || `Vui lòng nhập tối thiểu ${min} ký tự`;
        }
    };
}

Validator.maxLength = function (selector, max, message) {
    return {
        selector: selector,
        test: function (value) {
            return value.length <= max ? undefined : message || `Vui lòng nhập tối đa ${max} ký tự`;
        }
    };
}

Validator.isConfirmed = function (selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function (value) {
            if (getConfirmValue().length > 0) {
                return value === getConfirmValue() ? undefined : message || 'Giá trị nhập vào không chính xác';
            } else {
                return undefined;
            }

        }
    };
}

Validator.isRequired_1 = function (selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function (value) {
            return !(value.length > 1 && getConfirmValue().length == 0) ? undefined : message || 'Giá trị nhập vào không chính xác';
        }
    };
}

Validator.isRequired_2 = function (selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function (value) {
            return !(value.length == 0 && getConfirmValue().length > 0) ? undefined : message || 'Giá trị nhập vào không chính xác';
        }
    };
}

Validator.clear = function (selector, id) {
    return {
        selector: selector,
        test: function (value) {
            var divMain = document.getElementById(id);
            if (divMain) {
                divMain.innerHTML = "";
            }
        }
    };
}

Validator.callAjax = function (selector, url, message) {
    return {
        selector: selector,
        test: function (value) {
            var _token = $('input[name="_token"]').val();
            var id = $('input[name="ma"]').val();
            if (!id) id = "";
            var respon = $.ajax({
                url: url,
                method: 'post',
                data: { name: value, _token: _token, id: id },
                async: false,
            });
            return (respon.responseText == -1) ? undefined : message || 'Giá trị nhập đã tồn tại';
        }
    };
}

Validator.callAjaxCheckYear = function (selector, url, message) {
    return {
        selector: selector,
        test: function (value) {
            var _token = $('input[name="_token"]').val();
            var nam_dau = $('input[name="nam_dau"]').val();
            var nam_sau = $('input[name="nam_sau"]').val();
            var id = $('input[name="ma"]').val();
            if (!id) {
                id = '';
            }
            if (nam_dau && nam_sau) {
                var respon = $.ajax({
                    url: url,
                    method: 'post',
                    data: { nam_sau: nam_sau, nam_dau: nam_dau, _token: _token, id: id },
                    async: false,
                });
                return (respon.responseText == -1) ? undefined : message || 'Giá trị nhập đã tồn tại';
            }
        }
    };
}

Validator.callAjaxCheckTimeOpenSemester = function (selector, url, message) {
    return {
        selector: selector,
        test: function (value) {
            var _token = $('input[name="_token"]').val();
            var ma_nam_hoc = $('select[name="ma_nam_hoc"]').val();
            var ma_hoc_ky = $('select[name="ma_hoc_ky"]').val();
            var id = $('input[name="ma"]').val();
            if (!id) {
                id = '';
            }
            if (ma_nam_hoc && ma_hoc_ky) {
                var respon = $.ajax({
                    url: url,
                    method: 'post',
                    data: { ma_hoc_ky: ma_hoc_ky, ma_nam_hoc: ma_nam_hoc, _token: _token, id: id },
                    async: false,
                });
                return (respon.responseText == -1) ? undefined : message || 'Giá trị nhập đã tồn tại';
            }
        }
    };
}

Validator.isLess = function (selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function (value) {
            if (value.length > 0 && getConfirmValue().length > 0) {
                return value < getConfirmValue() ? undefined : message || 'Giá trị phải nhỏ hơn';
            }
            return undefined
        }
    };
}

Validator.isLessOrEqual = function (selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function (value) {
            if (value.length > 0 && getConfirmValue().length > 0) {
                return value <= getConfirmValue() ? undefined : message || 'Giá trị phải nhỏ hơn hoặc bằng';
            }
            return undefined
        }
    };
}

Validator.isBig = function (selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function (value) {
            if (value.length > 0 && getConfirmValue().length > 0) {
                return value > getConfirmValue() ? undefined : message || 'Giá trị phải lớn hơn';
            }
            return undefined
        }
    };
}

Validator.isBig_number = function (selector, message, number) {
    return {
        selector: selector,
        test: function (value) {
            return value > number ? undefined : message || 'Giá trị phải lớn hơn ' + number;
        }
    };
}

Validator.isBigOrEqual = function (selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function (value) {
            if (value.length > 0 && getConfirmValue().length > 0) {
                return value >= getConfirmValue() ? undefined : message || 'Giá trị phải lớn hơn hoặc bằng';
            }
            return undefined
        }
    };
}

Validator.isLessOne = function (selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function (value) {
            if (value > 0, getConfirmValue() > 0) {
                return ((value - getConfirmValue()) == 1) ? undefined : message || 'Giá trị cách nhau 1 đơn vị';
            }
            return undefined;
        }
    };
}

Validator.isBigOne = function (selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function (value) {
            if (value > 0, getConfirmValue() > 0) {
                return ((getConfirmValue() - value) == 1) ? undefined : message || 'Giá trị cách nhau 1 đơn vị';
            }
            return undefined;
        }
    };
}

// Validator.isLessDate = function (selector, getConfirmValue, message) {
//     return {
//         selector: selector,
//         test: function (value) {
//             return value < getConfirmValue() ? undefined : message || 'Thời gian phải nhỏ hơn';
//         }
//     };
// }

// Validator.isLessDateOrEqual = function (selector, getConfirmValue, message) {
//     return {
//         selector: selector,
//         test: function (value) {
//             return value <= getConfirmValue() ? undefined : message || 'Thời gian phải nhỏ hơn hoặc bằng';
//         }
//     };
// }

// Validator.isBigDateOrEqual = function (selector, getConfirmValue, message) {
//     return {
//         selector: selector,
//         test: function (value) {
//             return value >= getConfirmValue() ? undefined : message || 'Thời gian phải lớn hơn hoặc bằng';
//         }
//     };
// }

// Validator.isBigDate = function (selector, getConfirmValue, message) {
//     return {
//         selector: selector,
//         test: function (value) {
//             return value > getConfirmValue() ? undefined : message || 'Thời gian phải lớn hơn';
//         }
//     };
// }

