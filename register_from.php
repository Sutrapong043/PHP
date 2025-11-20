<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก | MySystem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Prompt', sans-serif; background-color: #f8f9fa; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .card-register { width: 100%; max-width: 500px; border: none; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); background: white; padding: 2.5rem; }
        .btn-primary-custom { background-color: #198754; border: none; width: 100%; padding: 10px; border-radius: 8px; transition: 0.3s; }
        .btn-primary-custom:hover { background-color: #157347; transform: translateY(-2px); }
        .form-control { border-radius: 8px; padding: 10px 15px; background-color: #f8f9fa; border: 1px solid #eee; }
        .form-control:focus { box-shadow: none; border-color: #198754; background-color: #fff; }
    </style>
</head>
<body>
    <div class="card-register">
        <div class="text-center mb-4">
            <h3 class="fw-bold text-success"><i class="bi bi-person-plus me-2"></i>สมัครสมาชิกใหม่</h3>
            <p class="text-muted">กรอกข้อมูลเพื่อเริ่มต้นใช้งาน</p>
        </div>

        <form action="register_save.php" method="POST">
            <div class="mb-3">
                <label class="form-label">ชื่อผู้ใช้ (Username)</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="mb-3">
                <label class="form-label">เบอร์โทรศัพท์</label>
                <input type="tel" class="form-control" name="phone" required>
            </div>
            <div class="mb-3">
                <label class="form-label">ชื่อ-นามสกุล</label>
                <input type="text" class="form-control" name="full-name" required>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">รหัสผ่าน</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">ยืนยันรหัสผ่าน</label>
                    <input type="password" class="form-control" name="confirm_password" required>
                </div>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="agreeTerms" value="agreed" id="agreeCheck" required>
                <label class="form-check-label text-muted small" for="agreeCheck">
                    ฉันยอมรับเงื่อนไขและข้อตกลงการใช้งาน
                </label>
            </div>

            <button type="submit" class="btn btn-success btn-primary-custom fw-bold">สมัครสมาชิก</button>
        </form>

        <div class="text-center mt-4">
            <small class="text-muted">มีบัญชีอยู่แล้ว? <a href="Login.php" class="text-decoration-none fw-bold text-success">เข้าสู่ระบบ</a></small>
        </div>
    </div>
</body>
</html>