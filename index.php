<?php

# Einstiegspunkt

use App\CologneHash;
use App\Component\LoginForm;
use App\Component\SoundExpression;
use App\StringCompare;

require ('autoload.php');

// Datenbankverbindung herstellen
$pdo = new PDO('mysql:host=it.treptowkolleg.de;port=3306;dbname=tk03','tk03','tk03');
// SQL-Query aufschreiben
$sqlQuery = 'select * from Lehrkraft';
// Query ausführen und Ergebnisse zwischenspeichern
$results = $pdo->query($sqlQuery);

$form = new LoginForm();

function getExcelColumnIndex($str){
    $columnIndex = 0;
    $len = strlen($str);

    for($i = 0; $i < $len; ++$i){
        $columnIndex *= 26;
        $columnIndex += ord($str[$i]) - ord('a') + 1;
    }

    return $columnIndex;
}

$strCmp = new StringCompare();


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
        <h3>Zeichenketten vergleichen</h3>
        <?= $strCmp->findDistance($_POST['usr']); ?>
    <?php endif;?>

    <h2>Klingt wie?</h2>
    Reimt sich Lumpen auf Pumpen?
    <p>Antwort: <?=CologneHash::getCologneHash("Lumpen") == CologneHash::getCologneHash("Pumpen") ? "Ja" : "Nein" ?></p>

    Reimt sich Mir auf Dir?
    <p>Antwort: <?=CologneHash::getCologneHash("Mir") == CologneHash::getCologneHash("Dir") ? "Ja" : "Nein" ?></p>

    Reimt sich Mir auf Dich?
    <p>Antwort: <?=CologneHash::getCologneHash("Mir") == CologneHash::getCologneHash("Dich") ? "Ja" : "Nein" ?></p>

    Reimt sich Ick auf Dick?
    <p>Antwort: <?=CologneHash::getCologneHash("Ick") == CologneHash::getCologneHash("Dick") ? "Ja" : "Nein" ?></p>

    Klingt Gehrhardt Hauptman so ähnlich wie Gerhard Hauptmann?
    <p>Antwort: <?=SoundExpression::compareSound('Gehrhardt Hauptman','Gerhard Hauptmann')? 'Ja' : 'Nein' ?></p>

    <b>Text A:</b>
    <p>Der Baum ist gerade noch schön!</p>

    <b>Text B:</b>
    <p>Der Baum ist sehr schön!</p>

    <?php SoundExpression::compareText('Der Baum ist gerade noch schön!','Der Baum ist sehr schön!',$percent); ?>

    Sind beide Texte ähnlich? Wenn ja, inwieweit?
    <p>Antwort: Die Texte ähneln sich zu <?=round($percent,2);?>%</p>



    <h2>Lehrkräfte</h2>
    <ul>
        <!-- für jeden Datensatz Vorname und Nachname in einer ungeordneten Liste ausgeben /-->
        <?php foreach ($results as $result): ?>
        <li><?=$result['vorname']?> <?=$result['name']?></li>
        <?php endforeach; ?>
    </ul>






    </body>
</html>