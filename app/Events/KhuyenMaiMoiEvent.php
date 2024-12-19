<?php

namespace App\Events;

use App\Models\khuyen_mai;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class KhuyenMaiMoiEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $khuyen_mai;
    


    public function __construct(khuyen_mai $khuyen_mai )
    {
        $this->khuyen_mai = $khuyen_mai;
        
    

    }

    public function broadcastOn()
    {
        return new Channel('khuyen-mai');
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->khuyen_mai->id,
            'ten_khuyen_mai' => $this->khuyen_mai->ten_khuyen_mai,
            'ma_khuyen_mai' => $this->khuyen_mai->ma_khuyen_mai,
            'gia_tri_khuyen_mai' => $this->khuyen_mai->gia_tri_khuyen_mai,
            'ngay_bat_dau' => $this->khuyen_mai->ngay_bat_dau,
            'ngay_ket_thuc' => $this->khuyen_mai->ngay_ket_thuc,
            'trang_thai' => $this->khuyen_mai->trang_thai,
            
        ];
    }
}
