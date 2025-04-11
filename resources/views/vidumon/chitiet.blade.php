<x-product-layout>
    <x-slot name='title'>
        Product
    </x-slot>
<style>
    .info
    {
        display:grid;
        grid-template-columns:repeat(2,30% 70%);
    }
    </style>
    <h4>{{$data->name}}</h4>
    <script>
$(document).ready(function(){
$("#add-to-cart").click(function(){
id = "{{$data->id}}";
num = $("#product-number").val()
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
</script>
    <div class='info'>
        <div>
        <img src="{{asset('product_image/'.$data->image)}}" width='200px'
        height='200px'><br>
    </div>
    <div>
        Loại món: <b>{{$data->category}}</b><br>
        Gía: <b>{{$data->price}}</b><br>
        Trạng thái: <b>{{$data->stock}}</b><br>
</div>
</div>
<div class ='row'>
    <div class='col-sm-12'>
        <b>Mô tả:</b><br>
        {{$data->description}}
</div>
<div class='mt-1'>
Số lượng mua:
<input type='number' id='product-number' size='5' min="1" value="1">
<button class='btn btn-success btn-sm mb-1' id='add-to-cart'>Thêm vào giỏ hàng</button>
</div>
</div>
</x-product-layout>


