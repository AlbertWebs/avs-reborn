<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WishlistHelper
{
    /**
     * Add item to wishlist
     * 
     * @param int $productId
     * @param int|string $userIdOrSession
     * @param string|null $type 'session' for session-based, null for user-based
     * @return bool
     */
    public static function add($productId, $userIdOrSession, $type = null)
    {
        // Check if item already exists
        $exists = false;
        if ($type === 'session') {
            $exists = DB::table('wishlist')
                ->where('session_id', $userIdOrSession)
                ->where('item_id', $productId)
                ->exists();
        } else {
            $exists = DB::table('wishlist')
                ->where('user_id', $userIdOrSession)
                ->where('item_id', $productId)
                ->exists();
        }

        if (!$exists) {
            if ($type === 'session') {
                DB::table('wishlist')->insert([
                    'session_id' => $userIdOrSession,
                    'item_id' => $productId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('wishlist')->insert([
                    'user_id' => $userIdOrSession,
                    'item_id' => $productId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            return true;
        }
        return false;
    }

    /**
     * Get user wishlist items
     * 
     * @param int|string $userIdOrSession
     * @param string|null $type 'session' for session-based, null for user-based
     * @return \Illuminate\Support\Collection
     */
    public static function getUserWishList($userIdOrSession, $type = null)
    {
        if ($type === 'session') {
            return DB::table('wishlist')
                ->where('session_id', $userIdOrSession)
                ->get();
        } else {
            return DB::table('wishlist')
                ->where('user_id', $userIdOrSession)
                ->get();
        }
    }

    /**
     * Remove item from wishlist by product ID
     * 
     * @param int $productId
     * @param int|string $userIdOrSession
     * @param string|null $type 'session' for session-based, null for user-based
     * @return bool
     */
    public static function removeByProduct($productId, $userIdOrSession, $type = null)
    {
        if ($type === 'session') {
            return DB::table('wishlist')
                ->where('session_id', $userIdOrSession)
                ->where('item_id', $productId)
                ->delete();
        } else {
            return DB::table('wishlist')
                ->where('user_id', $userIdOrSession)
                ->where('item_id', $productId)
                ->delete();
        }
    }

    /**
     * Get wishlist count
     * 
     * @param int|string $userIdOrSession
     * @param string|null $type 'session' for session-based, null for user-based
     * @return int
     */
    public static function count($userIdOrSession, $type = null)
    {
        if ($type === 'session') {
            return DB::table('wishlist')
                ->where('session_id', $userIdOrSession)
                ->count();
        } else {
            return DB::table('wishlist')
                ->where('user_id', $userIdOrSession)
                ->count();
        }
    }
}
