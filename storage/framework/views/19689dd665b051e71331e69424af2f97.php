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

            <!-- Striped Rows -->
            <div class="col-xl-12">
                <div class="card">

                    <div class="card-header ">
                        <div class="row">
                            <div class="col-2">
                                <a href="<?php echo e(route('baiviets.create')); ?>" class="btn btn-success">Thêm bài
                                    viết
                                </a>
                            </div>
                            <div class="col-3">
                                <form action="<?php echo e(route('baiviets.index')); ?>" method="POST"
                                    id="filter-form-km">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('GET'); ?>
                                    <div class="form-group mb-3">
                                        <input type="text" name="search_" class="form-control"
                                            placeholder="Tìm kiếm theo mã khuyến mãi"
                                            onchange="document.getElementById('filter-form-km').submit();">
                                    </div>
                                </form>
                            </div>
                            <div class="col-7">
                                <!-- Hiển thị thông báo thành công -->
                                <?php if (session('success')): ?>
                                    <div class="alert alert-success alert-dismissable fade show " role="alert">
                                        <?php echo e(session('success')); ?>

                                        <button type="button" class="btn-close justify-content-center"
                                            data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tiêu đề bài viết</th>
                                            <th scope="col"> Ảnh bài viết </th>
                                            <th scope="col"> Ngày đăng</th>
                                            <th scope="col">Tác giả</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $baiviets;
                                        $__env->addLoop($__currentLoopData);
                                        foreach ($__currentLoopData as $key => $baiviet): $__env->incrementLoopIndices();
                                            $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($key + 1); ?></td>
                                                <td><?php echo e($baiviet->tieu_de_bai_viet); ?></td>
                                                <td>
                                                    <?php if ($baiviet->anh_bai_viet): ?>
                                                        <img src="<?php echo e(asset('storage/' . $baiviet->anh_bai_viet)); ?>"
                                                            alt="Hình ảnh bv" width="50px">
                                                    <?php else: ?>
                                                        <img src="<?php echo e(asset('images/placeholder.png')); ?>"
                                                            alt="Không có ảnh" width="50px">
                                                        <!-- Placeholder image -->
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e($baiviet->ngay_dang); ?></td>
                                                <td><?php echo e($baiviet->user?->ho_ten); ?></td>
                                                <td
                                                    class="<?php echo e($baiviet->is_active == 0 ? 'text-success' : 'text-danger'); ?>">
                                                    <?php echo e($baiviet->is_active == 0 ? 'Hiển Thị' : 'Ẩn'); ?>

                                                </td>
                                                <td>
                                                    <div>
                                                        <a href="<?php echo e(route('baiviets.show', $baiviet->id)); ?>"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#myModal<?php echo e($baiviet->id); ?>">
                                                            <i
                                                                class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                        </a>

                                                        <!-- The Modal -->
                                                        <div class="modal" id="myModal<?php echo e($baiviet->id); ?>">
                                                            <?php echo $__env->make('admin.baiviet.show', [
                                                                'post' => $baiviet,
                                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                        </div>
                                                    </div>

                                                    <a href="<?php echo e(route('baiviets.edit', $baiviet->id)); ?>"><i
                                                            class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                                    <form action="<?php echo e(route('baiviets.destroy', $baiviet->id)); ?>"
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
                                        <?php endforeach;
                                        $__env->popLoop();
                                        $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div><br>
                            <?php echo e($baiviets->links()); ?>

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


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\du_an_tot_nghiep\resources\views/admin/baiviet/index.blade.php ENDPATH**/ ?>