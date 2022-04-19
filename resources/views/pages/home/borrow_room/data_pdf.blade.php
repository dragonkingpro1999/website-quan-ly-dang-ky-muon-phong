<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Xuất file PDF
    </title>
    <style>
        body{
            font-family: 'DejaVu Sans';
        }
        .table thead th {
            vertical-align: bottom;
        }
        .table th {
            text-align: center;
            font-size: 15px;
        }
        .table td, .table th {
            border: 1px solid #ddd;
            width: 12.5%;
        }
        .table td, .table th {
            padding: .75rem;

        }
        th {
            display: table-cell;
            font-weight: bold;
        }
        .table {
            color: black;
        }
        table {
            border-collapse: collapse;
        }

        table {
            border-collapse: separate;
            text-indent: initial;
        }
        .table .room_style a {
            color: black;
            text-decoration: none;
            font-weight: bold;
        }

        .table{
            width: 100%;
            color: black;
            font-size:13px;
        }

        .table td,.table th{
            padding:5;
            border:1px solid #ddd;
            text-align: center;
            font-size:13px;
            width: 12.5%;
        }

        .table th{
            text-align: center;
            font-size: 15px;
        }

        .table td a:hover{
            color: blue;
        }

        .table td a{
            color: black;
            text-decoration: none;
        }

        .table .room_style{
            font-size: 15px;
            text-align: left;
        }
        .table .room_style a:hover{
            color: blue;
        }
        .table .room_style a{
            color: black;
            text-decoration: none;
            font-weight: bold;
        }

        .table tbody tr:nth-child(even){
            background-color: #f5f5f5;
        }

    </style>
</head>

