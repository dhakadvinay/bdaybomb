<?php
// Setup Admin User - Run this once to create/fix admin account
require_once 'includes/db.php';

$username = 'admin';
$password = 'admin123';
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "<h1>🔧 Admin Setup</h1>";

// Delete existing admin user
$conn->query("DELETE FROM admin_users WHERE username = 'admin'");
echo "<p>✅ Cleared old admin user (if any existed)</p>";

// Insert new admin user
$stmt = $conn->prepare("INSERT INTO admin_users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hash);

if ($stmt->execute()) {
    echo "<p style='color: green; font-size: 18px;'><strong>✅ Admin user created successfully!</strong></p>";
    echo "<p><strong>Username:</strong> admin</p>";
    echo "<p><strong>Password:</strong> admin123</p>";
    echo "<p><strong>Hash:</strong> " . $hash . "</p>";
    
    // Verify it works
    $verify_stmt = $conn->prepare("SELECT password FROM admin_users WHERE username = ?");
    $verify_stmt->bind_param("s", $username);
    $verify_stmt->execute();
    $result = $verify_stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify('admin123', $row['password'])) {
            echo "<p style='color: green;'><strong>✅ Password verification: SUCCESS</strong></p>";
            echo "<p style='background: #d4edda; padding: 15px; border-radius: 5px;'>";
            echo "You can now login at: <a href='/myfirstweb/admin/login.php'>/myfirstweb/admin/login.php</a>";
            echo "</p>";
        } else {
            echo "<p style='color: red;'><strong>❌ Password verification: FAILED</strong></p>";
        }
    }
    
    $verify_stmt->close();
} else {
    echo "<p style='color: red;'><strong>❌ Error creating admin user: " . $stmt->error . "</strong></p>";
}

$stmt->close();
$conn->close();
?>
