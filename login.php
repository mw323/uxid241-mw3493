<?php

declare(strict_types=1);

session_start();

require_once 'db.php';
require_once 'functions.php';

function e(string $value): string {
  return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = get_post('email');
        $plain = get_post('password');   

        $result = mysqli_execute_query(
        $conn,
        'SELECT id, password_hash FROM users WHERE email = ?',
        [$email]
    );

    $user = mysqli_fetch_assoc($result);

    if ($user !== null && password_verify($plain, $user['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        
        header('Location: admin/index.php');
        exit;
    }

    $error = 'Invalid email or password.';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">
    <header class="login-header">
        <div class="logo-section">
            <a href="index.php" class="login-logo">
                <span class="login-logo-icon">
                    <svg width="8" height="16" viewBox="0 0 8 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.24347 6.84222e-08H5.75266C6.9074 6.84222e-08 7.7722 1.21229 7.53725 2.50465C7.46227 2.90493 7.15234 3.19085 6.79742 3.19085H1.20371C0.843794 3.19085 0.538865 2.90493 0.463882 2.50465C0.408576 2.202 0.412971 1.88905 0.476748 1.58859C0.540524 1.28813 0.662076 1.00773 0.832552 0.767794C1.00303 0.527861 1.21814 0.334442 1.46221 0.201621C1.70629 0.0687996 1.97319 -7.9247e-05 2.24347 6.84222e-08ZM2.49341 1.25232C2.56501 1.25232 2.63367 1.21979 2.68429 1.16188C2.73491 1.10397 2.76335 1.02543 2.76335 0.943531C2.76335 0.861635 2.73491 0.783092 2.68429 0.725182C2.63367 0.667273 2.56501 0.634739 2.49341 0.634739C2.42182 0.634739 2.35316 0.667273 2.30254 0.725182C2.25192 0.783092 2.22348 0.861635 2.22348 0.943531C2.22348 1.02543 2.25192 1.10397 2.30254 1.16188C2.35316 1.21979 2.42182 1.25232 2.49341 1.25232ZM5.53271 1.25232C5.60431 1.25232 5.67296 1.21979 5.72359 1.16188C5.77421 1.10397 5.80265 1.02543 5.80265 0.943531C5.80265 0.861635 5.77421 0.783092 5.72359 0.725182C5.67296 0.667273 5.60431 0.634739 5.53271 0.634739C5.46112 0.634739 5.39246 0.667273 5.34184 0.725182C5.29122 0.783092 5.26278 0.861635 5.26278 0.943531C5.26278 1.02543 5.29122 1.10397 5.34184 1.16188C5.39246 1.21979 5.46112 1.25232 5.53271 1.25232ZM3.55817 1.94425C3.55817 1.86235 3.52973 1.78381 3.47911 1.7259C3.42848 1.66799 3.35982 1.63545 3.28823 1.63545C3.21664 1.63545 3.14798 1.66799 3.09736 1.7259C3.04673 1.78381 3.01829 1.86235 3.01829 1.94425C3.01829 2.02614 3.04673 2.10469 3.09736 2.1626C3.14798 2.2205 3.21664 2.25304 3.28823 2.25304C3.35982 2.25304 3.42848 2.2205 3.47911 2.1626C3.52973 2.10469 3.55817 2.02614 3.55817 1.94425ZM5.00284 1.94425C5.00284 1.86235 4.9744 1.78381 4.92377 1.7259C4.87315 1.66799 4.80449 1.63545 4.7329 1.63545C4.66131 1.63545 4.59265 1.66799 4.54202 1.7259C4.4914 1.78381 4.46296 1.86235 4.46296 1.94425C4.46296 2.02614 4.4914 2.10469 4.54202 2.1626C4.59265 2.2205 4.66131 2.25304 4.7329 2.25304C4.80449 2.25304 4.87315 2.2205 4.92377 2.1626C4.9744 2.10469 5.00284 2.02614 5.00284 1.94425ZM4.283 0.943531C4.283 0.861635 4.25456 0.783092 4.20394 0.725182C4.15332 0.667273 4.08466 0.634739 4.01306 0.634739C3.94147 0.634739 3.87281 0.667273 3.82219 0.725182C3.77157 0.783092 3.74313 0.861635 3.74313 0.943531C3.74313 1.02543 3.77157 1.10397 3.82219 1.16188C3.87281 1.21979 3.94147 1.25232 4.01306 1.25232C4.08466 1.25232 4.15332 1.21979 4.20394 1.16188C4.25456 1.10397 4.283 1.02543 4.283 0.943531ZM6.29754 16H1.7036C0.653838 16 -0.150976 14.9192 0.0239833 13.7355L1.2437 5.35239H1.28119L1.2437 5.34668V3.80958H6.76243V5.34668L6.72544 5.35239H6.75743L7.97715 13.7298C8.14711 14.9192 7.3473 16 6.29754 16ZM5.85264 9.06934H2.14849C1.95854 9.06934 1.79358 9.22945 1.76358 9.44103L1.21871 13.1808C1.09874 14.01 1.65861 14.7648 2.39344 14.7648H5.6077C6.34253 14.7648 6.9024 14.01 6.78243 13.1808L6.23755 9.44103C6.22126 9.3375 6.17389 9.24372 6.10363 9.17587C6.03336 9.10801 5.94459 9.07034 5.85264 9.06934Z" fill="#203027"/>
                    </svg>
                </span>
                <span class="login-logo-text">addSalt</span>
            </a>
        </div>
    </header>

    <div class="login-main">
        <h1>Welcome back!</h1>
        <p class="login-subtitle">Log in to manage addSalt</p>

        <div class="login-card">
            <?php if (!empty($error)) : ?>
                <p class="login-error"><?php echo e($error); ?></p>
            <?php endif; ?>

            <form method="post" class="login-form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="abc@example.com" value="<?php echo e($email ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>

                <button type="submit" class="login-button">Log in</button>
            </form>

            <p class="register-text">New to addSalt?<a href="register.php">Create an account</a></p>
            
        </div>
    </div>
</body>
</html>