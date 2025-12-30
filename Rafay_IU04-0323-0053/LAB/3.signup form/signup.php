<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $courses = isset($_POST['courses']) ? implode(', ', $_POST['courses']) : '';
    $country = $_POST['country'];
    $city = $_POST['city'];

    if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] == 0) {
        $profilePicture = $_FILES['profilePicture']['name'];
        move_uploaded_file($_FILES['profilePicture']['tmp_name'], 'uploads/' . $profilePicture);
    } else {
        $profilePicture = '';
    }

    echo "Signup successful! Welcome, $firstName $lastName.";
}
?>