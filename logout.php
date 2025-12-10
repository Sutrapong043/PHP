<?php
// เริ่ม Session (ต้องอยู่บรรทัดบนสุด)
session_start();

// ล้างค่าตัวแปรใน Session ทั้งหมด
session_unset();

// ทำลาย Session file บนเซิร์ฟเวอร์
// นี่คือการ "ฆ่า" session ทิ้ง
session_destroy();

// ส่งผู้ใช้กลับไปหน้าล็อกอิน
header('Location: Login.php');

// หยุดการทำงานของสคริปต์ทันที
exit();

?>