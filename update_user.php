<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id = $_POST['customer_ID'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $role = $_POST['role']; // รับค่ายศมาด้วย

    // อัปเดต SQL (เพิ่ม role = ?)
    $sql = "UPDATE customer SET fullname = ?, phone = ?, role = ? WHERE customer_ID = ?";
    $stmt = mysqli_prepare($con, $sql);
    
    if ($stmt) {
        // Bind params (s = string, i = integer) -> sssi
        mysqli_stmt_bind_param($stmt, "sssi", $fullname, $phone, $role, $id);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['msg_success'] = "บันทึกข้อมูลและยศสำเร็จ!";
        } else {
            $_SESSION['msg_error'] = "เกิดข้อผิดพลาด: " . mysqli_error($con);
        }
    }
}

header("Location: User_Management.php");
exit();
?>