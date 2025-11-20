<?php
session_start();
if (!isset($_SESSION['customer_id'])) {
    header("Location: Login.php");
    exit();
}
$fullname = $_SESSION['fullname'];
$username = $_SESSION['username'];
$my_role = isset($_SESSION['role']) ? $_SESSION['role'] : 'User';
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรไฟล์ของฉัน | MySystem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Prompt', sans-serif; background-color: #f8f9fa; }
        .card-profile { border: none; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); background: white; }
        .profile-header { background: linear-gradient(45deg, #0d6efd, #0dcaf0); color: white; padding: 2rem; border-radius: 15px 15px 0 0; }
        .avatar-circle { width: 80px; height: 80px; background: white; color: #0d6efd; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: bold; margin-bottom: 10px; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="Web_Page.php"><i class="bi bi-speedometer2 me-2"></i>MySystem</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- แก้ไขตรงนี้: ให้ไป Web_Page.php -->
                    <li class="nav-item"><a class="nav-link" href="Web_Page.php">หน้าหลัก</a></li>
                    
                    <?php if($my_role != 'User') { ?>
                    <li class="nav-item"><a class="nav-link" href="User_Management.php">จัดการผู้ใช้</a></li>
                    <?php } ?>
                </ul>
                <div class="d-flex align-items-center text-white">
                    <div class="me-3 text-end d-none d-lg-block">
                        <div class="fw-bold"><?php echo htmlspecialchars($fullname); ?></div>
                        <small class="badge bg-secondary rounded-pill"><?php echo $my_role; ?></small>
                    </div>
                    <a href="logout.php" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันออกจากระบบ?');">ออกจากระบบ</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Profile Content -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-profile">
                    <div class="profile-header text-center">
                        <div class="d-flex justify-content-center">
                            <div class="avatar-circle">
                                <?php echo mb_substr($fullname, 0, 1); ?>
                            </div>
                        </div>
                        <h3><?php echo htmlspecialchars($fullname); ?></h3>
                        <p class="mb-0 badge bg-light text-primary"><?php echo $my_role; ?></p>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="mb-4 text-primary"><i class="bi bi-info-circle me-2"></i>ข้อมูลส่วนตัว</h5>
                        
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted">Username:</div>
                            <div class="col-md-8 fw-bold"><?php echo htmlspecialchars($username); ?></div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted">รหัสสมาชิก (ID):</div>
                            <div class="col-md-8"><?php echo isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : '-'; ?></div>
                        </div>
                        
                        <div class="mt-4 text-center">
                            <!-- แก้ไขปุ่มกลับหน้าหลัก -->
                            <a href="Web_Page.php" class="btn btn-outline-primary me-2"><i class="bi bi-arrow-left me-1"></i> กลับหน้าหลัก</a>
                            <button class="btn btn-warning text-white"><i class="bi bi-pencil-square me-1"></i> แก้ไขข้อมูล</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>