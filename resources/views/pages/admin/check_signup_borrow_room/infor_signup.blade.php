@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Thông tin mượn phòng</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('check_signup_borrow_room') }}">Chờ duyệt</a> - <a href="{{ route('checked_signup_borrow_room') }}">Tất cả</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thông tin</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Thông tin mượn phòng</h6>
                    </div>
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <h4>Thông tin người mượn:</h4>
                                <hr>
                                <div class="form-group">
                                    <label>Tên: </label> {{ $info->ten_nguoi_dung}}
                                </div>
                                <div class="form-group">
                                    <label>Tài khoản: </label> {{ $info->tai_khoan_nguoi_dung}}
                                </div>
                                <div class="form-group">
                                    <label>Email: </label> {{ $info->email_nguoi_dung}}
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại: </label> {{ $info->so_dien_thoai_nguoi_dung}}
                                </div>
                                <div class="form-group">
                                    <label>Vai trò: </label> {{ $info->ten_vai_tro }} -> {{ $info->mo_ta_vai_tro }}
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <h4>Chi tiết mượn phòng:</h4> 
                                <hr>
                                <div class="form-group">
                                    <label>Phòng mượn: </label> {{ $info->ten_phong }} -> {{ $info->mo_ta_phong }}
                                </div>
                                <div class="form-group">
                                    <label>Ngày mượn: </label> {{ $info->ngay_muon }}
                                </div>
                                <div class="form-group">
                                    <label>Giờ mượn: </label> {{ $info->thoi_gian_bat_dau_muon }} - {{ $info->thoi_gian_ket_thuc_muon }}
                                </div>
                                <div class="form-group">
                                    <label>Ngày đăng ký mượn: </label> {{ $info->ngay_tao }}
                                </div>
                                <div class="form-group">
                                    <label>Trạng thái mượn: </label> {{ $info->trang_thai == 1 ? 'Đang chờ duyệt' : ''}}{{ $info->trang_thai == 2 ? 'Mượn thành công' : ''}}{{ $info->trang_thai == 3 ? 'Hủy bởi người dùng' : ''}}{{ $info->trang_thai == 4 ? 'Hủy bởi nhà quản trị' : ''}}
                                </div>
                                <div class="form-group">
                                    <label>Lý do mượn: </label> {{ $info->ly_do_muon ? $info->ly_do_muon : 'Trống'}}
                                </div>
                                <div class="form-group">
                                    <label>Chức năng sử dụng: </label> {{ $info->chuc_nang_su_dung ? $info->chuc_nang_su_dung : 'Trống'}}
                                </div>
                            </div>
                            @if ($info->ma_nguoi_duyet)
                            <div class="col-12 col-lg-6">
                                <h4>Thông tin người duyệt / hủy:</h4>
                                <hr>
                                <div class="form-group">
                                    <label>Tên: </label> {{ $info->ten_nguoi_duyet }}
                                </div>
                                <div class="form-group">
                                    <label>Tài khoản: </label> {{ $info->tai_khoan_nguoi_duyet }}
                                </div>
                                <div class="form-group">
                                    <label>Email: </label> {{ $info->email_nguoi_duyet }}
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại: </label> {{ $info->so_dien_thoai_nguoi_duyet }}
                                </div>
                                @if ($info->ly_do_huy)
                                <div class="form-group">
                                    <label>Lý do hủy: </label> {{ $info->ly_do_huy }}
                                </div>
                                @endif
                            </div>
                            @endif
                        </div>
                           
                        @if ($info->trang_thai == 1)
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="{{ route('check_borrow_room') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $info->ma }}">
                                    <button type="submit" onclick="return confirm('Duyệt cho mượn')" class="btn btn-primary" style="float: left; width: 200px">Duyệt cho mượn</button>
                                </form>
                            </div>
                            <div class="col-lg-6" >
                                

                                <button type="button" 
                                    class="btn btn-danger" 
                                    style="float: right; width: 200px"
                                    data-toggle="modal" 
                                    data-target="#exampleModal"
                                    id="#myBtn"
                                    >Không cho phép mượn</button>
                            </div>
                        </div>
                            
                            
                        @endif 
                
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->
    </div>
    <!---Container Fluid-->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Không cho mượn phòng</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('destroy_borrow_room') }}" method="POST" id="destroy_borrow_room">
            @csrf
            <input type="hidden" name="id" value="{{ $info->ma }}">
            <div class="modal-body">
                <div class="form-group col-lg-12">
                    <label for="ly_do_huy">Lý do không cho mượn:</label>
                    <textarea class="form-control" name="ly_do_huy" id="ly_do_huy" rows="3" placeholder="Nhập lý do không cho mượn ..."></textarea>
                    <div class="form-message"></div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Đóng</button>
            <button type="submit" class="btn btn-primary" >Không cho mượn và mail thông báo</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection
