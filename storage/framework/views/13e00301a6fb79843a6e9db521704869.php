<?php $__env->startSection('title'); ?>
    
<?php $__env->stopSection(); ?>

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
                                <form action="<?php echo e(route('baiviets.update', $post->id)); ?>" method="POST"
                                    enctype="multipart/form-data">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div class="mb-3">
                                        <label for="anh_bai_viet" class="form-label">Hình ảnh bài viết </label>
                                        <input type="file" id="anh_bai_viet" name="anh_bai_viet" class="form-control">
                                        <div class="mt-2">
                                            <?php if($post->anh_bai_viet): ?>
                                                <img id="imagePreview" src="<?php echo e(asset('storage/' . $post->anh_bai_viet)); ?>"
                                                    alt="Hình ảnh" style="width: 200px;">
                                            <?php else: ?>
                                                <img id="imagePreview" src="#" alt="Hình ảnh"
                                                    style="display: none; width: 200px;">
                                            <?php endif; ?>
                                        </div>

                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="tieu_de_bai_viet">Tiêu đề bài viết</label>
                                        <input type="text" name="tieu_de_bai_viet" value="<?php echo e($post->tieu_de_bai_viet); ?>"
                                            class="form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="noi_dung">Nội dung</label>
                                        <textarea type="text" name="noi_dung" class="form-control"><?php echo e($post->noi_dung); ?></textarea>

                                        <div class="mb-3">
                                            <label for="user_id" class="form-label">Tác giả</label>
                                            <select class="form-select" name="user_id" id="user_id">
                                                <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $ho_ten): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($id); ?>"
                                                        <?php echo e($id == $post->user_id ? 'selected' : ''); ?>>
                                                        <?php echo e($ho_ten); ?> </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="form-group  mb-3">
                                            <label for="ngay_dang">Ngày Đăng:</label>
                                            <input type="date" name="ngay_dang" value="<?php echo e($post->ngay_dang); ?>"
                                                class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label for="is_active" class="form-label">Trạng thái</label>
                                            <div class="col-sm-10 mb-3 d-flex gap-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_active"
                                                        id="trang_thai_show" value="0"
                                                        <?php echo e(old('is_active', $post->is_active) == '0' ? 'checked' : ' ?>'); ?>>
                                                    <label
                                                        class="form-check-label
                                                        text-success"
                                                        for="trang_thai_show">Hiển
                                                        thị</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_active"
                                                        id="trang_thai_hide" value="1"
                                                        <?php echo e(old('is_active', $post->is_active) == '1' ? 'checked' : ''); ?>>
                                                    <label class="form-check-label text-danger"
                                                        for="trang_thai_hide">Ẩn</label>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\du_an_tot_nghiep\resources\views/admin/baiviet/edit.blade.php ENDPATH**/ ?>