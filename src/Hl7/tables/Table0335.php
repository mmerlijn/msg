<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 22:19
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0335 extends Table
{
    protected static $name='Repeat pattern';
    protected static $table=[
       "QS"=>"every seconds",
       "QM"=>"every minutes",
       "QH"=>"every hours",
       "QD"=>"every days",
       "QW"=>"every weeks",
       "QL"=>"every months (Lunar cycle)",
       "QJ"=>"repeats on a particular day of the week,",
       "BID"=>"twice a day at institution-specified times",
       "TID"=>"three times a day at institution-specified times",
       "QID"=>"four times a day at institution-specified times",
       "xID"=>"“X” times per day at institution-specified times, where X is a numeral 5 or greater.",
       "QAM"=>"in the morning at institution-specified time",
       "QSHIFT"=>"during each of three eight-hour shifts at institution-specified times",
       "QOD"=>"every other day",
       "QHS"=>"every day before the hour of sleep",
       "QPM"=>"in the evening at institution-specified time",
       "C"=>"service is provided continuously between start time and stop time",
       "U"=>"for future use, where is an interval specification as defined by the UNIX cron specification.",
       "PRN"=>"given as needed",
       "PRNxxx"=>"where xxx is some frequency code",
       "Once"=>"one time only.",
       "Meal Related Timings"=>"C (“cum”)",
       "A"=>"Ante (before)",
       "P"=>"Post (after)",
       "I"=>"Inter",
       "M"=>"Cibus Matutinus (breakfast)",
       "D"=>"Cibus Diurnus (lunch)",
       "V"=>"Cibus Vespertinus (dinner)",
    ];
}