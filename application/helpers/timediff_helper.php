<?php
if (!function_exists('getTimeDiff')) {
    function getTimeDiff($dtime, $atime)
    {
        // https://stackoverflow.com/a/12434750/10769031

        $nextDay = $dtime > $atime ? 1 : 0;
        $dep = explode(':', $dtime);
        $arr = explode(':', $atime);

        $diff = abs(mktime($dep[0], $dep[1], 0, date('n'), date('j'), date('y')) 
            - mktime($arr[0], $arr[1], 0, date('n'), date('j') + $nextDay, date('y')));

        //Hour
        $hours = floor($diff / (60 * 60));

        //Minute 
        $mins = floor(($diff - ($hours * 60 * 60)) / (60));
        $mins = $mins / 60;

        return $hours + $mins;
    }

    function getTimeDiffNND($dtime, $atime)
    {
        $dep = explode(':', $dtime);
        $arr = explode(':', $atime);

        $diff = (strtotime($dep[0].':'.$dep[1].':00') 
            - strtotime($arr[0].':'.$arr[1].':00'))/60;

        // //Hour
        // $hours = $diff / (60);

        // //Minute 
        // $mins = floor(($diff - ($hours * 60 * 60)) / (60));
        // $mins = $mins / 60;

        return $diff;
    }
}