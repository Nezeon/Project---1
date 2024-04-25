<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Form</h2>
        <form id="myForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="menu">Type:</label>
                <select class="form-control" id="menu" name="menu">
                    <option value="Select">Select</option>
                    <option value="Im a Resturant and donate leftover food to you for donating">Im a Resturant and donate leftover food to you for donating</option>
                    <option value="I am an individual donating food want to put the location">I am an individual donating food want to put the location</option>
                    
                </select>
            </div>
            <button type="button" class="btn btn-primary" id="fetchLocation">Fetch Location</button>
            Make sure to click this button to fetch your location
            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">
            <br>
            <button type="submit" class="btn btn-success mt-3">Submit</button>
        </form>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom script for fetching location -->
    <script>
        document.getElementById("fetchLocation").onclick = function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    document.getElementById("latitude").value = position.coords.latitude;
                    document.getElementById("longitude").value = position.coords.longitude;
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        };
    </script>

    <?php
    // Database connection
    $servername = "localhost";
    $username = "u154566579_root"; // Replace with your MySQL username
    $password = "Alphabetagamma@12345"; // Replace with your MySQL password
    $dbname = "u154566579_Alphaa"; // Replace with your MySQL database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $menu = $_POST['menu'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];

        // Prepare SQL statement
        $sql = "INSERT INTO form_data (name, email, phone, address, menu, latitude, longitude) VALUES ('$name', '$email', '$phone', '$address', '$menu', '$latitude', '$longitude')";

        // Execute SQL statement
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New record created successfully');</script>";
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
    }

    // Close connection
    $conn->close();
    ?>
</body>
</html>
