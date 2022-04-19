@extends('pages.home.user.index')
@section('content_home_user')
    <h3><b>Quyền quản trị của tài khoản</b></h3>
    <div class="row">
        <div class="form-group col-lg-12">
            @foreach ($role as $key => $item)
                
                @if ($item->ma != '7' || $nguoi_dung->ma == '1')
                    
                    @php $temp=-999; @endphp
                    @foreach ($all as $key_all => $item_all)
                        
                        @if ($item->ma == $item_all->ma_quyen && $item_all->co_quyen == '1')
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="{{ $item->ma }}" name="phan_quyen[{{ $item->ma }}]" value="1" checked disabled>
                                <label class="custom-control-label" for="{{ $item->ma }}">{{ $item->ten }} -> {{ $item->mo_ta }} ---> <a href="{{ URL::to('admin/'.($item->ma == 8 ? 'duyet-dang-ky/cho-duyet' : ($item->ma == 10 ?  'cai-dat/gioi-thieu': $item->url)) ) }}">Chuyển trang {{ $item->ten }}</a></label>
                            </div>
                            @if ($item->ma == '5')
                                <button type="button" class="btn btn-primary ml-4" data-toggle="modal" data-target="#exampleModal" id="#myBtn">Phòng có quyền quản lý </button>
                            @endif
                                @php $temp=$item->ma; @endphp
                            @break
                        @endif 

                    @endforeach

                    @if ($temp !=$item->ma)
                        
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="{{ $item->ma }}" name="phan_quyen[{{ $item->ma }}]" value="1" disabled>
                            <label class="custom-control-label" for="{{ $item->ma }}">{{ $item->ten }} -> {{ $item->mo_ta }}</label>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
        
        
    </div>
    @include('pages.home.user.modal')
@endsection