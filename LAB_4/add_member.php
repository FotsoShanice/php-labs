<!DOCTYPE html>
<html>
<head>
    <title>Add Member</title>
    <style>
        body { font-family: Arial; background: #eef; padding: 30px; }
        form { background: white; padding: 20px; border-radius: 8px; max-width: 400px; margin: auto; }
        input[type="text"], input[type="email"], input[type="date"] {
            width: 100%; padding: 10px; margin: 10px 0;
        }
        input[type="submit"] {
            background: #4CAF50; color: white; padding: 10px; border: none; width: 100%;
        }
    </style>
</head>
<body>
    <h2 align="center">Add Member</h2>
    <form method="POST" action="process_member.php">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="date" name="membership_date" required>
        <input type="submit" value="Add Member">
    </form>
</body>
</html>