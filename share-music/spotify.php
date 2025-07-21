<?php
header('Content-Type: application/json');

$clientId     = 'id';
$clientSecret = 'sectet_id';

$track  = $_GET['track']  ?? '';
$artist = $_GET['artist'] ?? '';

if (!$track || !$artist) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing track or artist']);
    exit;
}

$ch = curl_init('https://accounts.spotify.com/api/token');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => 'grant_type=client_credentials',
    CURLOPT_HTTPHEADER     => [
        'Authorization: Basic ' . base64_encode("$clientId:$clientSecret"),
        'Content-Type: application/x-www-form-urlencoded',
    ],
]);
$response = curl_exec($ch);
curl_close($ch);

$data  = json_decode($response, true);
$token = $data['access_token'] ?? '';

if (!$token) {
    http_response_code(500);
    echo json_encode(['error' => 'Spotify auth failed']);
    exit;
}

$params = [
    'q'     => "track:$track artist:$artist",
    'type'  => 'track',
    'limit' => 1
];
$searchUrl = 'https://api.spotify.com/v1/search?' . http_build_query($params);

$ch = curl_init($searchUrl);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => [
        "Authorization: Bearer $token"
    ]
]);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);
$item   = $result['tracks']['items'][0] ?? null;

if (!$item) {
    echo json_encode([]);
    exit;
}

echo json_encode([
    'cover'   => $item['album']['images'][0]['url']         ?? '',
    'spotify' => $item['external_urls']['spotify']           ?? ''
]);
