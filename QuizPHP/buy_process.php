<?php include('connection.php');
session_start();

$Money = $_GET['Money'];
$Qty = $_GET['quantity'];
$id = $_GET['id'];
$qryUser = "Select id_user from login where Username = '" . $_SESSION['Username'] . "'";
$GetUserID = mysqli_query($conn, $qryUser);
$GetUserID = mysqli_fetch_assoc($GetUserID);
$qryPrice = "Select Price from images where id = '" . $id . "'";
$GetPrice = mysqli_query($conn, $qryPrice);
$GetPrice = mysqli_fetch_assoc($GetPrice);
$FlagPrice = $GetPrice["Price"];
$Change = $Money - ($FlagPrice * $Qty);

$query = "insert into transaction (id_user,id_flag,Quantity,Money,Kembalian) Values (?,?,?,?,?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('iiiii', $GetUserID['id_user'], $id, $Qty, $Money, $Change);
if ($stmt->execute()) {
    include("buy.php");
    include("UI_Success.html"); // Assuming "UI_Success.php" is the success UI file
} else {
    echo 'Error: ' . $stmt->error;
    include("Fail.php"); // Assuming "Fail.php" is the failure UI file
}

?>