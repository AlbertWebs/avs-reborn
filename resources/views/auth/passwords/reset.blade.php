@extends('front.master')

@section('content')
<div class="login-page-wrapper">
    <div class="login-container">
        <div class="login-content">
            <!-- Reset Password Header -->
            <div class="login-header">
                <div class="login-logo">
                    <?php $SiteSettings = DB::table('sitesettings')->get(); ?>
                    @foreach($SiteSettings as $Settings)
                        @if($Settings->logo)
                            <img src="{{url('/')}}/uploads/logo/{{$Settings->logo}}" alt="{{$Settings->sitename}}" class="logo-img">
                        @else
                            <h1 class="logo-text">{{$Settings->sitename ?? 'Amani Vehicle Sounds'}}</h1>
                        @endif
                    @endforeach
                </div>
                <h2 class="login-title">Reset Password</h2>
                <p class="login-subtitle">Enter your new password below</p>
            </div>

            <!-- Reset Password Form -->
            <div class="login-form-wrapper">
                <form method="POST" action="{{ route('password.update') }}" class="login-form" id="resetPasswordForm">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Email Field -->
                    <div class="form-group-modern">
                        <label for="email" class="form-label-modern">
                            <span>Email Address</span>
                        </label>
                        <div class="input-wrapper">
                            <input 
                                id="email" 
                                type="email" 
                                class="form-input-modern @error('email') is-invalid @enderror" 
                                name="email" 
                                value="{{ $email ?? old('email') }}" 
                                required 
                                autocomplete="email" 
                                autofocus
                                placeholder="Enter your email address"
                            >
                            @error('email')
                                <div class="error-message">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="form-group-modern">
                        <label for="password" class="form-label-modern">
                            <span>New Password</span>
                        </label>
                        <div class="input-wrapper">
                            <input 
                                id="password" 
                                type="password" 
                                class="form-input-modern @error('password') is-invalid @enderror" 
                                name="password" 
                                required 
                                autocomplete="new-password"
                                placeholder="Enter your new password"
                            >
                            <button type="button" class="password-toggle" id="passwordToggle" aria-label="Toggle password visibility">
                                <span id="eyeIcon">👁️</span>
                            </button>
                            @error('password')
                                <div class="error-message">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="form-group-modern">
                        <label for="password-confirm" class="form-label-modern">
                            <span>Confirm Password</span>
                        </label>
                        <div class="input-wrapper">
                            <input 
                                id="password-confirm" 
                                type="password" 
                                class="form-input-modern" 
                                name="password_confirmation" 
                                required 
                                autocomplete="new-password"
                                placeholder="Confirm your new password"
                            >
                            <button type="button" class="password-toggle" id="passwordConfirmToggle" aria-label="Toggle password visibility">
                                <span id="eyeIconConfirm">👁️</span>
                            </button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-login-submit">
                        <span class="btn-text">Reset Password</span>
                        <i class="icon-long-arrow-right btn-icon"></i>
                    </button>

                    <!-- Back to Login Link -->
                    <div class="register-link-wrapper">
                        <p class="register-text">Remember your password? <a href="{{ route('login') }}" class="register-link">Sign In</a></p>
                    </div>
                </form>
            </div>
        </div>

        <!-- Decorative Background Elements -->
        <div class="login-background">
            <div class="bg-shape bg-shape-1"></div>
            <div class="bg-shape bg-shape-2"></div>
            <div class="bg-shape bg-shape-3"></div>
        </div>
    </div>
</div>

<style>
/* Login Page Styles */
.login-page-wrapper {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
    background: #ffffff;
    position: relative;
    overflow: hidden;
}

.login-container {
    width: 100%;
    max-width: 480px;
    position: relative;
    z-index: 10;
}

.login-content {
    background: #ffffff;
    border-radius: 24px;
    padding: 3rem 2.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #e9ecef;
    animation: fadeInUp 0.6s ease-out;
    position: relative;
    z-index: 10;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Login Header */
.login-header {
    text-align: center;
    margin-bottom: 2.5rem;
}

.login-logo {
    margin-bottom: 1.5rem;
}

.logo-img {
    max-width: 180px;
    height: auto;
    margin: 0 auto;
    display: block;
}

.logo-text {
    font-size: 1.75rem;
    font-weight: 700;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin: 0;
}

.login-title {
    font-size: 2rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 0.5rem;
    letter-spacing: -0.02em;
}

.login-subtitle {
    color: #666;
    font-size: 0.95rem;
    margin: 0;
}

/* Form Styles */
.login-form-wrapper {
    width: 100%;
}

.form-group-modern {
    margin-bottom: 1.5rem;
}

.form-label-modern {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.75rem;
}

.input-wrapper {
    position: relative;
}

.form-input-modern {
    width: 100%;
    padding: 1rem 1.25rem;
    padding-right: 3rem;
    font-size: 1rem;
    color: #333;
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    transition: all 0.3s ease;
    outline: none;
}

.form-input-modern:focus {
    background: #fff;
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}

.form-input-modern::placeholder {
    color: #999;
}

.password-toggle {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #666;
    cursor: pointer;
    padding: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: color 0.3s ease;
    z-index: 10;
    pointer-events: auto;
}

.password-toggle:hover {
    color: #667eea;
}

.error-message {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #f5576c;
    font-size: 0.85rem;
    margin-top: 0.5rem;
    animation: shake 0.4s ease;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-10px); }
    75% { transform: translateX(10px); }
}

