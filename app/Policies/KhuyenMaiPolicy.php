<?php

namespace App\Policies;

use App\Models\User;
use App\Models\khuyen_mai;
use Illuminate\Auth\Access\Response;

class KhuyenMaiPolicy
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
    public function view(User $user, khuyen_mai $khuyenMai): bool
    {
        //
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
    public function update(User $user, khuyen_mai $khuyenMai): bool
    {
        //
        return $user->chuc_vu->ten_chuc_vu === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, khuyen_mai $khuyenMai): bool
    {
        //
        return $user->chuc_vu->ten_chuc_vu === 'admin';
    }

    
}
