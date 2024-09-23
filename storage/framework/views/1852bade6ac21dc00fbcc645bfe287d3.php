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
                        <?php if($errors->any()): ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <div class="alert alert-danger" style="width: 100%;">
                                                <ul>
                                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><?php echo e($error); ?></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo e(route('sanphams.store')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Sản phẩm</h5>
                                </div><!-- end card header -->

                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="ten_san_pham" class="form-label">Tên sản phẩm</label>
                                                <input type="text" id="ten_san_pham" name="ten_san_pham"
                                                    class="form-control <?php $__errorArgs = ['ten_san_pham'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    value="<?php echo e(old('ten_san_pham')); ?>">
                                                <?php $__errorArgs = ['ten_san_pham'];
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
                                            <div class="mb-3">
                                                <label for="gia_goc" class="form-label">Giá gốc</label>
                                                <input type="number" id="gia_goc" name="gia_goc"
                                                    class="form-control <?php $__errorArgs = ['gia_goc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    value="<?php echo e(old('gia_goc')); ?>">
                                                <?php $__errorArgs = ['gia_goc'];
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
                                            <div class="mb-3">
                                                <label for="danh_muc_id" class="form-label">Danh mục</label>
                                                <select type="text" class="form-select" name="danh_muc_id"
                                                    id="danh_muc_id">
                                                    <?php $__currentLoopData = $danh_mucs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $ten_danh_muc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($id); ?>"><?php echo e($ten_danh_muc); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php $__errorArgs = ['danh_muc_id'];
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
                                            <div class="mb-3">
                                                <label for="gia_km" class="form-label">Giá khuyến mãi</label>
                                                <input type="number" id="gia_km" name="gia_km"
                                                    class="form-control <?php $__errorArgs = ['gia_km'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    value="<?php echo e(old('gia_km')); ?>">
                                                <?php $__errorArgs = ['gia_km'];
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

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="anh_san_pham" class="form-label">Hình ảnh </label>
                                                <input type="file" id="anh_san_pham" name="anh_san_pham"
                                                    class="form-control <?php $__errorArgs = ['anh_san_pham'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <?php $__errorArgs = ['anh_san_pham'];
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
                                                <div class="mt-2">
                                                    <img id="imagePreview" src="#" alt="Hình ảnh"
                                                        style="display: none;width:200px;">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="so_luong" class="form-label">Số lượng</label>
                                                <input type="number" id="so_luong" name="so_luong"
                                                    class="form-control <?php $__errorArgs = ['so_luong'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    value="<?php echo e(old('so_luong')); ?>">
                                                <?php $__errorArgs = ['so_luong'];
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
                                            <div class="mb-3">
                                                <label for="ma_ta_san_pham" class="form-label">Mô tả sản phẩm</label>
                                                <input type="text" id="ma_ta_san_pham" name="ma_ta_san_pham"
                                                    class="form-control <?php $__errorArgs = ['ma_ta_san_pham'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    value="<?php echo e(old('ma_ta_san_pham')); ?>">
                                                <?php $__errorArgs = ['ma_ta_san_pham'];
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

                                        <div class="mb-3">
                                            <label for="trang_thai" class="form-label">Trạng thái</label>
                                            <div class="col-sm-10 mb-3 d-flex gap-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_active"
                                                        id="trang_thai_show" value="1"
                                                        <?php echo e(old('is_active') == 1 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label text-success"
                                                        for="trang_thai_show">Hiển thị</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_active"
                                                        id="trang_thai_hide" value="0"
                                                        <?php echo e(old('is_active') == 0 ? 'checked' : ''); ?>>
                                                    <label class="form-check-label text-danger"
                                                        for="trang_thai_hide">Ẩn</label>
                                                </div>
                                                <?php $__errorArgs = ['is_active'];
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

                                    </div>
                                </div>

                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Biến Thể</h5>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="color_san_pham" class="form-label">Màu sắc</label>
                                                <input type="text" id="color_san_pham"
                                                    name="product_variants[1-2][color]"
                                                    class="form-control <?php $__errorArgs = ['product_variants.1-2.color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    value="<?php echo e(old('product_variants.1-2.color')); ?>">
                                                <?php $__errorArgs = ['product_variants.1-2.color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="mb-3">
                                                <label for="size_san_pham" class="form-label">Size sản phẩm</label>
                                                <input type="text" id="size_san_pham"
                                                    name="product_variants[1-2][size]"
                                                    class="form-control <?php $__errorArgs = ['product_variants.1-2.size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    value="<?php echo e(old('product_variants.1-2.size')); ?>">
                                                <?php $__errorArgs = ['product_variants.1-2.size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>

                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="anh_bien_the" class="form-label">Hình ảnh biến thể</label>
                                                <input type="file" id="anh_bien_the"
                                                    name="product_variants[1-2][anh_bien_the]"
                                                    class="form-control <?php $__errorArgs = ['product_variants.1-2.anh_bien_the'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <?php $__errorArgs = ['product_variants.1-2.anh_bien_the'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                <div class="mt-2">
                                                    <img id="imagePreview" src="#" alt="Hình ảnh biến thể"
                                                        style="display: none;width:200px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div> <!-- container-fluid -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        document.getElementById('anh_san_pham').addEventListener('change', function() {
            const file = this.files[0];
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (file && !validTypes.includes(file.type)) {
                alert('Chỉ cho phép tải lên các loại file: jpeg, png, jpg, gif');
                this.value = ''; // Clear the file input
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\du_an_tot_nghiep\du_an_tot_nghiep\resources\views/admin/sanpham/create.blade.php ENDPATH**/ ?>