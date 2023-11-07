<?php
$isAdmin = isset($_SESSION['user_type']) && $_SESSION['user_type'] === "Admin";
$isUser = isset($_SESSION['user_type']) && $_SESSION['user_type'] === "User";
$Loggedin = !isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        .background {
            background-color: rgba(0, 0, 0, 0.25) !important;
        }
    </style>
</head>


<body>
    <nav class="navbar navbar-expand-xxl background">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">HOME</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    
    
</body>
</html>