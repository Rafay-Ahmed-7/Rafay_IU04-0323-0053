<?php include 'header.php'; ?>
<h1>User Registration</h1>
<p>Join our car rental community today! Create an account to book vehicles, view your booking history, and manage your profile. Registration is quick and free.</p>
<p>Already have an account? <a href="login.php">Log in here</a>.</p>
<form method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Enter your full name" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Create a password" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone Number (Optional)</label>
        <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter your phone number">
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $_POST['name'], $_POST['email'], $hash, $_POST['phone']);
    if ($stmt->execute()) {
        echo "<div class='alert alert-success mt-3'>Registration successful! <a href='login.php'>Log in now</a>.</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Email already exists. Please try a different one.</div>";
    }
}
?>
<?php include 'footer.php'; ?>