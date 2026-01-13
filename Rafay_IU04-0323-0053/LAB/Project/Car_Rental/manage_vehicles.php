<?php include 'header.php'; if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') header('Location: admin_login.php'); ?>
<h1>Manage Vehicles</h1>
<p>Post new vehicles, edit details, upload images, and set availability. Ensure all fields are filled for better listings.</p>
<a href="#addVehicle" class="btn btn-primary mb-3" data-bs-toggle="modal">Add New Vehicle</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Price/Day</th>
            <th>Availability</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = $conn->query("SELECT v.*, b.name AS brand FROM vehicles v JOIN brands b ON v.brand_id = b.id");
        if ($result->num_rows == 0) {
            echo "<tr><td colspan='6'>No vehicles found. Add one above.</td></tr>";
        } else {
            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['brand']; ?></td>
                    <td><?php echo $row['model']; ?></td>
                    <td>$<?php echo $row['price_per_day']; ?></td>
                    <td><?php echo $row['availability']; ?></td>
                    <td>
                        <a href="#editVehicle<?php echo $row['id']; ?>" class="btn btn-warning btn-sm" data-bs-toggle="modal">Edit</a>
                        <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this vehicle?')">Delete</a>
                    </td>
                </tr>
                <!-- Edit Modal -->
                <div class="modal fade" id="editVehicle<?php echo $row['id']; ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="post" enctype="multipart/form-data" class="modal-content">
                            <div class="modal-header">
                                <h5>Edit Vehicle</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <div class="mb-3">
                                    <label for="brand_id" class="form-label">Brand</label>
                                    <select name="brand_id" class="form-control" id="brand_id" required>
                                        <?php $brands = $conn->query("SELECT * FROM brands"); while ($b = $brands->fetch_assoc()): ?>
                                            <option value="<?php echo $b['id']; ?>" <?php if ($b['id'] == $row['brand_id']) echo 'selected'; ?>><?php echo $b['name']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="model" class="form-label">Model</label>
                                    <input type="text" name="model" value="<?php echo $row['model']; ?>" class="form-control" id="model" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" id="description"><?php echo $row['description']; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="price_per_day" class="form-label">Price per Day</label>
                                    <input type="number" step="0.01" name="price_per_day" value="<?php echo $row['price_per_day']; ?>" class="form-control" id="price_per_day" required>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Upload New Image (Optional)</label>
                                    <input type="file" name="image" class="form-control" id="image">
                                </div>
                                <div class="mb-3">
                                    <label for="availability" class="form-label">Availability</label>
                                    <select name="availability" class="form-control" id="availability">
                                        <option value="yes" <?php if ($row['availability'] == 'yes') echo 'selected'; ?>>Yes</option>
                                        <option value="no" <?php if ($row['availability'] == 'no') echo 'selected'; ?>>No</option>
                                    </select>
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
<div class="modal fade" id="addVehicle" tabindex="-1">
    <div class="modal-dialog">
        <form method="post" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <h5>Add New Vehicle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="brand_id" class="form-label">Brand</label>
                    <select name="brand_id" class="form-control" id="brand_id" required>
                        <option value="">Select Brand</option>
                        <?php $brands = $conn->query("SELECT * FROM brands"); while ($b = $brands->fetch_assoc()): ?>
                            <option value="<?php echo $b['id']; ?>"><?php echo $b['name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="model" class="form-label">Model</label>
                    <input type="text" name="model" class="form-control" id="model" placeholder="Enter model" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control" id="description" placeholder="Enter description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="price_per_day" class="form-label">Price per Day</label>
                    <input type="number" step="0.01" name="price_per_day" class="form-control" id="price_per_day" placeholder="Enter price" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image</label>
                    <input type="file" name="image" class="form-control" id="image" required>
                </div>
                <div class="mb-3">
                    <label for="availability" class="form-label">Availability</label>
                    <select name="availability" class="form-control" id="availability">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="add" class="btn btn-primary">Add Vehicle</button>
            </div>
        </form>
    </div>
</div>
<?php
if (isset($_POST['add'])) {
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$image");
    $stmt = $conn->prepare("INSERT INTO vehicles (brand_id, model, description, price_per_day, image, availability) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issdss", $_POST['brand_id'], $_POST['model'], $_POST['description'], $_POST['price_per_day'], $image, $_POST['availability']);
    $stmt->execute();
    header('Location: manage_vehicles.php');
}
if (isset($_POST['edit'])) {
    $image = $_FILES['image']['name'] ? $_FILES['image']['name'] : $conn->query("SELECT image FROM vehicles WHERE id={$_POST['id']}")->fetch_assoc()['image'];
    if ($_FILES['image']['name']) move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$image");
    $stmt = $conn->prepare("UPDATE vehicles SET brand_id=?, model=?, description=?, price_per_day=?, image=?, availability=? WHERE id=?");
    $stmt->bind_param("issdssi", $_POST['brand_id'], $_POST['model'], $_POST['description'], $_POST['price_per_day'], $image, $_POST['availability'], $_POST['id']);
    $stmt->execute();
    header('Location: manage_vehicles.php');
}
if (isset($_GET['delete'])) {
    $conn->query("DELETE FROM vehicles WHERE id={$_GET['delete']}");
    header('Location: uploads');
}
?>
<?php include 'footer.php'; ?>