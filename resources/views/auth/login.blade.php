<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Administrator - Puskesmas</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Dedicated Login & Gatekeeper CSS -->
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
</head>
<body>

    <!-- Main Login Wrapper -->
    <div class="login-wrapper">

        <!-- Corner Ornaments -->
        <div class="decor-card-tl" aria-hidden="true">
            <div class="decor-gradient-tl"></div>
            <div class="decor-dashed-tl"></div>
            <div class="decor-solid-tl"></div>
        </div>
        <div class="decor-card-br" aria-hidden="true">
            <div class="decor-gradient-br"></div>
            <div class="decor-dashed-br"></div>
            <div class="decor-solid-br"></div>
        </div>
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

        {{-- ====== MAIN DATABASE LOGIN FORM ====== --}}
        <div class="login-card fade-in" id="loginCard">
            <div class="login-header">
                <div class="brand-logo-wrap">
                    <img src="{{ $appSetting->logo_url ?? asset('assets/logo/logo-puskesmas.png') }}" alt="Logo" class="brand-logo-img">
                    @if(($appSetting->show_app_name ?? true) && !empty($appSetting->app_name ?? 'Puskesmas'))
                        <h1 class="login-title"><span class="brand-text">{{ $appSetting->app_name }}</span></h1>
                    @endif
                </div>
                <p class="login-subtitle">Masuk ke portal administrator</p>
            </div>

            <form id="dbLoginForm">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label">Alamat Email Administrator</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-envelope input-icon"></i>
                        <input type="email"
                               name="email"
                               id="email"
                               class="form-input"
                               placeholder="admin@carelink.com"
                               required>
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
                        <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
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

    <!-- Scripts: SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
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
            const toggle = document.getElementById('togglePassword');
            const input = document.getElementById('password');
            if (toggle && input) {
                toggle.addEventListener('click', () => {
                    const isPass = input.getAttribute('type') === 'password';
                    input.setAttribute('type', isPass ? 'text' : 'password');
                    toggle.classList.toggle('fa-eye', !isPass);
                    toggle.classList.toggle('fa-eye-slash', isPass);
                });
            }

            // Handle Database Login Submission
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
