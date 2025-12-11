<?php
// Generate correct password hash for 'admin123'
$password = 'admin123';
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "Password: " . $password . "<br>";
echo "Hash: " . $hash . "<br><br>";

// Verify it works
if (password_verify($password, $hash)) {
    echo "✅ Verification: SUCCESS<br>";
} else {
    echo "❌ Verification: FAILED<br>";
}

echo "<br>Copy this hash and use it in the SQL:<br>";
echo "<code>" . $hash . "</code>";
?>
