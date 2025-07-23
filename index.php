<?php
// Facebook Webhook Verification
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_GET['hub_mode'] === 'subscribe' && $_GET['hub_verify_token'] === 'WebhookToken') {
        echo $_GET['hub_challenge'];
        exit;
    } else {
        http_response_code(403);
        echo 'Verifizierung fehlgeschlagen.';
        exit;
    }
}

// Facebook Lead-Daten empfangen (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $raw = file_get_contents("php://input");
    file_put_contents("leads.json", $raw . PHP_EOL, FILE_APPEND);
    http_response_code(200);
    echo 'OK';
}
?>
