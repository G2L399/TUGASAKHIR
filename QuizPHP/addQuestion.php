<?php
// Include the database connection file
// include 'connection.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Check if an image file was uploaded
//     if (isset($_FILES['image'])) {
//         // Get the name from the form input
//         $name = $_POST['question'];

//         // Read the image file
//         $imageData = file_get_contents($_FILES['image']['tmp_name']);

//         // Insert data into the "quiz" table
//         $sql = "INSERT INTO images (Flags, Name) VALUES (?, ?)";
//         $stmt = $conn->prepare($sql);
//         $stmt->bind_param('ss', $imageData, $name);

//         if ($stmt->execute()) {
//             echo "<script>alert('Image Uploaded Successfully');location.href='Question.php';</script>";
//         } else {
//             echo 'Error: ' . $stmt->error;
//         }

//         $stmt->close();
//     } else {
//         echo 'Please select an image file.';
//     }
// }
// Include the database connection file
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if an image file was uploaded
    if (isset($_FILES['image'])) {
        // Get the name from the form input
        $name = $_POST['question'];
        $Price = $_POST['PRICE'];
        // Check if the name already exists in the database
        $sql = "SELECT COUNT(*) FROM images WHERE Name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $stmt->bind_result($nameCount);
        $stmt->fetch();
        $stmt->close();

        if ($nameCount > 0) {
            echo "<script>alert('Error: The Image already exists in the database.');location.href='Question.php';</script>'";
        } else {
            // Read the image file
            $imageData = file_get_contents($_FILES['image']['tmp_name']);

            // Insert data into the "quiz" table
            $sql = "INSERT INTO images (Flags, Name, Price) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssi', $imageData, $name, $Price);

            if ($stmt->execute()) {
                echo "<script>alert('Image Uploaded Successfully');location.href='play.php';</script>";
            } else {
                echo 'Error: ' . $stmt->error;
            }

            $stmt->close();
        }
    } else {
        echo 'Please select an image file.';
    }
}

?>