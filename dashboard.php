<?php
require_once 'config/database.php';
require_once 'includes/functions.php';
requireLogin();

$query = "SELECT * FROM users WHERE id = " . $_SESSION['user_id'];
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2>Welcome, <?php echo e($user['full_name'] ?? $_SESSION['user_name']); ?></h2>
                <p class="text-muted">Role: <?php echo e($user['role'] ?? 'user'); ?></p>
            </div>
            <a href="auth/logout.php" class="btn btn-outline-danger">Logout</a>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Profile</h5>
                        <p class="card-text">Update your personal information and bio.</p>
                        <a href="profile.php" class="btn btn-primary">Go to Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Events</h5>
                        <p class="card-text">Browse hackathons, sports, club events and workshops.</p>
                        <a href="index.php" class="btn btn-outline-secondary">Open Home Page</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Admin Panel</h5>
                        <p class="card-text">Manage users if you have admin access.</p>
                        <?php if (isAdmin()): ?>
                            <a href="admin/users.php" class="btn btn-warning">Manage Users</a>
                        <?php else: ?>
                            <span class="text-muted">Admin access required.</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
