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

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_stmt = $conn->prepare("DELETE FROM career_applications WHERE id = ?");
    $delete_stmt->bind_param("i", $delete_id);
    if ($delete_stmt->execute()) {
        echo "<p style='color:green;'>Application deleted successfully!</p>";
    } else {
        echo "<p style='color:red;'>Failed to delete application.</p>";
    }
    $delete_stmt->close();
}

// Fetch applications
$result = $conn->query("SELECT * FROM career_applications ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Applications</title>
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
        .container {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: white;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #6a64f1;
            color: white;
        }
        .actions a {
            text-decoration: none;
            padding: 5px 10px;
            color: white;
            border-radius: 5px;
            margin-right: 5px;
        }
        .actions .delete {
            background-color: red;
        }
        .actions .view {
            background-color: green;
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
    <h1>Manage Job Applications</h1>
</header>

<nav>
    <a href="admin_dashboard.php">Dashboard</a>
    <a href="manage_submissions.php">Manage Submissions</a>
    <a href="manage_users.php">Manage Users</a>
    <a href="logout.php">Logout</a>
</nav>

<div class="container">
    <h2>Job Applications</h2>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Position Applied For</th>
                <th>Resume</th>
                <th>Cover Letter</th>
                <th>Submitted At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['gender']); ?></td>
                    <td><?php echo htmlspecialchars($row['address']); ?></td>
                    <td><?php echo htmlspecialchars($row['position_applied_for']); ?></td>
                    <td><a href="<?php echo htmlspecialchars($row['resume_url']); ?>" target="_blank">View Resume</a></td>
                    <td><?php echo nl2br(htmlspecialchars($row['cover_letter'])); ?></td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    <td class="actions">
                        <a href="?delete_id=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this application?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No job applications found.</p>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2025 Gaming Company. All Rights Reserved.</p>
</footer>

</body>
</html>

<?php
$conn->close();
?>

