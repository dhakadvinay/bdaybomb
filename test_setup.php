<?php
// Test Setup Page - Verify all components are working
session_start();

$tests = [
    'database' => false,
    'tables' => false,
    'uploads_folder' => false,
    'files' => []
];

// Test 1: Database Connection
try {
    require_once 'includes/db.php';
    if (!$conn->connect_error) {
        $tests['database'] = true;
    }
} catch (Exception $e) {
    $tests['database'] = false;
}

// Test 2: Check Tables
if ($tests['database']) {
    $result = $conn->query("SHOW TABLES FROM birthday_surprise");
    if ($result && $result->num_rows >= 2) {
        $tests['tables'] = true;
    }
}

// Test 3: Check Uploads Folder
if (is_dir('uploads') && is_writable('uploads')) {
    $tests['uploads_folder'] = true;
}

// Test 4: Check Required Files
$required_files = [
    'index.php',
    'gallery.php',
    'admin/login.php',
    'admin/dashboard.php',
    'includes/db.php',
    'includes/auth.php',
    'assets/css/style.css',
    'assets/js/animations.js'
];

foreach ($required_files as $file) {
    $tests['files'][$file] = file_exists($file);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Test - Birthday Surprise</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }
        h1 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }
        .test-section {
            margin-bottom: 25px;
        }
        .test-section h2 {
            color: #667eea;
            font-size: 1.2rem;
            margin-bottom: 15px;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 10px;
        }
        .test-item {
            display: flex;
            align-items: center;
            padding: 10px;
            margin-bottom: 8px;
            border-radius: 5px;
            background: #f9f9f9;
        }
        .test-item.pass {
            background: #d4edda;
            border-left: 4px solid #28a745;
        }
        .test-item.fail {
            background: #f8d7da;
            border-left: 4px solid #dc3545;
        }
        .status-icon {
            font-size: 1.5rem;
            margin-right: 15px;
            min-width: 30px;
        }
        .status-text {
            flex: 1;
        }
        .summary {
            margin-top: 30px;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        .summary.ready {
            background: #d4edda;
            color: #155724;
            border: 2px solid #28a745;
        }
        .summary.not-ready {
            background: #f8d7da;
            color: #721c24;
            border: 2px solid #dc3545;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            justify-content: center;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        .btn-secondary {
            background: #999;
            color: white;
        }
        .btn-secondary:hover {
            background: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 Birthday Surprise - Setup Test</h1>

        <!-- Database Tests -->
        <div class="test-section">
            <h2>📊 Database</h2>
            <div class="test-item <?php echo $tests['database'] ? 'pass' : 'fail'; ?>">
                <span class="status-icon"><?php echo $tests['database'] ? '✅' : '❌'; ?></span>
                <span class="status-text">Database Connection</span>
            </div>
            <div class="test-item <?php echo $tests['tables'] ? 'pass' : 'fail'; ?>">
                <span class="status-icon"><?php echo $tests['tables'] ? '✅' : '❌'; ?></span>
                <span class="status-text">Database Tables (admin_users, photos)</span>
            </div>
        </div>

        <!-- Folder Tests -->
        <div class="test-section">
            <h2>📁 Folders</h2>
            <div class="test-item <?php echo $tests['uploads_folder'] ? 'pass' : 'fail'; ?>">
                <span class="status-icon"><?php echo $tests['uploads_folder'] ? '✅' : '❌'; ?></span>
                <span class="status-text">Uploads Folder (writable)</span>
            </div>
        </div>

        <!-- File Tests -->
        <div class="test-section">
            <h2>📄 Required Files</h2>
            <?php foreach ($tests['files'] as $file => $exists): ?>
                <div class="test-item <?php echo $exists ? 'pass' : 'fail'; ?>">
                    <span class="status-icon"><?php echo $exists ? '✅' : '❌'; ?></span>
                    <span class="status-text"><?php echo htmlspecialchars($file); ?></span>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Summary -->
        <?php
        $all_pass = $tests['database'] && $tests['tables'] && $tests['uploads_folder'] && 
                    array_reduce($tests['files'], function($carry, $item) { return $carry && $item; }, true);
        ?>
        <div class="summary <?php echo $all_pass ? 'ready' : 'not-ready'; ?>">
            <?php if ($all_pass): ?>
                <h2>✅ All Systems Ready!</h2>
                <p>Your birthday surprise website is ready to use.</p>
            <?php else: ?>
                <h2>⚠️ Setup Incomplete</h2>
                <p>Please fix the failed tests above before using the website.</p>
            <?php endif; ?>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <?php if ($all_pass): ?>
                <a href="/myfirstweb/index.php" class="btn btn-primary">🏠 Go to Home Page</a>
                <a href="/myfirstweb/admin/login.php" class="btn btn-primary">🔐 Admin Login</a>
            <?php endif; ?>
            <a href="/myfirstweb/SETUP_GUIDE.md" class="btn btn-secondary">📖 Setup Guide</a>
        </div>
    </div>
</body>
</html>
