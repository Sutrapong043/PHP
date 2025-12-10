<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['customer_id'])) {
    header("Location: Login.php");
    exit();
}

date_default_timezone_set('Asia/Bangkok'); // เวลาไทย
$currentTime = date('d/m/Y H:i:s');
$updateStatus = 'ระบบพร้อมใช้งาน (ไม่มีการอัปเดตค้างอยู่)';

$result_total   = mysqli_query($con, "SELECT COUNT(*) as count FROM customer");
$row_total      = mysqli_fetch_assoc($result_total);
$total_users    = $row_total['count'];

$result_admin   = mysqli_query($con, "SELECT COUNT(*) as count FROM customer WHERE role = 'Admin'");
$row_admin      = mysqli_fetch_assoc($result_admin);
$total_admin    = $row_admin['count'];

$result_dev     = mysqli_query($con, "SELECT COUNT(*) as count FROM customer WHERE role = 'Dev'");
$row_dev        = mysqli_fetch_assoc($result_dev);
$total_dev      = $row_dev['count'];

$result_member  = mysqli_query($con, "SELECT COUNT(*) as count FROM customer WHERE role = 'User'");
$row_member     = mysqli_fetch_assoc($result_member);
$total_member   = $row_member['count'];

$fullname = $_SESSION['fullname'];
$my_role  = isset($_SESSION['role']) ? $_SESSION['role'] : 'User';
?>


