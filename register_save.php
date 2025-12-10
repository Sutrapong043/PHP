<?php
include 'connect.php';

// รับค่า เริด
$username = isset($_POST['username']) ? $_POST['username'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$fullname = isset($_POST['full-name']) ? $_POST['full-name'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
$agreeTerms = isset($_POST['agreeTerms']) ? $_POST['agreeTerms'] : '';

// HTML Output ้า
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สถานะการสมัครสมาชิก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Prompt', sans-serif; background-color: #f8f9fa; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card-msg { width: 100%; max-width: 500px; border: none; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); background: white; padding: 2rem; text-align: center; }
    </style>
</head>
<body>
    <div class="card-msg">
<?php

if (empty($username) || empty($phone) || empty($fullname) || empty($password) || empty($confirm_password)) {
    echo "<i class='bi bi-exclamation-circle text-warning display-1'></i>";
    echo "<h3 class='mt-3 fw-bold'>ข้อมูลไม่ครบถ้วน</h3>";
    echo "<p class='text-muted'>กรุณากรอกข้อมูลให้ครบทุกช่อง</p>";
    echo "<a href='register_from.php' class='btn btn-warning w-100 mt-3'>กลับไปแก้ไข</a>";
    exit();
}

if ($password != $confirm_password) {
    echo "<i class='bi bi-x-circle text-danger display-1'></i>";
    echo "<h3 class='mt-3 fw-bold'>รหัสผ่านไม่ตรงกัน</h3>";
    echo "<p class='text-muted'>กรุณาตรวจสอบรหัสผ่านอีกครั้ง</p>";
    echo "<a href='register_from.php' class='btn btn-danger w-100 mt-3'>กลับไปแก้ไข</a>";
    exit();
}

if (empty($agreeTerms)) {
    echo "<i class='bi bi-file-earmark-x text-danger display-1'></i>";
    echo "<h3 class='mt-3 fw-bold'>ข้อตกลงการใช้งาน</h3>";
    echo "<p class='text-muted'>คุณต้องยอมรับเงื่อนไขและข้อตกลงก่อน</p>";
    echo "<a href='register_from.php' class='btn btn-secondary w-100 mt-3'>กลับไปแก้ไข</a>";
    exit();
}

// Hashing  Save
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO customer (username, phone, fullname, password) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($con, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ssss", $username, $phone, $fullname, $hashed_password);
    
    if (mysqli_stmt_execute($stmt)) {
        // Success Case
        echo "<i class='bi bi-check-circle-fill text-success display-1'></i>";
        echo "<h3 class='mt-3 fw-bold text-success'>สมัครสมาชิกสำเร็จ!</h3>";
        echo "<p class='text-muted'>ยินดีต้อนรับคุณ <strong>$fullname</strong></p>";
        echo "<a href='Login.php' class='btn btn-primary w-100 mt-3'>เข้าสู่ระบบทันที</a>";
    } else {
        // Duplicate User Case
        if (mysqli_errno($con) == 1062) {
            echo "<i class='bi bi-person-x text-danger display-1'></i>";
            echo "<h3 class='mt-3 fw-bold'>Username นี้ถูกใช้แล้ว</h3>";
            echo "<p class='text-muted'>กรุณาเปลี่ยนชื่อผู้ใช้ใหม่</p>";
            echo "<a href='register_from.php' class='btn btn-outline-danger w-100 mt-3'>ลองใหม่อีกครั้ง</a>";
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
} else {
    echo "Prepared Statement Error: " . mysqli_error($con);
}
?>
    </div>
</body>
</html>