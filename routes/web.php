<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TypeRoomController;
use App\Http\Controllers\UsesController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UsesRoomController;
use App\Http\Controllers\DeviceRoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TimeOpenSemesterController;
use App\Http\Controllers\HistorySignupBorrowRoom;
use App\Http\Controllers\ManagerUserController;
use App\Http\Controllers\DecentralizationController;
use App\Http\Controllers\RoleRoomController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\IntroduceController;
use App\Http\Controllers\ContactSettingController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SettingBorrowRoomController;
use App\Http\Controllers\SettingMailController;
use App\Http\Controllers\SettingLdapController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FeedBackController;


use App\Http\Controllers\CheckSignUpController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BorrowRoomController;


use App\Http\Controllers\Auth\LoginLogoutController;

use Illuminate\Support\Facades\Session;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Router thay đổi menu tại nút change_sidebar_toggle_top
Route::get('/change_sidebar_toggle_top', function () {
    $_toggled = Session::get('_toggled');
    if (!$_toggled) {
        Session::put('_toggled', true);
    } else {
        Session::put('_toggled', false);
    }
    return redirect()->back();
})->name('change_sidebar_toggle_top');



//Login - logout
Route::get('/', function () {
    return redirect()->route('home');
});

// Route::get('/ldap', [LoginLogoutController::class, 'ldap'])->name('check_ldap');

Route::get('dang-nhap', function () {
    return view('login');
})->name('login')->middleware('CheckedLogin');

Route::prefix('auth')->group(function () {
    Route::post('/login', [LoginLogoutController::class, 'login'])->name('check_login');
    Route::get('/logout', [LoginLogoutController::class, 'logout'])->name('logout');
});
//End Login - logout



