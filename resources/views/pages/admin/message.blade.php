<div>
    @php
    $success = Session::get('success');
    $error = Session::get('error');
    @endphp
    
    @if (isset($success) || isset($error))
        <div id="toast__message">
            @if (isset($success))
                <div class="toast__message toast__message--success">
                    <div class="toast__icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="toast__body">
                        <h3 class="toast__title">Thành công</h3>
                        <p class="toast__msg">{{$success}}</p>
                    </div>
                    <div class="toast__close">
                        <i class="fas fa-times" onclick="removeToast()"></i>
                    </div>
                </div>
                @php
                    Session::forget('success');
                @endphp
            @endif
            
            @if (isset($error))
                <div class="toast__message toast__message--danger">
                    <div class="toast__icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="toast__body">
                        <h3 class="toast__title">Thất bại</h3>
                        <p class="toast__msg">{{$error}}</p>
                    </div>
                    <div class="toast__close">
                        <i class="fas fa-times" onclick="removeToast()"></i>
                    </div>
                </div>
                @php
                    Session::forget('error');
                @endphp
            @endif
        </div>
    @endif
 
</div>