<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['customer_id']) || (isset($_SESSION['role']) && $_SESSION['role'] == 'User')) {
    header("Location: Web_Page.php");
    exit();
}

$sql = "SELECT * FROM customer ORDER BY customer_ID ASC";
$result = mysqli_query($con, $sql);
$fullname = $_SESSION['fullname'];
$my_role = isset($_SESSION['role']) ? $_SESSION['role'] : 'User';
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการผู้ใช้ | MySystem</title>
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

        /* Card & Table */
        .card-table {
            border: none;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            background: white;
            padding: 1.5rem;
        }

        .table th {
            background-color: #f8f9fc;
            color: #4e73df;
            font-weight: 600;
            border-top: none;
        }

        .table td {
            vertical-align: middle;
        }

        .badge-role {
            padding: 8px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        .btn-action {
            border-radius: 10px;
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
                    <li class="nav-item"><a class="nav-link active" href="User_Management.php">จัดการผู้ใช้</a></li>
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

    <div class="container mt-4">
        <?php if (isset($_SESSION['msg_success'])) { ?>
            <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                <?php echo $_SESSION['msg_success'];
                unset($_SESSION['msg_success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php } ?>

        <?php if (isset($_SESSION['msg_error'])) { ?>
            <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <?php echo $_SESSION['msg_error'];
                unset($_SESSION['msg_error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php } ?>

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <h3 class="fw-bold text-dark m-0"><i
                    class="bi bi-shield-lock-fill me-2 text-primary"></i>จัดการสิทธิ์ผู้ใช้งาน</h3>
            <a href="register_from.php" class="btn btn-success rounded-pill px-4 shadow-sm btn-action">
                <i class="bi bi-plus-lg me-1"></i> เพิ่มสมาชิกใหม่
            </a>
        </div>

        <div class="card card-table">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="rounded-start">#</th>
                            <th>Username</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>สถานะ (Role)</th>
                            <th class="text-center rounded-end">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Check for correct ID column Name
                            $customer_id = isset($row['customer_id']) ? $row['customer_id'] : (isset($row['customer_ID']) ? $row['customer_ID'] : '');

                            $badge_color = 'bg-secondary';
                            if ($row['role'] == 'Admin')
                                $badge_color = 'bg-primary';
                            if ($row['role'] == 'Dev')
                                $badge_color = 'bg-warning text-dark';
                            ?>
                            <tr>
                                <td class="text-muted"><?php echo $customer_id; ?></td>
                                <td class="fw-bold text-primary"><?php echo htmlspecialchars($row['username']); ?></td>
                                <td>
                                    <div class="fw-medium"><?php echo htmlspecialchars($row['fullname']); ?></div>
                                    <small class="text-muted"><i
                                            class="bi bi-telephone me-1"></i><?php echo htmlspecialchars($row['phone']); ?></small>
                                </td>
                                <td><span
                                        class="badge <?php echo $badge_color; ?> badge-role shadow-sm"><?php echo $row['role']; ?></span>
                                </td>
                                <td class="text-center">
                                    <button type="button"
                                        class="btn btn-warning btn-sm text-dark fw-bold btn-action shadow-sm me-1"
                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                        data-id="<?php echo $customer_id; ?>"
                                        data-username="<?php echo $row['username']; ?>"
                                        data-fullname="<?php echo $row['fullname']; ?>"
                                        data-phone="<?php echo $row['phone']; ?>" data-role="<?php echo $row['role']; ?>">
                                        <i class="bi bi-pencil-square me-1"></i> แก้ไข
                                    </button>

                                    <?php if ($my_role == 'Dev' || ($my_role == 'Admin' && $row['role'] == 'User')) { ?>
                                        <a href="#" class="btn btn-danger btn-sm btn-action shadow-sm"
                                            onclick="return confirm('ยืนยันลบผู้ใช้งานนี้?');">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header bg-warningsubtle border-0 rounded-top-4">
                    <h5 class="modal-title fw-bold text-dark"><i
                            class="bi bi-pencil-square me-2"></i>แก้ไขข้อมูลผู้ใช้งาน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="update_user.php" method="POST">
                    <div class="modal-body p-4">
                        <input type="hidden" name="customer_ID" id="edit_id">

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase">Username</label>
                            <input type="text" class="form-control bg-light" id="edit_username" readonly>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-medium">ชื่อ-นามสกุล</label>
                                <input type="text" class="form-control" name="fullname" id="edit_fullname" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium">เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control" name="phone" id="edit_phone" required>
                            </div>
                        </div>

                        <hr class="my-4 text-muted opacity-25">

                        <div class="mb-3">
                            <label class="form-label fw-bold text-primary"><i
                                    class="bi bi-award-fill me-2"></i>กำลังหนดสิทธิ์ (Role)</label>
                            <select class="form-select border-primary border-opacity-25" name="role" id="edit_role">
                                <option value="User">User (สมาชิกทั่วไป)</option>
                                <option value="Admin">Admin (ผู้ดูแลระบบ)</option>
                                <?php if ($my_role == 'Dev') { ?>
                                    <option value="Dev">Dev (ผู้พัฒนาระบบ)</option>
                                <?php } ?>
                            </select>
                            <div class="form-text text-muted">กรุณาตรวจสอบความถูกต้องก่อนบันทึก</div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4"
                            data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="submit"
                            class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold">บันทึกการเปลี่ยนแปลง</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            // Extract info from data-* attributes
            const id = button.getAttribute('data-id');
            const username = button.getAttribute('data-username');
            const fullname = button.getAttribute('data-fullname');
            const phone = button.getAttribute('data-phone');
            const role = button.getAttribute('data-role');

            // Update the modal's content.
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_fullname').value = fullname;
            document.getElementById('edit_phone').value = phone;
            document.getElementById('edit_role').value = role;
        });
    </script>
</body>

</html>