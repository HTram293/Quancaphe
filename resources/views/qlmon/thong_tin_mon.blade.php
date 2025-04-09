<html>
<head>
</head>
<body>
@foreach($products as $row)
Tên: {{$row->name}}, Giá bán: {{$row->price}}<br>
@endforeach
</body>
</html>
