@extends('home')
@section('content_home')
<div style="background-color: white;" class="padding-tb-50 color-black">


    <div id="tin-tuc" style="padding-bottom: 60px">
    </div>
    <div class="container">
        <div id="contact">
            <p><i class="far fa-newspaper"></i> TIN TỨC</p>
            <h2>TIN TỨC MỚI</h2>
        </div>
        <div class="container">
            @foreach ($news as $key => $item)
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
            <div class="paging-news-home">
                {{ $news->links() }}
            </div>

        </div>
    </div>

    
</div>

@endsection

@section('script')
<script>
    $('.submit_contact').click(function() {
        $(`.error`).html("");
        ma_nguoi_dung = $('#ma_nguoi_dung').val();
        ten = $('#ten').val();
        email = $('#email').val();
        chu_de = $('#chu_de').val();
        noi_dung = $('#noi_dung').val();
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
            success: function(data) {

                if (data.status == "error_ten") {
                    $(`.error_ten`).html(data.message);
                }
                if (data.status == "error_email") {
                    $(`.error_email`).html(data.message);
                }
                if (data.status == "error_chu_de") {
                    $(`.error_chu_de`).html(data.message);
                }
                if (data.status == "error_noi_dung") {
                    $(`.error_noi_dung`).html(data.message);
                }
                if (data.status == "success") {
                    alert(data.message);
                    location.reload();
                }
            },
        });
    })
</script>
@endsection