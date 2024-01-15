<?php

// Setze deine OpenAI API-Zugangsdaten
$openaiApiKey = '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';

// Definiere die URL der OpenAI API
$openaiApiUrl = 'https://api.openai.com/v1/engines/davinci-codex/completions';

// Definiere die Suchanfrage
$searchQuery = 'Stelle dich vor!';

// Erstelle die Daten, die du an die API senden möchtest
$data = array(
    'prompt' => $searchQuery,
    'max_tokens' => 150,
    // Weitere Parameter nach Bedarf hinzufügen
);

// Konvertiere die Daten in das JSON-Format
$jsonData = json_encode($data);

// Erstelle die HTTP-Header für die Anfrage
$headers = array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $openaiApiKey,
);

// Erstelle die Anfrage an die OpenAI API
$ch = curl_init($openaiApiUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Führe die Anfrage aus
$response = curl_exec($ch);

// Überprüfe auf Fehler
if (curl_errno($ch)) {
    echo 'Curl-Fehler: ' . curl_error($ch);
} else {
    // Verarbeite die API-Antwort
    $decodedResponse = json_decode($response, true);

    echo $searchQuery . PHP_EOL;
    // Zeige das Ergebnis an
    //echo 'Antwort von OpenAI API: ' . $decodedResponse['choices'][0]['text'];

    ?>
<pre><code><?php print_r($decodedResponse)?></code></pre>
<?php
}

// Schließe die cURL-Verbindung
curl_close($ch);
