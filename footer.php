<?php
session_start();

// Check if user is authenticated
if (!isset($_SESSION['email'])) {
    footer('Location: footer.php');
    exit;
}

$email = $_SESSION['email'];

// Logout handler
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_destroy();
    setcookie(session_name(), '', time() - 3600);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', Tahoma, Geneva, Verdana, Arial, sans-serif;
        }

        .container {
            text-align: center;
            max-width: 500px;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h1 {
            color: #007bff;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button.btn-primary {
            background-color: #007bff;
            color: white;
        }

        button.btn-secondary {
            background-color: #6c757d;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Logged in as: <?php echo htmlspecialchars($email); ?></h1>
        <p>Click the button below to log out.</p>
        <form method="post">
            <button type="submit" name="logout" class="btn btn-danger">Logout</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
