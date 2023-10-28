<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; // Get the ID of the image to update

    // Get the new name and price
    $name = $_POST['NAME'];
    $price = $_POST['PRICE'];

    // Initialize the new image data
    $newImage = null;

    // Check if a new image file was uploaded
    if (isset($_FILES['IMAGE']) && $_FILES['IMAGE']['size'] > 0) {
        $newImage = file_get_contents($_FILES['IMAGE']['tmp_name']);
    }

    // Prepare the SQL statement to update the image data
    $sql = "UPDATE images SET Name = ?, Price = ?";
    $bindTypes = "si";
    $bindValues = [$name, $price];

    // If a new image is provided, update the image data as well
    if ($newImage !== null) {
        $sql .= ", Flags = ?";
        $bindTypes .= "s";
        $bindValues[] = $newImage;
    }

    $sql .= " WHERE id = ?";
    $bindTypes .= "i";
    $bindValues[] = $id;

    // Update the image data in the database
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($bindTypes, ...$bindValues);

    if ($stmt->execute()) {
        echo "<script>alert('Image Updated Successfully');location.href='play.php';</script>";
    } else {
        echo 'Error: ' . $stmt->error;
    }
}
?>
