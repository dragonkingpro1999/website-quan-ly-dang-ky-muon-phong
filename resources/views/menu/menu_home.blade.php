<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-darkblue fixed-top navbar-transparent " color-on-scroll="400">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="{{ route('home') }}" rel="tooltip"
                data-placement="bottom">
                Website đăng ký mượn phòng
            </a>
            <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navigation" aria-controls="navigation-index" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-bar top-bar"></span>
                <span class="navbar-toggler-bar middle-bar"></span>
                <span class="navbar-toggler-bar bottom-bar"></span>
            </button>
        </div>
        @php
            $_url = "$_SERVER[REQUEST_URI]";
        @endphp
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-home"></i>
                        <p>Trang chủ</p>
                    </a>
                </li>

                @if ($_url == "/trang-chu")
                    <li class="nav-item">
                        <a class="nav-link" href="#gioi-thieu">
                            <i class="far fa-star"></i>
                            <p>Giới thiệu</p>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#gioi-thieu">
                            <i class="far fa-star"></i>
                            <p>Giới thiệu</p>
                        </a>
                    </li>
                @endif
                
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink2"
                        data-toggle="dropdown">
                        <i class="far fa-newspaper"></i>
                        Tin tức
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink2">
                        
                        
                        @if ($_url == "/trang-chu")
                            <a class="dropdown-item" href="#tin-tuc">
                                <i class="far fa-newspaper"></i> Tin tức
                            </a>
                        @else
                            <a class="dropdown-item" href="{{ route('home') }}#tin-tuc">
                                <i class="far fa-newspaper"></i> Tin tức
                            </a>
                        @endif
                        <a class="dropdown-item" href="{{ route('home_news') }}">
                            <i class="fas fa-newspaper"></i> Tất cả tin tức
                        </a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home_calendar') }}">
                        <i class="fas fa-calendar-day"></i>
                        <p>Lịch mượn</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home_calendar_th') }}">
                        <i class="far fa-calendar-alt"></i>
                        <p>Lịch TH</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home_calendar_lt') }}">
                        <i class="fas fa-calendar-alt"></i>
                        <p type="submit">Lịch LT</p>
                    </a>
                </li>
                

                @if ($_url == "/trang-chu")
                    <li class="nav-item">
                        <a class="nav-link" class="scroll-lien-he" href="#lien-he">
                            <i class="far fa-paper-plane"></i>
                            <p>Liên hệ</p>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" class="scroll-lien-he" href="{{ route('home') }}#lien-he">
                            <i class="far fa-paper-plane"></i>
                            <p>Liên hệ</p>
                        </a>
                    </li>
                @endif

                @if (Auth::guard('nguoi_dung')->check())
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1"
                            data-toggle="dropdown">
                            <i class="far fa-user"></i>
                            @if (Auth::guard('nguoi_dung')->check())
                                Xin chào {{ Auth::guard('nguoi_dung')->user()->ten }}
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink1">
                            
                            <a class="dropdown-item" href="{{ route('infor_user_home') }}">
                                <i class="fas fa-user-edit"></i> Thông tin tài khoản
                            </a>
                            <a class="dropdown-item" href="{{ route('history_signup_borrow_room') }}">
                                <i class="fas fa-history"></i> Lịch sử đăng ký mượn phòng
                            </a>
                            <a class="dropdown-item" href="{{ route('role_user_home') }}">
                                <i class="fas fa-tools"></i> Quản trị viên
                            </a>
                            <a class="dropdown-item"
                                href="{{ route('logout') }}">
                                <i class="fas fa-sign-out-alt"></i> Đăng xuất
                            </a>
                        
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i>
                            <p>Đăng nhập</p>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>