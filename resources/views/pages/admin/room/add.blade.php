@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Thêm phòng</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('room') }}">Phòng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm phòng</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Thêm phòng</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('insert_room') }}" id="form-add-room" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                
                                <div class="form-group col-lg-12">
                                    <label style="color: red">Thông tin phòng:</label>

                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="ten">Tên (<span class="text-red">*</span>): </label>
                                            <input type="text" class="form-control" name="ten" id="ten" placeholder="Nhập tên ...">
                                            <div class="form-message"></div>
                                        </div>
                                        
                                        <div class="form-group col-lg-6">
                                            <label for="ma_loai_phong">Loại phòng (<span class="text-red">*</span>):</label>
                                            <select class="form-control"  name="ma_loai_phong" id="ma_loai_phong">
                                                <option value="">Chọn loại phòng</option>
        
                                                @foreach ($type_room as $key => $item)
                                                    <option value="{{ $item->ma }}">{{ $item->ten }} -> {{ $item->mo_ta }}</option>
                                                @endforeach
        
                                            </select>
                                            <div class="form-message"></div>
                                        </div>
        
                                        <div class="form-group col-lg-6">
                                            <label for="ten">Sức chứa (người): </label>
                                            <input type="number" class="form-control" name="suc_chua" id="suc_chua" min="0" value="0">
                                            <div class="form-message"></div>
                                        </div>
        
                                        <div class="form-group col-lg-6">
                                            <label for="trang_thai">Trạng thái:</label>
                                            <select class="form-control" name="trang_thai" id="trang_thai">
                                                <option value="1">Tốt</option>
                                                <option value="0">Đang sửa chữa</option>
                                            </select>
                                            <div class="form-message"></div>
                                        </div>
        
                                        <div class="form-group col-lg-6">
                                            <label for="hien_thi">Hiển thị - Ẩn phòng:</label>
                                            <select class="form-control" name="hien_thi" id="hien_thi">
                                                <option value="1">Hiển thị</option>
                                                <option value="0">Ẩn</option>
                                            </select>
                                            <div class="form-message"></div>
                                        </div>
                                        
                                        <div class="form-group col-lg-6">
                                            <label for="hinh_anh">Hình ảnh:</label>
                                            <input type="file" class="form-control" name="hinh_anh" id="hinh_anh">
                                            <div class="form-message"></div>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="mo_ta">Mô tả:</label>
                                            <textarea class="form-control" name="mo_ta" id="mo_ta" rows="3" placeholder="Nhập mô tả ..."></textarea>
                                            <div class="form-message"></div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group col-lg-12">
                                    <label style="color: red">Thiết lập vai trò mượn phòng:</label>

                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="vai_tro_admin">Admin:</label>
                                            <select class="form-control" name="1" id="vai_tro_admin">
                                                <option value="1">Mượn phòng phải được duyệt</option>
                                                <option value="0">Mượn phòng không cần duyệt</option>
                                                <option selected value="-1">Không cho phép mượn phòng</option>
                                            </select>
                                            <div class="form-message"></div>
                                        </div>
    
                                        <div class="form-group col-lg-6">
                                            <label for="vai_tro_giao_vien">Giáo viên:</label>
                                            <select class="form-control" name="2" id="vai_tro_giao_vien">
                                                <option value="1">Mượn phòng phải được duyệt</option>
                                                <option selected value="0">Mượn phòng không cần duyệt</option>
                                                <option value="-1">Không cho phép mượn phòng</option>
                                            </select>
                                            <div class="form-message"></div>
                                        </div>
    
                                        <div class="form-group col-lg-6">
                                            <label for="vai_tro_sinh_vien">Sinh viên:</label>
                                            <select class="form-control" name="3" id="vai_tro_sinh_vien">
                                                <option selected value="1">Mượn phòng phải được duyệt</option>
                                                <option value="0">Mượn phòng không cần duyệt</option>
                                                <option value="-1">Không cho phép mượn phòng</option>
                                            </select>
                                            <div class="form-message"></div>
                                        </div>
    
                                        <div class="form-group col-lg-6">
                                            <label for="vai_tro_khac">Khác:</label>
                                            <select class="form-control" name="4" id="vai_tro_khac">
                                                <option selected value="1">Mượn phòng phải được duyệt</option>
                                                <option value="0">Mượn phòng không cần duyệt</option>
                                                <option value="-1">Không cho phép mượn phòng</option>
                                            </select>
                                            <div class="form-message"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->
    </div>
    <!---Container Fluid-->
@endsection
