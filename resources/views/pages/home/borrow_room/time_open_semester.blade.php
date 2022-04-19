<!-- Modal -->

<div class="modal fade" id="timeOpenSemester">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('paging_date_search_room') }}" method="POST">
            @csrf
            
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" style="color: red">Năm học - Học kỳ</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body mb-2">
                    <div class="form-group">
                        <label for="ma_time_open_semester">Năm học - Học kỳ (<span class="text-red">*</span>):</label>
                        <select class="fix-form-input form-control"  name="ma_time_open_semester" id="ma_time_open_semester">
                            @foreach ($all_time_open_semester as $item)
                                @if ($item->ma == $time_open_semester->ma)
                                    <option selected value="{{ $item->ma }}">{{ $item->ten_hoc_ky }} năm {{ $item->nam_dau }} - {{ $item->nam_sau }}. Từ ngày {{ $item->thoi_gian_bat_dau }} đến ngày {{ $item->thoi_gian_ket_thuc }}</option>
                                @else
                                    <option value="{{ $item->ma }}">{{ $item->ten_hoc_ky }} năm {{ $item->nam_dau }} - {{ $item->nam_sau }}. Từ ngày {{ $item->thoi_gian_bat_dau }} đến ngày {{ $item->thoi_gian_ket_thuc }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" style="width: 120px" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" style="width: 120px" class="btn btn-primary">Đổi</button>
                </div>

            </div>
        </form>
    </div>
</div>
