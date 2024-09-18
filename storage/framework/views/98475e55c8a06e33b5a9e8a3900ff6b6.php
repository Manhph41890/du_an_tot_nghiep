

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
                        <h4 class="fs-18 fw-semibold m-0"> Quản lý khuyến mãi </h4>
                    </div>
                </div>

                <!-- Striped Rows -->
                <div class="col-xl-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title mb-0">Tên khuyến mãi </h5>
                            <a href="<?php echo e(route('khuyenmais.create')); ?>" class="btn btn-success">Thêm mã khuyến mãi </a>
                        </div><!-- end card header -->
                        <div class="row">
                            <div class="card-body">
                                <div class="table-responsive">

                                    <!-- Hiển thị thông báo thành công -->
                                    <?php if(session('success')): ?>
                                        <div class="alert alert-success alert-dismissable fade show " role="alert">
                                            <?php echo e(session('success')); ?>

                                            <button type="button" class="btn-close justify-content-center"
                                                data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php endif; ?>
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Tên khuyến mãi</th>
                                                <th scope="col">Mã khuyến mãi </th>
                                                <th scope="col">Giá trị khuyến mãi </th>
                                                <th scope="col">Số lượng mã khuyến mãi </th>
                                                <th scope="col">Ngày bắt đầu </th>
                                                <th scope="col">Ngày kết thúc</th>
                                                <th scope="col">Trạng Thái </th>
                                                <th scope="col">Hành Động </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $khuyenMais; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $khuyenMai): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($key + 1); ?></td>
                                                    <td><?php echo e($khuyenMai->ten_khuyen_mai); ?></td>
                                                    <td><?php echo e($khuyenMai->ma_khuyen_mai); ?></td>
                                                    <td><?php echo e($khuyenMai->gia_tri_khuyen_mai); ?>%</td>
                                                    <td><?php echo e($khuyenMai->so_luong_ma); ?></td>
                                                    <td><?php echo e($khuyenMai->ngay_bat_dau); ?></td>
                                                    <td><?php echo e($khuyenMai->ngay_ket_thuc); ?></td>
                                                    <td
                                                        class="<?php echo e($khuyenMai->is_active == 0 ? 'text-success' : 'text-danger'); ?>">
                                                        <?php echo e($khuyenMai->is_active == 0 ? 'Hiển Thị' : 'Ẩn'); ?>

                                                    </td>
                                                    <td>
                                                        <a href="<?php echo e(route('khuyenmais.edit', $khuyenMai->id)); ?>"
                                                            class="btn btn-warning btn-sm">Sửa</a>
                                                        <form action="<?php echo e(route('khuyenmais.destroy', $khuyenMai->id)); ?>"
                                                            method="POST" style="display:inline-block;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                                        </form>
                                                    </td>
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\datn\du_an_tot_nghiep\resources\views/admin/khuyenmai/index.blade.php ENDPATH**/ ?>