<x-product-layout>
    <x-slot name='title'>
        Product
    </x-slot>
    <style>
        .info {
            display: grid;
            grid-template-columns: 1fr 1fr; 
            gap: 10px; 
            margin-top: 20px;
            align-items: center; 
        }
        .info .image-box {
            text-align: center;
            width: 250px;
            height: 250px; 
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .info .image-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }
        .info .details {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            text-align: left;
        }
        .info .details b {
            margin-bottom: 8px; 
        }
        .product-title {
            font-family: 'Afacad', sans-serif;
            font-size: 2.5rem;
            color: #4E1F00; 
            text-align: center;
            margin-top: 20px;
        }
        .popup-overlay {
                display: none;
                position: fixed;
                top: 0; left: 0;
                width: 100%; height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 1000;
                justify-content: center;
                align-items: center;
            }
        
            .popup-content {
                background-color: white;
                padding: 20px;
                border-radius: 8px;
                text-align: center;
            }
        
            .close-btn {
                margin-top: 10px;
                padding: 5px 10px;
                border: none;
                background-color: #ccc;
                border-radius: 4px;
                cursor: pointer;
            }
        
            .close-btn:hover {
                background-color: #bbb;
            }
            .popup-overlay {
  display: none;
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background-color: rgba(0,0,0,0.5);
  z-index: 999;
  justify-content: center;
  align-items: center;
}

.popup-content {
  background: white;
  padding: 30px;
  border-radius: 10px;
  width: 600px;
  text-align: center;
  box-shadow: 0 0 10px rgba(0,0,0,0.2);
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
    <div class="product-title">
        {{$data->name}}
    </div>
    <script>
        $(document).ready(function(){
            $("#add-to-cart").click(function(){
                id = "{{$data->id}}";
                num = $("#product-number").val()
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{route('cartadd')}}",
                    data: {"_token": "{{ csrf_token() }}", "id": id, "num": num},
                    beforeSend: function(){},
                    success: function(data){
                        $("#cart-number-product").html(data);
                    },
                    error: function(xhr, status, error){},
                    complete: function(xhr, status){}
                });
            });
        });
    </script>
    <div class='info'>
        <div class="image-box">
            <img src="{{asset('product_image/'.$data->image)}}" alt="Product Image">
        </div>
        <div class="details">
            <b>Loại món: {{$data->category}}</b>
            <b>Giá: {{$data->price}}đ</b>
            <b>Trạng thái: {{$data->stock}}</b>
        </div>
    </div> 
    <div class='row'>
        <div class='col-sm-12'>
            <b>Mô tả:</b><br>
            {{$data->description}}
        </div>
        <div class='mt-1'>
            Số lượng mua:
            <input type='number' id='product-number' size='5' min="1" value="1">
            <button class='btn btn-success btn-sm mb-1' onclick="showPopup()">Thêm vào giỏ hàng</button>
        </div>
        
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
        
        <script>
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

        
</x-product-layout>


