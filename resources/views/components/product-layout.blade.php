<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" ></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
<style>
    .navbar {
background-color: #ff5850;
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
                <div class="logo">                  
                        <img src="{{asset('images/Coffee Logo.png')}}" width="100%">
                    </a>
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
</body>
</html>
