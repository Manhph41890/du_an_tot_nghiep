<!-- Left Sidebar Start -->
<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->

        <div id="sidebar-menu">

            <div class="logo-box">
                <a class='logo logo-light' href='index.html'>
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-light.png" alt="" height="24">
                    </span>
                </a>
                <a class='logo logo-dark' href='index.html'>
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-dark.png" alt="" height="24">
                    </span>
                </a>
            </div>

            <ul id="side-menu">

                <li class="menu-title">Menu</li>

                <li>
                    <a href="<?php echo e(route('dashboard')); ?>" data-bs-toggle="collapse">
                        <span> Dashboard </span>
                        
                    </a>
                    
                </li>

                <!-- <li>
            <a href="landing.html" target="_blank">
                <i data-feather="globe"></i>
                <span> Landing </span>
            </a>
        </li> -->

                <li class="menu-title">Pages</li>

                

                

                

                <li>
                    <a href="#danhmuc" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> Danh mục </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="danhmuc">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='<?php echo e(route('danhmucs.create')); ?>'>Thêm</a>
                            </li>
                            <li>
                                <a class='tp-link' href='<?php echo e(route('danhmucs.index')); ?>'>Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#chucvu" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> Chức vụ </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="chucvu">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='<?php echo e(route('chucvus.create')); ?>'>Thêm</a>
                                <a class='tp-link' href='<?php echo e(route('chucvus.index')); ?>'>Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <li>
                    <a href="#sanpham" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> Sản phẩm </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sanpham">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='<?php echo e(route('sanphams.create')); ?>'>Thêm</a>
                            </li>
                            <li>
                                <a class='tp-link' href='<?php echo e(route('sanphams.index')); ?>'>Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#phuongthucthanhtoan" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> PT thanh toán </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="phuongthucthanhtoan">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='<?php echo e(route('phuongthucthanhtoans.index')); ?>'>Danh sách</a>
                            </li>
                            <li>
                                <a class='tp-link' href='<?php echo e(route('phuongthucthanhtoans.create')); ?>'>Thêm</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#phuongthucvanchuyen" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> PT vận chuyển </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="phuongthucvanchuyen">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='<?php echo e(route('phuongthucvanchuyens.index')); ?>'>Danh sách</a>
                            </li>
                            <li>
                                <a class='tp-link' href='<?php echo e(route('phuongthucvanchuyens.create')); ?>'>Thêm</a>
                            </li>

                        </ul>
                    </div>
                </li>


                <li>
                    <a href="#khuyenmai" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> Khuyến mãi </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="khuyenmai">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='<?php echo e(route('khuyenmais.create')); ?>'>Thêm</a>
                            </li>
                            <li>
                                <a class='tp-link' href='<?php echo e(route('khuyenmais.index')); ?>'>Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#user" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> User </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="user">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='<?php echo e(route('user.index')); ?>'>Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li>
                    <a href="#baiviet" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span>Bài viết </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="baiviet">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='<?php echo e(route('baiviets.create')); ?>'>Thêm</a>
                            </li>
                            <li>
                                <a class='tp-link' href='<?php echo e(route('baiviets.index')); ?>'>Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title mt-2">General</li>

                <li>
                    <a href="#sidebarBaseui" data-bs-toggle="collapse">
                        <i data-feather="package"></i>
                        <span> Components </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarBaseui">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='ui-accordions.html'>Accordions</a>
                            </li>
                            <li>
                                <a class='tp-link' href='ui-alerts.html'>Alerts</a>
                            </li>
                            <li>
                                <a class='tp-link' href='ui-badges.html'>Badges</a>
                            </li>
                            <li>
                                <a class='tp-link' href='ui-breadcrumb.html'>Breadcrumb</a>
                            </li>
                            <li>
                                <a class='tp-link' href='ui-buttons.html'>Buttons</a>
                            </li>
                            <li>
                                <a class='tp-link' href='ui-cards.html'>Cards</a>
                            </li>
                            <li>
                                <a class='tp-link' href='ui-collapse.html'>Collapse</a>
                            </li>
                            <li>
                                <a class='tp-link' href='ui-dropdowns.html'>Dropdowns</a>
                            </li>
                            <li>
                                <a class='tp-link' href='ui-video.html'>Embed Video</a>
                            </li>
                            <li>
                                <a class='tp-link' href='ui-grid.html'>Grid</a>
                            </li>
                            <li>
                                <a class='tp-link' href='ui-images.html'>Images</a>
                            </li>
                            <li>
                                <a class='tp-link' href='ui-list.html'>List Group</a>
                            </li>
                            <li>
                                <a class='tp-link' href='ui-modals.html'>Modals</a>
                            </li>
                            <li>
                                <a class='tp-link' href='ui-placeholders.html'>Placeholders</a>
                            </li>
                            <li>
                                <a class='tp-link' href='ui-pagination.html'>Pagination</a>
                            </li>
                            <li>
                                <a class='tp-link' href='ui-popovers.html'>Popovers</a>
                            </li>
                            <li>
                                <a class='tp-link' href='ui-progress.html'>Progress</a>
                            </li>
                            <li>
                                <a class='tp-link' href='ui-scrollspy.html'>Scrollspy</a>
                            </li>
                            <li>
                                <a class='tp-link' href='ui-spinners.html'>Spinners</a>
                            </li>
                            <li>
                                <a class='tp-link' href='ui-tabs.html'>Tabs</a>
                            </li>
                            <li>
                                <a class='tp-link' href='ui-tooltips.html'>Tooltips</a>
                            </li>
                            <li>
                                <a class='tp-link' href='ui-typography.html'>Typography</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a class='tp-link' href='widgets.html'>
                        <i data-feather="aperture"></i>
                        <span> Widgets </span>
                    </a>
                </li>

                <li>
                    <a href="#sidebarAdvancedUI" data-bs-toggle="collapse">
                        <i data-feather="cpu"></i>
                        <span> Extended UI </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAdvancedUI">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='extended-carousel.html'>Carousel</a>
                            </li>
                            <li>
                                <a class='tp-link' href='extended-notifications.html'>Notifications</a>
                            </li>
                            <li>
                                <a class='tp-link' href='extended-offcanvas.html'>Offcanvas</a>
                            </li>
                            <li>
                                <a class='tp-link' href='extended-range-slider.html'>Range Slider</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarIcons" data-bs-toggle="collapse">
                        <i data-feather="award"></i>
                        <span> Icons </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarIcons">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='icons-feather.html'>Feather Icons</a>
                            </li>
                            <li>
                                <a class='tp-link' href='icons-mdi.html'>Material Design Icons</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarForms" data-bs-toggle="collapse">
                        <i data-feather="briefcase"></i>
                        <span> Forms </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarForms">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='forms-elements.html'>General Elements</a>
                            </li>
                            <li>
                                <a class='tp-link' href='forms-validation.html'>Validation</a>
                            </li>
                            <li>
                                <a class='tp-link' href='forms-quilljs.html'>Quilljs Editor</a>
                            </li>
                            <li>
                                <a class='tp-link' href='forms-pickers.html'>Picker</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarTables" data-bs-toggle="collapse">
                        <i data-feather="table"></i>
                        <span> Tables </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarTables">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='tables-basic.html'>Basic Tables</a>
                            </li>
                            <li>
                                <a class='tp-link' href='tables-datatables.html'>Data Tables</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarCharts" data-bs-toggle="collapse">
                        <i data-feather="pie-chart"></i>
                        <span> Apex Charts </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCharts">
                        <ul class="nav-second-level">
                            <li>
                                <a href='charts-line.html'>Line</a>
                            </li>
                            <li>
                                <a href='charts-area.html'>Area</a>
                            </li>
                            <li>
                                <a href='charts-column.html'>Column</a>
                            </li>
                            <li>
                                <a href='charts-bar.html'>Bar</a>
                            </li>
                            <li>
                                <a href='charts-mixed.html'>Mixed</a>
                            </li>
                            <li>
                                <a href='charts-timeline.html'>Timeline</a>
                            </li>
                            <li>
                                <a href='charts-rangearea.html'>Range Area</a>
                            </li>
                            <li>
                                <a href='charts-funnel.html'>Funnel</a>
                            </li>
                            <li>
                                <a href='charts-candlestick.html'>Candlestick</a>
                            </li>
                            <li>
                                <a href='charts-boxplot.html'>Boxplot</a>
                            </li>
                            <li>
                                <a href='charts-bubble.html'>Bubble</a>
                            </li>
                            <li>
                                <a href='charts-scatter.html'>Scatter</a>
                            </li>
                            <li>
                                <a href='charts-heatmap.html'>Heatmap</a>
                            </li>
                            <li>
                                <a href='charts-treemap.html'>Treemap</a>
                            </li>
                            <li>
                                <a href='charts-pie.html'>Pie</a>
                            </li>
                            <li>
                                <a href='charts-radialbar.html'>Radialbar</a>
                            </li>
                            <li>
                                <a href='charts-radar.html'>Radar</a>
                            </li>
                            <li>
                                <a href='charts-polararea.html'>Polar</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarMaps" data-bs-toggle="collapse">
                        <i data-feather="map"></i>
                        <span> Maps </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMaps">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href='maps-google.html'>Google Maps</a>
                            </li>
                            <li>
                                <a class='tp-link' href='maps-vector.html'>Vector Maps</a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>
<!-- Left Sidebar End -->
<?php /**PATH D:\laragon\www\du_an_tot_nghiep\resources\views/admin/partials/siderbar.blade.php ENDPATH**/ ?>