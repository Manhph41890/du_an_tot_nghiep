<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-page">

        <div class="content">

            <!-- Start Content-->
            <div class="container-xxl">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0"> <?php echo e($title); ?> </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0"></h5>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <form action="<?php echo e(route('phuongthucthanhtoans.store')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                
                                                <label for="kieu_thanh_toan" class="form-label">Kiểu thanh toán </label>
                                                <select type="text" id="kieu_thanh_toan" name="kieu_thanh_toan"
                                                    class="form-select <?php $__errorArgs = ['kieu_thanh_toan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    value="<?php echo e(old('kieu_thanh_toan')); ?>">
                                                    
                                                    <option selected>Chọn phương thức thanh toán</option>
                                                    <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
                                                    <option value="Thanh toán online">Thanh toán online</option>
                                                </select>
                                                <?php $__errorArgs = ['kieu_thanh_toan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback">
                                                        <?php echo e($message); ?>

                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\du_an_tot_nghiep\du_an_tot_nghiep\resources\views/admin/phuongthucthanhtoan/create.blade.php ENDPATH**/ ?>