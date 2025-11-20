<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ | MySystem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Prompt', sans-serif; background-color: #f8f9fa; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card-login { width: 100%; max-width: 400px; border: none; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); background: white; padding: 2rem; }
        .btn-primary-custom { background-color: #0d6efd; border: none; width: 100%; padding: 10px; border-radius: 8px; transition: 0.3s; }
        .btn-primary-custom:hover { background-color: #0b5ed7; transform: translateY(-2px); }
        .form-control { border-radius: 8px; padding: 10px 15px; background-color: #f8f9fa; border: 1px solid #eee; }
        .form-control:focus { box-shadow: none; border-color: #0d6efd; background-color: #fff; }
    </style>
</head>
<body>
    <div class="card-login">
        <div class="text-center mb-4">
            <h3 class="fw-bold text-primary"><i class="bi bi-speedometer2 me-2"></i>MySystem</h3>
            <p class="text-muted">เข้าสู่ระบบเพื่อจัดการข้อมูล</p>
        </div>
        
        <form action="check_login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">ชื่อผู้ใช้</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-person text-muted"></i></span>
                    <input type="text" class="form-control border-start-0 ps-0" id="username" name="username" placeholder="Username" required>
                </div>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">รหัสผ่าน</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-lock text-muted"></i></span>
                    <input type="password" class="form-control border-start-0 ps-0" id="password" name="password" placeholder="Password" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-primary-custom fw-bold">เข้าสู่ระบบ</button>
        </form>

        <div class="text-center mt-4">
            <small class="text-muted">ยังไม่มีบัญชี? <a href="register_from.php" class="text-decoration-none fw-bold">สมัครสมาชิก</a></small>
        </div>
    </div>
</body>
</html>