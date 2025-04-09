<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
<style>
        .navbar {
                background-color: brown;
                font-weight:bold;
}
        .nav-item a {
                color: #fff!important;
}
        .navbar-nav {
                margin:0 auto;
}
        .list-product{
                display:grid;
                grid-template-columns:repeat(4,24%);
}
        .product {
                margin:10px;
                text-align:center;
}
    </style>
    </head>
<body>
            <div class="header">
                <header style='text-align:center'>
</div>
                <div class="logo">                  
                        <img src="{{asset('images/Coffee Logo.png')}}" width="100%">
                </header>
                </div>
                <main style="width:1000px; margin:2px auto;">
        <div class='row'>
        <div class='col-3 pr-0'>
        <nav class="navbar navbar-light">
        <ul class="navbar-nav">
        <ul class="navbar-nav">
<li class="nav-item active">
<a class="nav-link menu-loai-mon" href="{{ url('mon') }}">TRANG CHỦ</a>
</li>
<li class="nav-item">
<a class="nav-link menu-loai-mon" href="{{ url('mon/loaimon/1') }}">CÀ PHÊ</a>
</li>
<li class="nav-item">
<a class="nav-link menu-loai-mon" href="{{ url('mon/loaimon/2') }}">TRÀ SỮA</a>
</li>
<li class="nav-item">
<a class="nav-link menu-loai-mon" href="{{ url('mon/loaimon/3') }}">NƯỚC ÉP</a>
</li>
<li class="nav-item">
<a class="nav-link menu-loai-mon" href="{{ url('mon/loaimon/4') }}">SINH TỐ</a>
</li>
<li class="nav-item">
<a class="nav-link menu-loai-mon" href="{{ url('mon/loaimon/5') }}">TRÀ</a>
</li>
</ul>
</nav>
</div>
                    
<div class='col-9'>
@yield('content')
</div>
</div>
</main>

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
