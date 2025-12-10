<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['customer_id'])) {
    header("Location: Login.php");
    exit();
}

$id = $_SESSION['customer_id'];
$fullname = $_SESSION['fullname'];
$my_role = isset($_SESSION['role']) ? $_SESSION['role'] : 'User';

// ดึงข้อมูลล่าสุดจากฐานข้อมูล
$sql = "SELECT * FROM customer WHERE customer_ID = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "ไม่พบข้อมูลผู้ใช้";
    exit();
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลส่วนตัว | MySystem</title>
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

        .card-edit {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            background: white;
            overflow: hidden;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #e0e0e0;
        }

        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(118, 75, 162, 0.1);
            border-color: #764ba2;
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
                    <li class="nav-item"><a class="nav-link active" href="Profile.php">โปรไฟล์ของฉัน</a></li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <div class="text-end d-lg-block">
                        <div class="fw-bold text-dark"><?php echo htmlspecialchars($fullname); ?></div>
                        <small class="badge bg-secondary rounded-pill"><?php echo $my_role; ?></small>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">

                <?php if (isset($_SESSION['msg_error'])) { ?>
                    <div class="alert alert-danger shadow-sm rounded-3 mb-4">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <?php echo $_SESSION['msg_error'];
                        unset($_SESSION['msg_error']); ?>
                    </div>
                <?php } ?>

                <div class="card card-edit">
                    <div class="card-header bg-white border-0 p-4 pb-0">
                        <h4 class="fw-bold text-primary"><i class="bi bi-pencil-square me-2"></i>แก้ไขข้อมูลส่วนตัว</h4>
                        <p class="text-muted small">อัปเดตข้อมูลของคุณให้เป็นปัจจุบัน</p>
                    </div>
                    <div class="card-body p-4">
                        <form action="save_profile.php" method="POST">
                            <input type="hidden" name="customer_ID" value="<?php echo $user['customer_ID']; ?>">

                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">ชื่อผู้ใช้ (Username)</label>
                                <input type="text" class="form-control bg-light"
                                    value="<?php echo htmlspecialchars($user['username']); ?>" readonly>
                                <div class="form-text">ชื่อผู้ใช้ไม่สามารถเปลี่ยนแปลงได้</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-medium">ชื่อ-นามสกุล</label>
                                <input type="text" class="form-control" name="fullname"
                                    value="<?php echo htmlspecialchars($user['fullname']); ?>" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-medium">เบอร์โทรศัพท์</label>
                                <input type="tel" class="form-control" name="phone"
                                    value="<?php echo htmlspecialchars($user['phone']); ?>" required>
                            </div>

                            <hr class="my-4 text-muted opacity-25">

                            <div class="mb-4">
                                <label class="form-label fw-medium text-danger"><i
                                        class="bi bi-key me-1"></i>เปลี่ยนรหัสผ่าน (ถ้าต้องการ)</label>
                                <input type="password" class="form-control" name="new_password"
                                    placeholder="เว้นว่างไว้หากไม่ต้องการเปลี่ยน">
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary py-3 rounded-pill fw-bold shadow-sm">
                                    บันทึกการเปลี่ยนแปลง
                                </button>
                                <a href="Profile.php" class="btn btn-light py-2 rounded-pill text-muted">ยกเลิก</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>