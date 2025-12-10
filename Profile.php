<?php
session_start();
include 'connect.php';

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
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --glass-bg: rgba(255, 255, 255, 0.95);
            --card-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: 'Prompt', sans-serif;
            background-color: #f0f2f5;
            background-image: radial-gradient(circle at 10% 20%, rgb(239, 246, 255) 0%, rgb(219, 228, 255) 90%);
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .nav-link {
            color: #555 !important;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #764ba2 !important;
        }

        /* Profile Card */
        .card-profile {
            border: none;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            background: white;
            overflow: hidden;
        }

        .profile-header {
            background: var(--primary-gradient);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
        }

        .avatar-circle {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            color: white;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-weight: bold;
            margin: 0 auto 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .role-badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 15px;
            border-radius: 50rem;
            font-size: 0.9rem;
            backdrop-filter: blur(4px);
        }

        .info-row {
            padding: 1rem 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .btn-action {
            border-radius: 12px;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-action:hover {
            transform: translateY(-2px);
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="Web_Page.php">
                <i class="bi bi-speedometer2 me-2 text-primary"></i>MySystem
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto ms-3">
                    <li class="nav-item"><a class="nav-link" href="Web_Page.php">หน้าหลัก</a></li>

                    <?php if ($my_role != 'User') { ?>
                        <li class="nav-item"><a class="nav-link" href="User_Management.php">จัดการผู้ใช้</a></li>
                    <?php } ?>

                    <li class="nav-item"><a class="nav-link active" href="Profile.php">โปรไฟล์ของฉัน</a></li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <div class="text-end d-none d-lg-block">
                        <div class="fw-bold text-dark"><?php echo htmlspecialchars($fullname); ?></div>
                        <small class="badge bg-secondary rounded-pill"><?php echo $my_role; ?></small>
                    </div>
                    <a href="logout.php" class="btn btn-danger rounded-pill px-4 shadow-sm"
                        onclick="return confirm('ยืนยันออกจากระบบ?');">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Profile Content -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">

                <?php if (isset($_SESSION['msg_success'])) { ?>
                    <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <?php echo $_SESSION['msg_success'];
                        unset($_SESSION['msg_success']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php } ?>

                <div class="card card-profile">
                    <div class="profile-header">
                        <div class="avatar-circle">
                            <?php echo mb_substr($fullname, 0, 1); ?>
                        </div>
                        <h3 class="fw-bold mb-1"><?php echo htmlspecialchars($fullname); ?></h3>
                        <span class="role-badge"><i class="bi bi-shield-check me-1"></i><?php echo $my_role; ?></span>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <h5 class="mb-4 text-primary fw-bold"><i class="bi bi-person-lines-fill me-2"></i>ข้อมูลส่วนตัว
                        </h5>

                        <div class="info-row d-flex justify-content-between align-items-center">
                            <span class="text-muted"><i class="bi bi-person me-2"></i>ชื่อผู้ใช้ (Username)</span>
                            <span class="fw-bold text-dark"><?php echo htmlspecialchars($username); ?></span>
                        </div>

                        <div class="info-row d-flex justify-content-between align-items-center">
                            <span class="text-muted"><i class="bi bi-card-heading me-2"></i>รหัสสมาชิก (ID)</span>
                            <span
                                class="fw-bold text-dark">#<?php echo isset($_SESSION['customer_id']) ? str_pad($_SESSION['customer_id'], 4, '0', STR_PAD_LEFT) : '-'; ?></span>
                        </div>

                        <div class="mt-5 text-center d-grid gap-2 d-md-block">
                            <a href="Web_Page.php" class="btn btn-outline-secondary btn-action me-md-2">
                                <i class="bi bi-arrow-left me-1"></i> กลับหน้าหลัก
                            </a>
                            <a href="Edit_Profile.php" class="btn btn-primary btn-action shadow-sm">
                                <i class="bi bi-pencil-square me-1"></i> แก้ไขข้อมูล
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>