<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก | MySystem Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --glass-bg: rgba(255, 255, 255, 0.95);
            --card-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            --hover-transform: translateY(-5px);
        }

        body {
            font-family: 'Prompt', sans-serif;
            background-color: #f0f2f5;
            background-image: radial-gradient(circle at 10% 20%, rgb(239, 246, 255) 0%, rgb(219, 228, 255) 90%);
            min-height: 100vh;
        }

        /* Navbar Styling */
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

        /* Stats Cards */
        .stats-card {
            border: none;
            border-radius: 20px;
            color: white;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: var(--card-shadow);
        }

        .stats-card:hover {
            transform: var(--hover-transform);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .stats-card .card-body {
            z-index: 2;
            position: relative;
        }

        .stats-icon {
            font-size: 4rem;
            position: absolute;
            right: -10px;
            bottom: -10px;
            opacity: 0.25;
            transform: rotate(-15deg);
        }

        .bg-gradient-primary { background: linear-gradient(45deg, #4e54c8, #8f94fb); }
        .bg-gradient-success { background: linear-gradient(45deg, #11998e, #38ef7d); }
        .bg-gradient-info    { background: linear-gradient(45deg, #00b4db, #0083b0); }
        .bg-gradient-warning { background: linear-gradient(45deg, #fce38a, #f38181); }

        /* General Card Styling */
        .custom-card {
            border: none;
            border-radius: 20px;
            background: white;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease;
        }

        .card-header-clean {
            background: transparent;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 1.5rem;
        }

        /* Carousel */
        .carousel-item img {
            height: 400px;
            object-fit: cover;
            border-radius: 15px;
            filter: brightness(0.85); /* Slightly brighter than before */
        }
        
        .carousel-caption {
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            border-radius: 15px;
            padding: 1.5rem;
            bottom: 2rem;
        }

        /* Announcement Bar */
        .announcement-bar {
            background: #fff;
            border-left: 5px solid #ffc107;
            border-radius: 15px;
            padding: 1rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
            display: flex;
            align-items: center;
        }

        /* Buttons */
        .btn-menu {
            border-radius: 12px;
            transition: all 0.2s;
            border: 1px solid #e3e6f0;
            background: white;
            color: #555;
        }
        
        .btn-menu:hover {
            transform: translateX(5px);
            background: #f8f9fc;
            border-color: #d1d3e2;
            color: #764ba2;
        }

        .status-badge {
            font-size: 0.85rem;
            padding: 0.5em 1em;
            border-radius: 50rem;
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
                    <li class="nav-item"><a class="nav-link active" href="Web_Page.php">หน้าหลัก</a></li>
                    
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
                        onclick="return confirm('ยืนยันออกจากระบบ?');">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header / Info Bar -->
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center bg-white p-3 rounded-4 shadow-sm mb-4 flex-wrap gap-2">
            <div class="text-secondary">
                <i class="bi bi-clock-history me-2 text-primary"></i>
                เวลาเซิร์ฟเวอร์: <span id="serverTime" class="fw-medium text-dark"><?php echo $currentTime; ?></span>
            </div>
            <div>
                <span id="systemStatus" class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2 rounded-pill">
                    <i class="bi bi-check-circle-fill me-1"></i>
                    <?php echo htmlspecialchars($updateStatus); ?>
                </span>
            </div>
        </div>

        <!-- 📢 Announcement -->
        <div class="announcement-bar mb-4">
            <div class="me-3 text-warning">
                <i class="bi bi-megaphone-fill fs-3"></i>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <h6 class="fw-bold mb-1 text-dark">ประกาศจากผู้ดูแลระบบ</h6>
                <marquee behavior="scroll" direction="left" scrollamount="6" class="text-muted">
                    ยินดีต้อนรับสู่เซิร์ฟเวอร | 🛠️ ติดต่อสอบถาม หรือ เเจ้งปัญหา โปรดติดต่อเเอดมินหรือผุ้พัฒนา |
                    📢 โปรดอัปเดตข้อมูลส่วนตัวให้เป็นปัจจุบัน
                </marquee>
            </div>
        </div>

        <!-- 📊 Stats Dashboard -->
        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-bar-chart-fill me-2 text-primary"></i>ภาพรวมระบบ</h5>
        <div class="row mb-4 g-4">
            <!-- Total Users -->
            <div class="col-xl-3 col-md-6">
                <div class="card stats-card bg-gradient-primary h-100">
                    <div class="card-body p-4">
                        <div class="text-white-50 small fw-bold text-uppercase mb-1">สมาชิกทั้งหมด</div>
                        <div id="stat_total" class="h2 mb-0 fw-bold"><?php echo $total_users; ?> คน</div>
                        <i class="bi bi-people-fill stats-icon"></i>
                    </div>
                </div>
            </div>

            <!-- General Users -->
            <div class="col-xl-3 col-md-6">
                <div class="card stats-card bg-gradient-success h-100">
                    <div class="card-body p-4">
                        <div class="text-white-50 small fw-bold text-uppercase mb-1">ผู้ใช้งานทั่วไป (User)</div>
                        <div id="stat_member" class="h2 mb-0 fw-bold"><?php echo $total_member; ?> คน</div>
                        <i class="bi bi-person stats-icon"></i>
                    </div>
                </div>
            </div>

            <!-- Admins -->
            <div class="col-xl-3 col-md-6">
                <div class="card stats-card bg-gradient-info h-100">
                    <div class="card-body p-4">
                        <div class="text-white-50 small fw-bold text-uppercase mb-1">ผู้ดูแล (Admin)</div>
                        <div id="stat_admin" class="h2 mb-0 fw-bold"><?php echo $total_admin; ?> คน</div>
                        <i class="bi bi-shield-lock-fill stats-icon"></i>
                    </div>
                </div>
            </div>

            <!-- Developers -->
            <div class="col-xl-3 col-md-6">
                <div class="card stats-card bg-gradient-warning h-100">
                    <div class="card-body p-4">
                        <div class="text-white-50 small fw-bold text-uppercase mb-1">ผู้พัฒนา (Dev)</div>
                        <div id="stat_dev" class="h2 mb-0 fw-bold"><?php echo $total_dev; ?> คน</div>
                        <i class="bi bi-code-slash stats-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- 📰 News & Shortcuts -->
        <div class="row g-4">
            <!-- News Slider -->
            <div class="col-lg-8">
                <div class="card custom-card h-100">
                    <div class="card-header-clean">
                        <h6 class="m-0 fw-bold text-primary"><i class="bi bi-newspaper me-2"></i>ข่าวสารและกิจกรรมล่าสุด</h6>
                    </div>
                    <div class="card-body p-3">
                        <div id="newsCarousel" class="carousel slide rounded-4 overflow-hidden shadow-sm" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="0" class="active"></button>
                                <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="1"></button>
                                <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="2"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="https://images.unsplash.com/photo-1504384308090-c54be3852f33?auto=format&fit=crop&w=800&q=80" class="d-block w-100" alt="News 1">
                                    <div class="carousel-caption">
                                        <h5 class="fw-bold">ยินดีต้อนรับสู่ระบบใหม่</h5>
                                        <p class="mb-0">ระบบจัดการฐานข้อมูลที่มีประสิทธิภาพและปลอดภัยยิ่งขึ้น</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=800&q=80" class="d-block w-100" alt="News 2">
                                    <div class="carousel-caption">
                                        <h5 class="fw-bold">อัปเดตฟีเจอร์ Dashboard</h5>
                                        <p class="mb-0">สามารถดูสถิติผู้เข้าใช้งานได้แบบ Real-time แล้ววันนี้</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=800&q=80" class="d-block w-100" alt="News 3">
                                    <div class="carousel-caption">
                                        <h5 class="fw-bold">ติดต่อทีมผู้พัฒนา</h5>
                                        <p class="mb-0">หากพบปัญหาการใช้งาน สามารถแจ้งทีม Dev ได้ตลอด 24 ชม.</p>
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

            <!-- Shortcuts -->
            <div class="col-lg-4">
                <div class="card custom-card h-100">
                    <div class="card-header-clean">
                        <h6 class="m-0 fw-bold text-dark"><i class="bi bi-grid-fill me-2 text-primary"></i>เมนูด่วน</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-3">
                            <a href="Profile.php" class="btn btn-menu p-3 text-start d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3 text-primary">
                                    <i class="bi bi-person-circle fs-5"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">แก้ไขข้อมูลส่วนตัว</div>
                                    <small class="text-muted">จัดการข้อมูลบัญชีของคุณ</small>
                                </div>
                            </a>
                            
                            <?php if ($my_role != 'User') { ?>
                                <a href="User_Management.php" class="btn btn-menu p-3 text-start d-flex align-items-center">
                                    <div class="bg-success bg-opacity-10 p-2 rounded-circle me-3 text-success">
                                        <i class="bi bi-people-fill fs-5"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">จัดการสมาชิก</div>
                                        <small class="text-muted">เพิ่ม ลบ หรือแก้ไขผู้ใช้</small>
                                    </div>
                                </a>
                            <?php } ?>
                            
                            <a href="Settings.php" class="btn btn-menu p-3 text-start d-flex align-items-center">
                                <div class="bg-secondary bg-opacity-10 p-2 rounded-circle me-3 text-secondary">
                                    <i class="bi bi-gear-fill fs-5"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">การตั้งค่าระบบ</div>
                                    <small class="text-muted">ปรับแต่งการใช้งานทั่วไป</small>
                                </div>
                            </a>
                            
                            <a href="logout.php" class="btn btn-menu p-3 text-start d-flex align-items-center border-danger border-opacity-25"
                                onclick="return confirm('ยืนยันออกจากระบบ?');">
                                <div class="bg-danger bg-opacity-10 p-2 rounded-circle me-3 text-danger">
                                    <i class="bi bi-power fs-5"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-danger">ออกจากระบบ</div>
                                    <small class="text-muted">End Session</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="text-center py-4 text-muted small mt-5">
        &copy; <?php echo date('Y'); ?> MySystem Dashboard. All rights reserved.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // 1. Real-time Clock
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('th-TH');
            const dateString = now.toLocaleDateString('th-TH');
            document.getElementById('serverTime').innerText = dateString + ' ' + timeString;
        }
        setInterval(updateClock, 1000);
        updateClock(); // Run immediately

        // 2. Real-time Data Polling
        let currentStats = {
            total_users: <?php echo $total_users; ?>,
            total_member: <?php echo $total_member; ?>,
            total_admin: <?php echo $total_admin; ?>,
            total_dev: <?php echo $total_dev; ?>
        };

        async function checkUpdates() {
            try {
                const response = await fetch('api_get_stats.php');
                const data = await response.json();
                
                let hasChange = false;
                
                // Check if any number changed
                if (data.total_users != currentStats.total_users || 
                    data.total_member != currentStats.total_member || 
                    data.total_admin != currentStats.total_admin || 
                    data.total_dev != currentStats.total_dev) {
                    
                    hasChange = true;
                    
                    // Update DOM
                    document.getElementById('stat_total').innerText = data.total_users + ' คน';
                    document.getElementById('stat_member').innerText = data.total_member + ' คน';
                    document.getElementById('stat_admin').innerText = data.total_admin + ' คน';
                    document.getElementById('stat_dev').innerText = data.total_dev + ' คน';

                    // Update local state
                    currentStats = data;
                }

                const statusBadge = document.getElementById('systemStatus');
                if (hasChange) {
                    statusBadge.innerHTML = '<i class="bi bi-cloud-check-fill me-1"></i> ข้อมูลถูก Update แล้ว';
                    statusBadge.classList.replace('text-success', 'text-primary');
                    statusBadge.classList.replace('border-success', 'border-primary');
                    statusBadge.classList.replace('bg-success', 'bg-primary');
                    
                    // Pulse animation
                    statusBadge.style.transition = 'all 0.5s';
                    statusBadge.style.transform = 'scale(1.1)';
                    setTimeout(() => statusBadge.style.transform = 'scale(1)', 500);

                    // Revert status after 5 seconds
                    setTimeout(() => {
                         statusBadge.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> ระบบพร้อมใช้งาน';
                         statusBadge.classList.replace('text-primary', 'text-success');
                         statusBadge.classList.replace('border-primary', 'border-success');
                         statusBadge.classList.replace('bg-primary', 'bg-success');
                    }, 5000);
                }

            } catch (error) {
                console.error('Error fetching stats:', error);
            }
        }

        // Poll every 3 seconds
        setInterval(checkUpdates, 3000);
    </script>
</body>

</html>