<?php

namespace App\Policies;

use App\Models\User;
use App\Models\phuong_thuc_thanh_toan;
use Illuminate\Auth\Access\Response;

class PhuongThucThanhToanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, phuong_thuc_thanh_toan $phuongThucThanhToan): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, phuong_thuc_thanh_toan $phuongThucThanhToan): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, phuong_thuc_thanh_toan $phuongThucThanhToan): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, phuong_thuc_thanh_toan $phuongThucThanhToan): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, phuong_thuc_thanh_toan $phuongThucThanhToan): bool
    {
        //
    }
}
