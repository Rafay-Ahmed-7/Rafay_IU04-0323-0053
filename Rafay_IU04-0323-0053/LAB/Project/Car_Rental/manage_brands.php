<?php include 'header.php'; if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') header('Location: admin_login.php'); ?>
<h1>Manage Vehicle Brands</h1>
<p>Add, edit, or delete vehicle brands. Brands help categorize vehicles for better organization.</p>
<a href="#addBrand" class="btn btn-primary mb-3" data-bs-toggle="modal">Add New Brand</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = $conn->query("SELECT * FROM brands");
        if ($result->num_rows == 0) {
            echo "<tr><td colspan='4'>No brands found. Add one above.</td></tr>";
        } else {
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>
                        <a href="#editBrand<?php echo $row['id']; ?>" class="btn btn-warning btn-sm" data-bs-toggle="modal">Edit</a>
                        <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this brand?')">Delete</a>
                    </td>
                </tr>
                <!-- Edit Modal -->
                <div class="modal fade" id="editBrand<?php echo $row['id']; ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="post" class="modal-content">
                            <div class="modal-header">
                                <h5>Edit Brand</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Brand Name</label>
                                    <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control" id="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" id="description"><?php echo $row['description']; ?></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="edit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endwhile;
        }
        ?>
    </tbody>
</table>
<!-- Add Modal -->
<div class="modal fade" id="addBrand" tabindex="-1">
    <div class="modal-dialog">
        <form method="post" class="modal-content">
            <div class="modal-header">
                <h5>Add New Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Brand Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter brand name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control" id="description" placeholder="Enter description"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="add" class="btn btn-primary">Add Brand</button>
            </div>
        </form>
    </div>
</div>
<?php
if (isset($_POST['add'])) {
    $stmt = $conn->prepare("INSERT INTO brands (name, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $_POST['name'], $_POST['description']);
    $stmt->execute();
    header('Location: manage_brands.php');
}
if (isset($_POST['edit'])) {
    $stmt = $conn->prepare("UPDATE brands SET name=?, description=? WHERE id=?");
    $stmt->bind_param("ssi", $_POST['name'], $_POST['description'], $_POST['id']);
    $stmt->execute();
    header('Location: manage_brands.php');
}
if (isset($_GET['delete'])) {
    $conn->query("DELETE FROM brands WHERE id={$_GET['delete']}");
    header('Location: manage_brands.php');
}
?>
<?php include 'footer.php'; ?>