//Admin
Route::middleware('CheckLogin', 'CheckRoleAdmin')->group(function () {
    Route::prefix('admin')->group(function () {

        Route::get('trang-chu', [AdminController::class, 'index'])->name('home_admin');
        Route::post('trang-chu', [AdminController::class, 'index'])->name('change_date');
        Route::get('trang-chu/tat-ca-muon-phong', [AdminController::class, 'all_borrow_room'])->name('all_borrow_room');
        Route::post('ajax/get-chart-admin', [AdminController::class, 'chart'])->name('chart_admin');
        Route::get('trang-chu/excel_borrow_room_all', [AdminController::class, 'excel_borrow_room_all'])->name('home_admin_excel_borrow_room_all');
        Route::get('trang-chu/excel_borrow_room_pendding', [AdminController::class, 'excel_borrow_room_pendding'])->name('home_admin_excel_borrow_room_pendding');
        Route::get('trang-chu/excel_borrow_room_success', [AdminController::class, 'excel_borrow_room_success'])->name('home_admin_excel_borrow_room_success');
        Route::get('trang-chu/excel_borrow_room_destroy_by_customer', [AdminController::class, 'excel_borrow_room_destroy_by_customer'])->name('home_admin_excel_borrow_room_destroy_by_customer');
        Route::get('trang-chu/excel_borrow_room_destroy_by_administrator', [AdminController::class, 'excel_borrow_room_destroy_by_administrator'])->name('home_admin_excel_borrow_room_destroy_by_administrator');
        Route::get('trang-chu/excel_borrow_room_frequency_of_room_use', [AdminController::class, 'excel_borrow_room_frequency_of_room_use'])->name('home_admin_excel_borrow_room_frequency_of_room_use');

        // Route của bảng loại phòng
        Route::prefix('loai-phong')->group(function () {
            Route::get('/', [TypeRoomController::class, 'index'])->name('type_room');
            Route::get('/them-loai-phong', [TypeRoomController::class, 'add'])->name('add_type_room');
            Route::post('/insert-type-room', [TypeRoomController::class, 'insert'])->name('insert_type_room');
            Route::post('/delete-type-room', [TypeRoomController::class, 'delete'])->name('delete_type_room');
            Route::get('/cap-nhat-loai-phong/{id}', [TypeRoomController::class, 'edit'])->name('edit_type_room');
            Route::post('/update-type-room', [TypeRoomController::class, 'update'])->name('update_type_room');
        });

        // Route của bảng tin tức
        Route::prefix('tin-tuc')->group(function () {
            Route::get('/', [NewsController::class, 'index'])->name('news');
            Route::get('/them-tin-tuc', [NewsController::class, 'add'])->name('add_news');
            Route::post('/insert-news', [NewsController::class, 'insert'])->name('insert_news');
            Route::post('/delete-news', [NewsController::class, 'delete'])->name('delete_news');
            Route::get('/cap-nhat-tin-tuc/{id}', [NewsController::class, 'edit'])->name('edit_news');
            Route::post('/update-news', [NewsController::class, 'update'])->name('update_news');
        });


        //Route của bảng chức năng
        Route::prefix('chuc-nang')->group(function () {
            Route::get('/', [UsesController::class, 'index'])->name('uses');
            Route::get('/them-chuc-nang', [UsesController::class, 'add'])->name('add_uses');
            Route::post('/insert-uses', [UsesController::class, 'insert'])->name('insert_uses');
            Route::post('/delete-uses', [UsesController::class, 'delete'])->name('delete_uses');
            Route::get('/cap-nhat-chuc-nang/{id}', [UsesController::class, 'edit'])->name('edit_uses');
            Route::post('/update-uses', [UsesController::class, 'update'])->name('update_uses');
        });


        Route::prefix('cai-dat')->group(function () {
            //Route của bảng giới thiệu
            Route::get('/gioi-thieu', [IntroduceController::class, 'edit'])->name('edit_introduce');
            Route::post('/update-introduce', [IntroduceController::class, 'update'])->name('update_introduce');

            //Route của bảng setting mail
            Route::get('/mail', [SettingMailController::class, 'edit'])->name('edit_setting_mail');
            Route::post('/update-setting_mail', [SettingMailController::class, 'update'])->name('update_setting_mail');

            //Route của bảng setting ldap
            Route::get('/ldap', [SettingLdapController::class, 'edit'])->name('edit_setting_ldap');
            Route::post('/update-setting_ldap', [SettingLdapController::class, 'update'])->name('update_setting_ldap');

            //Route của bảng cài đặt thời gian mượn phòng
            Route::get('/thoi-gian-muon-phong', [SettingBorrowRoomController::class, 'edit'])->name('edit_setting_borrow_room');
            Route::post('/update-setting-borrow-room', [SettingBorrowRoomController::class, 'update'])->name('update_setting_borrow_room');

            //Route của bảng lien hệ
            Route::get('/lien-he', [ContactSettingController::class, 'edit'])->name('edit_contact_setting');
            Route::post('/update-contact_setting', [ContactSettingController::class, 'update'])->name('update_contact_setting');

            //Route của bảng băng ron
            Route::get('/bang-ron', [BannerController::class, 'edit'])->name('edit_banner');
            Route::post('/update-banner', [BannerController::class, 'update'])->name('update_banner');

            //Route của bảng thanh trượt
            Route::prefix('thanh-truot')->group(function () {
                Route::get('/', [SliderController::class, 'index'])->name('slider');
                Route::get('/them-thanh-truot', [SliderController::class, 'add'])->name('add_slider');
                Route::post('/insert-slider', [SliderController::class, 'insert'])->name('insert_slider');
                Route::post('/delete-slider', [SliderController::class, 'delete'])->name('delete_slider');
                Route::get('/cap-nhat-thanh-truot/{id}', [SliderController::class, 'edit'])->name('edit_slider');
                Route::post('/update-slider', [SliderController::class, 'update'])->name('update_slider');
            });
        });

        //Route của bảng thiết bị
        Route::prefix('thiet-bi')->group(function () {
            Route::get('/', [DeviceController::class, 'index'])->name('device');
            Route::get('/them-thiet-bi', [DeviceController::class, 'add'])->name('add_device');
            Route::post('/insert-device', [DeviceController::class, 'insert'])->name('insert_device');
            Route::post('/delete-device', [DeviceController::class, 'delete'])->name('delete_device');
            Route::get('/cap-nhat-thiet-bi/{id}', [DeviceController::class, 'edit'])->name('edit_device');
            Route::post('/update-device', [DeviceController::class, 'update'])->name('update_device');
        });

        //Route của bảng phòng
        Route::prefix('phong')->group(function () {
            Route::get('/', [RoomController::class, 'index'])->name('room');
            Route::get('/them-phong', [RoomController::class, 'add'])->name('add_room');
            Route::post('/insert-room', [RoomController::class, 'insert'])->name('insert_room');
            Route::post('/delete-room', [RoomController::class, 'delete'])->name('delete_room');
            Route::get('/cap-nhat-phong/{id}', [RoomController::class, 'edit'])->name('edit_room');
            Route::post('/update-room', [RoomController::class, 'update'])->name('update_room');

            Route::prefix('chuc-nang-phong')->group(function () {
                Route::get('/{id}', [UsesRoomController::class, 'index'])->name('uses_room');
                Route::post('/delete-uses-room', [UsesRoomController::class, 'delete'])->name('delete_uses_room');
                Route::post('/deletes-uses-room', [UsesRoomController::class, 'deletes'])->name('deletes_uses_room');
                Route::post('/insert-uses-room', [UsesRoomController::class, 'insert'])->name('insert_uses_room');
            });



            Route::prefix('thiet-bi-phong')->group(function () {
                Route::get('/{id}', [DeviceRoomController::class, 'index'])->name('device_room');
                Route::post('/delete-device-room', [DeviceRoomController::class, 'delete'])->name('delete_device_room');
                Route::post('/deletes-device-room', [DeviceRoomController::class, 'deletes'])->name('deletes_device_room');
                Route::post('/insert-device-room', [DeviceRoomController::class, 'insert'])->name('insert_device_room');
                Route::post('/update-device-room', [DeviceRoomController::class, 'update'])->name('update_device_room');
                Route::post('ajax/get-device-room-by-id', [DeviceRoomController::class, 'edit'])->name('ajax_get_device_room_by_id');
            });

            // Route::prefix('quyen-phong')->group(function () {
            //     Route::get('/{id}', [RoleRoomController::class, 'index'])->name('role_room');
            //     Route::post('/delete-role-room', [RoleRoomController::class, 'delete'])->name('delete_role_room');
            //     Route::post('/deletes-role-room', [RoleRoomController::class, 'deletes'])->name('deletes_role_room');
            //     Route::post('/insert-role-room', [RoleRoomController::class, 'insert'])->name('insert_role_room');
            // });
        });

        //Route của thời gian mở đăng ký mượn phòng
        Route::prefix('thoi-gian-mo-hoc-ky')->group(function () {

            Route::prefix('nam-hoc')->group(function () {
                Route::get('/', [SchoolYearController::class, 'index'])->name('school_year');
                Route::get('/them-nam-hoc', [SchoolYearController::class, 'add'])->name('add_school_year');
                Route::post('/insert-school-year', [SchoolYearController::class, 'insert'])->name('insert_school_year');
                Route::post('/delete-school-year', [SchoolYearController::class, 'delete'])->name('delete_school_year');
                Route::get('/cap-nhat-nam-hoc/{id}', [SchoolYearController::class, 'edit'])->name('edit_school_year');
                Route::post('/update-school-year', [SchoolYearController::class, 'update'])->name('update_school_year');
            });

            Route::prefix('hoc-ky')->group(function () {
                Route::get('/', [SemesterController::class, 'index'])->name('semester');
                Route::get('/them-hoc-ky', [SemesterController::class, 'add'])->name('add_semester');
                Route::post('/insert-semester', [SemesterController::class, 'insert'])->name('insert_semester');
                Route::post('/delete-semester', [SemesterController::class, 'delete'])->name('delete_semester');
                Route::get('/cap-nhat-hoc-ky/{id}', [SemesterController::class, 'edit'])->name('edit_semester');
                Route::post('/update-semester', [SemesterController::class, 'update'])->name('update_semester');
            });

            Route::get('/', [TimeOpenSemesterController::class, 'index'])->name('time_open_semester');
            Route::get('/them-thoi-gian-mo-lich', [TimeOpenSemesterController::class, 'add'])->name('add_time_open_semester');
            Route::post('/insert-time-open-semester', [TimeOpenSemesterController::class, 'insert'])->name('insert_time_open_semester');
            Route::post('/delete-time-open-semester', [TimeOpenSemesterController::class, 'delete'])->name('delete_time_open_semester');
            Route::get('/cap-nhat/{id}', [TimeOpenSemesterController::class, 'edit'])->name('edit_time_open_semester');
            Route::post('/update-time-open-calander', [TimeOpenSemesterController::class, 'update'])->name('update_time_open_semester');
            Route::get('/change-status/{id}', [TimeOpenSemesterController::class, 'status'])->name('change_status_time_open_semester');
            Route::get('/change-default/{id}', [TimeOpenSemesterController::class, 'default'])->name('change_default_time_open_semester');
        });

        // Route của quản lý tài khoản
        Route::prefix('quan-ly-tai-khoan')->group(function () {
            Route::get('/', [ManagerUserController::class, 'index'])->name('manager_user');
            Route::get('/them-tai-khoan', [ManagerUserController::class, 'add'])->name('add_manager_user');
            Route::post('/insert-manager-user', [ManagerUserController::class, 'insert'])->name('insert_manager_user');
            Route::post('/delete-manager-user', [ManagerUserController::class, 'delete'])->name('delete_manager_user');
            Route::get('/cap-nhat-tai-khoan/{id}', [ManagerUserController::class, 'edit'])->name('edit_manager_user');
            Route::get('/cap-nhat-tai-khoan/{id}/thiet-lap-lai-mat-khau', [ManagerUserController::class, 'change_password'])->name('change_password_manager_user');
            Route::post('/up-change-password-manager-user', [ManagerUserController::class, 'up_change_password'])->name('up_change_password_manager_user');
            Route::post('/update-manager-user', [ManagerUserController::class, 'update'])->name('update_manager_user');
            Route::get('/quyen-tai-khoan/{id}', [DecentralizationController::class, 'index'])->name('decentralization');
            Route::post('/update-decentralization', [DecentralizationController::class, 'update'])->name('update_decentralization');

            Route::prefix('don-vi')->group(function () {
                Route::get('/', [UnitController::class, 'index'])->name('unit');
                Route::get('/them-don-vi', [UnitController::class, 'add'])->name('add_unit');
                Route::post('/insert-unit', [UnitController::class, 'insert'])->name('insert_unit');
                Route::post('/delete-unit', [UnitController::class, 'delete'])->name('delete_unit');
                Route::get('/cap-nhat-don-vi/{id}', [UnitController::class, 'edit'])->name('edit_unit');
                Route::post('/update-unit', [UnitController::class, 'update'])->name('update_unit');
            });
        });

        //Route của thời gian mở đăng ký mượn phòng
        Route::prefix('duyet-dang-ky')->group(function () {
            Route::get('/cho-duyet', [CheckSignUpController::class, 'index'])->name('check_signup_borrow_room');
            Route::get('/thong-tin-muon/{id}', [CheckSignUpController::class, 'infor_signup_borrow_room'])->name('infor_signup_borrow_room');
            Route::get('/tat-ca', [CheckSignUpController::class, 'all'])->name('checked_signup_borrow_room');
            Route::post('/tat-ca', [CheckSignUpController::class, 'all'])->name('change_date_checked_signup_borrow_room');
            Route::post('/check-borrow-room', [CheckSignUpController::class, 'check_borrow_room'])->name('check_borrow_room');
            Route::post('/destroy-borrow-room', [CheckSignUpController::class, 'destroy_borrow_room'])->name('destroy_borrow_room');
        });

        //Route của trả lời liên hệ
        Route::prefix('phan-hoi-lien-he')->group(function () {
            Route::get('/', [ContactController::class, 'index'])->name('contact');
            Route::get('/{id}', [ContactController::class, 'edit'])->name('edit_contact');
            Route::post('/update-contact', [ContactController::class, 'update'])->name('update_contact');
        });

        //Route của phản hồi phòng
        Route::prefix('phan-hoi-phong')->group(function () {
            Route::get('/', [FeedBackController::class, 'index'])->name('feed_back');
            Route::get('/{id}', [FeedBackController::class, 'edit'])->name('edit_feed_back');
            Route::post('/update-feed_back', [FeedBackController::class, 'update'])->name('update_feed_back');
        });
    });
});



