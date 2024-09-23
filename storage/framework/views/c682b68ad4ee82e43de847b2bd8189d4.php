<?php $__env->startSection('content'); ?>
<div class="content-page">
<div class="content">

<!-- Start Content-->
<div class="container-xxl">

    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Dashboard</h4>
        </div>
    </div>

    <!-- start row -->
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="row g-3">

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="fs-14 mb-1">Website Traffic</div>
                            </div>

                            <div class="d-flex align-items-baseline mb-2">
                                <div class="fs-22 mb-0 me-2 fw-semibold text-black">91.6K</div>
                                <div class="me-auto">
                                    <span class="text-primary d-inline-flex align-items-center">
                                        15%
                                        <i data-feather="trending-up" class="ms-1" style="height: 22px; width: 22px;"></i>
                                    </span>
                                </div>
                            </div>
                            <div id="website-visitors" class="apex-charts"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="fs-14 mb-1">Conversion rate</div>
                            </div>

                            <div class="d-flex align-items-baseline mb-2">
                                <div class="fs-22 mb-0 me-2 fw-semibold text-black">15%</div>
                                <div class="me-auto">
                                    <span class="text-danger d-inline-flex align-items-center">
                                        10%
                                        <i data-feather="trending-down" class="ms-1" style="height: 22px; width: 22px;"></i>
                                    </span>
                                </div>
                            </div>
                            <div id="conversion-visitors" class="apex-charts"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="fs-14 mb-1">Session duration</div>
                            </div>

                            <div class="d-flex align-items-baseline mb-2">
                                <div class="fs-22 mb-0 me-2 fw-semibold text-black">90 Sec</div>
                                <div class="me-auto">
                                    <span class="text-success d-inline-flex align-items-center">
                                        25%
                                        <i data-feather="trending-up" class="ms-1" style="height: 22px; width: 22px;"></i>
                                    </span>
                                </div>
                            </div>
                            <div id="session-visitors" class="apex-charts"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="fs-14 mb-1">Active Users</div>
                            </div>

                            <div class="d-flex align-items-baseline mb-2">
                                <div class="fs-22 mb-0 me-2 fw-semibold text-black">2,986</div>
                                <div class="me-auto">
                                    <span class="text-success d-inline-flex align-items-center">
                                        4%
                                        <i data-feather="trending-up" class="ms-1" style="height: 22px; width: 22px;"></i>
                                    </span>
                                </div>
                            </div>
                            <div id="active-users" class="apex-charts"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end sales -->
    </div> <!-- end row -->

    <!-- Start Monthly Sales -->
    <div class="row">
        <div class="col-md-6 col-xl-8">
            <div class="card">
                
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                            <i data-feather="bar-chart" class="widgets-icons"></i>
                        </div>
                        <h5 class="card-title mb-0">Monthly Sales</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div id="monthly-sales" class="apex-charts"></div>
                </div>
                
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card overflow-hidden">

                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                            <i data-feather="tablet" class="widgets-icons"></i>
                        </div>
                        <h5 class="card-title mb-0">Best Traffic Source</h5>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-traffic mb-0">
                            <tbody>
                                <thead>
                                    <tr>
                                        <th>Network</th>
                                        <th colspan="2">Visitors</th>
                                    </tr>
                                </thead>

                                <tr>
                                    <td>Instagram</td>
                                    <td>3,550</td>
                                    <td class="w-50">
                                        <div class="progress progress-md mt-0">
                                            <div class="progress-bar bg-danger" style="width: 80.0%"></div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Facebook</td>
                                    <td>1,245</td>
                                    <td class="w-50">
                                        <div class="progress progress-md mt-0">
                                            <div class="progress-bar bg-primary" style="width: 55.9%"></div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Twitter</td>
                                    <td>1,798</td>
                                    <td class="w-50">
                                        <div class="progress progress-md mt-0">
                                            <div class="progress-bar bg-secondary" style="width: 67.0%"></div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>YouTube</td>
                                    <td>986</td>
                                    <td class="w-50">
                                        <div class="progress progress-md mt-0">
                                            <div class="progress-bar bg-success" style="width: 38.72%"></div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Pinterest</td>
                                    <td>854</td>
                                    <td class="w-50">
                                        <div class="progress progress-md mt-0">
                                            <div class="progress-bar bg-danger" style="width: 45.08%"></div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Linkedin</td>
                                    <td>650</td>
                                    <td class="w-50">
                                        <div class="progress progress-md mt-0">
                                            <div class="progress-bar bg-warning" style="width: 68.0%"></div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Nextdoor</td>
                                    <td>420</td>
                                    <td class="w-50">
                                        <div class="progress progress-md mt-0">
                                            <div class="progress-bar bg-info" style="width: 56.4%"></div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Monthly Sales -->

    <div class="row">
        <div class="col-md-6 col-xl-6">
            <div class="card">
                
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                            <i data-feather="minus-square" class="widgets-icons"></i>
                        </div>
                        <h5 class="card-title mb-0">Audiences By Time Of Day</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div id="audiences-daily" class="apex-charts mt-n3"></div>
                </div>
                
            </div>
        </div>

        <div class="col-md-6 col-xl-6">
            <div class="card overflow-hidden">
                
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                            <i data-feather="table" class="widgets-icons"></i>
                        </div>
                        <h5 class="card-title mb-0">Most Visited Pages</h5>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-traffic mb-0">
                            <tbody>

                                <thead>
                                    <tr>
                                        <th>Page name</th>
                                        <th>Visitors</th>
                                        <th>Unique</th>
                                        <th colspan="2">Bounce rate</th>
                                    </tr>
                                </thead>

                                <tr>
                                    <td>
                                        /home
                                        <a href="#" class="ms-1" aria-label="Open website">
                                            <i data-feather="link" class="ms-1 text-primary" style="height: 15px; width: 15px;"></i>
                                        </a>
                                    </td>
                                    <td>5,896</td>
                                    <td>3,654</td>
                                    <td>82.54%</td>
                                    <td class="w-25">
                                        <div id="sparkline-bounce-1" class="apex-charts"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        /about.html
                                        <a href="#" class="ms-1" aria-label="Open website">
                                            <i data-feather="link" class="ms-1 text-primary" style="height: 15px; width: 15px;"></i>
                                        </a>
                                    </td>
                                    <td>3,898</td>
                                    <td>3,450</td>
                                    <td>76.29%</td>
                                    <td class="w-25">
                                        <div id="sparkline-bounce-2" class="apex-charts"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        /index.html 
                                        <a href="#" class="ms-1" aria-label="Open website">
                                            <i data-feather="link" class="ms-1 text-primary" style="height: 15px; width: 15px;"></i>
                                        </a>
                                    </td>
                                    <td>3,057</td>
                                    <td>2,589</td>
                                    <td>72.68%</td>
                                    <td class="w-25">
                                        <div id="sparkline-bounce-3" class="apex-charts"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        /invoice.html
                                        <a href="#" class="ms-1" aria-label="Open website">
                                            <i data-feather="link" class="ms-1 text-primary" style="height: 15px; width: 15px;"></i>
                                        </a>
                                    </td>
                                    <td>867</td>
                                    <td>795</td>
                                    <td>44.78%</td>
                                    <td class="w-25">
                                        <div id="sparkline-bounce-4" class="apex-charts"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        /docs/
                                        <a href="#" class="ms-1" aria-label="Open website">
                                            <i data-feather="link" class="ms-1 text-primary" style="height: 15px; width: 15px;"></i>
                                        </a>
                                    </td>
                                    <td>958</td>
                                    <td>801</td>
                                    <td>41.15%</td>
                                    <td class="w-25">
                                        <div id="sparkline-bounce-5" class="apex-charts"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        /service.html
                                        <a href="#" class="ms-1" aria-label="Open website">
                                            <i data-feather="link" class="ms-1 text-primary" style="height: 15px; width: 15px;"></i>
                                        </a>
                                    </td>
                                    <td>658</td>
                                    <td>589</td>
                                    <td>32.65%</td>
                                    <td class="w-25">
                                        <div id="sparkline-bounce-6" class="apex-charts"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        /analytical.html
                                        <a href="#" class="ms-1" aria-label="Open website">
                                            <i data-feather="link" class="ms-1 text-primary" style="height: 15px; width: 15px;"></i>
                                        </a>
                                    </td>
                                    <td>457</td>
                                    <td>859</td>
                                    <td>32.65%</td>
                                    <td class="w-25">
                                        <div id="sparkline-bounce-7" class="apex-charts"></div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</div> <!-- container-fluid -->
</div> <!-- content -->
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\du_an_tot_nghiep\du_an_tot_nghiep\resources\views/admin/home.blade.php ENDPATH**/ ?>