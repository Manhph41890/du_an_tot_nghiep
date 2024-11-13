<?php

namespace App\Policies;

use App\Models\User;
use App\Models\bai_viet;
use Illuminate\Auth\Access\Response;

class BaiVietPolicy
{
    public function viewAny(User $user)
    {
        return $user->chuc_vu->ten_chuc_vu === 'admin' || $user->chuc_vu->ten_chuc_vu === 'nhan_vien';
    }

    /**
     * Determine whether the user can view the danh muc.
     */
    public function view(User $user, bai_viet $bai_viet)
    {
        return $user->chuc_vu->ten_chuc_vu === 'admin' || $user->chuc_vu->ten_chuc_vu === 'nhan_vien';
    }

    /**
     * Determine whether the user can create danh muc.
     */
    public function create(User $user)
    {
        return $user->chuc_vu->ten_chuc_vu === 'admin';
    }

    /**
     * Determine whether the user can update the danh muc.
     */
    public function update(User $user, bai_viet $bai_viet)
    {
        return $user->chuc_vu->ten_chuc_vu === 'admin';
    }

    /**
     * Determine whether the user can delete the danh muc.
     */
    public function delete(User $user, bai_viet $bai_viet)
    {
        return $user->chuc_vu->ten_chuc_vu === 'admin';
    }
}