/// validator
Route::prefix('validator')->group(function () {
    Route::post('/check-name-type-room-is-unique', [TypeRoomController::class, 'check_name_is_unique']);
    Route::post('/check-name-uses-is-unique', [UsesController::class, 'check_name_is_unique']);
    Route::post('/check-name-device-is-unique', [DeviceController::class, 'check_name_is_unique']);
    Route::post('/check-name-room-is-unique', [RoomController::class, 'check_name_is_unique']);
    Route::post('/check-username-is-unique', [ManagerUserController::class, 'check_username_is_unique']);
    Route::post('/check-name-unit-is-unique', [UnitController::class, 'check_name_is_unique']);

    Route::post('/check-school-year-is-unique', [SchoolYearController::class, 'check_school_year_is_unique']);
    Route::post('/check-name-semester-is-unique', [SemesterController::class, 'check_name_is_unique']);
    Route::post('/check-school-year-and-semester-is-unique', [TimeOpenSemesterController::class, 'check_school_year__and_semester_is_unique']);


    Route::post('/check-email-is-unique', [UserController::class, 'check_email_is_unique']);
    Route::post('/check-phone-is-unique', [UserController::class, 'check_phone_is_unique']);
    Route::post('/check-password-old', [UserController::class, 'check_password_old']);
});


