@extends('home')
@section('content_home')

<div style="background-color: white;" class="padding-tb-50 color-black">


    <div id="tin-tuc" style="padding-bottom: 60px">
    </div>
    <div class="container">
        <div id="contact">
            <p><i class="far fa-newspaper"></i> TIN TỨC</p>
            <h2>{!! $news->tieu_de !!}</h2>
        </div>
        <div class="container">
            {!! $news->noi_dung !!}

        </div>
    </div>

    <style>
        table{
            border: 0px white;
            width: 100% !important;
        }
        
    </style>
    
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

    $('table tr td').css("text-align", "center");
    $('table tr td p').css("text-align", "center");
</script>
@endsection