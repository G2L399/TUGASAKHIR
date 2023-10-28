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

        .flag-name {
            font-size: 25px;
        }

        h2 {
            font-size: 20px;
        }
    </style>
</head>

<body>
    <h1 class="Products-Available">FLAGS AVAILABLE</h1>
    <h6 class="Prices">Note: Prices Are In USD</h6>
    <div class="container mt-5">
        <div class="row">
            <?php
            // $counter = 0; // Inisialisasi counter di non aktifkan liat komen dibawah ok
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imageData = $row["Flags"];
                    $base64Image = base64_encode($imageData);
                    $Name = $row["Name"];
                    $price = $row['Price'];
                    $id = $row['id'];
                    // $flagName = pathinfo($row["Name"], PATHINFO_FILENAME); // Extract file name without extension
                    ?>

                    <div class="col-md-4">
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
                                    <a href="buy.php?Name=<?= $row['Name'] ?>" class="btn btn-primary w-100">Purchase
                                        <?= $row['Name'] ?>'s Flag
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    // pake code ini kalau misal eror colum nya cuma logic doang ini ga penting amat 
                    // $counter++; // Increment counter
                    // if ($counter % 3 == 0) { // Jika sudah 3 card ditampilkan, tutup baris
                    //     echo '</div><div class="row">';
                    // }
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