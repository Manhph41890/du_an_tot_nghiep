<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from zoyothemes.com/tapeli/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 16 Jul 2024 08:33:02 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>

    <meta charset="utf-8" />
    <title><?php echo e($title); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset('assets/admin/images/favicon.ico')); ?>">

    <!-- App css -->
    <link href="<?php echo e(asset('assets/admin/css/app.min.css')); ?>" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="<?php echo e(asset('assets/admin/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />

</head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha384-..." crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<!-- body start -->

<body data-menu-color="light" data-sidebar="default">

    <!-- Begin page -->
    <div id="app-layout">

        <?php echo $__env->make('admin.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('admin.partials.siderbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;

        <?php echo $__env->make('admin.partials.siderbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;


        <!-- Start Page Content here -->
        <?php echo $__env->yieldContent('content'); ?>
        <!-- End Page content -->

        <?php echo $__env->make('admin.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>
    </div>
    <!-- END wrapper -->

    <!-- Vendor Scripts -->
    <!-- Vendor -->
    <script src="<?php echo e(asset('assets/admin/libs/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/libs/simplebar/simplebar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/libs/node-waves/waves.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/libs/waypoints/lib/jquery.waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/libs/jquery.counterup/jquery.counterup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/libs/feather-icons/feather.min.js')); ?>"></script>

    <!-- Apexcharts JS -->
    <script src="<?php echo e(asset('assets/admin/libs/apexcharts/apexcharts.min.js')); ?>"></script>

    <!-- Stock prices script -->
    <script src="<?php echo e(asset('assets/admin/apexcharts.com/samples/assets/admin/stock-prices.js')); ?>"></script>

    <!-- Widgets Init Js -->
    <script src="<?php echo e(asset('assets/admin/js/pages/analytics-dashboard.init.js')); ?>"></script>

    <!-- App js-->
    <script src="<?php echo e(asset('assets/admin/js/app.js')); ?>"></script>

</body>

<!-- Mirrored from zoyothemes.com/tapeli/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 16 Jul 2024 08:34:03 GMT -->

</html>
<?php /**PATH D:\laragon\www\du_an_tot_nghiep\resources\views/admin/layout.blade.php ENDPATH**/ ?>