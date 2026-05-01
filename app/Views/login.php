<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Absensi App</title>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
        }
        body {
            font-family: 'Inter', sans-serif;
            background: url('https://images.unsplash.com/photo-1557683316-973673baf926?q=80&w=2000&auto=format&fit=crop') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }
        .login-glass {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 420px;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header i {
            font-size: 3.5rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 15px;
        }
        .login-header h2 {
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }
        .form-control-modern {
            border-radius: 12px;
            border: 1px solid #cbd5e1;
            padding: 12px 16px;
            background-color: #f8fafc;
            transition: all 0.3s;
            height: auto;
        }
        .form-control-modern:focus {
            background-color: #ffffff;
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }
        .btn-modern {
            background: var(--primary-gradient);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            font-size: 1rem;
            width: 100%;
            transition: all 0.3s;
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
            margin-top: 10px;
        }
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 20px -3px rgba(79, 70, 229, 0.4);
            color: white;
        }
        .alert-modern {
            border-radius: 10px;
            border: none;
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="login-glass">
    <div class="login-header">
        <i class="fas fa-fingerprint"></i>
        <h2>Welcome Back</h2>
        <p class="text-muted mt-2">Sign in to your account</p>
    </div>

    <!-- pesan error -->
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-modern text-center py-2 mb-4">
            <i class="fas fa-exclamation-circle mr-1"></i> <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('login/auth') ?>" method="post">
        <div class="form-group mb-4">
            <label class="font-weight-medium text-secondary mb-2">Username</label>
            <input type="text" name="username" class="form-control form-control-modern" placeholder="Enter your username" required>
        </div>

        <div class="form-group mb-4">
            <label class="font-weight-medium text-secondary mb-2">Password</label>
            <input type="password" name="password" class="form-control form-control-modern" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn-modern">
            Sign In
        </button>
    </form>
</div>

</body>
</html>