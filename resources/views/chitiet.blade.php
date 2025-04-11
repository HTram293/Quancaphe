<x-product-layout>
    <x-slot name='title'>
        {{ $data->name }} | Product
    </x-slot>

    <style>
        .product-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .product-info {
            display: grid;
            grid-template-columns: 40% 60%;
            gap: 30px;
            margin-top: 20px;
        }
        .product-image {
            width: 100%;
            height: auto;
            border-radius: 8px;
            object-fit: cover;
        }
        .product-details {
            padding: 15px;
        }
        .product-meta {
            margin-bottom: 20px;
        }
        .product-meta div {
            margin-bottom: 10px;
            font-size: 16px;
        }
        .product-description {
            margin: 30px 0;
            line-height: 1.6;
        }
        .quantity-input {
            width: 80px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .add-to-cart-btn {
            padding: 8px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }
        .add-to-cart-btn:hover {
            background-color: #218838;
        }
        .modal {
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
        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            text-align: center;
        }
        .modal-content button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>

    <div class="product-container">
        <h2>{{ $data->name }}</h2>
        <p>{{ $data->description }}</p>
        <img src="{{ asset('product_image/' . $data->image) }}" alt="{{ $data->name }}">
        
        <div class="product-info">
            <div>
                <img src="{{ asset('storage/' . $data->product_image) }}" alt="{{ $data->name }}" class="product-image">
            </div>
            
            <div class="product-details">
                <div class="product-meta">
                    <div><strong>Phân loại:</strong> {{ $data->category }}</div>
                    <div><strong>Giá:</strong> {{ number_format($data->price) }} VND</div>
                    <div><strong>Trạng thái:</strong> 
                        @if($data->stock > 0)
                            {{ $data->stock }} sản phẩm có sẵn
                        @else
                            Tạm hết hàng
                        @endif
                    </div>
                </div>
                
                <div class="product-description">
                    <h4>Mô tả sản phẩm</h4>
                    <p>{{ $data->description }}</p>
                </div>
                
                <div class="product-actions">
                    <label for="product-number">Số lượng mua:</label>
                    <input type="number" id="product-number" class="quantity-input" min="1" max="{{ $data->stock }}" value="1">
                    <button class="add-to-cart-btn" id="add-to-cart">Thêm vào giỏ hàng</button>
                </div>

                <div id="cart-modal" class="modal">
                    <div class="modal-content">
                        <h4>Thông tin sản phẩm</h4>
                        <p>Sản phẩm đã được thêm vào giỏ hàng!</p>
                        <button id="close-modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function(){
        $("#add-to-cart").click(function(){
            var id = "{{ $data->id }}";
            var num = $("#product-number").val();
            
            if(num < 1 || num > {{ $data->stock }}) {
                alert('Vui lòng nhập số lượng hợp lệ');
                return false;
            }

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('cartadd') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "num": num
                },
                success: function(data){
                    $("#cart-number-product").html(data);

                    $("#cart-modal").fadeIn();
                },
                error: function(xhr, status, error){
                    alert('Có lỗi xảy ra: ' + error);
                }
            });
        });

        $("#close-modal").click(function(){
            $("#cart-modal").fadeOut();
        });


        $(window).click(function(event) {
            if ($(event.target).is("#cart-modal")) {
                $("#cart-modal").fadeOut();
            }
        });
    });
    </script>
</x-product-layout>