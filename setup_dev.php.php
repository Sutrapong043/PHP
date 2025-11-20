<?php
include 'connect.php';

// ข้อมูลที่จะสร้าง/อัปเดต
$username = "Sutrapong";
$password_raw = "Sutrapong";
$fullname = "System Developer"; // ชื่อสมมติ
$phone = "000-000-0000";        // เบอร์สมมติ
$role = "Dev";                  // ยศสูงสุด

// 1. เข้ารหัสรหัสผ่าน (สำคัญมาก! ต้อง Hash ก่อนลง DB)
$password_hash = password_hash($password_raw, PASSWORD_DEFAULT);

// 2. ตรวจสอบว่ามี User นี้อยู่แล้วหรือไม่
$check_sql = "SELECT * FROM customer WHERE username = '$username'";
$check_query = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_query) > 0) {
    // --- กรณีมีอยู่แล้ว : ให้ปรับยศเป็น Dev และรีเซ็ตรหัสผ่าน ---
    $sql = "UPDATE customer SET 
            password = ?, 
            role = ? 
            WHERE username = ?";
            
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $password_hash, $role, $username);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<h1 style='color:green;'>✅ อัปเดตสำเร็จ!</h1>";
        echo "<h3>User: $username ตอนนี้เป็นยศ <span style='color:red;'>$role</span> แล้วครับ</h3>";
        echo "สามารถล็อกอินด้วยรหัสผ่าน: <strong>$password_raw</strong>";
    } else {
        echo "เกิดข้อผิดพลาด: " . mysqli_error($con);
    }

} else {
    // --- กรณีไม่มี : สร้างใหม่เลย ---
    $sql = "INSERT INTO customer (username, password, fullname, phone, role) 
            VALUES (?, ?, ?, ?, ?)";
            
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $username, $password_hash, $fullname, $phone, $role);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<h1 style='color:green;'>✅ สร้าง User ใหม่สำเร็จ!</h1>";
        echo "<h3>สร้าง User: $username (ยศ <span style='color:red;'>$role</span>) เรียบร้อย</h3>";
        echo "สามารถล็อกอินด้วยรหัสผ่าน: <strong>$password_raw</strong>";
    } else {
        echo "เกิดข้อผิดพลาด: " . mysqli_error($con);
    }
}

echo "<br><br><a href='Login.php'>ไปหน้าล็อกอิน</a>";
?>