<body>
    @php
        //Giá trị ban đầu
        
        $ngay_bd = date_format(date_create($time_start),"d");
        $thang_bd = date_format(date_create($time_start),"m");
        $nam_bd = date_format(date_create($time_start),"Y");

        $ngay_kt = date_format(date_create($time_end),"d");
        $thang_kt = date_format(date_create($time_end),"m");
        $nam_kt = date_format(date_create($time_end),"Y");

        $ngay_thang_nam_db = date('d-m-Y', mktime(0, 0, 0, $thang_bd, $ngay_bd, $nam_bd));
        $ngay_thang_nam_kt = date('d-m-Y', mktime(0, 0, 0, $thang_kt, $ngay_kt, $nam_kt));

        // Tính toán về thứ
        $thu_ngay_bat_dau = date('l', mktime(0, 0, 0, $thang_bd, $ngay_bd, $nam_bd));
        $thu_ngay_ket_thuc = date('l', mktime(0, 0, 0, $thang_kt, $ngay_kt, $nam_kt));
        
        $ngaythangnam_bd = mktime(0, 0, 0, $thang_bd, $ngay_bd, $nam_bd);
        $ngaythangnam_kt = mktime(0, 0, 0, $thang_kt, $ngay_kt, $nam_kt);
    
        if($thu_ngay_bat_dau == "Monday"){
            $thu_hai_cua_tuan_bd = mktime(0, 0, 0, $thang_bd, $ngay_bd, $nam_bd);
        }elseif ($thu_ngay_bat_dau == "Tuesday") {
            $thu_hai_cua_tuan_bd = mktime(0, 0, 0, $thang_bd, $ngay_bd - 1, $nam_bd);
        }elseif ($thu_ngay_bat_dau == "Wednesday") {
            $thu_hai_cua_tuan_bd = mktime(0, 0, 0, $thang_bd, $ngay_bd - 2, $nam_bd);
        }elseif ($thu_ngay_bat_dau == "Thursday") {
            $thu_hai_cua_tuan_bd = mktime(0, 0, 0, $thang_bd, $ngay_bd - 3, $nam_bd);
        }elseif ($thu_ngay_bat_dau == "Friday") {
            $thu_hai_cua_tuan_bd = mktime(0, 0, 0, $thang_bd, $ngay_bd - 4, $nam_bd);
        }elseif ($thu_ngay_bat_dau == "Saturday") {
            $thu_hai_cua_tuan_bd = mktime(0, 0, 0, $thang_bd, $ngay_bd - 5, $nam_bd);
        }elseif ($thu_ngay_bat_dau == "Sunday") {
            $thu_hai_cua_tuan_bd = mktime(0, 0, 0, $thang_bd, $ngay_bd - 6, $nam_bd);
        }
        $ngay_dau_tien = date("d", $thu_hai_cua_tuan_bd);
        $thang_dau_tien = date("m", $thu_hai_cua_tuan_bd);
        $nam_dau_tien = date("Y", $thu_hai_cua_tuan_bd);
        $ngaythangnam_dau_tien = date("d-m-Y", $thu_hai_cua_tuan_bd);
        $ngaythangnam_CN_dau_tien = date("d-m-Y", mktime(0, 0, 0, $thang_dau_tien, $ngay_dau_tien + 6, $nam_dau_tien));

        if($thu_ngay_ket_thuc == "Monday"){
            $chu_nhat_cua_tuan_kt = mktime(0, 0, 0, $thang_kt, $ngay_kt + 6, $nam_kt);
        }elseif ($thu_ngay_ket_thuc == "Tuesday") {
            $chu_nhat_cua_tuan_kt = mktime(0, 0, 0, $thang_kt, $ngay_kt + 5, $nam_kt);
        }elseif ($thu_ngay_ket_thuc == "Wednesday") {
            $chu_nhat_cua_tuan_kt = mktime(0, 0, 0, $thang_kt, $ngay_kt + 4, $nam_kt);
        }elseif ($thu_ngay_ket_thuc == "Thursday") {
            $chu_nhat_cua_tuan_kt = mktime(0, 0, 0, $thang_kt, $ngay_kt + 3, $nam_kt);
        }elseif ($thu_ngay_ket_thuc == "Friday") {
            $chu_nhat_cua_tuan_kt = mktime(0, 0, 0, $thang_kt, $ngay_kt + 2, $nam_kt);
        }elseif ($thu_ngay_ket_thuc == "Saturday") {
            $chu_nhat_cua_tuan_kt = mktime(0, 0, 0, $thang_kt, $ngay_kt + 1, $nam_kt);
        }elseif ($thu_ngay_ket_thuc == "Sunday") {
            $chu_nhat_cua_tuan_kt = mktime(0, 0, 0, $thang_kt, $ngay_kt, $nam_kt);
        }

        $ngay_cuoi_cung = date("d", $chu_nhat_cua_tuan_kt);
        $thang_cuoi_cung = date("m", $chu_nhat_cua_tuan_kt);
        $nam_cuoi_cung = date("Y", $chu_nhat_cua_tuan_kt);
        $ngaythangnam_cuoi_cung = date("d-m-Y", $chu_nhat_cua_tuan_kt);

        // Tính toán về tuần
        $ngay_bat_dau = date_create($ngay_dau_tien.'-'.$thang_dau_tien.'-'.$nam_dau_tien);
        $ngay_ket_thuc = date_create($ngay_cuoi_cung.'-'.$thang_cuoi_cung.'-'.$nam_cuoi_cung);

        $khoang_cach_ngay = date_diff($ngay_bat_dau, $ngay_ket_thuc)->format('%a');

        $tong_so_tuan = ceil($khoang_cach_ngay/7);

    @endphp
    <br>
    @php
        $ngay_trong_tuan = 0; //1 tuần có 7 ngày, khởi tạo giá trị mặc định là 0
    @endphp

    
    <div class="bgcolor-while">
        <h1>
            <span style="color: blue;">
                @if (!isset($paging_ngay_bd) && !isset($paging_ngay_kt))
                    Lịch mượn phòng từ ngày <span style="color: red;">{{ $ngaythangnam_dau_tien }}</span>
                    đến ngày <span style="color: red">{{ $ngaythangnam_CN_dau_tien }}</span>
                @else
                    Lịch mượn phòng từ ngày <span style="color: red">{{ $paging_ngay_bd }}</span>
                    đến ngày <span style="color: red">{{ $paging_ngay_kt }}</span>
                @endif
            </span>
        </h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Phòng</th>
                    @if(!isset($paging_ngay_bd) && !isset($paging_ngay_kt))
                        @for ($i = 0; $i <= 6; $i++) {{-- thứ 2 đến CN--}}
        
                            @php
                                $thu_tiep_theo = date("d-m-Y", mktime(0, 0, 0, $thang_dau_tien, $ngay_dau_tien + $i, $nam_dau_tien));
                                $thu[$i+2] = $thu_tiep_theo;
                            @endphp
        
                            @if ($i == 6)
                                <th>CN<br>{{ $thu_tiep_theo }}</th>
                            @else
                                <th>Thứ {{ $i + 2 }}<br>{{ $thu_tiep_theo }}</th>
                            @endif 
        
                        @endfor
                    @else
                        @php
                            $paging_ngay_dau_tien = date_create($paging_ngay_bd);
                            $paging_ngay_dt = date_format($paging_ngay_dau_tien,"d");
                            $paging_thang_dt = date_format($paging_ngay_dau_tien,"m");
                            $paging_nam_dt = date_format($paging_ngay_dau_tien,"Y");
                        @endphp
                        @for ($i = 0; $i <= 6; $i++) {{-- thứ 2 đến CN--}}
            
                            @php
                                $thu_tiep_theo = date("d-m-Y", mktime(0, 0, 0, $paging_thang_dt, $paging_ngay_dt + $i, $paging_nam_dt));
                                $thu[$i+2] = $thu_tiep_theo;
                            @endphp

                            @if ($i == 6)
                                <th>CN<br>{{ $thu_tiep_theo }}</th>
                            @else
                                <th>Thứ {{ $i + 2 }}<br>{{ $thu_tiep_theo }}</th>
                            @endif 

                        @endfor
                    @endif
                </tr>
            </thead>
            <tbody>
                @php
                    $count_room = 0;
                @endphp
                @foreach ($list_room as $key => $item)
                    @php
                        $count_room ++;
                    @endphp
                    <tr>
                        <td class="room_style" data-label="Phòng">
                            <form>
                                @csrf
                                <a href="" data-toggle="modal" data-target="#informationRoom" class="get-infor-room" data-id="{{ $item->ma }}">
                                    {{$item->ten}}
                                </a>
                            </form>
                        </td>
                        @if(!isset($paging_ngay_bd) && !isset($paging_ngay_kt))
                            @for ($i = 0; $i <= 6; $i++) {{-- thứ 2 đến CN--}}
            
                                @php
                                    $thu_tiep_theo = date("d-m-Y", mktime(0, 0, 0, $thang_dau_tien, $ngay_dau_tien + $i, $nam_dau_tien));
                                    $thu[$i+2] = $thu_tiep_theo;
                                @endphp
            
                                @if ($i == 6)
                                    <td data-label="CN">
                                        @include('pages.home.borrow_room.data_pdf_borrow_room')
                                    </td>
                                @else
                                    <td data-label="Thứ {{$i + 2}}">
                                        @include('pages.home.borrow_room.data_pdf_borrow_room')
                                    </td>
                                @endif 
            
                            @endfor
                        @else
                            @php
                                $paging_ngay_dau_tien = date_create($paging_ngay_bd);
                                $paging_ngay_dt = date_format($paging_ngay_dau_tien,"d");
                                $paging_thang_dt = date_format($paging_ngay_dau_tien,"m");
                                $paging_nam_dt = date_format($paging_ngay_dau_tien,"Y");
                            @endphp
                            @for ($i = 0; $i <= 6; $i++) {{-- thứ 2 đến CN--}}
                
                                @php
                                    $thu_tiep_theo = date("d-m-Y", mktime(0, 0, 0, $paging_thang_dt, $paging_ngay_dt + $i, $paging_nam_dt));
                                    $thu[$i+2] = $thu_tiep_theo;
                                @endphp
                                @if ($i == 6)
                                    <td data-label="CN">
                                        @include('pages.home.borrow_room.data_pdf_borrow_room')
                                    </td>
                                    @else
                                    <td data-label="Thứ {{$i + 2}}">
                                        @include('pages.home.borrow_room.data_pdf_borrow_room')
                                    </td>
                                @endif 
                            @endfor
                        @endif
                    </tr>
                @endforeach
                
                @if ($count_room == 0)
                    <tr>
                        <td colspan="8">Chưa có dữ liệu hoặc tìm phòng không thấy</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
            
</body>

</html>
