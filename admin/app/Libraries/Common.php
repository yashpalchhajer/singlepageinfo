<?php
namespace App\Libraries;

use Carbon\Carbon;


class Common
{
    /**
     * get days of previous 30 days fron today
     * @return array date in 'Mon Date'
     */
    public static function getDaysOfMonth()
    {
        $start = Carbon::now();
        $end = Carbon::now()->subDays(30);
        $dates = [];
        for($date = $end; $date->lte($start); $date->addDay()) {
            $dates[]  = $date->format('d M');
        }
        return $dates;
    }
}