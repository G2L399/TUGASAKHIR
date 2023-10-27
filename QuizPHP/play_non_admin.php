<?php
session_start();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .flag-container {
            display: inline-block;
            padding: 50px 50px 0px 50px;

        }

        .flag-image {
            width: 100%;
            border: 5px solid black;
        }

        .Products-Available {
            padding: 50px 50px 0px 50px;
        }

        .flag-name {
            font-size: 25px;
            padding: 10px 50px 0px 50px;
        }

        .price-container {
            padding: 0px 50px 0px 50px;
        }

        h2 {
            font-size: 20px;
        }

        .Prices {
            padding: 0px 0px 0px 50px;
        }
    </style>
</head>

<body>
    <h1 class="Products-Available">FLAGS AVAILABLE</h1>
    <h6 class="Prices">Note : Prices Are In USD</h6>
    <div class="container mt-5">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
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

                    <div class="col">
                        <div class="col card mb-4">
                            <div class="card-body">
                                <!-- <div class="flag-container"> -->
                                    <img class="flag-image" src="data:image/jpeg;base64,<?php echo $base64Image; ?>"
                                        alt="<?php echo $Name, "'s Flag"; ?>">
                                <!-- </div> -->
                            </div>
                            <div class="card-body">
                                <h1 class="flag-name">
                                    <?php echo $Name; ?>
                                </h1>
                                <?php
                                // Buttons for updating and deleting
                                    ?>
                                    <div class="price-container">
                                        <h2 class="">
                                            Price :
                                            $
                                            <?php echo $price; ?>
                                        </h2>
                                        <br>
                                    </div>
                                    <div class="price-container">
                                        <h2 class="">
                                            Price :
                                            $
                                            <?php echo $price; ?>
                                        </h2>
                                    </div>
                                    <div class="col mt-3" style="padding-left:50px; padding-bottom: 25px;">
                                        <a href="buy.php?Name=<?= $row['Name'] ?>" class="btn btn-primary btn-lg">Purchase
                                            <?= $row['Name'] ?>'s Flag
                                        </a>
                                    </div>
                                </div>
                                <?php
                                ?>
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