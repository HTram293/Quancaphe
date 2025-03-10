<html>
<head>
</head>
<body>
    <table border="1">
        <tr>
            <th>Mã thể loại</th>
            <th>Tên thể loại</th>

@foreach($the_loai_sach as $row)
<tr>
  <td>{{$row->id}}</td>, 
  <td>{{$row->ten_the_loai}}</td>
@endforeach
</table>
</body>
</html>
