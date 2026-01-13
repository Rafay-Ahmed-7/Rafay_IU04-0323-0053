<?php include 'header.php'; ?>
<h1>Admin Login</h1>
<p>Access the admin panel to manage brands, vehicles, bookings, users, inquiries, and subscribers. This area is restricted to authorized administrators only.</p>
<p>If you're a regular user, <a href="login.php">log in here</a>.</p>
<form method="post">
    <div class="mb-3">
        <label for="email" class="form-label">Admin Email</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Enter admin email" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login as Admin</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND role = 'admin'");
    $stmt->bind_param("s", $_POST['email']);
    $stmt->execute();
    $admin = $stmt->get_result()->fetch_assoc();
    if ($admin && password_verify($_POST['password'], $admin['password'])) {
        $_SESSION['user_id'] = $admin['id'];
        $_SESSION['role'] = 'admin';
        header('Location: admin_dashboard.php');
    } else {
        echo "<div class='alert alert-danger mt-3'>Invalid admin credentials. Access denied.</div>";
    }
}
?>
<?php include 'footer.php'; ?>