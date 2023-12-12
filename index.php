<?php

# Einstiegspunkt

use App\Component\LoginForm;

require ('autoload.php');


$form = new LoginForm('','get');

?>

<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Informatik AG">
        <meta name="description" content="Übungswebsite mit Login-Formular">

        <title>Titel der Website</title>
    </head>
    <body>

       <?=$form->render()?>

    <form>
        <input>
        <button></button>
    </form>



    </body>
</html>