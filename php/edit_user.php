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

// Check if user ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("User ID is required.");
}

$id = intval($_GET['id']);

// Fetch user data based on ID
$query = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($query);

if ($result->num_rows != 1) {
    die("User not found.");
}

$user = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $email = htmlspecialchars(trim($_POST['email']));

    // Input validation
    if (empty($first_name) || empty($last_name) || empty($email)) {
        echo "<p style='color:red;'>All fields are required!</p>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='color:red;'>Invalid email format!</p>";
    } else {
        // Update user data in the database
        $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, updated_at = NOW() WHERE id = ?");
        $stmt->bind_param("sssi", $first_name, $last_name, $email, $id);

        if ($stmt->execute()) {
            echo "<p style='color:green;'>User updated successfully.</p>";
            header("Location: manage_users.php");
            exit();
        } else {
            echo "<p style='color:red;'>Error updating user: " . $conn->error . "</p>";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #6a64f1;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }

        .back-link {
            margin-top: 20px;
            text-align: center;
        }

        .back-link a {
            color: #6a64f1;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<h1>Edit User</h1>
<form method="POST" action="">
    <label for="first_name">First Name</label>
    <input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>

    <label for="last_name">Last Name</label>
    <input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

    <button type="submit">Update User</button>
</form>
<div class="back-link">
    <a href="manage_users.php">Back to Manage Users</a>
</div>
</body>
</html>

