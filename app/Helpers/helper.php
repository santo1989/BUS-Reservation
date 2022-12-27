<?php

function changeFormat($time) {
    $hour = (int)explode(':', $time)[0];
    $minute = explode(':', $time)[1];
    $ampm = "";

    if($hour > 12) {
        $hour = $hour - 12;
        $ampm = "pm";
    } else if($hour == 24) {
        $hour = "12";
        $ampm = "am";
    } else {
        $ampm = "am";
    }
    return "$hour:$minute $ampm";
    // return "$time";
}