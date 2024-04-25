<!DOCTYPE html>
<html>
<head>
    <title>Geolocation</title>
    <style>
        /* CSS styles for the map container */
        #map {
            height: 400px; /* Adjust the height as needed */
            width: 100%; /* Adjust the width as needed */
        }
    </style>
</head>
<body>
<div id="map"></div>

<?php
// Include the PHP file containing the Location class
require 'locations.php';

// Create a new instance of the Location class
$location = new Location();

// Fetch location data using the getLatLng method
$locations = $location->getLatLng();

// Check if location data is available
if ($locations) {
    // Convert location data to JSON for JavaScript usage
    echo '<script>var locations = ' . json_encode($locations) . ';</script>';
} else {
    // If no location data is available, display an error message
    echo '<script>alert("Error: No location data available.");</script>';
}
?>

<script>
    function initMap() {
        // Check if location data is available
        if (typeof locations !== 'undefined' && locations.length > 0) {
            // Create a map centered at the first location
            var map = new google.maps.Map(document.getElementById("map"), {
                center: {lat: parseFloat(locations[0].latitude), lng: parseFloat(locations[0].longitude)},
                zoom: 15
            });

            // Loop through location data and add markers to the map
            for (var i = 0; i < locations.length; i++) {
                var location = locations[i];
                var marker = new google.maps.Marker({
                    position: {lat: parseFloat(location.latitude), lng: parseFloat(location.longitude)},
                    map: map,
                    title: location.name
                });
            }
        } else {
            // If no location data is available, display an error message
            console.log("Error: No location data available.");
        }
    }
</script>

<!-- Include Google Maps API with your API key -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBaPGsMeJl-XKsUNYG3mI436Vh_WKq3cC8&callback=initMap&v=weekly" defer></script>
</body>
</html>
