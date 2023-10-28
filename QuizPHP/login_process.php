<?php
// Include the database connection file
include 'connection.php';

session_start(); // Start a new session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $enteredPassword = $_POST['password']; // Entered password (not hashed)
    $query = mysqli_query($conn,"SELECT * from login WHERE username = '$username'");

    // Query the database to retrieve the hashed password for the given username
    $sql = "SELECT Password FROM login WHERE Username = ?";
    $row1 = mysqli_fetch_array($query);
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, check the password
        $row = $result->fetch_assoc();
        // $row = mysqli_fetch_array($result);
        
        $userType = $row1['usertype']; // Get the user's type
        $storedPasswordHash = $row['Password'];
        // Verify the entered password against the stored hash
        if (md5($enteredPassword) === $storedPasswordHash) {
            // Authentication successful, set user session
            $_SESSION['Username'] = $username;
            $_SESSION['user_type'] = $userType; // Store the user's type
            $_SESSION['loggedin'] = true;
    
            // Redirect to the home page or user dashboard
            header("Location: home.php");
            exit();
        }
    }
    
    
}

// Authentication failed, display an error message and redirect to login page
$_SESSION['login_error'] = true;
header("Location: home.html");
exit();
?>
