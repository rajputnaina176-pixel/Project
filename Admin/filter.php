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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            line-height: 1.6;
            padding: 20px;
            background-color: #f5f5f5;
            color: #333;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 25px;
            text-align: center;
            font-size: 1.8rem;
            padding: 15px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Filter box styles */
        .filter-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .filter-box form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: 600;
            color: #2c3e50;
        }

        input[type="date"] {
            padding: 10px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        input[type="date"]:focus {
            border-color: #3498db;
            outline: none;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        /* Date links styles */
        .date-links {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        .date-links strong {
            color: #2c3e50;
            margin-right: 10px;
        }

        .date-links a {
            background: #e9ecef;
            padding: 8px 15px;
            border-radius: 6px;
            color: #2c3e50;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .date-links a:hover {
            background-color: #3498db;
            color: white;
            transform: translateY(-2px);
        }

        /* Table styles */
        .table-container {
            overflow-x: auto;
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            min-width: 1000px;
            background: white;
        }

        table th {
            background-color: #3498db;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            white-space: nowrap;
        }

        table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Responsive design */
        @media screen and (max-width: 1024px) {
            body {
                padding: 15px;
            }

            h2 {
                font-size: 1.6rem;
            }

            .filter-box {
                padding: 15px;
            }
        }

        @media screen and (max-width: 768px) {
            h2 {
                font-size: 1.4rem;
                padding: 12px;
            }

            .filter-box form {
                flex-direction: column;
                align-items: stretch;
            }

            input[type="date"],
            input[type="submit"] {
                width: 100%;
            }

            .date-links {
                flex-direction: column;
                align-items: stretch;
            }

            .date-links a {
                text-align: center;
            }
        }

        @media screen and (max-width: 480px) {
            body {
                padding: 10px;
            }

            h2 {
                font-size: 1.2rem;
                padding: 10px;
            }

            .filter-box {
                padding: 12px;
            }

            table th,
            table td {
                padding: 8px;
                font-size: 0.9rem;
            }
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
    <div class="table-container">
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
    </div>

</body>
</html>
