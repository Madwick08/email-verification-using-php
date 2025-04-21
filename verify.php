<?php
$email = $_POST['email'];
$otp = $_POST['otp'];


$conn = new mysqli("localhost", "root", "", "infosec_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND otp=? AND otp_expiry >= NOW()");
$stmt->bind_param("ss", $email, $otp);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    echo "<script>alert('OTP Verified! Welcome.'); window.location.href='welcome.html';</script>";
} else {
    echo "<script>alert('Invalid or expired OTP. Try again.'); window.location.href='login.html';</script>";
}
?>
