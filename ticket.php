<?php
include 'db.php';

// Check if the ticket ID is provided
if (isset($_GET['id'])) {
    $ticketId = $_GET['id'];

    // Fetch the ticket details from the database
    $stmt = $conn->prepare("SELECT * FROM tickets WHERE id = :id");
    $stmt->bindParam(':id', $ticketId);
    $stmt->execute();
    $ticket = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$ticket) {
        echo "Invalid Ticket ID";
        exit();
    }
} else {
    echo "No Ticket ID provided!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivant - Your Ticket</title>
    <?php include 'cdn.php';?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/ticket.css">
    <style>
        /* Add any additional styles if necessary */
    </style>
</head>
<body>

    <div class="container">
        <div class="logo_image">
            <img src="./images/UBA-Logo.png" alt="">
        </div>
        <?php
        // Format the created_at date and time
        $createdAt = new DateTime($ticket['created_at']);
        $formattedDate = $createdAt->format('Y-m-d'); // Format: YYYY-MM-DD
        $formattedTime = $createdAt->format('h:i A'); // Format: HH:MM AM/PM
        ?>
        <div class="ticket-details"><strong>Date:</strong> <?php echo htmlspecialchars($formattedDate); ?></div>
        <div class="ticket-details"><strong>Time:</strong> <?php echo htmlspecialchars($formattedTime); ?></div>
        <div class="ticket-details"><strong>Purpose:</strong> <?php echo htmlspecialchars($ticket['purpose']); ?></div>
        <div class="ticket-details"><strong>Ticket Number:</strong> <?php echo htmlspecialchars($ticket['ticket_number']); ?></div>
        


        <!-- <button class="btn" onclick="window.print()">Print Ticket</button> -->
        <div class="dash">
        <p class="powered">Powered by Suivant </p>
        </div>
        

    </div>
    <script>
        // Automatically trigger print dialog when the page is loaded
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
