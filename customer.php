<?php
include 'db.php';
include 'views/header.php';

$id = $_GET['id'];

// Fetch customer details
$sql = "SELECT * FROM customers WHERE id = $id";
$result = $conn->query($sql);
$customer = $result->fetch_assoc();

// Fetch transactions involving the customer
$transactions_sql = "
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
    WHERE 
        t.sender_id = $id OR t.receiver_id = $id
    ORDER BY 
        t.transfer_date DESC
";
$transactions_result = $conn->query($transactions_sql);
?>

<style>
    *{
        font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
    }
    
</style>

<h1><?= $customer['name'] ?></h1>
<table id="customers-view">
    <thead>
        <tr>
            <th colspan="2" style="text-align: center;">User Details</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>ID:</td>
            <td><?= $customer['id'] ?></td>
        </tr>
        <tr>
            <td>Name:</td>
            <td><?= $customer['name'] ?></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><?= $customer['email'] ?></td>
        </tr>
        <tr>
            <td>Current Balance:</td>
            <td><?= $customer['current_balance'] ?></td>
        </tr>
    </tbody>
</table>

<h2 style="text-align: center; margin-top:40px;">Transaction History</h2>
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
