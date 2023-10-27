<!DOCTYPE html>
<html>

<head>
    <title>Upload Image Form</title>
    <!-- Include Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        img {
            border: 5px solid black;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Upload Image and Answer</h2>
        <form action="addQuestion.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="imageUpload" class="form-label">Upload an Image</label>
                <input type="file" class="form-control" id="imageUpload" name="image" accept="image/*" required>
            </div>
            <!-- add an image preview -->
            <div class="mb-3">
                <img id="imagePreview" src="#" alt="Image Preview"
                    style="max-width: 100%; max-height: 200px; display: none;">
            </div>
            <div class="mb-3">
                <label for="question" class="form-label">Answer</label>
                <input type="text" class="form-control" id="question" name="question" required>
            </div>
            <div class="mb-3">
                <label for="Price" class="form-label">PRICE</label>
                <input type="text" class="form-control" id="Price" name="PRICE" required>
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