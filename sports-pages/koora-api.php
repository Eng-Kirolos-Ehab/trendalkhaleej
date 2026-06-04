<?php
// koora-api.php — Cached proxy for api-football v3
// Cache TTL: 60s live, 2min today, 30min fixtures/standings/results

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$API_KEY  = "fa9cf12e022ec755d29435ad98ebb58d";
$BASE_URL = "https://v3.football.api-sports.io";
$CACHE_DIR = __DIR__ . "/.api_cache";

$path = isset($_GET["path"]) ? $_GET["path"] : "";
if (!$path) { http_response_code(400); echo json_encode(["error"=>"missing path"]); exit; }

// Sanitise: only allow safe URL characters
if (!preg_match("/^[a-zA-Z0-9\/=&?_.\-]+$/", $path)) {
    http_response_code(400); echo json_encode(["error"=>"invalid path"]); exit;
}

// TTL depends on endpoint type
$ttl = 1800;
if (strpos($path, "live=") !== false) $ttl = 60;
elseif (strpos($path, "date=") !== false) $ttl = 120;

// Ensure cache dir exists
if (!is_dir($CACHE_DIR)) @mkdir($CACHE_DIR, 0755, true);
$cache_file = $CACHE_DIR . "/" . md5($path) . ".json";

// Serve fresh cache if available
if (file_exists($cache_file) && (time() - filemtime($cache_file)) < $ttl) {
    echo file_get_contents($cache_file);
    exit;
}

// Fetch from API
$ch = curl_init($BASE_URL . $path);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 15,
    CURLOPT_HTTPHEADER     => [
        "x-apisports-key: " . $API_KEY,
        "Accept: application/json",
    ],
    CURLOPT_SSL_VERIFYPEER => false,
]);
$body   = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// On upstream failure, serve stale cache if available
if ($body === false || $status < 200 || $status >= 300) {
    if (file_exists($cache_file)) { echo file_get_contents($cache_file); }
    else { http_response_code(502); echo json_encode(["error"=>"upstream failed","status"=>$status]); }
    exit;
}

// On any API error (rateLimit, token, etc.), serve stale cache rather than the error response
$decoded = json_decode($body, true);
if (!empty($decoded["errors"])) {
    if (file_exists($cache_file)) { echo file_get_contents($cache_file); }
    else { http_response_code(429); echo $body; }
    exit;
}

// Cache valid response and return it
file_put_contents($cache_file, $body, LOCK_EX);
echo $body;
