<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contact = $_POST["contact"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM patients WHERE contact='$contact'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password_hash"])) {
            $_SESSION["patient_id"] = $row["id"];
            $_SESSION["patient_name"] = $row["first_name"];
            header("Location: patient_dashboard.php"); // Redirect to dashboard
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
