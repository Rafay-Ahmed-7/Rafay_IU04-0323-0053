<?php include 'header.php'; if (!isset($_SESSION['user_id'])) header('Location: login.php'); ?>
<h1>My Bookings</h1>
<p>View the status of your car bookings below. If you have any issues, contact us via the Contact page.</p>
<table class="table">
    <thead>
        <tr>
            <th>Vehicle</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = $conn->query("SELECT b.*, v.model FROM bookings b JOIN vehicles v ON b.vehicle_id = v.id WHERE b.user_id = {$_SESSION['user_id']}");
        if ($result->num_rows == 0) {
            echo "<tr><td colspan='4'>No bookings found. <a href='index.php'>Browse cars</a> to make one.</td></tr>";
        } else {
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['model']; ?></td>
                    <td><?php echo $row['start_date']; ?></td>
                    <td><?php echo $row['end_date']; ?></td>
                    <td><?php echo ucfirst($row['status']); ?></td>
                </tr>
            <?php endwhile;
        }
        ?>
    </tbody>
</table>
<?php include 'footer.php'; ?>