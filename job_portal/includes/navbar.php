<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$role = $_SESSION['role'] ?? '';
?>

<style>
.navbar {
    background-color: #333;
    overflow: hidden;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar a {
    color: white;
    text-decoration: none;
    padding: 10px 15px;
    font-weight: bold;
    transition: background-color 0.3s;
}

.navbar a:hover {
    background-color: #575757;
    border-radius: 5px;
}
</style>

<div class="navbar">
    <div>
        <a href="index.php">🏠 Home</a>
        <a href="javascript:history.back()">🔙 Return</a>

        <?php if ($role === 'admin'): ?>
            <a href="admin_panel.php">🛠 Admin Panel</a>
        <?php elseif ($role === 'employer'): ?>
            <a href="post_job.php">📄 Post Job</a>
            <a href="employer_jobs.php">📂 Manage Jobs</a>
        <?php elseif ($role === 'jobseeker'): ?>
            <a href="browse_jobs.php">🔍 Browse Jobs</a>
            <a href="my_applications.php">📬 My Applications</a>
        <?php endif; ?>
    </div>

    <div>
        <a href="logout.php">🚪 Logout</a>
    </div>
</div>