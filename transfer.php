<?php
include 'db.php';
include 'views/header.php';

$sql = "SELECT * FROM customers";
$customers = $conn->query($sql);
?>

<style>
    *{
        font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
    }
    
</style>

<h1>Transfer Money</h1>
<form action="transfer_action.php" method="POST">
    <table id="customers-view">
        <tr>
            <td><label for="sender_id">Sender:</label></td>
            <td>
                <select name="sender_id" id="sender_id" class="dropdown_name">
                <?php while($row = $customers->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php endwhile; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="receiver_id">Receiver:</label></td>
            <td>
                <select name="receiver_id" id="receiver_id" class="dropdown_name">
                <?php
                $customers->data_seek(0);
                while($row = $customers->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php endwhile; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="amount">Amount:</label></td>
            <td><input type="number" name="amount" id="amount" step="0.01" required class="dropdown_name"></td>
        </tr>
        
    </table>
    <div class="button-container">
        <button type="submit" id="transfer_button">Transfer</button>
    </div>
</form>

<?php include 'views/footer.php'; ?>
