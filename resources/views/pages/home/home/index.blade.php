@extends('home')
@section('content_home')
    <div style="background-color: white;" class="padding-tb-50 color-black">
        <div class="">
            <div class="row">
                @php
                    $img= "home/img_banner/" .$banner->hinh_anh;
                @endphp
                <div class="col-12 col-md-12">
                    <img src="{{ asset($img) }}" />
                </div>

                <div class="col-12 col-md-12 mt-1">
                    <marquee><b>{{ $banner->tieu_de }}</b></marquee>
                </div>

                <div>

                </div>
            </div>
        </div>

        <div id="gioi-thieu" style="padding-bottom: 60px">
        </div>
        <div class="container">
            <div class="contact_s">
                <p><i class="far fa-star"></i> GIỚI THIỆU</p>
                <h2>GIỚI THIỆU WEBSITE</h2>
            </div>

            <div class="row">
                <div class="col-12 col-lg-4">
                    <div id="demo" class="carousel slide" data-ride="carousel">
                        <ul class="carousel-indicators">
                            @foreach ($slider as $key => $item)
                                <li data-target="#demo" data-slide-to="{{ $key }}" {{ $key==0? 'class="active"': '' }}></li>
                            @endforeach
                        </ul>
                        <div class="carousel-inner">
                            @foreach ($slider as $key => $item)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    @php
                                        $img_slider = "home/img_slider/".$item->hinh_anh;
                                    @endphp
                                    <img src="{{ asset($img_slider) }}" alt="{{ $key }}" >
                                    <div class="carousel-caption">
                                    <p>{{ $item->tieu_de }}</p>
                                    </div>   
                                </div> 
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                          <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#demo" data-slide="next">
                          <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-8 content-gio-thieu">
                    <h2>{{ $introduce->tieu_de }}</h2>
                   {!! $introduce->noi_dung !!}
                </div>
            </div>
                

        </div>

        <div id="tin-tuc" style="padding-bottom: 60px">
        </div>
        <div class="container">
            <div class="contact_s">
                <p><i class="far fa-newspaper"></i> TIN TỨC</p>
                <h2>TIN TỨC MỚI</h2>
            </div>
            <div class="container">
                @foreach ($news as $key => $item)
                    @if ($key == 3)
                        @break
                    @endif
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            @php
                                $anh = "home/img_tin_tuc/". $item->hinh_anh
                            @endphp
                            <a href="{{ route('home_news_info', ['id' => $item->ma]) }}">
                                <img src="{{ asset($anh)}} " alt="" width="300px">
                            </a>
                        </div>
                        <div class="col-lg-8 content-gio-thieu">
                            <a href="{{ route('home_news_info', ['id' => $item->ma]) }}">
                                <h2>{!! $item->tieu_de !!}</h2>
                            </a>
                            @php
                            $limit = 270;
                            while ($char_temp = substr ( $item->noi_dung , $limit, 1)) {
                                if($char_temp === " "){
                                    break;
                                }
                                $limit = $limit + 1;
                            }
                            $content_news = substr ( $item->noi_dung , 0, $limit);
                            $content_news = $content_news . "...";
                            @endphp
                            <p>{!! $content_news !!}</p>
                        </div>
                    </div>
                @endforeach
                <div class="btn-new-home">
                    <a href="{{ route('home_news') }}">
                        <button class="btn btn-info" ><i class="fas fa-arrow-circle-right"></i> Xem thêm...</button>
                    </a>
                </div>
                
            </div>
        </div>

        <div id="lien-he" style="padding-bottom: 60px">
        </div>
        <div class="container">
            <div class="contact_s">
                <p><i class="far fa-paper-plane"></i> LIÊN HỆ</p>
                <h2>LIÊN HỆ CHÚNG TÔI</h2>
            </div>

            <div class="row">

                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-2 icon-contact">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="col-8 content-contact">
                            <h3>Địa chỉ:</h3>
                            <p>{{ $contact_setting->dia_chi }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2 icon-contact">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="col-8 content-contact">
                            <h3>Email:</h3>
                            <p>{{ $contact_setting->email }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2 icon-contact">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="col-8 content-contact">    
                            <h3>Điện thoại:</h3>
                            <p>{{ preg_replace('~.*(\d{4})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{3}).*~', '($1) $2-$3', $contact_setting->so_dien_thoai) }}</p>
                        </div>
                    </div>

                </div>

                <div class="col-lg-8 mt-5 mt-lg-0">

                    <form>
                        @csrf
                        <input type="hidden" id="ma_nguoi_dung"
                        value="{{ Auth::guard('nguoi_dung')->check() ? Auth::guard('nguoi_dung')->user()->ma: '' }}"
                        >
                        <div class="form-row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="ten" class="form-control" id="ten" placeholder="Họ tên"
                                value="{{ Auth::guard('nguoi_dung')->check() ? Auth::guard('nguoi_dung')->user()->ten: '' }}"
                                />
                                <div class="error error_ten"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Địa chỉ email"
                                value="{{ Auth::guard('nguoi_dung')->check() ? Auth::guard('nguoi_dung')->user()->email: '' }}"
                                />
                                <div class="error error_email"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="chu_de" id="chu_de" placeholder="Chủ đề"/>
                            <div class="error error_chu_de"></div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="noi_dung" rows="3" id="noi_dung" placeholder="Nội dung"></textarea>
                            <div class="error error_noi_dung"></div>
                        </div>

                        <div class="mb-3 submit-mail">
                            <button class="btn btn-success submit_contact" type="button">Gửi</button>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>

@endsection

@section('script')
    <script>
        $('.submit_contact').click(function(){
            $(`.error`).html("");
            ma_nguoi_dung=$('#ma_nguoi_dung').val();
            ten=$('#ten').val();
            email=$('#email').val();
            chu_de=$('#chu_de').val();
            noi_dung=$('#noi_dung').val();
            _token = $('input[name="_token"]').val();

            $.ajax({
                url: "ajax/add-contact",
                method: 'post',
                data: { 
                    ma_nguoi_dung: ma_nguoi_dung,
                    ten: ten,
                    email: email,
                    chu_de: chu_de,
                    noi_dung: noi_dung,
                    _token: _token,
                },
                success:function(data){
                    
                    if(data.status == "error_ten"){
                        $(`.error_ten`).html(data.message);
                    }
                    if(data.status == "error_email"){
                        $(`.error_email`).html(data.message);
                    }
                    if(data.status == "error_chu_de"){
                        $(`.error_chu_de`).html(data.message);
                    }
                    if(data.status == "error_noi_dung"){
                        $(`.error_noi_dung`).html(data.message);
                    }
                    if(data.status == "success"){
                        alert(data.message);
                        location.reload();
                    }
                },
            });
        })
    </script>
@endsection
