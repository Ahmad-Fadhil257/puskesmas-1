<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Administrator - {{ config('app.name', 'Puskesmas CareLink') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- SweetAlert2 CSS (Toast & Modal) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --color-primary: #0A5C45;
            --color-primary-hover: #084A37;
            --radius-16: 16px;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            color: #122822;
            background: linear-gradient(135deg, #C5E5DD 0%, #D8EFE8 50%, #EEF8F5 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 16px;
            overflow-x: hidden;
        }

        /* SweetAlert2 Toast Modern Styling */
        .swal2-popup.swal2-toast {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            border-radius: 14px !important;
            padding: 12px 18px !important;
            box-shadow: 0 12px 32px rgba(10, 92, 69, 0.18), 0 2px 6px rgba(0, 0, 0, 0.06) !important;
            border: 1px solid rgba(10, 92, 69, 0.12) !important;
        }

        /* ====== LOGIN WRAPPER & CORNER DECORATIONS ====== */
        .login-wrapper {
            position: relative;
            width: 100%;
            max-width: 440px;
        }

        /* Top-Left Corner Decoration (Menempel di Pojok Kiri Atas Form) */
        .decor-card-tl {
            position: absolute;
            top: -38px;
            left: -38px;
            width: 160px;
            height: 160px;
            pointer-events: none;
            z-index: 0;
        }

        .decor-gradient-tl {
            position: absolute;
            width: 120px;
            height: 120px;
            top: 10px;
            left: 10px;
            background: radial-gradient(circle, rgba(10, 92, 69, 0.28) 0%, rgba(197, 229, 221, 0.1) 60%, transparent 100%);
            border-radius: 50%;
            filter: blur(14px);
        }

        .decor-dashed-tl {
            position: absolute;
            width: 130px;
            height: 130px;
            top: 0;
            left: 0;
            border: 2px dashed rgba(10, 92, 69, 0.35);
            border-radius: 50%;
        }

        .decor-solid-tl {
            position: absolute;
            width: 80px;
            height: 80px;
            top: 25px;
            left: 25px;
            border: 1.5px solid rgba(10, 92, 69, 0.2);
            border-radius: 50%;
        }

        /* Bottom-Right Corner Decoration (Menempel di Pojok Kanan Bawah Form) */
        .decor-card-br {
            position: absolute;
            bottom: -38px;
            right: -38px;
            width: 160px;
            height: 160px;
            pointer-events: none;
            z-index: 0;
        }

        .decor-gradient-br {
            position: absolute;
            width: 130px;
            height: 130px;
            bottom: 10px;
            right: 10px;
            background: radial-gradient(circle, rgba(10, 92, 69, 0.3) 0%, rgba(187, 228, 216, 0.1) 60%, transparent 100%);
            border-radius: 50%;
            filter: blur(14px);
        }

        .decor-dashed-br {
            position: absolute;
            width: 135px;
            height: 135px;
            bottom: 0;
            right: 0;
            border: 2px dashed rgba(10, 92, 69, 0.35);
            border-radius: 50%;
        }

        .decor-solid-br {
            position: absolute;
            width: 85px;
            height: 85px;
            bottom: 25px;
            right: 25px;
            border: 1.5px solid rgba(10, 92, 69, 0.2);
            border-radius: 50%;
        }

        /* Medical Plus Dots Accent */
        .decor-dots-tr {
            position: absolute;
            top: -16px;
            right: -12px;
            display: grid;
            grid-template-columns: repeat(3, 6px);
            gap: 6px;
            pointer-events: none;
            z-index: 0;
            opacity: 0.45;
        }

        .decor-dots-tr span {
            width: 6px;
            height: 6px;
            background: var(--color-primary);
            border-radius: 50%;
        }

        .decor-dots-bl {
            position: absolute;
            bottom: -16px;
            left: -12px;
            display: grid;
            grid-template-columns: repeat(3, 6px);
            gap: 6px;
            pointer-events: none;
            z-index: 0;
            opacity: 0.45;
        }

        .decor-dots-bl span {
            width: 6px;
            height: 6px;
            background: var(--color-primary);
            border-radius: 50%;
        }

        /* ====== MAIN LOGIN CARD ====== */
        .login-card {
            position: relative;
            z-index: 1;
            width: 100%;
            background: #FFFFFF;
            border-radius: var(--radius-16);
            padding: 44px 36px;
            box-shadow: 0 12px 40px rgba(10, 92, 69, 0.12), 0 2px 6px rgba(10, 92, 69, 0.04);
            border: 1px solid rgba(10, 92, 69, 0.08);
            transition: all 0.3s ease;
        }

        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-title {
            font-size: 1.625rem;
            font-weight: 800;
            color: #122822;
            margin-bottom: 6px;
            letter-spacing: -0.02em;
        }

        .login-subtitle {
            font-size: 0.875rem;
            color: #40564F;
        }

        /* Form Controls */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 700;
            color: #122822;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            color: #718D84;
            font-size: 0.9375rem;
            pointer-events: none;
        }

        .form-input {
            width: 100%;
            padding: 13px 44px 13px 44px;
            font-family: inherit;
            font-size: 0.875rem;
            border: 1.5px solid #CFE6DF;
            border-radius: var(--radius-16);
            background: #FAFCFB;
            color: #122822;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            outline: none;
        }

        .form-input:focus {
            border-color: var(--color-primary);
            background: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(10, 92, 69, 0.12);
        }

        .toggle-password {
            position: absolute;
            right: 16px;
            color: #718D84;
            font-size: 0.9375rem;
            cursor: pointer;
            transition: color 0.2s;
            padding: 4px;
        }

        .toggle-password:hover {
            color: var(--color-primary);
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 26px;
            font-size: 0.8125rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #40564F;
            cursor: pointer;
            font-weight: 500;
        }

        .remember-me input {
            accent-color: var(--color-primary);
            width: 16px;
            height: 16px;
            border-radius: 4px;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: var(--color-primary);
            color: #FFFFFF;
            border: none;
            border-radius: var(--radius-16);
            font-family: inherit;
            font-size: 0.9375rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 14px rgba(10, 92, 69, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-login:hover {
            background: var(--color-primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(10, 92, 69, 0.28);
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .login-footer {
            margin-top: 26px;
            text-align: center;
            font-size: 0.8125rem;
            color: #40564F;
        }

        .login-footer a {
            color: var(--color-primary);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: opacity 0.2s;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Main Login Wrapper -->
    <div class="login-wrapper">

        <!-- ====== ORNAMEN POJOK KIRI ATAS FORM ====== -->
        <div class="decor-card-tl" aria-hidden="true">
            <div class="decor-gradient-tl"></div>
            <div class="decor-dashed-tl"></div>
            <div class="decor-solid-tl"></div>
        </div>

        <!-- ====== ORNAMEN POJOK KANAN BAWAH FORM ====== -->
        <div class="decor-card-br" aria-hidden="true">
            <div class="decor-gradient-br"></div>
            <div class="decor-dashed-br"></div>
            <div class="decor-solid-br"></div>
        </div>

        <!-- ====== AKSEN DOTS MATRIX KANAN ATAS & KIRI BAWAH ====== -->
        <div class="decor-dots-tr" aria-hidden="true">
            <span></span><span></span><span></span>
            <span></span><span></span><span></span>
            <span></span><span></span><span></span>
        </div>
        <div class="decor-dots-bl" aria-hidden="true">
            <span></span><span></span><span></span>
            <span></span><span></span><span></span>
            <span></span><span></span><span></span>
        </div>

        <!-- ====== KARTU FORM LOGIN (ROUNDED 16PX) ====== -->
        <div class="login-card" id="loginContainer">
            
            <!-- Header -->
            <div class="login-header">
                <h1 class="login-title">Puskesmas CareLink</h1>
                <p class="login-subtitle">Masuk ke akun administrator Anda</p>
            </div>

            <!-- Form Login Database -->
            <form id="dbLoginForm">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label">Alamat Email</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-envelope input-icon"></i>
                        <input type="email"
                               name="email"
                               id="email"
                               class="form-input"
                               placeholder="nama@carelink.com"
                               required
                               autofocus>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password"
                               name="password"
                               id="password"
                               class="form-input"
                               placeholder="••••••••"
                               required>
                        <i class="fa-solid fa-eye toggle-password" id="togglePassword" title="Tampilkan/Sembunyikan Kata Sandi"></i>
                    </div>
                </div>

                <!-- Remember me -->
                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember" id="remember">
                        <span>Ingat Saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-login" id="btnSubmitLogin">
                    <span id="btnText">Masuk ke Dashboard</span>
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                </button>
            </form>

            <div class="login-footer">
                <a href="{{ url('/') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </div>

    </div>

    <!-- Scripts: SweetAlert2 (Toast & Modal) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Form Login & SweetAlert2 Toast Script -->
    <script>
        // SweetAlert2 Toast Notification Config
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            // Password Show/Hide Toggle
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', () => {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    togglePassword.classList.toggle('fa-eye', !isPassword);
                    togglePassword.classList.toggle('fa-eye-slash', isPassword);
                });
            }

            // AJAX Form Submission with SweetAlert2 Toast
            const dbLoginForm = document.getElementById('dbLoginForm');
            const btnSubmitLogin = document.getElementById('btnSubmitLogin');
            const btnText = document.getElementById('btnText');

            if (dbLoginForm) {
                dbLoginForm.addEventListener('submit', async (e) => {
                    e.preventDefault();

                    const email = document.getElementById('email').value;
                    const password = document.getElementById('password').value;
                    const remember = document.getElementById('remember').checked;
                    const token = "{{ csrf_token() }}";

                    btnSubmitLogin.disabled = true;
                    btnText.textContent = 'Memverifikasi...';

                    try {
                        const response = await fetch("{{ route('login.post') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": token,
                                "Accept": "application/json"
                            },
                            body: JSON.stringify({ email, password, remember })
                        });

                        const result = await response.json();

                        if (response.ok && result.success) {
                            Toast.fire({
                                icon: 'success',
                                title: result.message || 'Login berhasil! Mengalihkan...'
                            });
                            btnText.textContent = 'Sukses! Mengalihkan...';
                            setTimeout(() => {
                                window.location.href = result.redirect_url || "{{ route('dashboard') }}";
                            }, 700);
                        } else {
                            throw new Error(result.message || 'Email atau kata sandi tidak cocok.');
                        }
                    } catch (error) {
                        Toast.fire({
                            icon: 'error',
                            title: error.message
                        });
                        btnSubmitLogin.disabled = false;
                        btnText.textContent = 'Masuk ke Dashboard';
                    }
                });
            }
        });
    </script>
</body>
</html>
