<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Car Rental</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="index.php">Home</a>
            <a class="nav-link" href="about.php">About Us</a>
            <a class="nav-link" href="contact.php">Contact</a>
            <a class="nav-link" href="<?php echo isset($_SESSION['user_id']) ? ($_SESSION['role'] == 'admin' ? 'admin_dashboard.php' : 'user_dashboard.php') : 'login.php'; ?>">Dashboard</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a class="nav-link" href="logout.php">Logout</a>
            <?php else: ?>
                <a class="nav-link" href="register.php">Register</a>
                <a class="nav-link" href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container mt-4">