<?php  ?>
<style>
  nav {
    background-color: #007bff;
    padding: 12px 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
  nav a {
    color: white;
    text-decoration: none;
    margin-right: 18px;
    font-weight: 600;
    font-size: 16px;
  }
  nav a:hover {
    text-decoration: underline;
  }
  nav .welcome {
    color: #d1e7ff;
    margin-right: 20px;
    font-weight: 500;
  }
</style>

<nav>
  <?php if (isset($_SESSION['username'])): ?>
    <span class="welcome">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
    <?php if ($_SESSION['role'] === 'employer'): ?>
      <a href="browse_jobs.php">Browse Jobs</a>
      <a href="post_job.php">Post Job</a>
      <a href="employer_dashboard.php">Dashboard</a>
    <?php elseif ($_SESSION['role'] === 'jobseeker'): ?>
      <a href="browse_jobs.php">Browse Jobs</a>
      <a href="jobseeker_dashboard.php">Dashboard</a>
    <?php elseif ($_SESSION['role'] === 'admin'): ?>
      <a href="admin_panel.php">Admin Panel</a>
    <?php endif; ?>
    <a href="logout.php">Logout</a>
  <?php else: ?>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
  <?php endif; ?>
</nav>