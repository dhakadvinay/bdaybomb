<?php
// Debug Login Issues
session_start();
require_once 'includes/db.php';

echo "<h1>🔍 Login Debug Page</h1>";

// Test 1: Database Connection
echo "<h2>1. Database Connection</h2>";
if ($conn->connect_error) {
    echo "<p style='color: red;'>❌ Connection failed: " . $conn->connect_error . "</p>";
} else {
    echo "<p style='color: green;'>✅ Database connected successfully</p>";
}

// Test 2: Check admin_users table
echo "<h2>2. Admin Users Table</h2>";
$result = $conn->query("SELECT * FROM admin_users");
if ($result) {
    echo "<p style='color: green;'>✅ admin_users table exists</p>";
    echo "<p>Records found: " . $result->num_rows . "</p>";
    
    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Username</th><th>Password Hash</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
            echo "<td>" . substr($row['password'], 0, 20) . "...</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color: orange;'>⚠️ No admin users found in database</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Error querying admin_users: " . $conn->error . "</p>";
}

// Test 3: Test password verification
echo "<h2>3. Password Verification Test</h2>";
$test_password = 'admin123';
$correct_hash = '$2y$10$slYQmyNdGzin7olVZeVf.OPST9/PgBkqquzi.Ss7KIUgO2t0jKMm2';

if (password_verify($test_password, $correct_hash)) {
    echo "<p style='color: green;'>✅ Password 'admin123' verifies correctly with the hash</p>";
} else {
    echo "<p style='color: red;'>❌ Password verification failed</p>";
}

// Test 4: Simulate login
echo "<h2>4. Login Simulation</h2>";
$stmt = $conn->prepare("SELECT id, username, password FROM admin_users WHERE username = ?");
$username = 'admin';
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    echo "<p>Found user: " . htmlspecialchars($user['username']) . "</p>";
    
    if (password_verify('admin123', $user['password'])) {
        echo "<p style='color: green;'>✅ Login would succeed with password 'admin123'</p>";
    } else {
        echo "<p style='color: red;'>❌ Login would fail - password doesn't match</p>";
        echo "<p>Stored hash: " . $user['password'] . "</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Admin user not found in database</p>";
}

$stmt->close();

// Test 5: Check photos table
echo "<h2>5. Photos Table</h2>";
$result = $conn->query("SELECT COUNT(*) as count FROM photos");
if ($result) {
    $row = $result->fetch_assoc();
    echo "<p style='color: green;'>✅ Photos table exists with " . $row['count'] . " photos</p>";
} else {
    echo "<p style='color: red;'>❌ Error querying photos table: " . $conn->error . "</p>";
}

echo "<hr>";
echo "<p><a href='/myfirstweb/admin/login.php'>← Back to Login</a></p>";
?>
