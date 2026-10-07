<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Login - Livocare Labs Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="admin-login-body">

    <div class="admin-login-wrap">
        <div style="text-align: center; margin-bottom: 24px;">
            <div class="brand-logo" style="justify-content: center; margin-bottom: 14px;">
                <a href="{{ route('home') }}" aria-label="LIVOCARE LABS" style="text-decoration: none;">
                    <img src="{{ asset('images/logo.png') }}" alt="LIVOCARE LABS" class="brand-logo-img admin-login-logo">
                </a>
            </div>
            <p style="color: #94a3b8; font-size: 0.875rem;">Internal Staff & Phlebotomy Management Portal</p>
        </div>

        <div class="modern-card admin-login-card">
            <h2 style="font-size: 1.35rem; margin-bottom: 6px; color: var(--text-heading);">Sign In</h2>
            <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 22px;">Enter administrative credentials to continue.</p>

            @if($errors->any())
                <div style="background: #fef2f2; border: 1px solid #fecaca; border-radius: var(--radius-md); padding: 12px 14px; margin-bottom: 20px; font-size: 0.85rem; color: #dc2626;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label">Staff Email</label>
                    <input type="email" name="email" class="form-control" value="admin@livocarelabs.in" required autofocus>
                </div>

                <div class="form-group" style="margin-bottom: 22px;">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" value="admin123" required>
                    <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 5px;">
                        Default credentials: <code>admin@livocarelabs.in</code> / <code>admin123</code>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-size: 0.95rem;">
                    Access Management Dashboard
                </button>
            </form>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('home') }}" style="color: #94a3b8; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 6px; text-decoration: none;">
                ← <span>Back to Public Website</span>
            </a>
        </div>
    </div>

</body>
</html>
