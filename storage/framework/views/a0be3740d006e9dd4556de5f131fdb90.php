<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="content-page">

        <div class="content">

            <!-- Start Content-->
            <div class="container">

                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0"><?php echo e($title); ?></h4>
                    </div>
                </div>

                <!-- Striped Rows -->
                <div class="col-xl-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <a href="<?php echo e(route('chucvus.create')); ?>" class="btn btn-success">Thêm Chức Vụ</a>
                            </div>
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
                                                <th scope="col">#</th>
                                                <th scope="col">Tên chức vụ</th>
                                                <th scope="col">Mô tả chức vụ</th>
                                                <th scope="col">Hành Động </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $__currentLoopData = $chucvus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <th scope="row"><?php echo e($index + 1); ?></th>
                                                    <td><?php echo e($item->ten_chuc_vu); ?></td>
                                                    <td><?php echo e($item->mo_ta_chuc_vu); ?></td>
                                                    <td>
                                                        <a href="<?php echo e(route('chucvus.edit', $item->id)); ?>"><i
                                                                class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                                        <form action="<?php echo e(route('chucvus.destroy', $item->id)); ?>"
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


                        </div>

                        <?php echo e($chucvus->links()); ?>

                    </div>

                </div>


            </div> <!-- container-fluid -->

        </div>
    </div>

<?php $__env->startSection('js'); ?>
    <!-- Include your JS files here -->
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\du_an_tot_nghiep\du_an_tot_nghiep\resources\views/admin/chucvu/index.blade.php ENDPATH**/ ?>