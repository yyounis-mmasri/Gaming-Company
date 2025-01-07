<?php
// Start session
session_start();

// Database connection (use this inline or include from config.php)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gaming_company";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Input validation
    if (empty($email) || empty($password)) {
        echo "<p style='color:red;'>Email and Password are required!</p>";
        exit();
    }

    // Check if email exists in the admins table first
    $stmt = $conn->prepare("SELECT id, first_name, password FROM admins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        // Bind result variables
        $stmt->bind_result($id, $first_name, $hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct; set session variables
            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_name'] = $first_name;
            echo "<p style='color:green;'>Admin login successful! Welcome, $first_name.</p>";

            // Redirect to admin dashboard
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "<p style='color:red;'>Invalid password!</p>";
        }
    } else {
        // If not an admin, check the users table
        $stmt->close();
        $stmt = $conn->prepare("SELECT id, first_name, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            // Bind result variables
            $stmt->bind_result($id, $first_name, $hashed_password);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Password is correct; set session variables
                $_SESSION['user_id'] = $id;
                $_SESSION['user_name'] = $first_name;
                echo "<p style='color:green;'>Login successful! Welcome, $first_name.</p>";

                // Redirect to the user dashboard
                header("Location: ../index.php");
                exit();
            } else {
                echo "<p style='color:red;'>Invalid password!</p>";
            }
        } else {
            echo "<p style='color:red;'>No account found with this email!</p>";
        }
    }

    $stmt->close();
}

$conn->close();

