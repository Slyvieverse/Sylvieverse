<?php

namespace App\Policies;

use App\Models\Auction;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AuctionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Auction $auction): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    // app/Policies/AuctionPolicy.php
public function create(User $user) { return true; }
public function delete(User $user, Auction $auction) { return $auction->seller_id === $user->id; }

    /**
     * Determine whether the user can delete the model.
     */
   

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Auction $auction): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Auction $auction): bool
    {
        return false;
    }
}
