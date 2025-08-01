<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aadhar_number = trim($_POST["aadhar_number"]);
    if (empty($aadhar_number)) {
        die("<div class='error-message'>Aadhar number is required.</div>");
    }

    $sql = "SELECT * FROM patients WHERE aadhar_number = '$aadhar_number'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $patient = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patient Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #0A1931, #185ADB);
    }
  </style>
</head>
<body class="min-h-screen bg-gradient-to-r from-[#0A1931] to-[#264653] flex items-center justify-center p-6">

    <div class="w-full max-w-5xl bg-white rounded-2xl shadow-2xl p-8 space-y-10 text-gray-800">

        <!-- Header -->
        <h2 class="text-3xl font-bold text-center text-[#0A1931]">Patient Details</h2>

        <!-- Patient Info with Dummy Image -->
<!-- Patient Basic Info - Stylish Grid -->
<!-- Patient Basic Info - Mini Box Grid Style -->
<div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200">
    <h2 class="text-2xl font-bold text-center text-blue-800 mb-8">Patient Basic Information</h2>

    <!-- Profile Image Centered -->
    <div class="flex justify-center mb-6">
        <img src="images/p1.png" alt="Patient Photo" class="w-28 h-28 rounded-full border-4 border-[#2A9D8F] shadow-md">
    </div>

    <!-- Info Grid in Mini Boxes -->
    <div class="grid grid-cols-3 sm:grid-cols-3 lg:grid-cols-3 gap-6">
        <!-- Box -->
        <div class="bg-gray-50 rounded-xl p-4 shadow hover:shadow-md transition">
            <p class="text-sm text-gray-500">Full Name</p>
            <p class="font-semibold text-blue-900"><?php echo $patient['first_name'] . " " . $patient['last_name']; ?></p>
        </div>

        <div class="bg-gray-50 rounded-xl p-4 shadow hover:shadow-md transition">
            <p class="text-sm text-gray-500">Email</p>
            <p class="font-semibold text-blue-900"><?php echo $patient['email']; ?></p>
        </div>

        <div class="bg-gray-50 rounded-xl p-4 shadow hover:shadow-md transition">
            <p class="text-sm text-gray-500">Contact Number</p>
            <p class="font-semibold text-blue-900"><?php echo $patient['contact']; ?></p>
        </div>

        <div class="bg-gray-50 rounded-xl p-4 shadow hover:shadow-md transition">
            <p class="text-sm text-gray-500">Aadhar Number</p>
            <p class="font-semibold text-blue-900"><?php echo $patient['aadhar_number']; ?></p>
        </div>

        <div class="bg-gray-50 rounded-xl p-4 shadow hover:shadow-md transition">
            <p class="text-sm text-gray-500">Date of Birth</p>
            <p class="font-semibold text-blue-900"><?php echo $patient['dob']; ?></p>
        </div>

       
        <div class="bg-gray-50 rounded-xl p-4 shadow hover:shadow-md transition">
            <p class="text-sm text-gray-500">Registered On</p>
            <p class="font-semibold text-blue-900"><?php echo date("d M Y", strtotime($patient['created_at'])); ?></p>
        </div>
        <div class="bg-gray-50 rounded-xl p-4 shadow hover:shadow-md transition sm:col-span-2 lg:col-span-3">
            <p class="text-sm text-gray-500">Address</p>
            <p class="font-semibold text-blue-900"><?php echo $patient['address']; ?></p>
        </div>

    </div>
</div>



        <!-- Report Section - Card Based -->
<!-- Medical Reports -->
<div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-200 mt-12">
    <h2 class="text-2xl font-bold text-center text-blue-800 mb-8">Medical Reports</h2>
    
    <ul class="space-y-6">
        <?php
        function displayReport($type, $label, $icon, $patient) {
            if (!empty($patient[$type])) {
                echo "
                <li class='flex items-center justify-between bg-gray-50 p-5 rounded-xl shadow-md border border-gray-200 hover:shadow-lg transition'>
                    <!-- Left (Icon + Link) -->
                    <div class='flex items-center gap-4'>
                        <img src='images/$icon' alt='$label Icon' class='w-10 h-10'>
                        <a href='" . $patient[$type] . "' target='_blank' class='text-blue-700 font-semibold underline text-lg hover:text-blue-900'>$label</a>
                    </div>

                    <!-- Right (Update + Delete) -->
                    <div class='flex items-center gap-4'>
                        <form action='update_patient_report.php' method='POST' enctype='multipart/form-data' class='flex items-center gap-2'>
                            <input type='hidden' name='patient_id' value='" . $patient['id'] . "'>
                            <input type='hidden' name='report_type' value='$type'>
                            <input type='file' name='new_report' accept='application/pdf' class='text-sm border border-gray-300 rounded px-2 py-1' required>
                            <button type='submit' class='bg-green-500 text-white px-4 py-1.5 rounded hover:bg-green-600 font-medium text-sm'>Update</button>
                        </form>
                        <a href='delete_patient_report.php?id=" . $patient['id'] . "&type=$type'>
                            <button class='bg-red-500 text-white px-4 py-1.5 rounded hover:bg-red-600 font-medium text-sm'>Delete</button>
                        </a>
                    </div>
                </li>";
            }
        }

        displayReport('blood_report', 'Blood Report', 'blood.png', $patient);
        displayReport('urine_report', 'Urine Report', 'urine.png', $patient);
        displayReport('ecg_report', 'ECG Report', 'ecg.png', $patient);
        displayReport('xray_report', 'X-Ray Report', 'xray.png', $patient);
        displayReport('vaccination_record', 'Vaccination Record', 'vaccine.png', $patient);
        displayReport('previous_surgery', 'Previous Surgery Report', 'medicine.png', $patient);
        ?>
    </ul>
</div>

<div class="mt-10 flex justify-center">
    <a href="doctor_dashboard.php" class="inline-block bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-xl font-semibold transition duration-200 shadow-md">
        ← Back to Dashboard
    </a>
</div>


</body>
</html>
<?php
    }
}
$conn->close();
?>
