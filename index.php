<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "us_trip";

$con = mysqli_connect($server, $username, $password, $database);

if (!$con) {
    die("Database connection failed");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $desc = $_POST['other'];
    
    $stmt = $con->prepare("INSERT INTO trip (name, age, gender, email, phone, other, dt) VALUES (?, ?, ?, ?, ?, ?, current_timestamp())");
    $stmt->bind_param("sissss", $name, $age, $gender, $email, $phone, $desc);
    
    if ($stmt->execute()) {
        header("Location: index.html?success=1");
    } else {
        echo "Error submitting form";
    }
    
    $stmt->close();
    mysqli_close($con);
}
?>