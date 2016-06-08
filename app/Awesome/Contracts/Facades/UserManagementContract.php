<?php

namespace App\Awesome\Contracts\Facades;

interface UserManagementContract
{
    /**
     * Get users total.
     *
     * @return int
     */
    public static function getUsersTotal();

    /**
     * Get most active user.
     *
     * @return App\User
     */
    public static function getMostActiveUser();

    /**
     * Get items_amount income in this day.
     *
     * @return int
     */
    public static function getThisDayIncome();

    /**
     * Get money spend in this day.
     *
     * @return int
     */
    public static function getThisDaySpend();

    /**
     * Get items_amount income in this month.
     *
     * @return int
     */
    public static function getThisMonthIncome();

    /**
     * Get money spend in this month.
     *
     * @return int
     */
    public static function getThisMonthSpend();
}
