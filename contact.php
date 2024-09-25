<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $tests = htmlspecialchars($_POST['tests']);
    $dateTime = htmlspecialchars($_POST['dateTime']);

    // Convert the date format from YYYY-MM-DD to DD-MM-YY
    $dateTimeFormatted = date("d-m-y", strtotime($dateTime)); // Format to DD-MM-YY

    // Send the email
    $to = "contact@moryalabs.in";
    $subject = "New Appointment";
    $message = "Name: $name\nPhone: $phone\nAddress: $address\nTests: $tests\nDate & Time: $dateTimeFormatted";
    $headers = "From: noreply@moryalabs.in\r\n";

    if (!mail($to, $subject, $message, $headers)) {
        error_log("Failed to send email to $to");
    }

    // Redirect to confirmation page with query parameters
    header("Location: contact.php?name=" . urlencode($name) . "&phone=" . urlencode($phone) . "&address=" . urlencode($address) . "&tests=" . urlencode($tests) . "&dateTime=" . urlencode($dateTimeFormatted));
    exit();
} else {
    // If the form was not submitted, redirect back to the form
    header("Location: Appointment-confirmation.html");
    exit();
}
?>
