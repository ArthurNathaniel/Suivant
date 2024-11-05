<?php
include 'db.php'; // Include the database connection

// Query to retrieve all tickets
$stmt = $conn->prepare("SELECT * FROM tickets ORDER BY id DESC"); // Adjust the table name if necessary
$stmt->execute();
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Tickets</title>
        <?php include 'cdn.php';?>
    <link rel="stylesheet" href="./css/base.css">
</head>
<body>
    <div class="container">
        <h1>View Tickets</h1>

        <?php if (count($tickets) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Purpose</th>
                        <th>Ticket Number</th>
                        <th>Date Created</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tickets as $ticket): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($ticket['id']); ?></td>
                            <td><?php echo htmlspecialchars($ticket['purpose']); ?></td>
                            <td><?php echo htmlspecialchars($ticket['ticket_number']); ?></td>
                            <td><?php echo htmlspecialchars($ticket['created_at']); ?></td> <!-- Adjust field name as necessary -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No tickets found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
