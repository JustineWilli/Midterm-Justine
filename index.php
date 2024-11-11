<?php
session_start();
$users = array(
    array('email' => 'user1@example.com', 'password' => 'user1'),
    array('email' => 'user2@example.com', 'password' => 'user2'),
    array('email' => 'user3@example.com', 'password' => 'user3'),
    array('email' => 'user4@example.com', 'password' => 'user4'),
    array('email' => 'user5@example.com', 'password' => 'user5')
);

$emailError = $passwordError = $error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $userFound = $validEmail = false;

    if (empty($email)) {
        $emailError = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email.";  // Custom error message for invalid email
    }

    if (empty($password)) {
        $passwordError = "Password is required.";
    }

    if (!empty($email) && !empty($password) && empty($emailError)) {
        // Loop through users to check for valid login
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                $validEmail = true;
                if ($user['password'] === $password) {
                    $userFound = true;
                    $_SESSION['email'] = $email;
                    header('Location: dashboard.php');
                    exit;
                } else {
                    $error = "Invalid email or password.";
                }
            }
        }
        if (!$validEmail) {
            $error = "Invalid email or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .login-box {
            padding: 2rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .alert-box {
            max-width: 400px;
            width: 100%;
            margin-bottom: 10px;
        }
        footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        header {
            background-color: #007bff;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Header -->
<header>
    <h1>My Website</h1>
    <p>Login to access your account</p>
</header>

<!-- Main Content -->
<div class="login-container">
    <?php if (!empty($emailError) || !empty($passwordError) || !empty($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show alert-box" role="alert">
            <strong>System Errors:</strong>
            <ul class="mb-0">
                <?php if (!empty($emailError)) echo "<li>$emailError</li>"; ?>
                <?php if (!empty($passwordError)) echo "<li>$passwordError</li>"; ?>
                <?php if (!empty($error)) echo "<li>$error</li>"; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="login-box">
        <h3 class="text-center mb-4">Login</h3>
        <form method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo htmlspecialchars($email ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo htmlspecialchars($password ?? ''); ?>">
            </div>
            <div class="d-grid">
                <input type="submit" class="btn btn-primary" name="login" value="Login">
            </div>
        </form>
    </div>
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2024 My Website. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
