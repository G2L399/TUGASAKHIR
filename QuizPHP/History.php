<?php
session_start();
include('connection.php');
include("header.php");
$History = "SELECT t.id_transaction, t.id_user, l.Username AS User, t.id_flag,i.Flags, i.Name, t.Quantity, t.Money, t.Kembalian FROM transaction t JOIN login l ON t.id_user = l.id_user AND l.id_user = ? JOIN images i ON t.id_flag = i.id;";
$stmt = $conn->prepare($History);
$stmt->bind_param('i', $_SESSION['id_user']);
$stmt->execute();
$Purchased = $stmt->get_result();



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        img {
            border: 2px solid black;
            width: 20rem !important;
        }

        .top {
            font-size: 350%;
        }

        td {
            max-width: 175px;
            word-wrap: break-word;

        }
    </style>
</head>

<body>
    <table class="table table-bordered" style="vertical-align: middle;">
        <thead>
            <th colspan="7" class="text-center">
                <p class="top fw-bolder">
                    <?= $_SESSION['Username']; ?>'s Transaction
                </p>
            </th>
        </thead>
    </table>
    <table class="table table-bordered " style="margin-top:-25px; vertical-align: middle;">
        <thead class="table-dark">
            <tr>
                <th>Transaction ID</th>
                <th>User ID</th>
                <th>Flag ID</th>
                <th>Flag Name & Image</th>
                <th>Quantity</th>
                <th>Money</th>
                <th>Change</th>
            </tr>
        </thead>
        <tbody class="table-group-divider text-center">
            <?php
            if ($Purchased->num_rows > 0) {
                while ($row = $Purchased->fetch_assoc()) {
                    $Pic = $row['Flags'];
                    $Pic = base64_encode($Pic);
                    $Pic = "data:image/jpeg;base64," . $Pic;
                    $PicName = $row["Name"];
                    ?>
                    <tr>
                        <td scope="row">
                            <p class="top fw-bolder">
                                <?= $row['id_transaction']; ?>
                            </p>
                        </td>
                        <td>
                            <p class="top fw-bolder">
                                <?= $row['id_user']; ?>
                            </p>
                        </td>
                        <td>
                            <p class="top fw-bolder">
                                <?= $row['id_flag']; ?>
                            </p>
                        </td>
                        <td>
                            <img src="<?= $Pic ?>" alt="<?= $PicName ?>">
                            <p class="fw-bolder">
                                <?= $PicName ?>
                            </p>
                        </td>
                        <td>
                            <p class="top fw-bolder">
                                <?= $row['Quantity']; ?>
                            </p>
                        </td>
                        <td>
                            <p class="top fw-bolder">
                                $<?= $row['Money']; ?>
                            </p>
                        </td>
                        <td>
                            <p class="top fw-bolder">
                                $<?= $row['Kembalian']; ?>
                            </p>
                        </td>
                    </tr>
                    <?php

                }
            }

            ?>

        </tbody>
    </table>

</body>

</html>