/* Submit Button */
.btn-login-submit {
    width: 100%;
    padding: 1rem 2rem;
    font-size: 1rem;
    font-weight: 600;
    color: #fff;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    margin-bottom: 1.5rem;
    position: relative;
    z-index: 100;
    pointer-events: auto;
}

.btn-login-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
}

.btn-login-submit:active {
    transform: translateY(0);
}

.btn-login-submit .btn-icon {
    transition: transform 0.3s ease;
}

.btn-login-submit:hover .btn-icon {
    transform: translateX(4px);
}

/* Register Link */
.register-link-wrapper {
    text-align: center;
    margin-top: 1.5rem;
}

.register-text {
    font-size: 0.9rem;
    color: #666;
    margin: 0;
}

.register-link {
    color: #667eea;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.3s ease;
}

.register-link:hover {
    color: #764ba2;
    text-decoration: underline;
}

/* Background Shapes */
.login-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    overflow: hidden;
    z-index: 0;
    pointer-events: none;
}

.bg-shape {
    position: absolute;
    border-radius: 50%;
    opacity: 0.05;
    animation: float 20s infinite ease-in-out;
}

.bg-shape-1 {
    width: 300px;
    height: 300px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    top: -150px;
    right: -150px;
    animation-delay: 0s;
}

.bg-shape-2 {
    width: 200px;
    height: 200px;
    background: linear-gradient(135deg, #764ba2 0%, #66139B 100%);
    bottom: -100px;
    left: -100px;
    animation-delay: 5s;
}

.bg-shape-3 {
    width: 150px;
    height: 150px;
    background: linear-gradient(135deg, #66139B 0%, #667eea 100%);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    animation-delay: 10s;
}

@keyframes float {
    0%, 100% {
        transform: translate(0, 0) rotate(0deg);
    }
    33% {
        transform: translate(30px, -30px) rotate(120deg);
    }
    66% {
        transform: translate(-20px, 20px) rotate(240deg);
    }
}

/* Responsive Design */
@media (max-width: 576px) {
    .login-content {
        padding: 2rem 1.5rem;
        border-radius: 20px;
    }

    .login-title {
        font-size: 1.75rem;
    }

    .login-subtitle {
        font-size: 0.9rem;
    }

    .form-input-modern {
        padding: 0.875rem 1rem;
        padding-right: 2.5rem;
        font-size: 0.95rem;
    }

    .btn-login-submit {
        padding: 0.875rem 1.5rem;
        font-size: 0.95rem;
    }
}

@media (max-width: 400px) {
    .login-content {
        padding: 1.5rem 1.25rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password toggle functionality for password field
    const passwordToggle = document.getElementById('passwordToggle');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    
    if (passwordToggle && passwordInput) {
        passwordToggle.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle icon
            if (type === 'text') {
                eyeIcon.textContent = '🙈';
            } else {
                eyeIcon.textContent = '👁️';
            }
        });
    }

    // Password toggle functionality for confirm password field
    const passwordConfirmToggle = document.getElementById('passwordConfirmToggle');
    const passwordConfirmInput = document.getElementById('password-confirm');
    const eyeIconConfirm = document.getElementById('eyeIconConfirm');
    
    if (passwordConfirmToggle && passwordConfirmInput) {
        passwordConfirmToggle.addEventListener('click', function() {
            const type = passwordConfirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmInput.setAttribute('type', type);
            
            // Toggle icon
            if (type === 'text') {
                eyeIconConfirm.textContent = '🙈';
            } else {
                eyeIconConfirm.textContent = '👁️';
            }
        });
    }

    // Form submission loading state
    const resetPasswordForm = document.getElementById('resetPasswordForm');
    if (resetPasswordForm) {
        resetPasswordForm.addEventListener('submit', function() {
            const submitBtn = this.querySelector('.btn-login-submit');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.querySelector('.btn-text').textContent = 'Resetting Password...';
                submitBtn.querySelector('.btn-icon').style.display = 'none';
            }
        });
    }
});
</script>
@endsection
