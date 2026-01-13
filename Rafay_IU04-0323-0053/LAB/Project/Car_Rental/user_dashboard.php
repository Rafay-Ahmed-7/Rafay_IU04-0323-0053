<?php include 'header.php'; 
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    echo "<p>You must be logged in as a user to access this page.</p>";
    exit();
}
?>
<h1>User Dashboard</h1>
<p>Welcome to your personal dashboard! Here you can manage your profile, view and book cars, and track your booking history. Use the buttons below to navigate.</p>
<div class="row">
    <div class="col-md-3">
        <a href="profile.php" class="btn btn-primary btn-lg w-100 mb-3">Update Profile</a>
        <p>Edit your name, phone, and password.</p>
    </div>
    <div class="col-md-3">
        <a href="index.php" class="btn btn-success btn-lg w-100 mb-3">Book a Car</a>
        <p>Select from available vehicles and make a reservation.</p>
    </div>
    <div class="col-md-3">
        <a href="bookings.php" class="btn btn-info btn-lg w-100 mb-3">My Bookings</a>
        <p>View your booking history and status.</p>
    </div>
    <div class="col-md-3">
        <a href="user_inquiries.php" class="btn btn-secondary btn-lg w-100 mb-3">My Inquiries</a>
        <p>View your submitted inquiries and admin replies.</p>
    </div>
</div>
<?php include 'footer.php'; ?>