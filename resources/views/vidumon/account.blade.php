<x-account-panel>
@if ($errors->any())
    <div style='color:red;width:30%; margin:0 auto'>
      <div >
        {{ __('Whoops! Something went wrong.') }}
      </div>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif

  <form method = 'post' action="{{route('saveinfo')}}" enctype="multipart/form-data"
style='width:30%; margin:0 auto'>
<div style='text-align:center;font-weight:bold;color:#15c;'>CẬP NHẬT THÔNG TIN KHÁCH HÀNG</div>
<label>Tên khách hàng</label>
<input type='text' class='form-control form-control-sm' name='name' value="{{$user->name}}">
<label>Email</label>
<input type='text' class='form-control form-control-sm' name='email' value="{{$user->email}}">
<label>Số điện thoại</label>
<input type='text' class='form-control form-control-sm' name='phone' value="{{$user->phone}}">
<input type ='hidden' value='{{$user->id}}' name='id'>
{{ csrf_field() }}
<div style='text-align:center;'><input type='submit' class='btn btn-primary mt-1' value='Lưu'></div>
</form>
</x-account-panel>