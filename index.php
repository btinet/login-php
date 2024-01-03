<?php

# Einstiegspunkt

use App\CologneHash;
use App\Component\LoginForm;
use App\Component\SoundExpression;
use App\Database\MySQLConnection;
use App\StringCompare;

require ('autoload.php');

$db = new MySQLConnection('localhost','thes','root');

$results = [];
if($_POST) {
    $results = $db->select(['word','normalized_word','normalized_word2'],'term','word LIKE "%'.$_POST['usr'].'%"');
}



$form = new LoginForm();
$strCmp = new StringCompare();
$word = '';


?>
<!DOCTYPE HTML>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name='viewport' content='initial-scale=1, viewport-fit=cover'>
        <meta name="author" content="Informatik AG">
        <meta name="description" content="Übungswebsite mit Login-Formular">

        <link href="assets/styles/scss_grundlagen.css" type="text/css" rel="stylesheet">

        <title>Titel der Website</title>
    </head>
    <body>
    <div class="container">
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
            Meintest du <?= $word = $strCmp->findDistance($_POST['usr']); ?>?
        <?php endif;?>

        <h2>Klingt wie?</h2>
        Was klingt so ähnlich?
        <p>Antwort: <?= SoundExpression::compare($word,$strCmp->getPdo()) ?></p>

        Reimt sich Mir auf Dir?
        <p>Antwort: <?=CologneHash::getCologneHash("Mir") == CologneHash::getCologneHash("Dir") ? "Ja" : "Nein" ?></p>

        Reimt sich Mir auf Dich?
        <p>Antwort: <?=CologneHash::getCologneHash("Mir") == CologneHash::getCologneHash("Dich") ? "Ja" : "Nein" ?></p>

        Reimt sich Ick auf Dick?
        <p>Antwort: <?=CologneHash::getCologneHash("Ick") == CologneHash::getCologneHash("Dick") ? "Ja" : "Nein" ?></p>

        <b>Text A:</b>
        <p>Der Baum ist gerade noch schön!</p>

        <b>Text B:</b>
        <p>Der Baum ist sehr schön!</p>

        <?php SoundExpression::compareText('Der Baum ist gerade noch schön!','Der Baum ist sehr schön!',$percent); ?>

        Sind beide Texte ähnlich? Wenn ja, inwieweit?
        <p>Antwort: Die Texte ähneln sich zu <?=round($percent,2);?>%</p>

        <pre>
            <code class="language-php">
                <?php print_r($results) ?>
            </code>
        </pre>
    </div>

    </body>
</html>