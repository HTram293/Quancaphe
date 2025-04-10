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
    </style>
<script>
$(document).ready(function(){
$(".add-product").click(function(){
id = $(this).attr("product_id");
num = 1;
$.ajax({
type:"POST",
dataType:"json",
url: "{{route('cartadd')}}",
data:{"_token": "{{ csrf_token() }}","id":id,"num":num},
beforeSend:function(){
},
success:function(data){
$("#cart-number-product").html(data);
},
error: function (xhr,status,error){
},
complete: function(xhr,status){
}
});
});
});
$(".menu-loai-mon").click(function(){
loai-mon= $(this).attr("loai-mon");
$.ajax({
type:"POST",
dataType:"html",
url: "{{route('productview')}}",
data:{"_token": "{{ csrf_token() }}","loai_mon":loai_mon},
beforeSend:function(){
},
success:function(data){
$("#product-view-div").html(data);
},
error: function (xhr,status,error){
},
complete: function(xhr,status){
}
});
});
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
                    <button class="btn btn-success btn-sm mb-1 add-product" product_id="{{ $row->id }}">
                        Thêm vào giỏ hàng
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</x-book-layout>
