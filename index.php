<?php
// 環境変数からAPIキーを取得
$apiKey = getenv('OPENWEATHER_API_KEY');

if ($apiKey === false) {
    die("Error: API key not found in environment variables.");
}

$city = "Tokyo"; // 取得したい都市名
$apiUrl = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

// APIリクエストを送信
$response = file_get_contents($apiUrl);
if ($response === FALSE) {
    die("Error occurred while fetching weather data.");
}

// JSON形式のAPIレスポンスを連想配列に変換
$weatherData = json_decode($response, true);

// 必要なデータを抽出して表示
if ($weatherData['cod'] == 200) {
    $temperature = $weatherData['main']['temp'];  // 気温
    $description = $weatherData['weather'][0]['description']; // 天気の説明

    echo "Current temperature in $city: {$temperature}°C\n";
    echo "Weather: {$description}\n";
} else {
    echo "Error: Could not fetch weather data for $city.";
}
?>
