<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header w-100">
            <h3 class="modal-title">Thông tin vận chuyển</h3>
        </div>
        <!-- Modal Body -->
        <div class="modal-body align-content-center">

            <div class="row">
                {{-- @php
                    $status = $donhang->shipper->status;
                    dd($status);
                @endphp --}}

                <div class="col-12">
                    <div class="container mt-2">
                        <style>
                            .content-page {
                                display: block;
                                width: 90%;
                            }

                            .step {
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                z-index: 2;
                                position: relative;
                                cursor: pointer;
                                flex: 1;
                            }

                            .step .icon {
                                background-color: #fff;
                                border: 3px solid #ccc;
                                border-radius: 50%;
                                width: 50px;
                                height: 50px;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                color: #ccc;
                                font-size: 24px;
                                margin-bottom: 10px;
                            }

                            .step.active .icon {
                                border-color: #4caf50;
                                color: #4caf50;
                            }

                            .step .text {
                                font-weight: bold;
                                color: #333;
                                white-space: nowrap;
                            }

                            .step .date {
                                font-size: 12px;
                                color: #666;
                                margin-top: 5px;
                            }

                            .step.active .date {
                                color: #4caf50;
                            }

                            @media screen and (max-width: 768px) {
                                .progress-bar {
                                    flex-direction: column;
                                }

                                .progress-bar::before {
                                    height: 100%;
                                    width: 4px;
                                    left: 50%;
                                    transform: translateX(-50%);
                                    top: 5%;
                                    bottom: 5%;
                                }

                                .step {
                                    flex-direction: row;
                                    align-items: center;
                                    margin: 20px 0;
                                }

                                .step .icon {
                                    margin-right: 10px;
                                }

                                .step .text,
                                .step .date {
                                    text-align: left;
                                }
                            }
                        </style>

                        <div class="content-page">
                            <div class="content">
                                <div class="container">

                                    <div class="progress-bar" style="flex-direction: row">
                                        <div class="step active" data-step="1">
                                            <div class="icon"><i class="fas fa-file-alt"></i></div>
                                            <div class="text">Đã lấy hàng</div>
                                        </div>
                                        <div class="step" data-step="2">
                                            <div class="icon"><i class="fas fa-check"></i></div>
                                            <div class="text">Đã Giao Cho ĐVVC</div>
                                        </div>

                                        <div class="step" data-step="3">
                                            <div class="icon"><i class="fas fa-truck"></i></div>
                                            <div class="text">Đang giao</div>
                                        </div>
                                        <div class="step" data-step="4">
                                            <div class="icon"><i class="fas fa-box"></i></div>
                                            <div class="text">Đã Giao hàng</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            const steps = document.querySelectorAll('.step');
                            steps.forEach((step, index) => {
                                step.addEventListener('click', () => {
                                    steps.forEach((s, i) => {
                                        if (i <= index) {
                                            s.classList.add('active');
                                        } else {
                                            s.classList.remove('active');
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

</div>
