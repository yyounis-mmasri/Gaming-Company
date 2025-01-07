<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gaming_company"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form inputs
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate required fields
    if (empty($first_name) || empty($last_name) || empty($email) || empty($message)) {
        echo "<p style='color:red;'>Please fill in all required fields!</p>";
        exit();
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='color:red;'>Invalid email format!</p>";
        exit();
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO contact_submissions (first_name, last_name, email, subject, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Thank you for your message! We will get back to you soon.</p>";

    } else {
        echo "<p style='color:red;'>Something went wrong. Please try again later.</p>";
    }

    $stmt->close();
}

$conn->close();


