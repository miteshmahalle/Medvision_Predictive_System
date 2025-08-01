<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $last_name = $_POST["last_name"];
    $dob = $_POST["dob"];
    $contact = $_POST["contact"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $aadhar_number = $_POST["aadhar_number"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $upload_dir = "uploads/doctor_certificates/";
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

    function uploadFile($field_name) {
        global $upload_dir;
        if (!empty($_FILES[$field_name]["name"])) {
            $file_name = time() . "_" . basename($_FILES[$field_name]["name"]);
            $file_path = $upload_dir . $file_name;
            move_uploaded_file($_FILES[$field_name]["tmp_name"], $file_path);
            return $file_path;
        }
        return NULL;
    }

    $degree_certificate = uploadFile("degree_certificate");

    $sql = "INSERT INTO doctors (first_name, middle_name, last_name, dob, contact, email, address, aadhar_number, password_hash, degree_certificate)
            VALUES ('$first_name', '$middle_name', '$last_name', '$dob', '$contact', '$email', '$address', '$aadhar_number', '$password', '$degree_certificate')";

    if ($conn->query($sql) === TRUE) {
        echo "Doctor registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
