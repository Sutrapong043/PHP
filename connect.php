<?php

// ตั้งค่าตัวแปรสำหรับเชื่อมต่อฐานข้อมูล
$db_host = "localhost"; 
$db_user = "root";      
$db_pass = "";          
$db_name = "sutrapong"; 
$db_port = 3307;        // <-- เพิ่มพอร์ตที่นี่ (ค่าเริ่มต้นคือ 3306)

// เชื่อมต่อ MySQLi พร้อมพอร์ต
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);

// ตรวจสอบการเชื่อมต่อ
if (mysqli_connect_errno()) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . mysqli_connect_error());
}

// ตั้งค่า charset เป็น utf8 เพื่อรองรับภาษาไทย
mysqli_set_charset($con, "utf8");

?>
