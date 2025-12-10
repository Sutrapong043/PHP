<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ | MySystem</title>
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
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-login {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 2.5rem;
            transform: translateY(0);
            transition: transform 0.3s;
        }

        .card-login:hover {
            transform: translateY(-5px);
        }

        .brand-text {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
            background-color: #f8f9fa;
            border: 2px solid transparent;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(118, 75, 162, 0.1);
            border-color: #b5b5c3;
            background-color: #fff;
        }

        .input-group-text {
            border-radius: 12px 0 0 12px;
            background-color: #f8f9fa;
            border: none;
            color: #b5b5c3;
        }

        .form-control {
            border-radius: 0 12px 12px 0;
            border-left: none;
        }

        .input-group:focus-within .input-group-text {
            background-color: #fff;
            color: #764ba2;
        }

        .btn-login {
            background: var(--primary-gradient);
            border: none;
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            transition: 0.3s;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: white;
            box-shadow: 0 4px 15px rgba(118, 75, 162, 0.3);
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(118, 75, 162, 0.4);
            color: white;
        }
    </style>
</head>

<body>
    <div class="card-login">
        <div class="text-center mb-5">
            <h2 class="fw-bold brand-text mb-2"><i class="bi bi-speedometer2 me-2"></i>MySystem</h2>
            <p class="text-muted small">ยินดีต้อนรับกลับเข้าสู่ระบบ</p>
        </div>

        <form action="check_login.php" method="POST">
            <div class="mb-4">
                <label for="username" class="form-label text-muted small fw-bold text-uppercase ms-1">ชื่อผู้ใช้</label>
                <div class="input-group">
                    <span class="input-group-text ps-3"><i class="bi bi-person-fill fs-5"></i></span>
                    <input type="text" class="form-control" id="username" name="username"
                        placeholder="กรอกชื่อผู้ใช้ของคุณ" required>
                </div>
            </div>

            <div class="mb-5">
                <label for="password" class="form-label text-muted small fw-bold text-uppercase ms-1">รหัสผ่าน</label>
                <div class="input-group">
                    <span class="input-group-text ps-3"><i class="bi bi-lock-fill fs-5"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="กรอกรหัสผ่าน"
                        required>
                </div>
            </div>

            <button type="submit" class="btn btn-login">
                เข้าสู่ระบบ <i class="bi bi-arrow-right-short ms-1 fs-5 align-middle"></i>
            </button>
        </form>

        <div class="text-center mt-4 pt-3 border-top">
            <small class="text-muted">ยังไม่มีบัญชีสมาชิก? <a href="register_from.php"
                    class="text-decoration-none fw-bold text-primary">สมัครสมาชิกใหม่</a></small>
        </div>
    </div>
</body>

</html>