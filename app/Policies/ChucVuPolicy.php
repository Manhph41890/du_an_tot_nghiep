<?php

namespace App\Policies;

use App\Models\User;
use App\Models\chuc_vu;
use Illuminate\Auth\Access\Response;

class ChucVuPolicy
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
    public function view(User $user, chuc_vu $chucVu): bool
    {
        //
        return $user->chuc_vu->ten_chuc_vu === 'admin' || $user->chuc_vu->ten_chuc_vu === 'nhan_vien';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return $user->chuc_vu->ten_chuc_vu === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, chuc_vu $chucVu): bool
    {
        //
        return $user->chuc_vu->ten_chuc_vu === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, chuc_vu $chucVu): bool
    {
        //
        return $user->chuc_vu->ten_chuc_vu === 'admin';
    }
}