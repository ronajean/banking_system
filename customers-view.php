<?php
include 'db.php';
include 'views/header.php';

$sql = "SELECT * FROM customers";
$result = $conn->query($sql);
?>

<h1>All Customers</h1>
<table id="customers-view">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Balance</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr class="clickable-row" data-id="<?= $row['id']; ?>">
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['current_balance'] ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Select all rows with the class 'clickable-row'
    const rows = document.querySelectorAll('.clickable-row');

    // Add a click event listener to each row
    rows.forEach(row => {
        row.addEventListener('click', () => {
            // Retrieve the data-id attribute value
            const id = row.getAttribute('data-id');
            // Redirect to the customer.php page with the ID as a query parameter
            window.location.href = `customer.php?id=${id}`;
        });
    });
});
</script>

<?php include 'views/footer.php'; ?>