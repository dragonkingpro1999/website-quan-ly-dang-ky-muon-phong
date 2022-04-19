@extends('admin')
@section('content_admin')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Quyền tài khoản</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home_admin') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('manager_user') }}">Tài khoản</a></li>
                <li class="breadcrumb-item active" aria-current="page">Quyền tài khoản</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Quyền tài khoản: {{ $nguoi_dung->tai_khoan }} - {{ $nguoi_dung->ten }}</h6>
                    </div>
                    <div class="card-body">
                        @if ($nguoi_dung->ma != 1)
                        <form method="POST" action="{{ route('update_decentralization') }}" id="form-manager-decentralization">
                            @csrf
                        @endif
                            <input type="hidden" value="{{ $nguoi_dung->ma }}" name='ma_nguoi_dung'>
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    @if ($nguoi_dung->ma != 1)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input check_all_role" id="check_all_role" >
                                            <label class="custom-control-label" for="check_all_role">Tất cả</label>
                                        </div>
                                        
                                    @endif
                                    @foreach ($role as $key => $item)
                                        
                                        @if ($item->ma != '7' || $nguoi_dung->ma == '1')
                                            
                                            @php $temp=-999; @endphp
                                            @foreach ($all as $key_all => $item_all)
                                                
                                                @if ($item->ma == $item_all->ma_quyen && $item_all->co_quyen == '1')
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input check_role" id="{{ $item->ma }}" name="phan_quyen[{{ $item->ma }}]" value="1" checked>
                                                        <label class="custom-control-label" for="{{ $item->ma }}">{{ $item->ten }} -> {{ $item->mo_ta }}</label>
                                                    </div>
                                                    @if ($item->ma == '5')
                                                        <div class="list_room">

                                                        </div>
                                                    @endif
                                                        @php $temp=$item->ma; @endphp
                                                    @break
                                                @endif 
                    
                                            @endforeach
                    
                                            @if ($temp !=$item->ma)
                                                
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input check_role" id="{{ $item->ma }}" name="phan_quyen[{{ $item->ma }}]" value="1">
                                                    <label class="custom-control-label" for="{{ $item->ma }}">{{ $item->ten }} -> {{ $item->mo_ta }}</label>
                                                </div>
                                                @if ($item->ma == '5')
                                                    <div class="list_room">

                                                    </div>
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                                
                                
                            </div>
                            @if ($nguoi_dung->ma != 1)
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            @endif
                        @if ($nguoi_dung->ma != 1)
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->
    </div>
    <!---Container Fluid-->
    
@endsection

@section('script')
    <script>
        html = `
            <button type="button" class="btn btn-primary ml-4" data-toggle="modal" data-target="#exampleModal" id="#myBtn">Chọn phòng </button>
            @include('pages.admin.decentralization.modal')
        `;
        if (document.getElementsByName('phan_quyen[5]')[0].checked == true) {
            $('.list_room').html(html);
        }
        $('#5').click(function (){
            
            if(document.getElementsByName('phan_quyen[5]')[0].checked == true){
                $('.list_room').html(html);
            }else{
                $('.list_room').html('');
            }
            $('#check_all_room').click(function(){
                const check_all_role = document.getElementById('check_all_room');
                if (check_all_role.checked) {
                    for (let i = 0; i < $('.check_room').length; i++) {
                        if (!$('.check_room')[i].checked) {
                            $('.check_room')[i].click()
                        }
                    }
                }else{
                    for (let i = 0; i < $('.check_room').length; i++) {
                        if ($('.check_room')[i].checked) {
                            $('.check_room')[i].click()
                        }
                    }
                }
            })
        });
        
        $('#check_all_role').click(function(){
            const check_all_role = document.getElementById('check_all_role');
            if (check_all_role.checked) {
                for (let i = 0; i < $('.check_role').length; i++) {
                    if (!$('.check_role')[i].checked) {
                        $('.check_role')[i].click()
                    }
                }
            }else{
                for (let i = 0; i < $('.check_role').length; i++) {
                    if ($('.check_role')[i].checked) {
                        $('.check_role')[i].click()
                    }
                }
            }
        })

        $('#check_all_room').click(function(){
            const check_all_role = document.getElementById('check_all_room');
            if (check_all_role.checked) {
                for (let i = 0; i < $('.check_room').length; i++) {
                    if (!$('.check_room')[i].checked) {
                        $('.check_room')[i].click()
                    }
                }
            }else{
                for (let i = 0; i < $('.check_room').length; i++) {
                    if ($('.check_room')[i].checked) {
                        $('.check_room')[i].click()
                    }
                }
            }
        })
    </script>
@endsection