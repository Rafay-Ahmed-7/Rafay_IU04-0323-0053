<?php include 'header.php'; ?>
<h1>User Login</h1>
<p>Welcome back! Log in to access your dashboard, view bookings, and manage your account. If you're an admin, please use the <a href="admin_login.php">admin login</a>.</p>
<p>Don't have an account? <a href="register.php">Register here</a>.</p>
<form method="post">
    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $_POST['email']);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header('Location: index.php');
    } else {
        echo "<div class='alert alert-danger mt-3'>Invalid email or password. Please try again.</div>";
    }
}
?>
<?php include 'footer.php'; ?>