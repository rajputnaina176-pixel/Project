<?php
$conn = mysqli_connect("localhost", "root", "", "database");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Validate and sanitize registration number from GET
if (!isset($_GET['reg_num']) || !is_numeric($_GET['reg_num'])) {
    die("Invalid or missing registration number.");
}
$reg = (int) $_GET['reg_num']; // Cast to integer for safety

// Handle selected date from POST or GET
$selected_date = '';
if (isset($_POST['filter_date'])) {
    $selected_date = $_POST['filter_date'];
} elseif (isset($_GET['click_date'])) {
    $selected_date = $_GET['click_date'];
}

// Fetch unique transaction dates for the specific student
$date_sql = "SELECT DISTINCT `Date` FROM transcation_info 
             WHERE S_REG_NUM = $reg AND `Date` != '0000-00-00' 
             ORDER BY `Date` DESC";
$date_result = mysqli_query($conn, $date_sql);

// Fetch transactions for the specific student and selected date (if any)
$txn_sql = "SELECT t.*, 
                   s.First_Name, 
                   s.Father_Name, 
                   s.class_nm1 AS student_class, 
                   s.Section AS student_section
            FROM transcation_info t
            JOIN students s ON t.S_REG_NUM = s.S_REG_NUM
            WHERE t.S_REG_NUM = $reg";

if (!empty($selected_date)) {
    $safe_date = mysqli_real_escape_string($conn, $selected_date);
    $txn_sql .= " AND t.Date = '$safe_date'";
}

$txn_sql .= " ORDER BY t.Date DESC";
$txn_result = mysqli_query($conn, $txn_sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaction History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .filter-box {
            margin: 20px 0;
        }
        .filter-box form {
            display: inline-block;
            margin-right: 20px;
        }
        .date-links a {
            margin-right: 10px;
            text-decoration: none;
            background: #ddd;
            padding: 5px 10px;
            border-radius: 5px;
            color: black;
        }
        .date-links a:hover {
            background-color: #bbb;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Transaction Records for Student #<?php echo htmlspecialchars($reg); ?></h2>

    <div class="filter-box">
        <!-- Date filter form -->
        <form method="POST" action="transactions_view.php?reg_num=<?php echo $reg; ?>">
            <label for="filter_date">Filter by Date:</label>
            <input type="date" id="filter_date" name="filter_date" value="<?php echo htmlspecialchars($selected_date); ?>">
            <input type="submit" value="Filter">
        </form>

        <!-- Quick Date Links -->
        <div class="date-links">
            <strong>Quick Dates:</strong>
            <?php while ($date_row = mysqli_fetch_assoc($date_result)) { ?>
                <a href="transactions_view.php?reg_num=<?php echo $reg; ?>&click_date=<?php echo $date_row['Date']; ?>">
                    <?php echo $date_row['Date']; ?>
                </a>
            <?php } ?>
        </div>
    </div>

    <!-- Transaction Table -->
    <table>
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Student Name</th>
                <th>Father Name</th>
                <th>Class</th>
                <th>Section</th>
                <th>Session</th>
                <th>Description</th>
                <th>For Month</th>
                <th>Monthly Fee</th>
                <th>Transaction Amount</th>
                <th>Transaction Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($txn_result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($txn_result)) { ?>
                    <tr>
                        <td><?php echo $row['Trans_id']; ?></td>
                        <td><?php echo $row['First_Name']; ?></td>
                        <td><?php echo $row['Father_Name']; ?></td>
                        <td><?php echo $row['student_class']; ?></td>
                        <td><?php echo $row['student_section']; ?></td>
                        <td><?php echo $row['st_session']; ?></td>
                        <td><?php echo $row['Description']; ?></td>
                        <td><?php echo $row['for_month']; ?></td>
                        <td><?php echo $row['Monthly_fee']; ?></td>
                        <td><?php echo $row['trans_amt']; ?></td>
                        <td><?php echo $row['Date']; ?></td>
                    </tr>
                <?php } ?>
            <?php else: ?>
                <tr>
                    <td colspan="11">
                        No transactions found<?php echo $selected_date ? " on $selected_date" : ""; ?>.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
