<?php
include 'db.php';

$apiKey = 'YOUR_ACCUWEATHER_API_KEY';
$locationKey = 'YOUR_LOCATION_KEY'; // Get this from AccuWeather API based on your location

$apiUrl = "http://dataservice.accuweather.com/forecasts/v1/daily/5day/{$locationKey}?apikey={$apiKey}";

$response = file_get_contents($apiUrl);
$weatherData = json_decode($response, true);

foreach ($weatherData['DailyForecasts'] as $day) {
    $date = $day['Date'];
    $temperature = $day['Temperature']['Maximum']['Value'];
    $humidity = $day['Day']['RelativeHumidity'];
    $rainfall = $day['Day']['Rain']['Value'];
    $windSpeed = $day['Day']['Wind']['Speed']['Value'];

    $sql = "INSERT INTO weather_data (date, temperature, humidity, rainfall, wind_speed, region) VALUES ('$date', '$temperature', '$humidity', '$rainfall', '$windSpeed', 'specified_region') ON DUPLICATE KEY UPDATE temperature='$temperature', humidity='$humidity', rainfall='$rainfall', wind_speed='$windSpeed'";

    $conn->query($sql);
}

$sql = "SELECT * FROM weather_data WHERE region = 'specified_region'";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
echo json_encode($data);

$conn->close();
?>

