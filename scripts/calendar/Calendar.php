<?php
    require_once (substr(__DIR__,0,strrpos(__DIR__,'scripts')).'router.php');
    require_once (Router::$Config['Language']);
/**
 * Created by PhpStorm.
 * User: malasz
 * Date: 17.06.17
 * Time: 11:02
 */

class Calendar
{
    public static function GetDayOfMonth(){
        return date('d');
    }
    public static function GetMonthNumber(){
        return date('m');
    }
    public static function GetMonth($Number){
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October','November', 'December'];
        return Language::$LANG['Calendar']['Months'][$months[$Number-1]];
    }
    public static function GetYear() {
        return date('Y');
    }

    public static function GenerateCalendar($Month, $Year) {
        $dayOfWeek = (date('w', strtotime('01-'.$Month.'-'.$Year))-1);
        $dayOfWeek = $dayOfWeek == -1 ? 6 : $dayOfWeek;

        $dayOfMonth = Calendar::GetDayOfMonth();

        $calendar = "";

        for($i = 0; $i < $dayOfWeek; $i++)
            $calendar=$calendar."<li>"."</li>";

        if($Month == self::GetMonthNumber())
        {
            for($i = 1; $i < $dayOfMonth; $i++)
                $calendar=$calendar."<li>".$i."</li>";

            $calendar=$calendar."<li class='active'>".$dayOfMonth."</li>";

            for($i = $dayOfMonth+1; $i <= cal_days_in_month(CAL_GREGORIAN, $Month, $Year); $i++)
                $calendar=$calendar."<li>".$i."</li>";
        }
        else
        {
            for($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $Month, $Year); $i++)
                $calendar=$calendar."<li>".$i."</li>";
        }

        return $calendar;

    }

    public static function GenerateWeekdays(){
        $arr = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $str='';
        for($i=0; $i < 7; $i++)
            $str=$str.('<li '.($i > 0 ? 'style="margin-left:3.5px;text-align:center!important;"' : '').'>'.Language::$LANG['Calendar']['Weekdays'][$arr[$i]].'</li>');
        return $str;

    }
}


?>