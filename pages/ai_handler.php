<?php
// 1. SILENCE ERRORS
ini_set('display_errors', 0); 
error_reporting(0);
ob_start();

// 2. DATABASE CONNECTION
include '../includes/db.php';
if (!$conn) {
    ob_clean();
    die(json_encode(["response" => "Database connection failed."]));
}

header('Content-Type: application/json');

// Get user message
$json_input = file_get_contents('php://input');
$request = json_decode($json_input, true);
$userMsg = $request['message'] ?? 'Hi'; 

// --- DATA GATHERING ---
$context = "You are a Construction Assistant in Nairobi. All currency is in Ksh. ";
$p_res = mysqli_query($conn, "SELECT project, overall_cost FROM projects LIMIT 10");
if($p_res){
    while($p = mysqli_fetch_assoc($p_res)) {
        $context .= "Project {$p['project']} costs {$p['overall_cost']} Ksh. ";
    }
}

// --- CALL GEMINI AI ---
// Using your current new key
$apiKey = "AIzaSyDiev1yeHmD0-lPETLWGzk8VkuYbnVw7zk"; 

/** * THE 2026 FIX: 
 * We are switching from gemini-1.5 to gemini-2.5-flash.
 * Most new projects no longer support the 1.5 string, which causes the 404.
 */
$url = "https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key=" . $apiKey;

$payload = [
    "contents" => [[
        "parts" => [["text" => "Context: $context \n\nUser Question: $userMsg"]]
    ]]
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$result = json_decode($response, true);
ob_clean(); 

$aiText = $result['candidates'][0]['content']['parts'][0]['text'] ?? null;

if ($http_code === 200 && $aiText) {
    echo json_encode(["response" => $aiText]);
} else {
    // If 2.5 still fails, it will show us a specific error code
    $msg = $result['error']['message'] ?? "API is initializing. Try again in 1 minute.";
    echo json_encode(["response" => "Assistant Note: (Code $http_code) " . $msg]);
}
exit;