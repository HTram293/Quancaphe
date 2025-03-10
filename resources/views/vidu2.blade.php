<form action="{{url('tinhtong')}}" method = "post">
Số thứ nhất: <input type='text' name='so_a'><br>
Số thứ hai: <input type='text' name='so_b'><br>
<input type='submit' value='Kết quả'>
{{ csrf_field() }}
</form>
