<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        .navbar {
            background-color: #ff5850;
            font-weight: bold;
        }
        .nav-item a {
            color: #fff !important;
        }
        .navbar-nav {
            margin: 0 auto;
        }
        .list-product {
            display: grid;
            grid-template-columns: repeat(4, 24%);
        }
        .product {
            margin: 10px;
            text-align: center;
        }
        .auth-buttons {
            position: absolute;
            top: 20px;
            right: 50px;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <div class="header">
        <header style='text-align:center'>
            <div class="logo">                  
                <img src="{{asset('images/Coffee Logo.png')}}" width="100%">
            </div>

            <div class="auth-buttons">
                @auth 
                <div class="dropdown">
                    <button class="btn text-white dropdown-toggle" type="button" id="userDropdown" 
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        style="background-color: #6c757d; border: none; font-weight: bold; padding: 10px 24px; font-size: 16px; border-radius: 5px; min-width: 130px;">
                        {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item font-weight-bold" href="{{ route('account') }}">🔧 Quản lý</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger font-weight-bold">
                                🚪 Đăng xuất
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <div class="d-flex">
                    <a href="{{ route('login') }}" class="nav-link p-0">
                        <button class="btn text-white mr-2"
                            style="background-color: #28a745; border: none; font-weight: bold; padding: 5px 10px; font-size: 16px; border-radius: 5px; min-width: 60px;">
                            Đăng nhập
                        </button>
                    </a>
                    <a href="{{ route('register') }}" class="nav-link p-0 ml-2">
                        <button class="btn text-white"
                            style="background-color: #007bff; border: none; font-weight: bold; padding: 5px 15px; font-size: 16px; border-radius: 5px; min-width: 60px;">
                            Đăng ký
                        </button>
                    </a>
                </div>
                @endauth
            </div>

            <main style="width:100%; margin:2px auto;">
                <div class='row'>
                    <div class='col-3 pr-0'>
                        <x-menu>
                            <x-slot name='item'>
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{url('mon')}}">Trang chủ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('mon/loaimon/1')}}">Cà phê</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('mon/loaimon/2')}}">Trà sữa</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('mon/loaimon/3')}}">Nước ép</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('mon/loaimon/4')}}">Sinh tố</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('mon/loaimon/5')}}">Trà</a>
                                </li>
                            </x-slot>
                        </x-menu>
                    </div>
                    <div class='col-9'>
                        {{$slot}}
                    </div>
                </div>

                <div style='color:white;position:relative' class='mr-2'>
                    <div style='width:20px; height:20px;background-color:#23b85c; font-size:12px; border:none;
                    border-radius:50%; position:absolute;right:2px;top:-2px' id='cart-number-product'>
                        @if (session('cart'))
                            {{ count(session('cart')) }}
                        @else
                            0
                        @endif
                    </div>
                    <a href="{{route('order')}}" style='cursor:pointer;color:white;'>
                        <i class="fa fa-cart-arrow-down fa-2x mr-2 mt-2" aria-hidden="true"></i>
                    </a>
                </div>
            </main>
        </header>

        <footer style="background-color: brown; color: white; padding: 20px; text-align:left;">
            <div style="display: flex; justify-content: space-around; flex-wrap: wrap; max-width: 1200px; margin: auto;">
                <div>
                    <h3>Giới thiệu</h3>
                    <ul style="list-style: none; padding: 0;">
                        <li><a href="#" style="color: white;" id="aboutFooterBtn">Về Chúng Tôi</a></li>
                        <li><a href="#" style="color: white;" id="KhuyenmaiBtn">Khuyến mãi</a></li>
                    </ul>
                </div>
                <div>
                    <h3>Thông tin tuyển dụng</h3>
                    <ul style="list-style: none; padding: 0;">
                        <p>- Điện thoại: <br> 1900 2345 6767 (Bấm phím 0: Lễ Tân | phím 1: CSKH)</p>
                        <p>- Email:<br>Phòng nhân sự: <a href="mailto:nhansucoffeeandtea@gmail.com" style="color: white;">nhansucoffeeandtea@gmail.com</a> </p>
                    </ul>
                </div>
                <div>
                    <h3>Điều khoản</h3>
                    <ul style="list-style: none; padding: 0;">
                        <li><a href="#" style="color: white;">Điều khoản sử dụng</a></li>
                        <li><a href="#" style="color: white;">Chính sách bảo mật thông tin</a></li>
                    </ul>
                </div>
                <div>
                    <h3>Đặt hàng: 1800 6936</h3>
                </div>
            </div>
            <div style="margin-top: 20px; text-align: center">
                <p>&copy; 2014-2022 Công ty cổ phần thương mại dịch vụ Trà Cà Phê VN</p>
                <p>MST: 0318672890 - ĐKKD: 03073126/20224. NGUYỄN VĂN A</p>
                <p>Địa chỉ: 86-88 Cà Phê, P.10, Q.Bình Tân, TP. Hồ Chí Minh</p>
                <p>Điện thoại: 090 123 5679</p>
                <p>Email: <a href="mailto:coffeeandtea.vn" style="color: white;">coffeeandtea.vn</a></p>
            </div>
        </footer>
    </div>

    <!-- ✅ Scripts ở cuối để dropdown hoạt động -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
