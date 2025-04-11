<html>
<head>
</head>
<body>
@foreach($loai_mon as $row)
Loại: {{$row->id_category}}, Tên: {{$row->name}}<br>
@endforeach
</body>
</html>