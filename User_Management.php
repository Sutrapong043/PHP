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
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Prompt', sans-serif; background-color: #f8f9fa; }
        .card-table { border: none; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); background: white; padding: 20px; }
        .table th { background-color: #f1f3f5; color: #495057; }
        .badge-role { padding: 8px 12px; border-radius: 20px; font-weight: 500; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="Web_Page.php"><i class="bi bi-speedometer2 me-2"></i>MySystem</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- แก้ไขตรงนี้: ให้ไป Web_Page.php -->
                    <li class="nav-item"><a class="nav-link" href="Web_Page.php">หน้าหลัก</a></li>
                    <li class="nav-item"><a class="nav-link active" href="User_Management.php">การจัดการผู้ใช้</a></li>
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

    <div class="container mt-5">
        <?php if(isset($_SESSION['msg_success'])) { ?>
            <div class="alert alert-success fade show"><?php echo $_SESSION['msg_success']; unset($_SESSION['msg_success']); ?></div>
        <?php } ?>
        <?php if(isset($_SESSION['msg_error'])) { ?>
            <div class="alert alert-danger fade show"><?php echo $_SESSION['msg_error']; unset($_SESSION['msg_error']); ?></div>
        <?php } ?>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary"><i class="bi bi-shield-lock-fill me-2"></i>จัดการสิทธิ์ผู้ใช้งาน</h2>
            <a href="register_from.php" class="btn btn-success"><i class="bi bi-plus-lg me-1"></i> เพิ่มสมาชิกใหม่</a>
        </div>

        <div class="card card-table">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>สถานะ (Role)</th>
                            <th class="text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        while($row = mysqli_fetch_assoc($result)) { 
                            $badge_color = 'bg-secondary';
                            if ($row['role'] == 'Admin') $badge_color = 'bg-primary';
                            if ($row['role'] == 'Dev') $badge_color = 'bg-danger';
                        ?>
                            <tr>
                                <td><?php echo $row['customer_ID']; ?></td>
                                <td class="fw-bold"><?php echo htmlspecialchars($row['username']); ?></td>
                                <td><?php echo htmlspecialchars($row['fullname']); ?><div class="small text-muted"><?php echo htmlspecialchars($row['phone']); ?></div></td>
                                <td><span class="badge <?php echo $badge_color; ?> badge-role"><?php echo $row['role']; ?></span></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-sm text-white edit-btn" 
                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                        data-id="<?php echo $row['customer_ID']; ?>"
                                        data-username="<?php echo $row['username']; ?>"
                                        data-fullname="<?php echo $row['fullname']; ?>"
                                        data-phone="<?php echo $row['phone']; ?>"
                                        data-role="<?php echo $row['role']; ?>">
                                        <i class="bi bi-pencil-fill"></i> แต่งตั้ง/แก้ไข
                                    </button>
                                    <?php if ($my_role == 'Dev' || ($my_role == 'Admin' && $row['role'] == 'User')) { ?>
                                        <a href="#" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบ?');"><i class="bi bi-trash-fill"></i></a>
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
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white"><h5 class="modal-title fw-bold">แก้ไขข้อมูลและแต่งตั้งยศ</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <form action="update_user.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="customer_ID" id="edit_id">
                        <div class="mb-3"><label class="form-label text-muted">Username</label><input type="text" class="form-control bg-light" id="edit_username" readonly></div>
                        <div class="row">
                            <div class="col-md-6 mb-3"><label class="form-label">ชื่อ-นามสกุล</label><input type="text" class="form-control" name="fullname" id="edit_fullname" required></div>
                            <div class="col-md-6 mb-3"><label class="form-label">เบอร์โทรศัพท์</label><input type="text" class="form-control" name="phone" id="edit_phone" required></div>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label fw-bold text-primary">👑 ตำแหน่ง (Role)</label>
                            <select class="form-select" name="role" id="edit_role">
                                <option value="User">User (สมาชิกทั่วไป)</option>
                                <option value="Admin">Admin (ผู้ดูแลระบบ)</option>
                                <?php if ($my_role == 'Dev') { ?><option value="Dev">Dev (ผู้พัฒนาระบบ)</option><?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button><button type="submit" class="btn btn-warning text-white fw-bold">บันทึก</button></div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            document.getElementById('edit_id').value = button.getAttribute('data-id');
            document.getElementById('edit_username').value = button.getAttribute('data-username');
            document.getElementById('edit_fullname').value = button.getAttribute('data-fullname');
            document.getElementById('edit_phone').value = button.getAttribute('data-phone');
            document.getElementById('edit_role').value = button.getAttribute('data-role');
        });
    </script>
</body>
</html>