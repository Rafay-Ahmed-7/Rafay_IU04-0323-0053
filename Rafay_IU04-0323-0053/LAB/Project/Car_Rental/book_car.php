<?php include 'header.php'; if (!isset($_SESSION['user_id'])) header('Location: login.php'); ?>
<h1>Book a Car</h1>
<p>Select your rental dates and confirm your booking. Ensure the dates are available before proceeding. You can view your bookings in your dashboard.</p>
<?php
$vehicle = $conn->query("SELECT * FROM vehicles WHERE id = {$_GET['id']}")->fetch_assoc();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO bookings (user_id, vehicle_id, start_date, end_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $_SESSION['user_id'], $_GET['id'], $_POST['start_date'], $_POST['end_date']);
    $stmt->execute();
    echo "<div class='alert alert-success'>Booking submitted successfully! Check your dashboard for status.</div>";
}
?>
<form method="post">
    <div class="card mb-4">
        <div class="card-body">
            <h5><?php echo $vehicle['model']; ?></h5>
            <p><?php echo $vehicle['description']; ?></p>
            <p class="text-success"><strong>Rs.<?php echo $vehicle['price_per_day']; ?>/day</strong></p>
        </div>
    </div>
    <div class="mb-3">
        <label for="start_date" class="form-label">Start Date</label>
        <input type="date" name="start_date" class="form-control" id="start_date" required>
    </div>
    <div class="mb-3">
        <label for="end_date" class="form-label">End Date</label>
        <input type="date" name="end_date" class="form-control" id="end_date" required>
    </div>
    <button type="submit" class="btn btn-primary">Book Now</button>
</form>
<?php include 'footer.php'; ?>