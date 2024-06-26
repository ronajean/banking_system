<?php
// Assuming $conn is your database connection
include 'db.php'; // Include your database connection file
include 'views/header.php';

// Fetch all transactions
$transactions_result = $conn->query("
    SELECT 
        t.id, 
        t.amount, 
        s.name AS sender_name, 
        r.name AS receiver_name, 
        t.transfer_date 
    FROM 
        transfers t
    JOIN 
        customers s ON t.sender_id = s.id
    JOIN 
        customers r ON t.receiver_id = r.id
    ORDER BY 
        t.transfer_date DESC
");

?>

<style>
    * {
        font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
    }
    
</style>

    <h1>Transaction History</h1>

    <table id="customers-view">
        <thead>
            <tr>
                <th>ID</th>
                <th>Sender</th>
                <th>Receiver</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($transactions_result->num_rows > 0) {
                while ($row = $transactions_result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['sender_name']}</td>
                        <td>{$row['receiver_name']}</td>
                        <td>{$row['amount']}</td>
                        <td>{$row['transfer_date']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No transactions found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php include 'views/footer.php'; ?>