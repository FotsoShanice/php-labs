<?php
class Member {
    public $name;
    public $email;
    public $membership_date;

    public function __construct($name, $email, $membership_date) {
        $this->name = $name;
        $this->email = $email;
        $this->membership_date = $membership_date;
    }

    public function viewBorrowedBooks($books) {
        echo "<div class='output'>
                <strong>Name:</strong> {$this->name}<br>
                <strong>Email:</strong> {$this->email}<br>
                <strong>Member Since:</strong> {$this->membership_date}<br>
                <strong>Borrowed Books:</strong> " . implode(", ", $books) . "
              </div>";
    }
}

$member = new Member("Alice Smith", "alice@example.com", "2023-01-01");
$borrowed = ["Introduction to OOP"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Member</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        h1 { color: #222; }
        .output { background: #e8f5e9; padding: 15px; border-left: 4px solid #66BB6A; }
    </style>
</head>
<body>
    <h1>Member Page</h1>
    <?php $member->viewBorrowedBooks($borrowed); ?>
</body>
</html>