<?php
include 'db.php';

$sender_id = $_POST['sender_id'];
$receiver_id = $_POST['receiver_id'];
$amount = $_POST['amount'];

$conn->autocommit(FALSE);

$sender_sql = "SELECT current_balance, name FROM customers WHERE id = $sender_id";
$sender_result = $conn->query($sender_sql);
$sender = $sender_result->fetch_assoc();

if ($sender['current_balance'] >= $amount) {
    $update_sender = "UPDATE customers SET current_balance = current_balance - $amount WHERE id = $sender_id";
    $update_receiver = "UPDATE customers SET current_balance = current_balance + $amount WHERE id = $receiver_id";
    $insert_transfer = "INSERT INTO transfers (sender_id, receiver_id, amount) VALUES ($sender_id, $receiver_id, $amount)";

    if ($conn->query($update_sender) && $conn->query($update_receiver) && $conn->query($insert_transfer)) {
        $conn->commit();

        // Fetch sender and receiver names
        $sender_name = $sender['name'];
        $receiver_result = $conn->query("SELECT name FROM customers WHERE id = $receiver_id");
        $receiver = $receiver_result->fetch_assoc();
        $receiver_name = $receiver['name'];

        // Display success message as a pop-up
        echo "<script>
            alert('Successfully transferred Php $amount from $sender_name to $receiver_name!');
            window.location.href = 'customers-view.php'; // Redirect to the desired page after clicking OK
        </script>";
    } else {
        $conn->rollback();

        // Display failure message as a pop-up
        echo "<script>
            alert('Transfer failed!');
            window.location.href = 'customers-view.php'; // Redirect to the desired page after clicking OK
        </script>";
    }
} else {
    // Display insufficient balance message as a pop-up
    echo "<script>
        alert('Insufficient balance!');
        window.location.href = 'customers-view.php'; // Redirect to the desired page after clicking OK
    </script>";
}

$conn->autocommit(TRUE);
?>
