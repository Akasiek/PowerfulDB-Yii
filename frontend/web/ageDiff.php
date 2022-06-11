<?php
function ageDiff($birth_date, $death_date)
{
    $d1 = new DateTime($birth_date);
    if (!$death_date) $d2 = new DateTime();
    else $d2 = new DateTime($death_date);
    return $d2->diff($d1)->y;
}