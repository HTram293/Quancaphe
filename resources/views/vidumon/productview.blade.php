<div class='list-product'>
@foreach($data as $row)
<div class='product'>
<a href="{{url('product/chitiet/'.$row->id)}}">
<img src="{{asset('storage/product_image/'.$row->image)}}" width='200px' height='200px'><br>
<b>{{$row->name}}</b><br/>
<i>{{number_format($row->price,0,",",".")}}đ</i><br>
</a>
<div class='btn-add-product'>
<button class='btn btn-success btn-sm mb-1 add-product' product_id="{{$row->id}}">
Thêm vào giỏ hàng
</button>
</div>
</div>
@endforeach
</div>