<?php include 'header.php'; if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') header('Location: admin_dashboard.php'); ?>
<h1>Admin Dashboard</h1>
<p>Manage the entire car rental system from here. View statistics, handle bookings, and oversee users and content.</p>
<div class="row">
    <div class="col-md-3">
        <div class="card text-center mb-4">
            <div class="card-body">
                <h5>Total Users</h5>
                <p class="h3"><?php echo $conn->query("SELECT COUNT(*) FROM users WHERE role='user'")->fetch_row()[0]; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center mb-4">
            <div class="card-body">
                <h5>Total Vehicles</h5>
                <p class="h3"><?php echo $conn->query("SELECT COUNT(*) FROM vehicles")->fetch_row()[0]; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center mb-4">
            <div class="card-body">
                <h5>Total Bookings</h5>
                <p class="h3"><?php echo $conn->query("SELECT COUNT(*) FROM bookings")->fetch_row()[0]; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center mb-4">
            <div class="card-body">
                <h5>Pending Bookings</h5>
                <p class="h3"><?php echo $conn->query("SELECT COUNT(*) FROM bookings WHERE status='pending'")->fetch_row()[0]; ?></p>
            </div>
        </div>
    </div>
</div>
<p>Additional stats: Total Inquiries: <?php echo $conn->query("SELECT COUNT(*) FROM inquiries")->fetch_row()[0]; ?>, Total Subscribers: <?php echo $conn->query("SELECT COUNT(*) FROM subscribers")->fetch_row()[0]; ?></p>
<div class="row">
    <div class="col-md-2"><a href="manage_brands.php" class="btn btn-secondary w-100 mb-2">Brands</a></div>
    <div class="col-md-2"><a href="manage_vehicles.php" class="btn btn-secondary w-100 mb-2">Vehicles</a></div>
    <div class="col-md-2"><a href="manage_bookings.php" class="btn btn-secondary w-100 mb-2">Bookings</a></div>
    <div class="col-md-2"><a href="manage_users.php" class="btn btn-secondary w-100 mb-2">Users</a></div>
    <div class="col-md-2"><a href="manage_inquiries.php" class="btn btn-secondary w-100 mb-2">Inquiries</a></div>
    <div class="col-md-2"><a href="manage_subscribers.php" class="btn btn-secondary w-100 mb-2">Subscribers</a></div>
</div>
<?php include 'footer.php'; ?>