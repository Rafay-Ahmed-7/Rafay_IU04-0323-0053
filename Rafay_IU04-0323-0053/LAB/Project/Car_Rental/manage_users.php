<?php include 'header.php'; if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') header('Location: admin_login.php'); ?>
<h1>Manage Registered Users</h1>
<p>View all registered users. This list includes their details for reference. No direct editing is available here for security.</p>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Registered Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = $conn->query("SELECT * FROM users WHERE role='user'");
        if ($result->num_rows == 0) {
            echo "<tr><td colspan='5'>No users found.</td></tr>";
        } else {
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
            <?php endwhile;
        }
        ?>
    </tbody>
</table>
<?php include 'footer.php'; ?>