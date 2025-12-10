<?php
session_start();
include 'connect.php';

// 1. ตรวจสอบสิทธิ์ (ต้องล็อกอินก่อน)
if (!isset($_SESSION['customer_id'])) {
    header("Location: Login.php");
    exit();
}

// 2. ดึงข้อมูลจำนวนสมาชิกแต่ละยศ (Real-time จาก Database)
// นับทั้งหมด
$result_total = mysqli_query($con, "SELECT COUNT(*) as count FROM customer");
$row_total = mysqli_fetch_assoc($result_total);
$total_users = $row_total['count'];

// นับ Admin
$result_admin = mysqli_query($con, "SELECT COUNT(*) as count FROM customer WHERE role = 'Admin'");
$row_admin = mysqli_fetch_assoc($result_admin);
$total_admin = $row_admin['count'];

// นับ Dev
$result_dev = mysqli_query($con, "SELECT COUNT(*) as count FROM customer WHERE role = 'Dev'");
$row_dev = mysqli_fetch_assoc($result_dev);
$total_dev = $row_dev['count'];

// นับ User ทั่วไป
$result_member = mysqli_query($con, "SELECT COUNT(*) as count FROM customer WHERE role = 'User'");
$row_member = mysqli_fetch_assoc($result_member);
$total_member = $row_member['count'];

