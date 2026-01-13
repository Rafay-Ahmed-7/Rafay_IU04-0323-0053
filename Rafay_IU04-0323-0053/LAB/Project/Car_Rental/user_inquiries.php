<?php include 'header.php'; if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') header('Location: login.php'); ?>
<h1>My Inquiries</h1>
<p>View your submitted inquiries and any replies from the admin. If you have questions, submit a new inquiry via the Contact page.</p>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Message</th>
            <th>Reply</th>
            <th>Status</th>
            <th>Submitted</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Assuming inquiries are linked to user by email (since no user_id in inquiries table)
        $user_email = $conn->query("SELECT email FROM users WHERE id={$_SESSION['user_id']}")->fetch_assoc()['email'];
        $result = $conn->query("SELECT * FROM inquiries WHERE email='$user_email' ORDER BY created_at DESC");
        if ($result->num_rows == 0) {
            echo "<tr><td colspan='5'>No inquiries found. <a href='contact.php'>Submit one here</a>.</td></tr>";
        } else {
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['message']; ?></td>
                    <td><?php echo $row['reply'] ?: 'No reply yet'; ?></td>
                    <td><?php echo ucfirst($row['status']); ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
            <?php endwhile;
        }
        ?>
    </tbody>
</table>
<?php include 'footer.php'; ?>