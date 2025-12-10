<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['customer_id'])) {

    $id = $_POST['customer_ID'];
    $fullname = trim($_POST['fullname']);
    $phone = trim($_POST['phone']);
    $new_password = $_POST['new_password'];

    // ป้องกันการแก้ไขข้อมูลคนอื่น (Check Session ID vs Posted ID) -> จริงๆ ใช้ Session ID ชัวร์กว่า
    if ($id != $_SESSION['customer_id']) {
        $_SESSION['msg_error'] = "ไม่ได้รับอนุญาตให้แก้ไขข้อมูลนี้";
        header("Location: Edit_Profile.php");
        exit();
    }

    if (empty($fullname) || empty($phone)) {
        $_SESSION['msg_error'] = "กรุณากรอกชื่อและเบอร์โทรศัพท์";
        header("Location: Edit_Profile.php");
        exit();
    }

    if (!empty($new_password)) {
        // กรณีเปลี่ยนรหัสผ่านด้วย
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $sql = "UPDATE customer SET fullname = ?, phone = ?, password = ? WHERE customer_ID = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "sssi", $fullname, $phone, $hashed_password, $id);
    } else {
        // กรณีเปลี่ยนแค่ข้อมูลทั่วไป
        $sql = "UPDATE customer SET fullname = ?, phone = ? WHERE customer_ID = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $fullname, $phone, $id);
    }

    if (mysqli_stmt_execute($stmt)) {
        // อัปเดต Session
        $_SESSION['fullname'] = $fullname;
        $_SESSION['msg_success'] = "อัปเดตข้อมูลส่วนตัวสำเร็จ!";
        header("Location: Profile.php");
    } else {
        $_SESSION['msg_error'] = "เกิดข้อผิดพลาด: " . mysqli_error($con);
        header("Location: Edit_Profile.php");
    }
    exit();
}

header("Location: Profile.php");
exit();
?>