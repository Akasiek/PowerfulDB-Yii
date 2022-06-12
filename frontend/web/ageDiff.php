<?php
function ageDiff($start_date, $end_date)
{
    $d1 = new DateTime($start_date);
    if (!$end_date) $d2 = new DateTime();
    else $d2 = new DateTime($end_date);
    return $d2->diff($d1)->y;
}