$fullname = $_SESSION['fullname'];
$my_role = isset($_SESSION['role']) ? $_SESSION['role'] : 'User';
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก | MySystem Dashboard</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Prompt', sans-serif; background-color: #f0f2f5; }
        
        /* Stats Card Style */
        .stats-card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
            color: white;
        }
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .stats-icon { font-size: 3rem; opacity: 0.3; position: absolute; right: 20px; bottom: 10px; }
        .bg-gradient-primary { background: linear-gradient(45deg, #4e73df, #224abe); }
        .bg-gradient-success { background: linear-gradient(45deg, #1cc88a, #13855c); }
        .bg-gradient-info { background: linear-gradient(45deg, #36b9cc, #258391); }
        .bg-gradient-warning { background: linear-gradient(45deg, #f6c23e, #dda20a); }

        /* News Carousel */
        .carousel-item img {
            height: 400px;
            object-fit: cover;
            border-radius: 15px;
            filter: brightness(0.7);
        }
        .carousel-caption {
            background: rgba(0,0,0,0.5);
            border-radius: 10px;
            padding: 20px;
        }
        
        /* Announcement Bar */
        .announcement-bar {
            background: #ffefd5;
            color: #856404;
            border-left: 5px solid #ffc107;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="Web_Page.php"><i class="bi bi-speedometer2 me-2"></i>MySystem</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="Web_Page.php">หน้าหลัก</a></li>
                    
                    <!-- เมนูจัดการ (แสดงเฉพาะ Admin/Dev) -->
                    <?php if($my_role != 'User') { ?>
                    <li class="nav-item"><a class="nav-link" href="User_Management.php">จัดการผู้ใช้</a></li>
                    <?php } ?>
                    
                    <li class="nav-item"><a class="nav-link" href="Profile.php">โปรไฟล์ของฉัน</a></li>
                </ul>
                <div class="d-flex align-items-center text-white">
                    <div class="me-3 text-end d-none d-lg-block">
                        <div class="fw-bold"><?php echo htmlspecialchars($fullname); ?></div>
                        <small class="badge bg-secondary rounded-pill"><?php echo $my_role; ?></small>
                    </div>
                    <a href="logout.php" class="btn btn-outline-danger btn-sm" onclick="return confirm('ยืนยันออกจากระบบ?');">
                        <i class="bi bi-box-arrow-right"></i> Output
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        
        <!-- 📢 1. Announcement Bar (ประกาศด่วน) -->
        <div class="announcement-bar shadow-sm">
            <i class="bi bi-megaphone-fill fs-4 me-3 text-warning"></i>
            <div class="w-100">
                <h5 class="fw-bold mb-1">ประกาศจากผู้ดูแลระบบ</h5>
                <marquee behavior="scroll" direction="left" scrollamount="6">
                    ยินดีต้อนรับสู่ระบบเวอร์ชั่นใหม่! | 🛠️ ปิดปรับปรุงเซิร์ฟเวอร์ทุกวันอาทิตย์ เวลา 02:00 - 04:00 น. | 📢 โปรดอัปเดตข้อมูลส่วนตัวให้เป็นปัจจุบัน
                </marquee>
            </div>
        </div>

        <!-- 📊 2. Stats Dashboard (แสดงจำนวนคน) -->
        <div class="row mb-4">
            <!-- Total Users -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stats-card bg-gradient-primary h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-uppercase mb-1 opacity-75">สมาชิกทั้งหมด</div>
                                <div class="h2 mb-0 fw-bold"><?php echo $total_users; ?> คน</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-people-fill stats-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- General Users -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stats-card bg-gradient-success h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-uppercase mb-1 opacity-75">ผู้ใช้งานทั่วไป (User)</div>
                                <div class="h2 mb-0 fw-bold"><?php echo $total_member; ?> คน</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-person stats-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admins -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stats-card bg-gradient-info h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-uppercase mb-1 opacity-75">ผู้ดูแล (Admin)</div>
                                <div class="h2 mb-0 fw-bold"><?php echo $total_admin; ?> คน</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-shield-lock-fill stats-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Developers -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stats-card bg-gradient-warning h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-uppercase mb-1 opacity-75">ผู้พัฒนา (Dev)</div>
                                <div class="h2 mb-0 fw-bold"><?php echo $total_dev; ?> คน</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-code-slash stats-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 📰 3. News Slider (ข่าวสาร) -->
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card shadow mb-4 border-0 rounded-4">
                    <div class="card-header py-3 bg-white border-0 rounded-top-4">
                        <h6 class="m-0 fw-bold text-primary"><i class="bi bi-newspaper me-2"></i>ข่าวสารและกิจกรรมล่าสุด</h6>
                    </div>
                    <div class="card-body p-0">
                        <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="0" class="active"></button>
                                <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="1"></button>
                                <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="2"></button>
                            </div>
                            <div class="carousel-inner rounded-bottom-4">
                                <div class="carousel-item active">
                                    <img src="https://images.unsplash.com/photo-1504384308090-c54be3852f33?auto=format&fit=crop&w=800&q=80" class="d-block w-100" alt="News 1">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>ยินดีต้อนรับสู่ระบบใหม่</h5>
                                        <p>ระบบจัดการฐานข้อมูลที่มีประสิทธิภาพและปลอดภัยยิ่งขึ้น</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=800&q=80" class="d-block w-100" alt="News 2">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>อัปเดตฟีเจอร์ Dashboard</h5>
                                        <p>สามารถดูสถิติผู้เข้าใช้งานได้แบบ Real-time แล้ววันนี้</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=800&q=80" class="d-block w-100" alt="News 3">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>ติดต่อทีมผู้พัฒนา</h5>
                                        <p>หากพบปัญหาการใช้งาน สามารถแจ้งทีม Dev ได้ตลอด 24 ชม.</p>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side Panel (Shortcuts) -->
            <div class="col-lg-4">
                <div class="card shadow mb-4 border-0 rounded-4">
                    <div class="card-header py-3 bg-white border-0 rounded-top-4">
                        <h6 class="m-0 fw-bold text-dark">เมนูด่วน</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="Profile.php" class="btn btn-outline-primary text-start p-3">
                                <i class="bi bi-person-circle me-2"></i> แก้ไขข้อมูลส่วนตัว
                            </a>
                            <?php if($my_role != 'User') { ?>
                            <a href="User_Management.php" class="btn btn-outline-success text-start p-3">
                                <i class="bi bi-people-fill me-2"></i> จัดการสมาชิก
                            </a>
                            <?php } ?>
                            <a href="#" class="btn btn-outline-secondary text-start p-3">
                                <i class="bi bi-gear-fill me-2"></i> การตั้งค่าระบบ
                            </a>
                            <a href="logout.php" class="btn btn-outline-danger text-start p-3" onclick="return confirm('ยืนยันออกจากระบบ?');">
                                <i class="bi bi-power me-2"></i> ออกจากระบบ
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
