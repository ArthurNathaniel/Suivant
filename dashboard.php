<?php
include 'db.php';

// Function to get ticket counts for different periods
function getTicketCounts($conn, $period) {
    $stmt = null;

    switch ($period) {
        case 'today':
            $stmt = $conn->prepare("SELECT purpose, COUNT(*) as count FROM tickets WHERE DATE(created_at) = CURDATE() GROUP BY purpose");
            break;
        case 'this_week':
            $stmt = $conn->prepare("SELECT purpose, COUNT(*) as count FROM tickets WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1) GROUP BY purpose");
            break;
        case 'this_month':
            $stmt = $conn->prepare("SELECT purpose, COUNT(*) as count FROM tickets WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE()) GROUP BY purpose");
            break;
        case 'this_year':
            $stmt = $conn->prepare("SELECT purpose, COUNT(*) as count FROM tickets WHERE YEAR(created_at) = YEAR(CURDATE()) GROUP BY purpose");
            break;
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get ticket counts for different periods
$dataToday = getTicketCounts($conn, 'today');
$dataThisWeek = getTicketCounts($conn, 'this_week');
$dataThisMonth = getTicketCounts($conn, 'this_month');
$dataThisYear = getTicketCounts($conn, 'this_year');

// Combine results into an associative array
$results = [
    'today' => $dataToday,
    'this_week' => $dataThisWeek,
    'this_month' => $dataThisMonth,
    'this_year' => $dataThisYear,
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivant - Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/dashboard.css">
</head>
<body>

<div class="container">
    <h1>Dashboard</h1>

    <div>
        <h2>Today</h2>
        <canvas id="todayChart"></canvas>
    </div>

    <div>
        <h2>This Week</h2>
        <canvas id="thisWeekChart"></canvas>
    </div>

    <div>
        <h2>This Month</h2>
        <canvas id="thisMonthChart"></canvas>
    </div>

    <div>
        <h2>This Year</h2>
        <canvas id="thisYearChart"></canvas>
    </div>
</div>

<script>
    const results = <?php echo json_encode($results); ?>;

    const getChartData = (data) => {
        const purposeLabels = [];
        const purposeCounts = [];

        data.forEach(item => {
            purposeLabels.push(item.purpose);
            purposeCounts.push(item.count);
        });

        return { labels: purposeLabels, counts: purposeCounts };
    };

    // Get data for each period
    const todayData = getChartData(results.today);
    const thisWeekData = getChartData(results.this_week);
    const thisMonthData = getChartData(results.this_month);
    const thisYearData = getChartData(results.this_year);

    // Function to create a chart
    const createChart = (canvasId, labels, counts, title) => {
        const ctx = document.getElementById(canvasId).getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: title,
                    data: counts,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Tickets'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Ticket Purpose'
                        }
                    }
                }
            }
        });
    };

    // Get all unique purposes from the results
    const allPurposes = Array.from(new Set([
        ...todayData.labels,
        ...thisWeekData.labels,
        ...thisMonthData.labels,
        ...thisYearData.labels
    ]));

    const todayCounts = allPurposes.map(purpose => todayData.counts[todayData.labels.indexOf(purpose)] || 0);
    const thisWeekCounts = allPurposes.map(purpose => thisWeekData.counts[thisWeekData.labels.indexOf(purpose)] || 0);
    const thisMonthCounts = allPurposes.map(purpose => thisMonthData.counts[thisMonthData.labels.indexOf(purpose)] || 0);
    const thisYearCounts = allPurposes.map(purpose => thisYearData.counts[thisYearData.labels.indexOf(purpose)] || 0);

    // Create charts for each period
    createChart('todayChart', allPurposes, todayCounts, 'Today');
    createChart('thisWeekChart', allPurposes, thisWeekCounts, 'This Week');
    createChart('thisMonthChart', allPurposes, thisMonthCounts, 'This Month');
    createChart('thisYearChart', allPurposes, thisYearCounts, 'This Year');
</script>

</body>
</html>
