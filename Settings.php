<?php
session_start();
if (!isset($_SESSION['customer_id'])) {
    header("Location: Login.php");
    exit();
}
$fullname = $_SESSION['fullname'];
$my_role = isset($_SESSION['role']) ? $_SESSION['role'] : 'User';
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การตั้งค่าระบบ | MySystem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --glass-bg: rgba(255, 255, 255, 0.95);
        }

        body {
            font-family: 'Prompt', sans-serif;
            background-color: #f0f2f5;
            background-image: radial-gradient(circle at 10% 20%, rgb(239, 246, 255) 0%, rgb(219, 228, 255) 90%);
            min-height: 100vh;
        }

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

        .settings-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            background: white;
            overflow: hidden;
            transition: transform 0.3s;
        }

        .settings-card:hover {
            transform: translateY(-5px);
        }

        .form-switch .form-check-input {
            width: 3em;
            height: 1.5em;
        }

        .list-group-item {
            border: none;
            padding: 1.25rem;
            border-bottom: 1px solid #f0f0f0 !important;
        }

        .list-group-item:last-child {
            border-bottom: none !important;
        }

        .settings-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 1.25rem;
            margin-right: 15px;
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
                    <li class="nav-item"><a class="nav-link" href="Profile.php">โปรไฟล์ของฉัน</a></li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <div class="text-end d-none d-lg-block">
                        <div class="fw-bold text-dark"><?php echo htmlspecialchars($fullname); ?></div>
                        <small class="badge bg-secondary rounded-pill"><?php echo $my_role; ?></small>
                    </div>
                    <a href="logout.php" class="btn btn-danger rounded-pill px-4 shadow-sm"
                        onclick="return confirm('ยืนยันออกจากระบบ?');">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h3 class="fw-bold mb-4 text-dark"><i class="bi bi-gear-fill me-2 text-primary"></i>การตั้งค่าระบบ</h3>

        <div class="row g-4">
            <!-- General Settings -->
            <div class="col-md-6">
                <div class="settings-card h-100">
                    <div class="p-4 border-bottom bg-light bg-opacity-50">
                        <h5 class="m-0 fw-bold text-primary">ทั่วไป</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="settings-icon bg-primary bg-opacity-10 text-primary">
                                    <i class="bi bi-moon-stars"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">โหมดมืด (Dark Mode)</div>
                                    <small class="text-muted">เปลี่ยนธีมเป็นสีเข้ม</small>
                                </div>
                            </div>
                            <div class="form-check form-switch pb-2">
                                <input class="form-check-input" type="checkbox" role="switch" disabled>
                            </div>
                        </div>

                        <div class="list-group-item d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="settings-icon bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-bell"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">การแจ้งเตือน</div>
                                    <small class="text-muted">รับการแจ้งเตือนทางอีเมล</small>
                                </div>
                            </div>
                            <div class="form-check form-switch pb-2">
                                <input class="form-check-input" type="checkbox" role="switch" checked>
                            </div>
                        </div>

                        <div class="list-group-item d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="settings-icon bg-info bg-opacity-10 text-info">
                                    <i class="bi bi-translate"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">ภาษา (Language)</div>
                                    <small class="text-muted">ภาษาไทย</small>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security & System -->
            <div class="col-md-6">
                <div class="settings-card h-100 mb-4">
                    <div class="p-4 border-bottom bg-light bg-opacity-50">
                        <h5 class="m-0 fw-bold text-danger">ความปลอดภัย & ระบบ</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="Edit_Profile.php"
                            class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="settings-icon bg-warning bg-opacity-10 text-warning">
                                    <i class="bi bi-key"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">เปลี่ยนรหัสผ่าน</div>
                                    <small class="text-muted">อัปเดตรหัสผ่านเพื่อความปลอดภัย</small>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right text-muted"></i>
                        </a>

                        <?php if ($my_role == 'Admin' || $my_role == 'Dev') { ?>
                            <div class="list-group-item d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="settings-icon bg-danger bg-opacity-10 text-danger">
                                        <i class="bi bi-database-gear"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">สำรองข้อมูล (Backup)</div>
                                        <small class="text-muted">ดาวน์โหลด SQL Backup</small>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-outline-danger rounded-pill">Download</button>
                            </div>
                        <?php } ?>

                        <div class="list-group-item d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="settings-icon bg-secondary bg-opacity-10 text-secondary">
                                    <i class="bi bi-info-circle"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">เกี่ยวกับระบบ</div>
                                    <small class="text-muted">MySystem v1.0.2</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="Web_Page.php" class="btn btn-light rounded-pill px-4 text-muted"><i
                    class="bi bi-arrow-left me-1"></i> กลับหน้าหลัก</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>