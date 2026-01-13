<?php include 'header.php'; ?>
<h1>About Us</h1>
<p>Welcome to our car rental company! We are dedicated to providing reliable, affordable, and high-quality rental vehicles for all your travel needs. With years of experience in the industry, we ensure a seamless booking process and exceptional customer service.</p>
<p>Our mission is to make transportation easy and accessible. Learn more about our services, policies, and commitment to safety.</p>
<?php $page = $conn->query("SELECT * FROM pages WHERE title='About Us'")->fetch_assoc(); ?>
<div><?php echo $page['content']; ?></div>
<?php include 'footer.php'; ?>