@extends('layouts.app')

@section('content')
<style>
    .product {
        position: relative;
        margin: 10px;
        text-align: center;
        padding-bottom: 35px;
    }
    .btn-add-product {
        position: absolute;
        bottom: 0;
        width: 100%;
    }
</style>

<h2>Danh sách sản phẩm</h2>
<div class="row list-product">
    @if(isset($data) && $data->count() > 0)
        @foreach($data as $product)
            <div class="col-4 product">
                <div class="card mb-3">
                    <a href="{{ url('product/chitiet/'.$product->id) }}">
                        <img src="{{ asset('product_image/'.$product->image) }}" width="100%" height="200px">
                        <div class="card-body text-center">
                            <b>{{ $product->name }}</b><br>
                            <i>{{ number_format($product->price, 0, ',', '.') }}đ</i>
                        </div>
                    </a>
                    <div class="btn-add-product">
                        <button class="btn btn-success btn-sm add-product" product_id="{{ $product->id }}">
                            Thêm vào giỏ hàng
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>Không có sản phẩm nào để hiển thị.</p>
    @endif
</div>

<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="cartForm" method="POST" action="{{ route('cart.store') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="cartModalLabel">Thông tin đơn hàng</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="product_id" id="modal_product_id" value="">
            <label class="form-label">Chọn size</label><br>
            @foreach(['S', 'M', 'L'] as $size)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="size" value="{{ $size }}" id="size{{ $size }}" required>
                    <label class="form-check-label" for="size{{ $size }}">Size {{ $size }}</label>
                </div>
            @endforeach
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Thêm vào giỏ hàng</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="orderForm" method="POST" action="{{ route('cart.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Thông tin đơn hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="modal_product_id" value="">
                    <input type="hidden" name="product_price" id="modal_product_price" value="">

                    <label class="form-label">🧊 Chọn Size:</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="size" value="S" id="sizeS" data-price="0" required>
                        <label class="form-check-label" for="sizeS">Size S: +0₫</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="size" value="M" id="sizeM" data-price="7000" required>
                        <label class="form-check-label" for="sizeM">Size M: +7,000₫</label>
                    </div>

                    <label class="form-label mt-3">🍬 Độ ngọt:</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sweetness" value="Normal" id="sweetnessNormal" required>
                        <label class="form-check-label" for="sweetnessNormal">Ngọt bình thường</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sweetness" value="Medium" id="sweetnessMedium" required>
                        <label class="form-check-label" for="sweetnessMedium">Ngọt vừa</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sweetness" value="Low" id="sweetnessLow" required>
                        <label class="form-check-label" for="sweetnessLow">Ít ngọt</label>
                    </div>

                    <label class="form-label mt-3">❄️ Chọn đá:</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="ice" value="Regular" id="iceRegular" required>
                        <label class="form-check-label" for="iceRegular">Đá bình thường</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="ice" value="Less" id="iceLess" required>
                        <label class="form-check-label" for="iceLess">Ít đá</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Thêm vào giỏ hàng</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Quay lại</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function(){
    $(".btn-add-product").click(function(){
        let productId = $(this).attr("product_id");
        let productName = $(this).attr("product_name");
        let productPrice = $(this).attr("product_price");

        $("#modal_product_id").val(productId);
        $("#modal_product_price").val(productPrice);
        $("#orderModalLabel").text("Thông tin đơn hàng: " + productName);

        $("#orderModal").modal('show');
    });
});
</script>
@endpush