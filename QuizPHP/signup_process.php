<?php
// Include the database connection file
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Encrypt the password with MD5

    // Check if the username already exists in the database
    $checkUsernameQuery = "SELECT * FROM login WHERE Username = ?";
    $stmtCheckUsername = $conn->prepare($checkUsernameQuery);
    $stmtCheckUsername->bind_param('s', $username);
    $stmtCheckUsername->execute();
    $resultCheckUsername = $stmtCheckUsername->get_result();

    if ($resultCheckUsername->num_rows > 0) {
        // Username already exists, display an error message
        echo "Username already taken. Please choose a different username.";
    } else {
        // Insert the new user's data into the "Username" table
        $insertQuery = "INSERT INTO login (Username, Password) VALUES (?, ?)";
        $stmtInsert = $conn->prepare($insertQuery);
        $stmtInsert->bind_param('ss', $username, $password);

        if ($stmtInsert->execute()) {
            // Signup successful, redirect to the login page
            header("Location: login.php");
            exit();
        } else {
            // Signup failed, display an error message
            echo "Signup failed. Please try again.";
        }

        $stmtInsert->close();
    }

    $stmtCheckUsername->close();
}
?>
