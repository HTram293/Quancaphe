<html>
<head>
</head>
<body>
@foreach($products as $row)
Tên: {{$row->name}}, Gía bán: {{$row->price}}<br>
@endforeach
</body>
</html>
