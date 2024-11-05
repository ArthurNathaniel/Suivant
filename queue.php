<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivant - Select Your Purpose</title>
    <?php include 'cdn.php';?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/queue.css">
</head>
<body>

    <div class="container">
    <div class="logo_image">
            <img src="./images/UBA-Logo.png" alt="">
        </div>
        <h2>Select Your Purpose</h2>
        <form action="generate_ticket.php" method="POST">
            <div class="form-group">
                <select name="purpose" required>
                    <option value="" disabled selected>Select one...</option>
                    <option value="Deposit">Deposit</option>
                    <option value="Withdrawal">Withdrawal</option>
                    <option value="Account Opening">Account Opening</option>
                    <option value="Account Inquiry">Account Inquiry</option>
                    <option value="Loan Application">Loan Application</option>
                    <option value="Credit Card Services">Credit Card Services</option>
                    <option value="General Inquiry">General Inquiry</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <button type="submit" class="btn">Submit</button>
        </form>
    </div>

</body>
</html>
