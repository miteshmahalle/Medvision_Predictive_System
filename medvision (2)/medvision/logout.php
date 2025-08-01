<?php
session_start();
session_destroy();
header("Location: loginPatient.html"); // Redirect to patient login page
exit();
?>
