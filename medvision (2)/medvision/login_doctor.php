<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contact = $_POST["contact"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM doctors WHERE contact='$contact'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password_hash"])) {
            $_SESSION["doctor_id"] = $row["id"];
            $_SESSION["doctor_name"] = $row["first_name"];
            header("Location: doctor_dashboard.php"); // Redirect to doctor panel
            exit();
        } else {
            echo "Invalid credentials!";
        }
    } else {
        echo "User not found!";
    }
}

$conn->close();
?>
