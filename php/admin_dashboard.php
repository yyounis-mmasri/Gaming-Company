<?php
// Start session
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
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

// Fetch counts for dashboard stats
$submissions_count = $conn->query("SELECT COUNT(*) AS count FROM contact_submissions")->fetch_assoc()['count'];
$applications_count = $conn->query("SELECT COUNT(*) AS count FROM career_applications")->fetch_assoc()['count'];
$users_count = $conn->query("SELECT COUNT(*) AS count FROM users")->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        header {
            background-color: #6a64f1;
            color: white;
            padding: 20px;
            text-align: center;
        }
        nav {
            background-color: #4c4cff;
            display: flex;
            justify-content: center;
            padding: 10px 0;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 16px;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .dashboard-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin: 20px;
        }
        .card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 20px;
            text-align: center;
            flex: 1 1 200px;
            max-width: 300px;
        }
        .card h3 {
            margin: 0 0 10px;
            color: #6a64f1;
        }
        .card p {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        footer {
            background-color: #4c4cff;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<header>
    <h1>Welcome, <?php echo $_SESSION['admin_name']; ?></h1>
</header>

<nav>
    <a href="manage_submissions.php">Manage Submissions</a>
    <a href="manage_applications.php">Manage Applications</a>
    <a href="manage_users.php">Manage Users</a>
    <a href="logout.php">Logout</a>
</nav>

<div class="dashboard-container">
    <div class="card">
        <h3>Contact Submissions</h3>
        <p><?php echo $submissions_count; ?></p>
    </div>
    <div class="card">
        <h3>Job Applications</h3>
        <p><?php echo $applications_count; ?></p>
    </div>
    <div class="card">
        <h3>Registered Users</h3>
        <p><?php echo $users_count; ?></p>
    </div>
</div>

<footer>
    <p>&copy; 2025 Gaming Company. All Rights Reserved.</p>
</footer>

</body>
</html>

<?php
$conn->close();
?>

