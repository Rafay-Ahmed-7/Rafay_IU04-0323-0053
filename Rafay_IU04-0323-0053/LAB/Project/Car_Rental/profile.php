<?php include 'header.php'; if (!isset($_SESSION['user_id'])) header('Location: login.php'); ?>
<h1>Update Your Profile</h1>
<p>Keep your information up to date for a better experience. Update your details below and save changes.</p>
<?php
$user = $conn->query("SELECT * FROM users WHERE id = {$_SESSION['user_id']}")->fetch_assoc();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("UPDATE users SET name=?, phone=?, password=? WHERE id=?");
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt->bind_param("sssi", $_POST['name'], $_POST['phone'], $hash, $_SESSION['user_id']);
    $stmt->execute();
    echo "<div class='alert alert-success'>Profile updated successfully!</div>";
}
?>
<form method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" class="form-control" id="name" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="text" name="phone" value="<?php echo $user['phone']; ?>" class="form-control" id="phone">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">New Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Enter new password" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Profile</button>
</form>
<?php include 'footer.php'; ?>