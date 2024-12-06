<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header w-100">
            <h4 class="modal-title">Thông tin vận chuyển</h4>
        </div>
        <!-- Modal Body -->
        <div class="modal-body align-content-center">
            <div class="row">
                <div class="col-12">
                    <div class="container mt-2">
                        <style>
                            .progress-bar {
                                display: flex;
                                flex-direction: row;
                                justify-content: space-between;
                                align-items: center;
                                position: relative;
                                margin: 20px 0;
                            }

                            .progress-bar::before {
                                content: "";
                                position: absolute;
                                top: 50%;
                                left: 0;
                                right: 0;
                                height: 4px;
                                background-color: #ccc;
                                z-index: 1;
                                transform: translateY(-50%);
                            }

                            .step {
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                z-index: 2;
                                position: relative;
                                flex: 1;
                                cursor: pointer;
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
                                transition: all 0.3s ease;
                            }

                            .step.active .icon {
                                border-color: #4caf50;
                                background-color: #e8f5e9;
                                color: #4caf50;
                            }

                            .step .text {
                                font-weight: bold;
                                color: #333;
                                white-space: nowrap;
                                transition: color 0.3s ease;
                            }

                            .step.active .text {
                                color: #4caf50;
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
                                    @php
                                        $steps = [
                                            [
                                                'icon' => 'fas fa-file-alt',
                                                'text' => 'Đã lấy hàng',
                                                'status' => 'Đã lấy hàng',
                                            ],
                                            [
                                                'icon' => 'fas fa-check',
                                                'text' => 'Đang vận chuyển',
                                                'status' => 'Đang vận chuyển',
                                            ],
                                        
                                            [
                                                'icon' => 'fas fa-box',
                                                'text' => 'Đã Giao hàng',
                                                'status' => 'Thành công',
                                            ],
                                        ];
                                        $status = $donhang->shipper->status ?? null;
                                        $currentIndex = array_search($status, array_column($steps, 'status')) ?? -1;
                                    @endphp

                                    <div class="progress-bar">
                                        @foreach ($steps as $key => $step)
                                            <div
                                                class="step {{ $currentIndex !== false && $key <= $currentIndex ? 'active' : '' }}">
                                                <div class="icon">
                                                    <i class="{{ $step['icon'] }}"></i>
                                                </div>
                                                <div class="text">{{ $step['text'] }}</div>
                                            </div>
                                        @endforeach
                                    </div>

                                    @if (!$donhang->shipper)
                                        <p class="mb-0 text-center">
                                            <strong>Đơn hàng đang ở trạng thái:</strong>
                                            {{ $donhang->trang_thai_don_hang }}
                                        </p>
                                    @elseif ($donhang->shipper->status == 'Thất bại')
                                        <p class="mb-0 text-center">
                                            <strong>Trạng thái:</strong> Giao hàng thất bại
                                        </p>
                                        <p class="text-danger">
                                            <strong>Lý do:</strong> {{ $donhang->shipper->ly_do_huy }}
                                        </p>
                                    @elseif ($donhang->shipper->status == 'Giao lại')
                                        <p class="mb-0 text-center">
                                            <strong>Trạng thái:</strong> Đơn hàng đang được giao lại
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</div>
