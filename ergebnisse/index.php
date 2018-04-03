<!DOCTYPE html>
<html lang="de"> 
<head>
    <meta charset="utf-8" />
    <title>Admin-Seite</title>

    <meta name="author" content="Tobias Hahnen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="format-detection" content="telephone=no">

    <link rel="icon" href="https://www.uni-due.de/favicon.ico">
    <link rel="apple-touch-icon" href="https://www.uni-due.de/imperia/md/images/cms/h/apple-touch-icon.png">
    <link rel="stylesheet" type="text/css" href="../css/index_ergebnisse.css" />

    <script src="../js/libraries/jquery-3.2.1.min.js"></script>
</head>
<body>
    <div class="div--logo">
        <img class="img--logo" src="/media/AllgPsy_de_4c_einzeilig_2015.png" alt="Das Logo konnte nicht gefunden werden!">
    </div>

    <div class="div--wrapper">
        <h2>Die Liste aller erspielten Ergebnisse:</h2>
        <ul>
<?php
if ($handle = opendir(".")) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != ".." && $entry != "index.php") {
            echo "\t\t\t<li>
            \t<p>Ergebnis '<a target='_blank' href='./" . $entry . "'>" . $entry . "</a>' vom " . date ("d.m.Y H:i:s", filemtime($entry)) . " Uhr.</p>
            </li>\n";
        }
    }
    closedir($handle);
}
?>
        </ul>
    </div>

    <div class="div--wrapper">
        <form action="">
            <input type="button" class="btn--steuerung btn--nav" id="btn_submit" value="Zum Start">
        </form>
    </div>

    <script src="../js/index_ergebnisse.js"></script>
</body>