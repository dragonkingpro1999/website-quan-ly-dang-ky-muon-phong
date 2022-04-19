<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Phòng có quyền quản lý</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                @foreach ($room as $item)
                    
                    @php $temp=-999; @endphp
                        @foreach ($manager_role_room as $key_role => $item_role)

                            @if ($item->ma == $item_role->ma_phong && $item_role->co_quyen == '1')
                                    <div class="form-group col-lg-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="{{ 'p'.$item->ma }}" name="phan_quyen_phong[{{ $item->ma }}]" value="1" checked disabled>
                                            <label class="custom-control-label" for="{{ 'p'.$item->ma }}">{{ $item->ten }} -> {{ $item->mo_ta }}</label>
                                        </div>
                                    </div>
                                    @php $temp=$item->ma; @endphp
                                @break
                            @endif 

                        @endforeach

                        @if ($temp !=$item->ma)
                            <div class="form-group col-lg-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="{{ 'p'.$item->ma }}" name="phan_quyen_phong[{{ $item->ma }}]" value="1" disabled>
                                    <label class="custom-control-label" for="{{ 'p'.$item->ma }}">{{ $item->ten }} -> {{ $item->mo_ta }}</label>
                                </div>
                            </div>
                        @endif
                @endforeach
                
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Đóng</button>
        </div>
        </div>
    </div>
</div>