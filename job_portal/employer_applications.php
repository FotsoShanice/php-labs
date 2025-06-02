<?php
session_start();
require_once 'db_conn.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$employer_id = $_SESSION['user_id'];

$sql = "
    SELECT 
        a.id,
        u.name AS applicant_name,
        u.email AS applicant_email,
        j.job_title,
        a.cover_letter,
        a.applied_at
    FROM job_applications a
    JOIN users u ON a.user_id = u.id
    JOIN jobs j ON a.job_id = j.id
    WHERE j.user_id = ?
    ORDER BY a.applied_at DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $employer_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Job Applications</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 30px;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            background: #fff;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 1px 6px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
        }
        th {
            background-color: #2c3e50;
            color: white;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        .cover-letter {
            white-space: pre-wrap;
        }
    </style>
</head>
<body>

<h2>Applications for My Job Posts</h2>

<?php if ($result && $result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Job Title</th>
                <th>Applicant</th>
                <th>Email</th>
                <th>Cover Letter</th>
                <th>Applied At</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= htmlspecialchars($row['job_title']) ?></td>
                    <td><?= htmlspecialchars($row['applicant_name']) ?></td>
                    <td><?= htmlspecialchars($row['applicant_email']) ?></td>
                    <td class="cover-letter"><?= nl2br(htmlspecialchars($row['cover_letter'])) ?></td>
                    <td><?= $row['applied_at'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No applications yet for your jobs.</p>
<?php endif; ?>

</body>
</html>