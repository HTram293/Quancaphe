<x-product-layout>
    <x-slot name='title'>
        {{ $data->name }} | Product
    </x-slot>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
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
        .product-details {
            padding: 15px;
        }
        .product-meta {
            margin-bottom: 20px;
        }
        .product-meta div {
            margin-bottom: 10px;
            font-size: 20px;
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
    </style>

    <div class="product-container">
        <h2>{{ $data->name }}</h2>
        
        <div class="product-info">
            <div>
                <img src="{{ asset('storage/' . $data->product_image) }}" alt="{{ $data->name }}" class="product-image">
            </div>
            
            <div class="product-details" style="display: flex; flex-direction: column; gap: 10px;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <strong>Phân loại:</strong>
                    <span>{{ $data->category }}</span>
                </div>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <strong>Giá:</strong>
                    <span>{{ number_format($data->price) }} VND</span>
                </div>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <strong>Trạng thái:</strong>
                    <span>
                        @if($data->stock > 0)
                            {{ $data->stock }} sản phẩm có sẵn
                        @else
                            Tạm hết hàng
                        @endif
                    </span>
                </div>
            </div>
                 
                <div class="product-description" style="font-size: 18px; text-align: left; margin-top: 20px; width: 100%; word-wrap: break-word; display: block; padding: 0;">
                    <h4 style="font-size: 20px; font-weight: bold; margin-bottom: 10px;">Mô tả sản phẩm</h4>
                    <p style="margin: 0;">{{ $data->description }}</p>
                </div>
                
                <div class="product-actions">
                    <label for="product-number">Số lượng mua:</label>
                    <input type="number" id="product-number" class="quantity-input" min="1" max="{{ $data->stock }}" value="1">
                    <button class="add-to-cart-btn" id="add-to-cart">Thêm vào giỏ hàng</button>
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
                beforeSend: function(){
                },
                success: function(data){
                    $("#cart-number-product").html(data);
                    alert('Đã thêm sản phẩm vào giỏ hàng');
                },
                error: function(xhr, status, error){
                    alert('Có lỗi xảy ra: ' + error);
                },
                complete: function(xhr, status){
                    
                }
            });
        });
    });
    </script>
</x-product-layout>