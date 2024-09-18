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
                        <h4 class="fs-18 fw-semibold m-0">Quản lý danh mục </h4>
                    </div>
                </div>

                <!-- Striped Rows -->
                <div class="col-xl-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title mb-0">Tên </h5>
                            <a href="<?php echo e(route('danhmucs.create')); ?>" class="btn btn-success">Thêm Danh Mục </a>
                        </div><!-- end card header -->
                        <div class="row">
                            <div class="card-body">
                                <div class="table-responsive">

                                    <!-- Hiển thị thông báo thành công -->
                                    
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Tên danh mục</th>
                                                <th scope="col">Trạng Thái </th>
                                                <th scope="col">Hành Động </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $danhmucs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <th scope="row"><?php echo e($index + 1); ?></th>
                                                    <td>
                                                        <img src="<?php echo e(Storage::url($item->anh_danh_muc)); ?>" width="100px"
                                                            alt="">
                                                    </td>
                                                    <td><?php echo e($item->ten_danh_muc); ?></td>
                                                    <td class="<?php echo e($item->is_active ? 'text-success' : 'text-danger'); ?>">
                                                        <?php echo e($item->is_active ? 'Hiển Thị' : 'Ẩn'); ?>

                                                    </td>
                                                    <td>
                                                        <a href="<?php echo e(route('danhmucs.edit', $item->id)); ?>"><i
                                                                class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                                        <form action="<?php echo e(route('danhmucs.destroy', $item->id)); ?>"
                                                            method="POST" style="display:inline;"
                                                            onsubmit="return confirm ('Bạn có muốn xóa danh mục sản phẩm này không ?') ">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" style="border: none; background: none;">
                                                                <i
                                                                    class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php echo e($danhmucs->links()); ?>

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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\datn\du_an_tot_nghiep\resources\views/admin/danhmuc/index.blade.php ENDPATH**/ ?>