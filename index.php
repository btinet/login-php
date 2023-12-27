<?php

# Einstiegspunkt

use App\Component\LoginForm;

require ('autoload.php');

// Datenbankverbindung herstellen
$pdo = new PDO('mysql:host=it.treptowkolleg.de;port=3306;dbname=tk03','tk03','tk03');
// SQL-Query aufschreiben
$sqlQuery = 'select * from Lehrkraft';
// Query ausführen und Ergebnisse zwischenspeichern
$results = $pdo->query($sqlQuery);

$form = new LoginForm();

?>
<!DOCTYPE HTML>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Informatik AG">
        <meta name="description" content="Übungswebsite mit Login-Formular">

        <title>Titel der Website</title>
    </head>
    <body>
    <h1>PHP-Übungen</h1>

    <h2>Login-Formular</h2>
    <?=$form->render()?>

    <?php if($_POST): ?>
    <h3>Übermittelte Daten:</h3>
    <ul>
        <!-- Für jedes Element im Array den Schlüssel und Wert ausgeben /-->
        <?php foreach ($_POST as $key => $value): ?>
        <li><b><?=$key?>:</b> <?=$value?></li>
        <?php endforeach;?>
    </ul>
    <?php endif;?>


    <h2>Lehrkräfte</h2>
    <ul>
        <!-- für jeden Datensatz Vorname und Nachname in einer ungeordneten Liste ausgeben /-->
        <?php foreach ($results as $result): ?>
        <li><?=$result['vorname']?> <?=$result['name']?></li>
        <?php endforeach; ?>
    </ul>

    </body>
</html>