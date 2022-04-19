@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cài đặt giới thiệu</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cài đặt giới thiệu</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Cài đặt giới thiệu</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update_introduce') }}" id="form-edit-introduce">
                            @csrf
                            <input type="hidden" name="ma" value="{{ $edit->ma }}">
                            
                            <div class="form-group">
                                <label for="tieu_de">Tiêu đề (<span class="text-red">*</span>):</label>
                                <textarea class="form-control" name="tieu_de" id="tieu_de" rows="2" >{{ $edit->tieu_de }}</textarea>
                                <div class="form-message"></div>
                            </div>

                            <div class="form-group">
                                <label for="noi_dung">Nội dung (<span class="text-red">*</span>):</label>
                                <textarea class="form-control" name="noi_dung" id="noi_dung" rows="3" >{{ $edit->noi_dung }}</textarea>
                                <div class="form-message"></div>
                            </div>

                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->
    </div>
    <!---Container Fluid-->
@endsection

@section('script')
<script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('noi_dung');
</script>
@endsection
