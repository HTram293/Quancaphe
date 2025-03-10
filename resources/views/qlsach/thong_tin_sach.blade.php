<html>
<head>
</head>
<body>
    <table border="1">
        <tr>
            <td>Tiêu đề</td>
            <td>Tác giả</td>
        </tr>
    </table>

@foreach($sach as $row)
<tr>
  <td>{{$row->tieu_de}}</td>, 
  <td>{{$row->tac_gia}}</td>
</tr>
@endforeach
</table>
</body>
</html>