// Trang chủ home
Route::get('trang-chu', [HomeController::class, 'index'])->name('home');
Route::get('trang-chu/tin-tuc', [HomeController::class, 'index_news'])->name('home_news');
Route::get('trang-chu/tin-tuc/{id}', [HomeController::class, 'index_news_info'])->name('home_news_info');
// Route::get('data_pdf', [HomeController::class, 'data_pdf'])->name('data_pdf');
Route::get('download_pdf', [HomeController::class, 'download_pdf'])->name('download_pdf');


Route::get('lich-muon-phong', [HomeController::class, 'index_borrow_room'])->name('home_calendar');

Route::get('lich-muon-phong-lt', [HomeController::class, 'index_borrow_room_lt'])->name('home_calendar_lt');
Route::get('lich-muon-phong-th', [HomeController::class, 'index_borrow_room_th'])->name('home_calendar_th');

Route::post('lich-muon-phong', [HomeController::class, 'index_borrow_room'])->name('paging_date_search_room');

Route::put('lich-muon-phong', [HomeController::class, 'index_borrow_room'])->name('search_room');

Route::get('send-mail', [HomeController::class, 'send_mail'])->name('send_mail');

Route::post('ajax/get-infor-room', [RoomController::class, 'get_infor'])->name('ajax_get_infor_room');
Route::post('ajax/get-infor-user-borrow-room', [BorrowRoomController::class, 'get_infor_user_borrow_room'])->name('ajax_get_infor_user_borrow_room');
Route::post('ajax/get-room-by-role-borrow', [RoomController::class, 'get_room_by_role_borrow'])->name('ajax_get_room_by_role_borrow');
Route::post('ajax/get-uses-room', [UsesRoomController::class, 'get_uses_room'])->name('ajax_get_uses_room');
Route::post('ajax/signup-borrow-room-one', [BorrowRoomController::class, 'signup_borrow_room_one'])->name('ajax_signup_borrow_room_one');
Route::post('ajax/signup-borrow-room-many', [BorrowRoomController::class, 'signup_borrow_room_many'])->name('ajax_signup_borrow_room_many');
Route::post('ajax/delete-borrow-room', [BorrowRoomController::class, 'delete_borrow_room'])->name('ajax_delete_borrow_room');
Route::post('ajax/get-infor-update-borrow-room', [BorrowRoomController::class, 'get_infor_update'])->name('ajax_get_infor_update_room');
Route::post('ajax/update-borrow-room', [BorrowRoomController::class, 'update_borrow_room'])->name('ajax_update_borrow_room');
Route::post('ajax/add-contact', [ContactController::class, 'insert'])->name('ajax_add_contact');
Route::post('ajax/add-feed-back-room', [FeedBackController::class, 'add_feed_back_room'])->name('ajax_add_feed_back_room');
Route::post('ajax/edit-feed-back-room', [FeedBackController::class, 'edit_feed_back_room'])->name('ajax_edit_feed_back_room');
Route::post('ajax/delete-feed-back-room', [FeedBackController::class, 'delete_feed_back_room'])->name('ajax_delete_feed_back_room');

Route::middleware('CheckLogin')->group(function () {

    //Thông tin tài khoản
    Route::get('/thong-tin-tai-khoan', [UserController::class, 'infor'])->name('infor_user_home');
    Route::get('/thong-tin-tai-khoan/cap-nhat', [UserController::class, 'edit'])->name('edit_user_home');
    Route::get('/thong-tin-tai-khoan/doi-mat-khau', [UserController::class, 'change_password'])->name('change_password_user_home');
    Route::post('/update-password-user-home', [UserController::class, 'up_change_password'])->name('up_change_password_user_home');
    Route::post('/update-user-home', [UserController::class, 'update'])->name('update_user_home');

    //Lịch sử đăng ký mượn phòng
    Route::prefix('lich-su-dang-ky-muon-phong')->group(function () {
        Route::get('/', [HistorySignupBorrowRoom::class, 'index'])->name('history_signup_borrow_room');
    });

    Route::get('/quyen-quan-tri-vien', [UserController::class, 'role'])->name('role_user_home');
});
