<?php
class Member {
    public $name, $email, $membership_date;
    function __construct($name, $email, $membership_date) {
        $this->name = $name;
        $this->email = $email;
        $this->membership_date = $membership_date;
    }
    function display() {
        echo "<div style='background:#fff;padding:20px;border-radius:6px;max-width:400px;margin:auto;
        box-shadow:0 0 10px #ccc;font-family:Arial;'>
        <h2>Member Added</h2>
        <p><strong>Name:</strong> $this->name</p>
        <p><strong>Email:</strong> $this->email</p>
        <p><strong>Joined On:</strong> $this->membership_date</p>
        </div>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $member = new Member($_POST['name'], $_POST['email'], $_POST['membership_date']);
    $member->display();
}
?>