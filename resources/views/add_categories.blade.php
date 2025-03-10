<html>
<head>
    <title>Thêm thể loại</title>
</head>
<body>
    <h2>NHẬP THỂ LOẠI</h2>
    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="/add_categories" method="POST">
        @csrf
        <table>
        <tr>
            <td>ID</td>
            <td>Tên thể loại</td>
        </tr>
        <tr>
           <td><input type="text" name="id[]" id="id"><br><br></td>
           <td><input type="text" name="id[]" id="id"><br></td>
        </tr>
        <tr> 
           <td><input type="text" name="ten_the_loai[]" id="ten_the_loai"><br><br></td>
           <td><input type="text" name="ten_the_loai[]" id="ten_the_loai"><br><br></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
            <input type="submit" value="Lưu" name="submit"></td>
        </tr>
    </table>
    </form>
</body>
</html>