<?php
session_start();
include 'config.php';

if (!isset($_SESSION["doctor_id"])) {
    die("Unauthorized access. Please login first.");
}

$doctor_id = $_SESSION["doctor_id"];
$sql = "SELECT * FROM doctors WHERE id='$doctor_id'";
$result = $conn->query($sql);
$doctor = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Doctor Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #0A1931, #185ADB);
    }
  </style>
<body class="min-h-screen flex items-center justify-center p-8">

    <div class="bg-white rounded-xl shadow-2xl max-w-3xl w-full space-y-8 p-10">

        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-blue-700 mb-3 ">Welcome, Dr. <?php echo $doctor['first_name']; ?>!</h2>
            <p class="text-gray-600 text-lg shadow-sm">Your dedicated patient management hub.</p>
        </div>

        <div class="bg-blue-700 rounded-lg shadow-xl p-8 flex flex-col items-center text-center">
            <div class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden shadow-md border-2 border-blue-200 mb-5">
                <img src="images/doctor.jpg" alt="Profile Image" class="w-full h-full object-cover">
            </div>
            <h3 class="text-xl font-semibold text-white shadow-sm"><?php echo $doctor['first_name'] . ' ' . $doctor['last_name'] ; ?></h3>
        </div>

        <div class="bg-white rounded-lg shadow-xl p-8">
            <h3 class="text-lg font-semibold text-green-700 text-center mb-5 shadow-sm">Find Patient by Aadhar Number</h3>
            <form action="search_patient.php" method="POST" class="space-y-5">
                <input type="text" name="aadhar_number" placeholder="Enter Aadhar Number" class="w-full px-4 py-3 rounded-md border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none shadow-inner" required>
                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-300 font-semibold mx-auto block shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 mr-2 inline-block">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                    Search
                </button>
            </form>
        </div>

        <form action="logout.php" method="POST" class="mt-6">
            <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300 font-semibold mx-auto block shadow-md">
               
                Logout
            </button>
        </form>
    </div>

</body>
</html>