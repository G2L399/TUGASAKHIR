<?php
session_start();
$isAdmin = isset($_SESSION['user_type']) && $_SESSION['user_type'] === "Admin";
$isUser = isset($_SESSION['user_type']) && $_SESSION['user_type'] === "User";
$Loggedin = !isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Homepage</title>
    <!-- Include Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <style>

    </style>
</head>

<body>
    <?php
    if (!$Loggedin) {
        ?>
        <h2>Selamat Datang
            <?= $_SESSION['user_type'] ?> Di Website Belanja Bendera Online.
        </h2>

        <?php
    } else {

    }

    ?>
    <div class="container mt-5">
        <h1 class="text-center">G2L FLAGS SHOP</h1>
    </div>

    <div class="container mt-5">

        <?php
        if ($Loggedin) {
            ?>
            
            <div class="row mt-5">
                <div class="col-12 text-end">
                    <a href="login.php" class="btn btn-primary">Login</a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-end">
                    <a href="signup.php" class="btn btn-primary">Signup</a>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="row mt-3">
                <div class="col-12 text-end">
                    <a href="logout.php" class="btn btn-primary">Log Out</a>
                </div>
            </div>

            <?php
        }

        if ($isAdmin) {
            echo '<div class="row mt-3">
            <div class="col-12 text-center">
                <a href="play.php" class="btn btn-success btn-lg">Show</a>
            </div>
        </div>';
        } else if ($isUser) {
            echo '<div class="row mt-3">
            <div class="col-12 text-center">
                <a href="play_non_admin.php" class="btn btn-success btn-lg">Show</a>
            </div>
        </div>';


        }
        ?>

        
        <div class="row mt-3">
            <div class="col-12 text-center">
                <a href="credits.php" class="btn btn-info btn-lg">Credits</a>
            </div>
        </div>

        <?php
        // Check if the user is an admin and display an additional button if true
        
        // $isAdmin = isset($_SESSION['username']) && $_SESSION['username'] === "Bagas";
        if ($isAdmin) {
            echo '<div class="row mt-3">
            <div class="col-12 text-center">
                <a href="Question.php" class="btn btn-danger btn-lg">Add Flags</a>
            </div>
        </div>';
        }

        ?>
    </div>

    <!-- Include Bootstrap 5 JavaScript and Popper.js for Bootstrap components (required) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>