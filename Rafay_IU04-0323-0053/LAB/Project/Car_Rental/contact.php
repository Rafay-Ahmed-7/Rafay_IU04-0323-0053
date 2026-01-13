<?php include 'header.php'; ?>
<h1>Contact Us</h1>
<p>Have a question or need assistance? Reach out to us through the form below. We respond to all inquiries within 24 hours. Whether it's about bookings, vehicle details, or general support, we're here to help!</p>
<p>For urgent matters, call us at +92-334251471.</p>
<form method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Your Email" required>
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea name="message" class="form-control" id="message" rows="4" placeholder="Your Message" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit Inquiry</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO inquiries (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $_POST['name'], $_POST['email'], $_POST['message']);
    $stmt->execute();
    echo "<div class='alert alert-success mt-3'>Inquiry submitted successfully! We'll get back to you soon.</div>";
}
?>
<?php include 'footer.php'; ?>