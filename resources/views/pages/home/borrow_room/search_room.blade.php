<!-- Modal -->

<div class="modal fade" id="searchRoom">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('paging_date_search_room') }}" method="POST">
            @csrf
            @if (isset($paging_ngay_bd) && isset($paging_ngay_kt))
                <input type="hidden" name="date_start" value={{$paging_ngay_bd}}>
                <input type="hidden" name="date_end" value={{$paging_ngay_kt}}>
            @endif

            @if (isset($time_open_semester))
                <input type="hidden" name="ma_time_open_semester" value={{$time_open_semester->ma}}>
            @endif

            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" style="color: red">Tìm kiếm</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body mb-2">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="search_name_room">Tên phòng</label>
                                <input type="text" class="fix-form-input form-control" name="search_name_room" id="search_name_room" placeholder="Tên phòng ..." value="{{isset($search_name_room) ? $search_name_room : null}}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="search_type_room">Loại phòng (<span class="text-red">*</span>):</label>
                                <select class="fix-form-input form-control"  name="search_type_room" id="search_type_room">
                                    <option value="">Tất cả loại phòng</option>
        
                                    @if (isset($search_type_room))
                                        @foreach ($type_room as $key => $item)
                                            @if ($search_type_room == $item->ma)
                                                <option selected value="{{ $item->ma }}">{{ $item->ten }} -> {{ $item->mo_ta }}</option>
                                            @else
                                                <option value="{{ $item->ma }}">{{ $item->ten }} -> {{ $item->mo_ta }}</option>
                                            @endif
                                           
                                        @endforeach  
                                    @else
                                        @foreach ($type_room as $key => $item)
                                            <option value="{{ $item->ma }}">{{ $item->ten }} -> {{ $item->mo_ta }}</option>
                                        @endforeach
                                    @endif

                                    
        
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="search_uses">Chức năng:</label>
                        <select class="select2-multiple form-control" style="width: 100% !important" name="search_uses[]" multiple="multiple" id="search_uses">
                            
                            @if (isset($search_uses))
                                @foreach ($uses as $key => $item)
                                    @php $temp=-999; @endphp
                                    @foreach ($search_uses as $id_uses)

                                        @if ($item->ma == $id_uses)
                                            <option selected value={{ $item->ma }}>{{ $item->ten }}</option>
                                                @php $temp=$item->ma; @endphp
                                            @break
                                        @endif 

                                    @endforeach

                                    @if ($temp !=$item->ma)
                                        <option value={{$item->ma}} name={{ $item->ten }} class={{ $item->ma }}>{{ $item->ten }}</option>
                                    @endif
                                    
                                @endforeach
                            @else
                                @foreach ($uses as $key => $item)
                                    <option value={{$item->ma}} name={{ $item->ten }} class={{ $item->ma }}>{{ $item->ten }}</option>
                                @endforeach
                            @endif   

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="search_device">Thiết bị:</label>
                        <select class="select2-multiple form-control" style="width: 100% !important" name="search_device[]" multiple="multiple" id="search_device">
                        
                            @if (isset($search_device))
                                @foreach ($device as $key => $item)
                                    @php $temp=-999; @endphp
                                    @foreach ($search_device as $id_device)

                                        @if ($item->ma == $id_device)
                                            <option selected value={{ $item->ma }}>{{ $item->ten }}</option>
                                                @php $temp=$item->ma; @endphp
                                            @break
                                        @endif 

                                    @endforeach

                                    @if ($temp !=$item->ma)
                                        <option value={{$item->ma}} name={{ $item->ten }} class={{ $item->ma }}>{{ $item->ten }}</option>
                                    @endif
                                    
                                @endforeach
                            @else
                                @foreach ($device as $key => $item)
                                    <option value={{$item->ma}} name={{ $item->ten }} class={{ $item->ma }}>{{ $item->ten }}</option>
                                @endforeach
                            @endif   
                                                     
                        </select>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" style="width: 120px" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <a href="{{ route('home_calendar') }}"><button type="button" style="width: 120px" class="btn btn-danger">Xóa tất cả</button></a>
                    <button type="submit" style="width: 120px" class="btn btn-primary">Bắt đầu tìm</button>
                </div>

            </div>
        </form>
    </div>
</div>
