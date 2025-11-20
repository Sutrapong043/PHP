<?php
session_start();

// 1. ตรวจสอบว่าล็อกอินหรือยัง (ถ้าไม่มี session ให้ถีบไปหน้า Login)
if (isset($_SESSION['customer_id'])) {
    // ถ้าล็อกอินแล้ว ให้ไปหน้า Dashboard เลย
    header("Location: Web_Page.php");
} else {
    // ถ้ายังไม่ล็อกอิน ให้ไปหน้า Login
    header("Location: Login.php");
}
exit();


// ดึงชื่อผู้ใช้มาแสดง
$fullname = $_SESSION['fullname'];
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบจัดการหลังบ้าน | Dashboard</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }
        .welcome-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            border: none;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-speedometer2 me-2"></i>MySystem
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">
                            <i class="bi bi-house-door me-1"></i> หน้าหลัก
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="User_Management.php"> <i class="bi bi-people me-1"></i> การจัดการผู้ใช้
</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-box-seam me-1"></i> การจัดการสินค้า
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">รายการสินค้า</a></li>
                            <li><a class="dropdown-item" href="#">เพิ่มสินค้าใหม่</a></li>
                        </ul>
                    </li>
                </ul>

                <div class="d-flex align-items-center">
                    <div class="text-white me-3 d-none d-lg-block">
                        <small style="color: #ccc;">ยินดีต้อนรับ,</small><br>
                        <span class="fw-bold"><?php echo htmlspecialchars($fullname); ?></span>
                    </div>
                    
                    <a href="logout.php" class="btn btn-danger btn-sm" onclick="return confirm('คุณต้องการออกจากระบบหรือไม่?');">
                        <i class="bi bi-box-arrow-right me-1"></i> ออกจากระบบ
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card welcome-card p-5 text-center">
                    <h1 class="display-4 text-primary fw-bold">สวัสดีคุณ <?php echo htmlspecialchars($fullname); ?>! 👋</h1>
                    <p class="lead text-muted">ยินดีต้อนรับเข้าสู่ระบบจัดการหลังบ้าน</p>
                    <hr class="my-4">
                    <p>คุณสามารถเลือกเมนูการจัดการต่างๆ ได้ที่แถบด้านบน</p>
                    
                    <div class="mt-4">
                        <a href="#" class="btn btn-primary btn-lg me-2"><i class="bi bi-people"></i> จัดการสมาชิก</a>
                        <a href="Profile.php" class="btn btn-outline-secondary btn-lg"><i class="bi bi-person-circle"></i> ดูโปรไฟล์ของฉัน</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>