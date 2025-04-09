<x-product-layout>
    <x-slot name='title'>
        Product
    </x-slot>
    <link href='https://fonts.googleapis.com/css?family=Afacad' rel='stylesheet'>

<style>
     body {
            font-family: 'Afacad';
            font-size: 20px;
        }
        h1 {
            text-align: center; /* Center the title */
            margin-bottom: 30px; /* Space below the title */
            color: #e08367; /* Darker color for better readability */
        }
    .info {
        display: grid;
        grid-template-columns: 30% 70%; /* Tỷ lệ cột */
        gap: 20px; /* Khoảng cách giữa các cột */
        margin-bottom: 20px; /* Khoảng cách dưới cùng */
        background-color: #fff; /* Nền trắng cho thông tin sản phẩm */
        border-radius: 10px; /* Bo góc cho khung */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Đổ bóng */
        padding: 20px; /* Padding cho khung */
    }
    .btn-success {
        background-color: #ffe8d1;
        color: black;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 15px;
        cursor: pointer;
        transition: background-color 0.3s; /* Hiệu ứng chuyển động */
        margin-top: 0px;
    }
    .btn-success:hover {
        background-color: #ff9bed; /* Màu nền khi hover */
    }
    .description {
        margin-top: 20px; /* Khoảng cách trên cho mô tả */
        background-color: #fff; /* Nền trắng cho mô tả */
        border-radius: 10px; /* Bo góc cho khung mô tả */
        padding: 15px; /* Padding cho mô tả */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Đổ bóng */
    }
    .quantity {
        margin-top: 20px; /* Khoảng cách trên cho phần số lượng */
        display: flex; /* Flexbox for alignment */
        align-items: center; /* Center items vertically */
        justify-content: center; /* Center items horizontally */
    }
    .quantity input {
        width: 60px; /* Fixed width for input */
        margin-left: 10px 0; /* Space between label and input */
        padding: 5px; /* Padding for input */
        border-radius: 5px; /* Rounded corners */
        border: 1px solid #ccc; /* Border for input */
    }
</style>

    <h1>{{$data->name}}</h1>

    <script>
        $(document).ready(function() {
            $("#add-to-cart").click(function() {
                id = "{{$data->id}}";
                num = $("#product-number").val();
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{route('cartadd')}}",
                    data: {"_token": "{{ csrf_token() }}", "id": id, "num": num},
                    beforeSend: function() {},
                    success: function(data) {
                        $("#cart-number-product").html(data);
                    },
                    error: function(xhr, status, error) {},
                    complete: function(xhr, status) {}
                });
            });
        });
    </script>
   
</div>
<div class='info'>
    <div>
        <img src="{{asset('product_image/'.$data->image)}}" width='400px'
    height='400px'><br>
    </div>
    <div>
        <div>
        Loại món: <b>{{$data->category}}</b><br>
        Giá: <b>{{ number_format($data->price, 0, ',', '.') }}đ</b><br>
        Trạng thái: <b>{{$data->stock}}</b><br>
    </div>
    <div class='description'>
    <b>Mô tả:</b><br>
    {{$data->description}}
</div>
<div class='quantity'style="text-align: center;">
        Số lượng mua:
        <input type='number' id='product-number' size='5' min="1" value="1">
        <button class='btn btn-success btn-sm mb-1' id='add-to-cart'>Thêm vào giỏ hàng</button>
    </div>
    </div>
</x-product-layout>