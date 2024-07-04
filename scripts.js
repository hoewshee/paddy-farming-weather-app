document.addEventListener("DOMContentLoaded", function() {
    if (document.getElementById('weather-container')) {
        fetch('fetch_weather.php')
        .then(response => response.json())
        .then(data => {
            let weatherContainer = document.getElementById('weather-container');
            let weatherHTML = '<h2>Weather Data</h2><table><tr><th>Date</th><th>Temperature</th><th>Humidity</th><th>Rainfall</th><th>Wind Speed</th></tr>';
            data.forEach(row => {
                weatherHTML += `<tr><td>${row.date}</td><td>${row.temperature}</td><td>${row.humidity}</td><td>${row.rainfall}</td><td>${row.wind_speed}</td></tr>`;
            });
            weatherHTML += '</table>';
            weatherContainer.innerHTML = weatherHTML;
        });
    }

    if (document.getElementById('recommendations-container')) {
        fetch('fetch_recommendations.php')
        .then(response => response.json())
        .then(data => {
            let recommendationsContainer = document.getElementById('recommendations-container');
            let recommendationsHTML = '<h2>Recommendations</h2><table><tr><th>Crop Type</th><th>Recommendation</th><th>Date</th></tr>';
            data.forEach(row => {
                recommendationsHTML += `<tr><td>${row.crop_type}</td><td>${row.recommendation}</td><td>${row.date}</td></tr>`;
            });
            recommendationsHTML += '</table>';
            recommendationsContainer.innerHTML = recommendationsHTML;
        });
    }
});

