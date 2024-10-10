<?php $__env->startSection('css'); ?>
    <style>
        .variant-list {
            margin-top: 10px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            display: none;
            /* Ẩn các biến thể ban đầu */
        }

        .toggle-variants {
            cursor: pointer;
            /* Thêm con trỏ tay cho các nút xổ ra */
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-page">
        <div class="content">
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
                                <a href="<?php echo e(route('sanphams.create')); ?>" class="btn btn-success">Thêm Sản Phẩm</a>
                            </div>
                            <?php if(session('success')): ?>
                                <div class="alert alert-success alert-dismissable fade show" role="alert">
                                    <?php echo e(session('success')); ?>

                                    <button type="button" class="btn-close justify-content-center" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div><!-- end card header -->

                    <div class="row">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Danh Mục</th>
                                            <th scope="col">Tên Sản Phẩm</th>
                                            <th scope="col">Giá Gốc</th>
                                            <th scope="col">Giá Khuyến Mãi</th>
                                            <th scope="col">Ảnh Sản Phẩm</th>
                                            <th scope="col">Số Lượng</th>
                                            <th scope="col">Mô tả sản Phẩm</th>
                                            <th scope="col">Trạng Thái</th>
                                            <th scope="col">Biến Thể</th>
                                            <th scope="col">Hành Động</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        

                                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <th scope="row"><?php echo e($index + 1); ?></th>
                                                <td><?php echo e($item->danh_muc?->ten_danh_muc); ?></td>
                                                <td><?php echo e($item->ten_san_pham); ?></td>
                                                <td><?php echo e(number_format($item->gia_goc, 0, ',', '.')); ?> VND</td>
                                                <td><?php echo e(number_format($item->gia_km, 0, ',', '.')); ?> VND</td>
                                                <td>
                                                    <?php if($item->anh_san_pham): ?>
                                                        <img src="<?php echo e(asset('storage/' . $item->anh_san_pham)); ?>"
                                                            alt="Hình ảnh sản phẩm" width="50px">
                                                    <?php else: ?>
                                                        <img src="<?php echo e(asset('images/placeholder.png')); ?>" alt="Không có ảnh"
                                                            width="50px">
                                                        <!-- Placeholder image -->
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e($item->so_luong); ?></td>
                                                <td><?php echo e($item->ma_ta_san_pham); ?></td>
                                                <td><?php echo $item->is_active
                                                    ? '<span class="badge bg-primary">Hiển Thị</span>'
                                                    : '<span class="badge bg-danger">Ẩn</span>'; ?></td>

                                                <td>
                                                    <div id="variants-<?php echo e($item->id); ?>" class="variant-list">
                                                        <?php if($item->bien_the_san_phams->isNotEmpty()): ?>
                                                            <?php $__currentLoopData = $item->bien_the_san_phams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($variant->so_luong > 0): ?>
                                                                    <!-- Kiểm tra số lượng lớn hơn 0 -->
                                                                    <?php if($variant->sizeSanPham && $variant->colorSanPham): ?>
                                                                        <p>
                                                                            Size: <?php echo e($variant->sizeSanPham->ten_size); ?>

                                                                            -
                                                                            Màu:
                                                                            <?php echo e($variant->colorSanPham->ten_color); ?> -
                                                                            Số lượng: <?php echo e($variant->so_luong); ?>

                                                                        </p>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                            <p>Không có biến thể nào.</p>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="<?php echo e(route('sanphams.edit', $item->id)); ?>">
                                                        <i
                                                            class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                    </a>
                                                    <form action="<?php echo e(route('sanphams.destroy', $item->id)); ?>"
                                                        method="POST" style="display:inline;"
                                                        onsubmit="return confirm('Bạn có muốn xóa sản phẩm này không?')">
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

                    <?php echo e($data->links()); ?>

                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
    </div>

<?php $__env->startSection('js'); ?>
    <script>
        document.querySelectorAll('.toggle-variants').forEach(function(toggle) {
            toggle.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const targetElement = document.querySelector(targetId);

                // Kiểm tra sự tồn tại của phần tử mục tiêu
                if (targetElement) {
                    if (targetElement.style.display === "none" || targetElement.style.display === "") {
                        targetElement.style.display = "block"; // Hiển thị phần tử
                        this.querySelector('.plus-icon').textContent = '-'; // Đổi biểu tượng
                    } else {
                        targetElement.style.display = "none"; // Ẩn phần tử
                        this.querySelector('.plus-icon').textContent = '+'; // Đổi biểu tượng
                    }
                } else {
                    console.log('Element not found for ID:', targetId);
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\du_an_tot_nghiep\resources\views/admin/sanpham/index.blade.php ENDPATH**/ ?>