<?php
// Start session (if needed)
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gaming_company";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $first_name = htmlspecialchars(trim($_POST['firstname']));
    $last_name = htmlspecialchars(trim($_POST['lastname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $gender = htmlspecialchars(trim($_POST['occupation']));
    $address = htmlspecialchars(trim($_POST['address']));
    $position = htmlspecialchars(trim($_POST['position_applied_for']));
    $cover_letter = htmlspecialchars(trim($_POST['message']));

    // File upload
    $target_dir = "uploads/"; // Directory to store resumes
    $resume_name = basename($_FILES["upload"]["name"]);
    $target_file = $target_dir . $resume_name;
    $upload_ok = 1;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is a valid type (e.g., pdf, doc, docx)
    $allowed_types = ["pdf", "doc", "docx"];
    if (!in_array($file_type, $allowed_types)) {
        echo "Sorry, only PDF, DOC, and DOCX files are allowed.";
        $upload_ok = 0;
    }

    // Check if file was uploaded without errors
    if ($upload_ok && move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
        // Insert into database
        $stmt = $conn->prepare("
            INSERT INTO career_applications 
            (first_name, last_name, email, phone, gender, address, position_applied_for, resume_url, cover_letter) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("sssssssss", $first_name, $last_name, $email, $phone, $gender, $address, $position, $target_file, $cover_letter);

        if ($stmt->execute()) {
            echo "Your application has been submitted successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Sorry, there was an error uploading your resume.";
    }
}

$conn->close();

