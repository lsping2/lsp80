<?php 
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$val_ct = count($val1);

$val1 = implode(",",$val1);
$val2 = implode(",",$val2);



$sel_ct = count($sel2);
$sel1 = implode(",",$sel1);
$sel2 = implode(",",$sel2);
$sel3 = implode(",",$sel3);

$add_sql = "";
$add_sql .= ", val_ct	= '$val_ct' ";
$add_sql .= ", val1	= '$val1' ";
$add_sql .= ", val2	= '$val2' ";

$add_sql .= ", sel1	= '$sel1' ";
$add_sql .= ", sel2	= '$sel2' ";
$add_sql .= ", sel3	= '$sel3' ";
$add_sql .= ", sel_ct	= '$sel_ct' ";


?>