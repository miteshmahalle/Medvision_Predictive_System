<?php
session_start();
include 'config.php';

if (!isset($_SESSION["patient_id"])) {
    die("Unauthorized access. Please login first.");
}

$patient_id = $_SESSION["patient_id"];
$sql = "SELECT * FROM patients WHERE id='$patient_id'";
$result = $conn->query($sql);
$patient = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patient Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
</head>
<style>
     body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #0A1931, #185ADB);
    }
</style>
<body class="bg-blue-950 text-gray-800 font-sans min-h-screen flex items-center justify-center px-4">

    <div class="bg-white rounded-xl shadow-2xl w-full max-w-4xl p-8 space-y-8 text-center">

        <!-- Welcome Panel -->
        <div class="bg-blue-900 text-white p-6 rounded-lg shadow">
            <h2 class="text-3xl font-bold">Welcome, <?php echo $patient['first_name']; ?>!</h2>
        </div>

        <!-- Basic Info Panel -->
       <!-- Basic Info Panel with Dummy Image -->
<!-- Basic Info Panel with Square Profile Image -->
<!-- Basic Info Panel (Modern UI-style) -->
<div class="panel bg-white shadow-lg p-6 rounded-xl mb-8 w-full max-w-4xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
        <!-- Profile Image -->
        <div class="flex justify-center md:justify-start">
        <img src="images/p1.png" alt="Profile Image" class="w-40 h-40 object-cover rounded-lg border-4 border-gray-300 shadow-md">

        </div>

        <!-- Info Grid -->
        <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4 text-left">
            <div>
                <p class="text-gray-500 text-sm font-semibold">Email</p>
                <p class="text-lg font-medium text-gray-900"><?php echo $patient['email']; ?></p>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-semibold">Contact</p>
                <p class="text-lg font-medium text-gray-900"><?php echo $patient['contact']; ?></p>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-semibold">Aadhar Number</p>
                <p class="text-lg font-medium text-gray-900"><?php echo $patient['aadhar_number']; ?></p>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-semibold">Address</p>
                <p class="text-lg font-medium text-gray-900"><?php echo $patient['address']; ?></p>
            </div>
        </div>
    </div>
</div>




        <!-- Medical Reports Panel -->
       <div class="bg-gray-100 p-6 rounded-lg shadow">
            <h3 class="text-2xl font-bold text-blue-900 mb-6">Your Medical Reports</h3>
            <ul class="space-y-4 text-left">
                <?php if ($patient['blood_report']) { ?>
                    <li class="flex items-center justify-between bg-blue-100 p-4 rounded-md shadow">
                        <div class="flex items-center gap-4">
                            <img src="images/blood.png" alt="Blood Report" class="w-10 h-10">
                            <span class="font-medium">Blood Report</span>
                        </div>
                        <a href="<?php echo $patient['blood_report']; ?>" target="_blank" class="text-blue-700 hover:underline font-semibold">Download</a>
                    </li>
                <?php } ?>
                <?php if ($patient['urine_report']) { ?>
                    <li class="flex items-center justify-between bg-blue-100 p-4 rounded-md shadow">
                        <div class="flex items-center gap-4">
                            <img src="images/urine.png" alt="Urine Report" class="w-10 h-10">
                            <span class="font-medium">Urine Report</span>
                        </div>
                        <a href="<?php echo $patient['urine_report']; ?>" target="_blank" class="text-blue-700 hover:underline font-semibold">Download</a>
                    </li>
                <?php } ?> 
                <?php if ($patient['ecg_report']) { ?>
                    <li class="flex items-center justify-between bg-blue-100 p-4 rounded-md shadow">
                        <div class="flex items-center gap-4">
                            <img src="images/ecg.png" alt="ECG Report" class="w-10 h-10">
                            <span class="font-medium">ECG Report</span>
                        </div>
                        <a href="<?php echo $patient['ecg_report']; ?>" target="_blank" class="text-blue-700 hover:underline font-semibold">Download</a>
                    </li>
                <?php } ?>
                <?php if ($patient['xray_report']) { ?>
                    <li class="flex items-center justify-between bg-blue-100 p-4 rounded-md shadow">
                        <div class="flex items-center gap-4">
                            <img src="images/xray.png" alt="X-Ray Report" class="w-10 h-10">
                            <span class="font-medium">X-Ray Report</span>
                        </div>
                        <a href="<?php echo $patient['xray_report']; ?>" target="_blank" class="text-blue-700 hover:underline font-semibold">Download</a>
                    </li>
                <?php } ?>
                <?php if ($patient['vaccination_record']) { ?>
                    <li class="flex items-center justify-between bg-blue-100 p-4 rounded-md shadow">
                        <div class="flex items-center gap-4">
                            <img src="images/vaccine.png" alt="Vaccination Record" class="w-10 h-10">
                            <span class="font-medium">Vaccination Record</span>
                        </div>
                        <a href="<?php echo $patient['vaccination_record']; ?>" target="_blank" class="text-blue-700 hover:underline font-semibold">Download</a>
                    </li>
                <?php } ?>
                <?php if ($patient['previous_surgery']) { ?>
                    <li class="flex items-center justify-between bg-blue-100 p-4 rounded-md shadow">
                        <div class="flex items-center gap-4">
                            <img src="images/medicine.png" alt="Previous Surgery Report" class="w-10 h-10">
                            <span class="font-medium">Previous Surgery Report</span>
                        </div>
                        <a href="<?php echo $patient['previous_surgery']; ?>" target="_blank" class="text-blue-700 hover:underline font-semibold">Download</a>
                    </li>
                <?php } ?>
            </ul>
        </div>

        <!-- Logout Button -->
        <form action="logout.php" method="POST">
            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition-all duration-200 mt-4">
                Logout
            </button>
        </form>

    </div>

</body>
</html>
