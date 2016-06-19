<?php

namespace App\Awesome\Facades\UserManagement;

use Exception;
use DB;
use Carbon\Carbon;

use App\User;
use App\Saving;
use App\Awesome\Contracts\Facades\UserManagementContract;

class UserManagementImpl implements UserManagementContract
{
    /**
     * Get users total.
     *
     * @return int
     */
    public static function getUsersTotal()
    {
        return User::count()-2;
    }

    /**
     * Get most active user.
     *
     * @return App\User
     */
    public static function getMostActiveUser()
    {
        $carbon = new Carbon;
        $userSaving = DB::table('savings')
            ->select('user_id', DB::raw('count(*) as total'))
            ->where('created_at', '>=', $carbon->startOfMonth())
            ->groupBy('user_id')
            ->orderBy('total', 'DESC')
            ->first();

        if (null != $userSaving) {
            return User::find($userSaving->user_id);
        }

        return null;
    }

    /**
     * Get items_amount income in this day.
     *
     * @return int
     */
    public static function getThisDayIncome()
    {
        return Saving::where('created_at', '>=', Carbon::today())->sum('items_amount');
    }

    /**
     * Get money spend in this day.
     *
     * @return int
     */
    public static function getThisDaySpend()
    {
        return Saving::where('created_at', '>=', Carbon::today())->sum('credit');
    }

    /**
     * Get items_amount income in this month.
     *
     * @return int
     */
    public static function getThisMonthIncome()
    {
        $carbon = new Carbon;
        return Saving::where('created_at', '>=', $carbon->startOfMonth())->sum('items_amount');
    }

    /**
     * Get money spend in this month.
     *
     * @return int
     */
    public static function getThisMonthSpend()
    {
        $carbon = new Carbon;
        return Saving::where('created_at', '>=', $carbon->startOfMonth())->sum('credit');
    }
}
