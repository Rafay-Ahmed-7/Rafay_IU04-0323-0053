<?php include 'header.php'; ?>
<div class="hero bg-light p-5 rounded mb-4">
    <h1>Welcome to Our Car Rental Service</h1>
    <p class="lead">Browse and book from our wide selection of available rental cars. Whether for business or leisure, we have the perfect vehicle for you. Check out our pricing, view details, and make a booking today!</p>
</div>
<h2>Available Cars</h2>
<p>Explore our fleet of vehicles below. Each car includes details on brand, model, pricing per day, and availability. Click "Book Now" to reserve your choice.</p>
<div class="row">
    <?php
    $result = $conn->query("SELECT v.*, b.name AS brand FROM vehicles v JOIN brands b ON v.brand_id = b.id WHERE v.availability = 'yes'");
    if ($result->num_rows == 0) {
        echo "<p>No vehicles available at the moment. Please check back later.</p>";
    } else {
        while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="uploads/<?php echo $row['image']; ?>" class="card-img-top" alt="Car Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['brand'] . ' ' . $row['model']; ?></h5>
                        <p class="card-text"><?php echo $row['description']; ?></p>
                        <p class="text-success"><strong>$<?php echo $row['price_per_day']; ?>/day</strong></p>
                        <a href="book_car.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
        <?php endwhile;
    }
    ?>
</div>
<?php include 'footer.php'; ?>