<?php
session_start();
require_once 'connect.php';

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($username === '' || $password === '') {
    echo "<script>alert('⚠️ กรุณากรอกชื่อผู้ใช้และรหัสผ่านให้ครบ'); window.history.back();</script>";
    exit;
}

$sql = "SELECT customer_ID, fullname, username, password, role FROM customer WHERE username = ?";
$stmt = mysqli_prepare($con, $sql);

if (!$stmt) {
    die("เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . mysqli_error($con));
}

mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    if (password_verify($password, $row['password'])) {
        // เข้าสู่ระบบสำเร็จ
        $_SESSION['customer_id'] = $row['customer_ID'];
        $_SESSION['fullname']    = $row['fullname'];
        $_SESSION['username']    = $row['username'];
        $_SESSION['role']        = $row['role']; // จำเป็นสำหรับ Web_Page.php

        // ส่งไปหน้า Dashboard Web_Page.php
        header("Location: Web_Page.php");
        exit;
    } else {
        echo "<script>alert('❌ รหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง'); window.history.back();</script>";
        exit;
    }
} else {
    echo "<script>alert('❌ ไม่พบชื่อผู้ใช้นี้ในระบบ'); window.history.back();</script>";
    exit;
}
?>