<!doctype html>
<html lang="th">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <script src="/_sdk/element_sdk.js"></script><!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet"><!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
  <style>
    body {
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
    }

    html {
      height: 100%;
    }

    .main-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem 1rem;
    }

    .form-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 20px;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
      padding: 3rem;
      width: 100%;
      max-width: 500px;
      position: relative;
      overflow: hidden;
    }

    .form-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, #667eea, #764ba2);
    }

    .form-header {
      text-align: center;
      margin-bottom: 2.5rem;
    }

    .form-title {
      font-size: 2.25rem;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 0.5rem;
      background: linear-gradient(135deg, #667eea, #764ba2);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .form-subtitle {
      color: #64748b;
      font-size: 1rem;
      font-weight: 400;
    }

    .form-floating {
      margin-bottom: 1.5rem;
    }

    .form-floating > .form-control {
      height: 3.5rem;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      background: #f8fafc;
      font-size: 1rem;
      font-weight: 500;
      transition: all 0.3s ease;
      padding-left: 3rem;
    }

    .form-floating > .form-control:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.15);
      background: #ffffff;
      transform: translateY(-1px);
    }

    .form-floating > .form-control:hover {
      border-color: #cbd5e0;
      background: #ffffff;
    }

    .form-floating > label {
      color: #64748b;
      font-weight: 500;
      padding-left: 3rem;
      font-size: 0.95rem;
    }

    .input-icon {
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      font-size: 1.1rem;
      z-index: 4;
    }

    .input-group-custom {
      position: relative;
    }

    .btn-primary-custom {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      border-radius: 12px;
      padding: 0.875rem 2rem;
      font-size: 1.1rem;
      font-weight: 600;
      color: white;
      width: 100%;
      transition: all 0.3s ease;
      margin-top: 1rem;
      position: relative;
      overflow: hidden;
    }

    .btn-primary-custom:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
      background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
    }

    .btn-primary-custom:active {
      transform: translateY(0);
    }

    .alert-custom {
      border: none;
      border-radius: 12px;
      padding: 1rem 1.25rem;
      margin-bottom: 1.5rem;
      font-weight: 500;
      border-left: 4px solid;
    }

    .alert-danger-custom {
      background: rgba(254, 215, 215, 0.8);
      color: #c53030;
      border-left-color: #c53030;
    }

    .alert-success-custom {
      background: rgba(198, 246, 213, 0.8);
      color: #22543d;
      border-left-color: #22543d;
    }

    .form-check-custom {
      margin: 1.5rem 0;
    }

    .form-check-custom .form-check-input {
      border-radius: 6px;
      border: 2px solid #e2e8f0;
      width: 1.25rem;
      height: 1.25rem;
    }

    .form-check-custom .form-check-input:checked {
      background-color: #667eea;
      border-color: #667eea;
    }

    .form-check-custom .form-check-label {
      color: #4a5568;
      font-size: 0.95rem;
      margin-left: 0.5rem;
    }

    @media (max-width: 576px) {
      .form-card {
        padding: 2rem 1.5rem;
        margin: 1rem;
      }

      .form-title {
        font-size: 1.875rem;
      }
    }
  </style>
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
 </head>
 <body>
  <div class="main-container">
   <div class="form-card">
    <div class="form-header">
     <h1 class="form-title" id="formTitle">สมัครสมาชิก</h1>
     <p class="form-subtitle">กรุณากรอกข้อมูลให้ครบถ้วน</p>
    </div>
    <div class="alert alert-danger alert-custom alert-danger-custom d-none" id="errorMessage" role="alert"><i class="bi bi-exclamation-triangle-fill me-2"></i> <span id="errorText"></span>
    </div>
    <div class="alert alert-success alert-custom alert-success-custom d-none" id="successMessage" role="alert"><i class="bi bi-check-circle-fill me-2"></i> <span id="successText"></span>
    </div>
    <form id="registrationForm" method="POST" action="register_save.php" novalidate>
     <div class="input-group-custom"><i class="bi bi-person-fill input-icon"></i>
      <div class="form-floating"><input type="text" class="form-control" id="username" name="username" placeholder="กรอกชื่อผู้ใช้" required> <label for="username">ชื่อผู้ใช้ (Username)</label>
      </div>
     </div>
     <div class="input-group-custom"><i class="bi bi-telephone-fill input-icon"></i>
      <div class="form-floating"><input type="tel" class="form-control" id="phone" name="phone" placeholder="กรอกเบอร์โทรศัพท์" required> <label for="phone">เบอร์โทรศัพท์ (Phone)</label>
      </div>
     </div>
     <div class="input-group-custom"><i class="bi bi-person-badge-fill input-icon"></i>
      <div class="form-floating"><input type="text" class="form-control" id="fullName" name="full-name" placeholder="กรอกชื่อ-นามสกุล" required> <label for="fullName">ชื่อ-นามสกุล (Full Name)</label>
      </div>
     </div>
     <div class="input-group-custom"><i class="bi bi-lock-fill input-icon"></i>
      <div class="form-floating"><input type="password" class="form-control" id="password" name="password" placeholder="กรอกรหัสผ่าน" required> <label for="password">รหัสผ่าน (Password)</label>
      </div>
     </div>
     <div class="input-group-custom"><i class="bi bi-shield-lock-fill input-icon"></i>
      <div class="form-floating"><input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="กรอกรหัสผ่านอีกครั้ง" required> <label for="confirmPassword">ยืนยันรหัสผ่าน (Confirm Password)</label>
      </div>
     </div>
     <div class="form-check form-check-custom"><input class="form-check-input" type="checkbox" id="agreeTerms" name="agreeTerms" value="agreed" required> <label class="form-check-label" for="agreeTerms"> ฉันยอมรับ <a href="#" class="text-decoration-none">ข้อกำหนดและเงื่อนไข</a> </label>
     </div><button type="submit" class="btn btn-primary-custom" id="submitBtn"> <i class="bi bi-person-plus-fill me-2"></i> สมัครสมาชิก </button>
    </form>
   </div>
  </div><!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const defaultConfig = {
      form_title: "สมัครสมาชิก",
      submit_button_text: "สมัครสมาชิก",
      primary_color: "#667eea",
      secondary_color: "#764ba2",
      background_color: "#ffffff",
      text_color: "#1a202c",
      button_text_color: "#ffffff"
    };

    let config = {};

    async function onConfigChange(newConfig) {
      config = newConfig;
      
      const formTitle = document.getElementById('formTitle');
      const submitBtn = document.getElementById('submitBtn');
      const container = document.querySelector('.container');
      const formWrapper = document.querySelector('.form-wrapper');
      
      if (formTitle) {
        formTitle.textContent = config.form_title || defaultConfig.form_title;
        formTitle.style.color = config.text_color || defaultConfig.text_color;
      }
      
      if (submitBtn) {
        submitBtn.textContent = config.submit_button_text || defaultConfig.submit_button_text;
        submitBtn.style.background = `linear-gradient(135deg, ${config.primary_color || defaultConfig.primary_color} 0%, ${config.secondary_color || defaultConfig.secondary_color} 100%)`;
        submitBtn.style.color = config.button_text_color || defaultConfig.button_text_color;
      }
      
      if (container) {
        container.style.background = `linear-gradient(135deg, ${config.primary_color || defaultConfig.primary_color} 0%, ${config.secondary_color || defaultConfig.secondary_color} 100%)`;
      }
      
      if (formWrapper) {
        formWrapper.style.background = config.background_color || defaultConfig.background_color;
      }
    }

    if (window.elementSdk) {
      window.elementSdk.init({
        defaultConfig,
        onConfigChange,
        mapToCapabilities: (config) => ({
          recolorables: [
            {
              get: () => config.primary_color || defaultConfig.primary_color,
              set: (value) => {
                config.primary_color = value;
                window.elementSdk.setConfig({ primary_color: value });
              }
            },
            {
              get: () => config.secondary_color || defaultConfig.secondary_color,
              set: (value) => {
                config.secondary_color = value;
                window.elementSdk.setConfig({ secondary_color: value });
              }
            },
            {
              get: () => config.background_color || defaultConfig.background_color,
              set: (value) => {
                config.background_color = value;
                window.elementSdk.setConfig({ background_color: value });
              }
            },
            {
              get: () => config.text_color || defaultConfig.text_color,
              set: (value) => {
                config.text_color = value;
                window.elementSdk.setConfig({ text_color: value });
              }
            },
            {
              get: () => config.button_text_color || defaultConfig.button_text_color,
              set: (value) => {
                config.button_text_color = value;
                window.elementSdk.setConfig({ button_text_color: value });
              }
            }
          ],
          borderables: [],
          fontEditable: undefined,
          fontSizeable: undefined
        }),
        mapToEditPanelValues: (config) => new Map([
          ["form_title", config.form_title || defaultConfig.form_title],
          ["submit_button_text", config.submit_button_text || defaultConfig.submit_button_text]
        ])
      });
    }

    const form = document.getElementById('registrationForm');
    const errorMessage = document.getElementById('errorMessage');
    const successMessage = document.getElementById('successMessage');
    const errorText = document.getElementById('errorText');
    const successText = document.getElementById('successText');

    function showError(message) {
      errorText.textContent = message;
      errorMessage.classList.remove('d-none');
      successMessage.classList.add('d-none');
      errorMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function showSuccess(message) {
      successText.textContent = message;
      successMessage.classList.remove('d-none');
      errorMessage.classList.add('d-none');
    }

    function hideMessages() {
      errorMessage.classList.add('d-none');
      successMessage.classList.add('d-none');
    }

    // Real-time validation
    const inputs = form.querySelectorAll('input[required]');
    inputs.forEach(input => {
      input.addEventListener('blur', function() {
        if (this.value.trim() === '') {
          this.classList.add('is-invalid');
        } else {
          this.classList.remove('is-invalid');
          this.classList.add('is-valid');
        }
      });

      input.addEventListener('input', function() {
        if (this.classList.contains('is-invalid') && this.value.trim() !== '') {
          this.classList.remove('is-invalid');
          this.classList.add('is-valid');
        }
      });
    });

    // Password confirmation validation
    const confirmPasswordInput = document.getElementById('confirmPassword');
    confirmPasswordInput.addEventListener('input', function() {
      const password = document.getElementById('password').value;
      if (this.value && this.value !== password) {
        this.classList.add('is-invalid');
        this.classList.remove('is-valid');
      } else if (this.value === password && password.length >= 6) {
        this.classList.remove('is-invalid');
        this.classList.add('is-valid');
      }
    });

    form.addEventListener('submit', function(e) {
      e.preventDefault();
      
      hideMessages();
      
      // Validate all required fields
      let isValid = true;
      const requiredInputs = form.querySelectorAll('input[required]');
      
      requiredInputs.forEach(input => {
        if (input.value.trim() === '') {
          input.classList.add('is-invalid');
          isValid = false;
        }
      });

      if (!isValid) {
        showError('กรุณากรอกข้อมูลให้ครบถ้วน');
        return;
      }
      
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirmPassword').value;
      const agreeTerms = document.getElementById('agreeTerms').checked;
      
      if (!agreeTerms) {
        showError('กรุณายอมรับข้อกำหนดและเงื่อนไขก่อนดำเนินการต่อ');
        return;
      }
      
      if (password !== confirmPassword) {
        showError('รหัสผ่านไม่ตรงกัน กรุณาตรวจสอบอีกครั้ง');
        confirmPasswordInput.classList.add('is-invalid');
        return;
      }
      
      if (password.length < 6) {
        showError('รหัสผ่านต้องมีความยาวอย่างน้อย 6 ตัวอักษร');
        document.getElementById('password').classList.add('is-invalid');
        return;
      }
      
      // Show loading state
      const submitBtn = document.getElementById('submitBtn');
      const originalText = submitBtn.innerHTML;
      submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>กำลังส่งข้อมูล...';
      submitBtn.disabled = true;
      
      showSuccess('ตรวจสอบข้อมูลเรียบร้อย! กำลังส่งข้อมูล...');
      
      setTimeout(() => {
        // Reset button state before actual submission
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        form.submit();
      }, 2000);
    });
  </script>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'99a2efc097232db4',t:'MTc2MjQxNDc2MS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>