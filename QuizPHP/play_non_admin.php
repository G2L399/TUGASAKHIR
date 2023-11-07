<?php
session_start();
include ('header.php');
// Connect to your database (you should have already included your connection code)
include('connection.php');
// Query to select all image data from the 'images' table
$query = "SELECT * FROM images order by images.Name ASC";
$result = $conn->query($query);


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flags</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .flag-container {
            display: inline-block;
            padding: 50px 50px 0px 50px;

        }

        .flag-image {
            width: 100%;
            border: 2px solid black;
        }

        .flag-name {
            font-size: 25px;
        }

        h2 {
            font-size: 20px;
        }

        .custom-container {
            max-width: 90%;
        }

        .center {
            display: flex;
            justify-content: center;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #ffffff;
            background-clip: border-box;
            border: 2px solid rgba(0, 0, 0, .125);
            border-radius: .25rem
        }
    </style>
</head>

<body>
    

    <div class="container mt-3">
        
        <h1 class="Products-Available center">FLAGS AVAILABLE</h1>
        <h6 class="Prices center">Note: Prices Are In USD</h6>

    </div>

    <div class="container mt-5 custom-container">
        <div class="row row-cols-lg-4">

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imageData = $row["Flags"];
                    $base64Image = base64_encode($imageData);
                    $Name = $row["Name"];
                    $price = $row['Price'];
                    $id = $row['id'];
                    // $flagName = pathinfo($row["Name"], PATHINFO_FILENAME); // Extract file name without extension
                    ?>

                    <div class="col-md-4 py-4">
                        <div class="card mb-4">

                            <div class="card-body">
                                <img class="flag-image" src="data:image/jpeg;base64,<?php echo $base64Image; ?>"
                                    alt="<?php echo $Name, "'s Flag"; ?>">
                            </div>
                            <div class="card-body">
                                <h1 class="flag-name">
                                    <?php echo $Name; ?>
                                </h1>
                                <div class="price-container">
                                    <h2 class="">
                                        Price:
                                        $
                                        <?php echo $price; ?>
                                    </h2>
                                </div>
                                <div class="mt-3">
                                    <a href="buy.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-lg">Purchase
                                        <?= $row['Name'] ?>'s Flag
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "No images available.";
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>