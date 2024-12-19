<?php

namespace App\Console\Commands;

use App\Models\don_hang;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AutoConfirmOrders extends Command
{
    protected $signature = 'orders:autoconfirm';
    protected $description = 'Tự động xác nhận thành công sau 3 ngày';
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        // Lấy tất cả các đơn hàng đã giao nhưng chưa xác nhận
        $orders = don_hang::where('trang_thai_don_hang', 'Đã giao')->where('updated_at', '<=', Carbon::now()->subDays(3))->get();
        foreach ($orders as $order) {
            $order->update(['trang_thai_don_hang' => 'Thành công']);
        }
        $this->info('Tự động xác nhận thành công sau 3 ngày!');
    }
}
