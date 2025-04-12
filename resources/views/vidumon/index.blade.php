<x-product-layout>
    <x-slot name='title'> Product
    </x-slot>
    <style>
        .product {
            position: relative;
            margin: 10px;
            text-align: center;
            padding-bottom: 35px;
        }
    
        .btn-add-product {
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    
        .popup-overlay {
            display: none; 
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
    
        .popup-content {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 600px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
    
        .option-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            text-align: left;
        }
    
        .option-group > div {
            width: 30%;
        }
    
        .option-group h4 {
            color: #6b3e00;
            margin-bottom: 10px;
        }
    
        .popup-buttons {
            margin-top: 30px;
            display: flex;
            justify-content: space-around;
        }
    
        .cancel-btn, .confirm-btn {
            padding: 10px 25px;
            border: none;
            border-radius: 20px;
            font-weight: bold;
            cursor: pointer;
        }
    
        .cancel-btn {
            background-color: #e74c3c;
            color: white;
        }
    
        .confirm-btn {
            background-color: #8bc34a;
            color: white;
        }
    
        .add-to-cart-btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
    
        .add-to-cart-btn:hover {
            background-color: #45a049;
        }
    </style>
    
    <script>
        $(document).ready(function () {
            $(".btn-add-product button").click(function () {
                const productId = $(this).data("id"); 
                console.log("Product ID:", productId); 
    
                showPopup();
            });
        });
    
        function showPopup() {
            document.getElementById("popup").style.display = "flex";
        }
    
        function hidePopup() {
            document.getElementById("popup").style.display = "none";
        }
    
        function confirmOrder() {
            const size = document.querySelector('input[name="size"]:checked');
            const sweet = document.querySelector('input[name="sweet"]:checked');
            const ice = document.querySelector('input[name="ice"]:checked');
    
            if (!size || !sweet || !ice) {
                alert("Vui lòng chọn đầy đủ các tuỳ chọn!");
                return;
            }
    
            alert(`Bạn đã chọn:\nSize: ${size.value}\nĐộ ngọt: ${sweet.value}\nĐá: ${ice.value}`);
            hidePopup();
        }
    </script>
    
    <div class="list-product">
        @foreach($data as $row)
            <div class="product">
                <a href="{{ url('product/chitiet/'.$row->id) }}">
                    <img src="{{ asset('product_image/'.$row->image) }}" width="200px" height="200px">
                    <br>
                    <b>{{ $row->name }}</b><br>
                    <i>{{ number_format($row->price, 0, ',', '.') }}đ</i>
                </a>
                <div class="btn-add-product">
                    <!-- Add a data-id attribute to store the product ID -->
                    <button class="btn btn-success btn-sm mb-1" data-id="{{ $row->id }}">Thêm vào giỏ hàng</button>
                </div>
            </div>
        @endforeach
    
        <!-- Popup overlay -->
        <div id="popup" class="popup-overlay">
            <div class="popup-content">
                <h3>Thông tin đơn hàng</h3>
    
                <div class="option-group">
                    <div>
                        <h4>Chọn size</h4>
                        <label><input type="radio" name="size" value="S"> Size S: 0đ</label><br>
                        <label><input type="radio" name="size" value="M"> Size M: +7,000đ</label>
                    </div>
    
                    <div>
                        <h4>Độ ngọt</h4>
                        <label><input type="radio" name="sweet" value="Bình thường"> Ngọt bình thường</label><br>
                        <label><input type="radio" name="sweet" value="Vừa"> Ngọt vừa</label><br>
                        <label><input type="radio" name="sweet" value="Ít"> Ít ngọt</label>
                    </div>
    
                    <div>
                        <h4>Chọn đá</h4>
                        <label><input type="radio" name="ice" value="Bình thường"> Đá bình thường</label><br>
                        <label><input type="radio" name="ice" value="Ít"> Ít đá</label>
                    </div>
                </div>
    
                <div class="popup-buttons">
                    <button class="cancel-btn" onclick="hidePopup()">Quay lại</button>
                    <button class="confirm-btn" onclick="confirmOrder()">Xác nhận và chuyển đến trang đặt bàn</button>
                </div>
            </div>
        </div>
    </div>
    </x-product-layout>