<?php $__env->startSection('content'); ?>
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
    <?php if(isset($products) && $products->count() > 0): ?>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <!-- Display product details -->
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <p>Không có sản phẩm nào để hiển thị.</p>
    <?php endif; ?>
</div>

<!-- Modal thêm vào giỏ hàng -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="cartForm" method="POST" action="<?php echo e(route('cart.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="modal-header">
          <h5 class="modal-title" id="cartModalLabel">Thông tin đơn hàng</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="product_id" id="modal_product_id" value="">
            <label class="form-label">Chọn size</label><br>
            <?php $__currentLoopData = ['S', 'M', 'L']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="size" value="<?php echo e($size); ?>" id="size<?php echo e($size); ?>" required>
                    <label class="form-check-label" for="size<?php echo e($size); ?>">Size <?php echo e($size); ?></label>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Thêm vào giỏ hàng</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
$(document).ready(function(){
    $(".add-product").click(function(){
        let id = $(this).attr("product_id");
        let num = 1;

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo e(route('cartadd')); ?>",
            data: {
                _token: "<?php echo e(csrf_token()); ?>",
                id: id,
                num: num
            },
            success: function(data){
                $("#cart-number-product").html(data);
            }
        });
    });

    $(".menu-loai-mon").click(function(){
        let loai_mon = $(this).attr("loai-mon");

        $.ajax({
            type: "POST",
            dataType: "html",
            url: "<?php echo e(route('productview')); ?>",
            data: {
                _token: "<?php echo e(csrf_token()); ?>",
                loai_mon: loai_mon
            },
            success: function(data){
                $("#product-view-div").html(data);
            }
        });
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/leluuthaonguyen/Downloads/Quancaphe-master/resources/views/vidumon/index.blade.php ENDPATH**/ ?>