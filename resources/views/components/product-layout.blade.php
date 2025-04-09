<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$title}}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Afacad' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.7.1.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
        body {
            font-family: 'Afacad';
            font-size: 20px;
        }
        .navbar {
            background-color: brown;
            font-size: 25px;
            font-weight: bold;
            display: flex;
            justify-content: flex-start;
            padding: 10px;
            list-style: none; 
            border: none; 
        }
        .nav-item {
            margin:10px; /* Khoảng cách giữa các mục */
        }
        .nav-link {
            color: #fff !important;
            text-decoration: none; /* Xoá đường gạch chân */
            padding: 10px 20px;
            font-size: 20px; /* Tăng kích thước font chữ */
        }
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2); 
            border-radius: 5px;
        }
        .header {
            text-align: center;
        }
        .list-product {
            display: grid;
            grid-template-columns: repeat(4, 24%);
        }
        .product {
            margin: 10px;
            text-align: center;
        }
        .cart-icon 
        {
            color: white;
            position: relative; 
            left: 10%;
        }
        .cart-count 
        {
            width: 20px;
            height: 20px;
            background-color: #23b85c;
            font-size: 12px;
            border: none;
            border-radius: 50%;
            position: absolute;
            right: -10px; /* Điều chỉnh vị trí */
            top: -9px; /* Điều chỉnh vị trí */
            text-align: center;
            line-height: 20px; /* Căn giữa số trong vòng tròn */
        }
        footer {
            background-color: brown; 
            color: white; 
            padding: 20px; 
            text-align: center; /* Center footer text */
        }
        footer h3 {
            margin: 10px 0; /* Margin for headings in footer */
        }
        footer p, footer ul {
            margin: 5px 0; /* Consistent margin for paragraphs and lists */
            padding: 0; /* Remove padding */
        }
        footer a {
            color: white; /* Ensure links are white */
            text-decoration: none; /* Remove underline from links */
        }
        footer a:hover {
            text-decoration: underline; /* Underline on hover for better visibility */
        }
    </style>
</head>
<body>
    <div class="header">
        <header>
            <div class="logo">
                <img src="{{asset('images/Coffee Logo.png')}}" width="100%">
            </div>
            <nav class="navbar">
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('mon')}}">TRANG CHỦ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('mon/loaimon/1')}}">CÀ PHÊ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('mon/loaimon/2')}}">TRÀ SỮA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('mon/loaimon/3')}}">NƯỚC ÉP</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('mon/loaimon/4')}}">SINH TỐ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('mon/loaimon/5')}}">TRÀ</a>
                </li>
                <div class='cart-icon'>
                    <a href="{{route('order')}}" style='cursor:pointer;color:white;'>
                        <i class="fa fa-cart-arrow-down fa-2x mr-2 mt-2" aria-hidden="true"></i>
                    </a>
                
                    <div class='cart-count' id='cart-number-product'>
                        @if (session('cart'))
                        {{ count(session('cart')) }}
                        @else
                        0
                        @endif
                    </div>
                </div>
            </nav>
                        <x-menu>
                            <x-slot name='item'>
                                <!-- Menu items can go here if needed -->
                            </x-slot>
                        </x-menu>
                    </div>
                    <div class='col-9'>
                        {{$slot}}
                    </div>
                </div>
            </main>
        </header>
    </div>
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
</body>
</html>