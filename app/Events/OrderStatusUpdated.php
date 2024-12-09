<?php

namespace App\Events;

use App\Models\don_hang;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class OrderStatusUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $donhang;

    /**
     * Create a new event instance.
     */
    // Khởi tạo với thông tin đơn hàng
    public function __construct(don_hang $donhang)
    {
        $this->donhang = $donhang;
    }

    // Xác định kênh Broadcasting
    public function broadcastOn()
    {
        return new PrivateChannel('order.' . $this->donhang->id);
    }

    // Xác định dữ liệu cần broadcast
    public function broadcastWith()
    {
        return [
            'id' => $this->donhang->id,
            'trang_thai_don_hang' => $this->donhang->trang_thai_don_hang,
        ];
    }

    public function updateStatus(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $donhang = don_hang::findOrFail($id);

            // Cập nhật trạng thái đơn hàng
            $donhang->update(['trang_thai_don_hang' => $request->input('trang_thai_don_hang')]);

            // Phát event
            broadcast(new OrderStatusUpdated($donhang));

            DB::commit();

            return response()->json([
                'success' => true,
                'status' => $donhang->trang_thai_don_hang,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi cập nhật trạng thái đơn hàng.',
            ], 500);
        }
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
}
