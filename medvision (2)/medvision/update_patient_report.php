<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST["patient_id"];
    $report_type = $_POST["report_type"];

    // Upload new file
    function uploadFile($field_name) {
        $upload_dir = "uploads/medical_reports/";
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

        if (!empty($_FILES[$field_name]["name"])) {
            $file_name = time() . "_" . basename($_FILES[$field_name]["name"]);
            $file_path = $upload_dir . $file_name;
            move_uploaded_file($_FILES[$field_name]["tmp_name"], $file_path);
            return $file_path;
        }
        return NULL;
    }

    $new_file = uploadFile("new_report");

    if ($new_file) {
        // First, delete the old report file from the server
        $sql_get_old = "SELECT $report_type FROM patients WHERE id='$patient_id'";
        $result = $conn->query($sql_get_old);
        if ($result->num_rows > 0) {
            $patient = $result->fetch_assoc();
            $old_file = $patient[$report_type];

            if (file_exists($old_file)) {
                unlink($old_file); // Delete old file
            }
        }

        // Update the database with the new file path
        $sql = "UPDATE patients SET $report_type='$new_file' WHERE id='$patient_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Report updated successfully!";
        } else {
            echo "Error updating report: " . $conn->error;
        }
    } else {
        echo "Failed to upload new report.";
    }
}

$conn->close();
?>
