<?php
include 'connection.php';
$query = "SELECT * FROM images where id = '" . $_GET['id'] . "'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$image = $row["Flags"];
$image = base64_encode($image);
$image = "data:image/png;base64," . $image;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchasing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>PAYMENT</title>
    <style>
        img {
            width: 50%;
            border: 5px solid black;
        }
    </style>
</head>

<body>
    <?php
    include("header.php");
    ?>
    <div class="container mb-5">
        <img src="<?= $image ?>" alt="<?= $row['Name'] ?> " class="mb-2">
        <h1>
            <?= $row['Name'] ?>
        </h1>
        <h4 class="mt-3">
            Price: $
            <?= $row['Price'] ?>
        </h4>
        <br>
        <form action="buy_process.php" method="get">
            <label for="MONEY" class="fw-bold">YOUR MONEY</label><br>
            <input type="number" name="Money" id="MONEY" class="form-control" value="25" required>
            <br>
            <div id="moneyWarning" style="color: red;margin-bottom:-50px;" class="h4"></div>
            <!-- Display the warning here -->
            <br><br>
            <label for="QTY" class="fw-bold mt-4">QUANTITY</label><br>
            <input type="number" name="quantity" id="QTY" class="form-control" value="1" required><BR></BR>
            <div id="errorDecimal" style="color: red;margin-top:-25px;" class="h4 mb-4x`"></div>
            <input type="submit" name="" id="submit" class="btn btn-info btn-lg fw-bold">
            <input type="hidden" name = "id" value="<?= $_GET['id'] ?>">

        </form>
    </div>
    <script>
        var price = <?= $row['Price'] ?>;
        const Money = document.getElementById('MONEY');
        const Qty = document.getElementById('QTY');
        const moneyWarning = document.getElementById('moneyWarning');
        const submit = document.getElementById('submit');

        // Function to check if the entered money is less than the total cost
        function checkMoney() {
            const enteredMoney = Money.value || 25;
            const enteredQTY = Qty.value || 1;

            const totalCost = price * enteredQTY;

            if (enteredMoney < totalCost) {
                moneyWarning.textContent = "Not Enough Money!!!";
                submit.disabled = true;
            } else {
                moneyWarning.textContent = "";
                submit.disabled = false;
            }
            if (enteredQTY % 1 !== 0) { // Check if it's a decimal
                errorDecimal.style.display = 'block';
                errorDecimal.textContent = "Please Enter An Integer Number";
                submit.disabled = true;
                moneyWarning.textContent = '';
            } else {
                errorDecimal.style.display = 'none';
                submit.disabled = false;
            }


        }
        // Attach the event listener to the "YOUR MONEY" input field
        Money.addEventListener('input', checkMoney);
        Qty.addEventListener('input', checkMoney); // Listen to changes in quantity as well


    </script>
</body>

</html>