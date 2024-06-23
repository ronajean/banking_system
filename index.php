<?php include 'views/header.php'; ?>

<h1>
    Welcome to the Banking System
</h1>

<div id = "desc">
    <p >
        This is a simple banking system that allows you to view all users, transfer money between users, and view transaction history.
    </p>
    <p>
        To get started, click on one of the buttons below.
    </p>
</div>

<div id="button-container" style="text-align: center; margin-top: 50px;">
    
    <p><button class="button-style" onclick="location.href='customers-view.php'">View Users</button></p>
    <p><button class="button-style" onclick="location.href='transfer.php'">Transfer Money</button></p>
    <p><button class="button-style" onclick="location.href='transactions.php'">Transaction History</button></p>
</div>


<?php include 'views/footer.php'; ?>