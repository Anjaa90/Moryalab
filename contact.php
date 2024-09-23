<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $tests = htmlspecialchars($_POST['tests']);
    $dateTime = htmlspecialchars($_POST['dateTime']);

    // Optionally, connect to a database to store the data
    /*
    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO appointments (name, phone, address, tests, dateTime) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $phone, $address, $tests, $dateTime);

    // Execute the statement
    $stmt->execute();
    $stmt->close();
    $conn->close();
    */

    // Optionally, send an email notification
    if (!mail("contact@moryalabs.in", "New Appointment", "Name: $name\nPhone: $phone\nAddress: $address\nTests: $tests\nDate & Time: $dateTime")) {
        error_log("Failed to send email to contact@moryalabs.in");
    }

    // Redirect to confirmation page
    header("Location: confirmation.php?name=$name&phone=$phone&address=$address&tests=$tests&dateTime=$dateTime");
    exit();
} else {
    // If the form was not submitted, redirect back to the form
    header("Location: index.php");
    exit();
}
?>
