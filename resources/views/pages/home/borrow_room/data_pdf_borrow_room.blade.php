@php $null = 0;@endphp
@foreach ($borrow_room as $key => $item_borrow_room)
    @php
        $ngay_muon= date_format(date_create($item_borrow_room->ngay_muon), "d-m-Y");
    @endphp
    @if ($thu_tiep_theo == $ngay_muon && $item->ma == $item_borrow_room->ma_phong)
    <span>
        <a href="" data-toggle="modal" data-target="#informationUserBorrowRoom" class="get-infor-user-borrow-room" data-id="{{ $item_borrow_room->ma }}">
            {{date_format(date_create($item_borrow_room->thoi_gian_bat_dau_muon), "H:i")}}-{{date_format(date_create($item_borrow_room->thoi_gian_ket_thuc_muon), "H:i")}}
            {{-- {{date('h:i',strtotime($item_borrow_room->thoi_gian_bat_dau_muon));}} --}}
            <br><strong style="font-size: 10px;">{{ $item_borrow_room->ten_nguoi_dung }}</strong><br>
        </a>
    </span>
    @endif
@endforeach


