<?php include 'header.php'; if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') header('Location: admin_login.php'); ?>
<h1>Manage User Inquiries</h1>
<p>View inquiries from users, reply to them, and mark as resolved. Delete resolved inquiries to keep the list clean.</p>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = $conn->query("SELECT * FROM inquiries");
        if ($result->num_rows == 0) {
            echo "<tr><td colspan='7'>No inquiries found.</td></tr>";
        } else {
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['message']; ?></td>
                    <td><?php echo ucfirst($row['status']); ?></td>
                </tr>
                <!-- Reply Modal -->
                <div class="modal fade" id="replyInquiry<?php echo $row['id']; ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <form class="modal-content" id="replyForm<?php echo $row['id']; ?>">
                            <div class="modal-header">
                                <h5>Reply to Inquiry</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>" id="id<?php echo $row['id']; ?>">
                                <div class="mb-3">
                                    <label for="reply<?php echo $row['id']; ?>" class="form-label">Reply Message</label>
                                    <textarea name="reply" class="form-control" id="reply<?php echo $row['id']; ?>" rows="4" placeholder="Type your reply here..." required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="status<?php echo $row['id']; ?>" class="form-label">Status</label>
                                    <select name="status" class="form-control" id="status<?php echo $row['id']; ?>">
                                        <option value="open" <?php if ($row['status'] == 'open') echo 'selected'; ?>>Open</option>
                                        <option value="resolved" <?php if ($row['status'] == 'resolved') echo 'selected'; ?>>Resolved</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onclick="submitReply(<?php echo $row['id']; ?>)">Send Reply</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endwhile;
        }
        ?>
    </tbody>
</table>
<?php
if (isset($_POST['reply'])) {
    $stmt = $conn->prepare("UPDATE inquiries SET reply=?, status=? WHERE id=?");
    $stmt->bind_param("ssi", $_POST['reply'], $_POST['status'], $_POST['id']);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit();
}
if (isset($_GET['delete'])) {
    if ($conn->query("DELETE FROM inquiries WHERE id={$_GET['delete']}")) {
        echo "<script>alert('Inquiry deleted successfully!'); window.location.reload();</script>";
    } else {
        echo "<script>alert('Error deleting inquiry.');</script>";
    }
}
?>
<script>
function submitReply(id) {
    const formData = new FormData();
    formData.append('reply', document.getElementById('reply' + id).value);
    formData.append('status', document.getElementById('status' + id).value);
    formData.append('id', document.getElementById('id' + id).value);

    fetch('manage_inquiries.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Reply sent successfully!');
            // Close the modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('replyInquiry' + id));
            modal.hide();
            // Reload the page to update the table
            window.location.reload();
        } else {
            alert('Error sending reply. Please try again.');
        }
    })
    .catch(error => {
        alert('An error occurred. Please try again.');
    });
}
</script>
<?php include 'footer.php'; ?>