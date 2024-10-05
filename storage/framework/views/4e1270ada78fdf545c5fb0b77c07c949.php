<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="content-page">

        <div class="content">

            <!-- Start Content-->
            <div class="container">

                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">Danh sách người dùng</h4>
                    </div>
                </div>

                <!-- Striped Rows -->
                <div class="col-xl-12">
                    <div class="card">

                        <div class="d-flex justify-content-between">
                            <!-- Hiển thị thông báo thành công -->
                            <?php if(session('success')): ?>
                                <div class="alert alert-success alert-dismissable fade show " role="alert">
                                    <?php echo e(session('success')); ?>

                                    <button type="button" class="btn-close justify-content-center" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                        </div><!-- end card header -->

                        <div class="row">
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class="table table-striped mb-0">

                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">ID Chức vụ</th>
                                                <th scope="col">Họ và tên</th>
                                                <th scope="col">Ảnh đại diện</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Số điện thoại</th>
                                                <th scope="col">Ngày sinh</th>
                                                <th scope="col">Địa chỉ</th>
                                                <th scope="col">Giới tính</th>
                                                <th scope="col">Mật khẩu</th>
                                                <th scope="col">Trạng thái</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($item->id); ?></td>
                                                    <td><?php echo e($item->chuc_vus?->ten_chuc_vu); ?></td>
                                                    <td><?php echo e($item->ho_ten); ?></td>
                                                    <td><img src="<?php echo e(asset('storage/' . $item->anh_dai_dien)); ?>"
                                                            alt="Hình ảnh bài viết" width="150px"></td>
                                                    <td><?php echo e($item->email); ?></td>
                                                    <td><?php echo e($item->so_dien_thoai); ?></td>
                                                    <td><?php echo e($item->ngay_sinh); ?></td>
                                                    <td><?php echo e($item->dia_chi); ?></td>
                                                    <td><?php echo e($item->gioi_tinh); ?></td>
                                                    <td><?php echo e($item->mat_khau); ?></td>
                                                    <td><?php echo e($item->is_active); ?></td>

                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>


                        </div>

                    </div>

                </div>


            </div> <!-- container-fluid -->

        </div>
    </div>

<?php $__env->startSection('js'); ?>
    <!-- Include your JS files here -->
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\du_an_tot_nghiep\resources\views/admin/user/index.blade.php ENDPATH**/ ?>