<?php
include 'config.php';

if (!isset($_GET['id']) || !isset($_GET['type'])) {
    die("Invalid request.");
}

$patient_id = $_GET['id'];
$report_type = $_GET['type']; // Example: "blood_report", "urine_report", etc.

// Fetch the file path from database
$sql = "SELECT $report_type FROM patients WHERE id='$patient_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $patient = $result->fetch_assoc();
    $file_path = $patient[$report_type];

    // Delete the file from the server
    if ($file_path && file_exists($file_path)) {
        unlink($file_path);
    }

    // Remove file path from database
    $sql = "UPDATE patients SET $report_type=NULL WHERE id='$patient_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Report deleted successfully!";
    } else {
        echo "Error deleting report: " . $conn->error;
    }
} else {
    echo "No report found.";
}

$conn->close();
?>
