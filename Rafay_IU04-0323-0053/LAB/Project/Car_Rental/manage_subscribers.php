<?php include 'header.php'; if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') header('Location: admin_login.php'); ?>
<h1>Manage Subscribers</h1>
<p>View the list of email subscribers. Delete any unwanted entries to manage your mailing list.</p>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = $conn->query("SELECT * FROM subscribers");
        if ($result->num_rows == 0) {
            echo "<tr><td colspan='3'>No subscribers found.</td></tr>";
        } else {
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this subscriber?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile;
        }
        ?>
    </tbody>
</table>
<?php
if (isset($_GET['delete'])) {
    $conn->query("DELETE FROM subscribers WHERE id={$_GET['delete']}");
    header('Location: manage_subscribers.php');
}
?>
<?php include 'footer.php'; ?>