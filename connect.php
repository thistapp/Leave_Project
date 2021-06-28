<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "leave_db");
mysqli_error($con);

$arr = array(

    1 => "<p style='color:#5eba00; font-weight: bold;'>อนุมัติ</p>",
    2 => "<p style='color:#fab005; font-weight: bold;'>รออนุมัติ</p>",
    3 => "<p style='color:#cd201f; font-weight: bold;'>ไม่อนุมัติ</p>"
);

$td = array(
    0 => "ลาครึ่งวัน",
    1 => "ลาเต็มวัน"
);


date_default_timezone_set("Asia/Bangkok");


$arr_type = array("00:00 - 00:00" => "ลาเต็มวัน");
