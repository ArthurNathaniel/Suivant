<?php
include 'db.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the selected purpose
    $purpose = $_POST['purpose'];

    // Generate a random ticket number
    $ticketNumber = 'TKT' . rand(1000, 9999);

    // Insert the ticket into the database
    $stmt = $conn->prepare("INSERT INTO tickets (purpose, ticket_number) VALUES (:purpose, :ticket_number)");
    $stmt->bindParam(':purpose', $purpose);
    $stmt->bindParam(':ticket_number', $ticketNumber);
    $stmt->execute();

    // Get the ID of the inserted ticket
    $ticketId = $conn->lastInsertId();

    // Redirect to the ticket display page with the ticket ID
    header("Location: ticket.php?id=$ticketId");
    exit();
} else {
    // Redirect back to the form if accessed directly
    header("Location: queue.php");
    exit();
}
?>
