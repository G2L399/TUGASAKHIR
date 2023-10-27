<head>
    <title>Upload Image Form</title>
    <!-- Include Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        img {
            width: 50%;
            border: 5px solid black;
        }
    </style>
</head>

<body>
    <?php
    include('connection.php');
    $query = mysqli_query($conn, "select * from images where id = '" . $_GET['id'] . "'");
    $row = mysqli_fetch_array($query);
    $Name = $row["Name"];
    $Flags = $row["Flags"];
    $Flags = base64_encode($Flags);
    $Flags = 'data:image/jpeg;base64,' . $Flags;
    $Price = $row["Price"];
    $id = $row["id"];
    ?>


    <div class="container mt-5">
        <h1 class="mb-3">BEFORE</h1>
        <img src="<?php echo $Flags; ?>" class="mb-3" alt="Flags">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" required>
        <div class="mb-3">
            <h4>
                <?php
                echo $Name; ?><br>
                Price : $gsdgsgs
                <?php
                echo $Price;
                ?>
            </h4>
        </div>
        <form action="update_process.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
            <!-- Hidden field for ID -->
            <input type="hidden" name="id" value="<?php echo $id; ?>" required>
            
            <!-- Input for updating the image -->
            <h1>AFTER</h1>
            <div class="mb-3">
                <label for="imageUpload" class="h4">Upload an Image (optional)</label>
                <input type="file" class="form-control" id="imageUpload" name="IMAGE" accept="image/*">
            </div>

            <!-- add an image preview -->
            <div class="mb-3">
                <img id="imagePreview" src="<?php echo $Flags; ?>" alt="Image Preview" style="display: none;">
            </div>
            <!-- Input for updating the name -->
            <div class="mb-3">
                <label for="question" class="h4">Name</label>
                <input type="text" class="form-control" id="question" name="NAME" value="<?php echo $Name; ?>" required>
            </div>

            <!-- Input for updating the price -->
            <div class="mb-3">
                <label for="Price" class="h4">Price</label>
                <input type="text" class="form-control" id="Price" name="PRICE" value="<?php echo $Price; ?>" required>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>

    <!-- Include Bootstrap 5 JavaScript and Popper.js for Bootstrap components (required) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add an event listener to the file input to set the question input value to the selected file's name
        document.getElementById('imageUpload').addEventListener('change', function () {
            const uploadedFile = this.files[0];
            if (uploadedFile) {
                const fileName = uploadedFile.name;
                const DefaultPrice = 25;
                const baseName = fileName.split('.').slice(0, -1).join('.'); // Remove the file extension
                const capitalizedFileName = baseName.charAt(0).toUpperCase() + baseName.slice(1);
                document.getElementById('question').value = capitalizedFileName;
                document.getElementById('Price').value = DefaultPrice;
            }

            const imagePreview = document.getElementById('imagePreview');
            imagePreview.style.display = 'block';
            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(uploadedFile);
        });
    </script>
</body>

</html>