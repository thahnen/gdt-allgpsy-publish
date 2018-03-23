<!DOCTYPE html>
<html lang="de"> 
<head>
    <!-- ====================================================================
         * Copyright (C) 2017-2018 Hahnen Industries - All Rights Reserved
         * 
         * This file is part of GDT.
         * Unauthorized copying of this file or the software, via any medium
         * is strictly prohibited and can not be distributed without the express
         * permission of Hahnen Industries representated by Tobias Hahnen
         *
         * Written by Tobias Hahnen <tobias.hahnen@stud.hn.de>, March 2018
        ===================================================================== -->
        
    <meta charset="utf-8" />
    <title>GDT Versionsauswahl</title>
    <meta name="author" content="Tobias Hahnen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" href="https://www.uni-due.de/favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/auswahl.css" />
    <script src="js/libraries/jquery-3.2.1.min.js"></script>
</head>
<body>
<?php
$name_vpnum = "-1";
$alter = -1;
$schuljahre = -1;
$geschlecht = "-1";
$err = "Error";

function Get($index, $defaultValue) { return isset($_GET[$index]) ? $_GET[$index] : $defaultValue; }

function test_input($data) { return htmlspecialchars(stripslashes(trim($data))); }

$ln_vpn = test_input(Get("name_vpnum", $err));
if ($ln_vpn == $err) { goto fehler; }
else { $name_vpnum = $ln_vpn; }

$lalter = test_input(Get("alter", $err));
if ($lalter == $err) { goto fehler; }
else { try {
        $alter = intval($lalter);
        if ($alter <= 0 || $alter > 125) { goto fehler; }
    } catch (Exception $e) { goto fehler; }
}

$lschuljahre = test_input(Get("schuljahre", $err));
if ($lschuljahre == $err) { goto fehler; }
else { try {
        $schuljahre = intval($lschuljahre);
        if ($schuljahre <= 0 || $lschuljahre > 20) { goto fehler; }
    } catch (Exception $e) { goto fehler; }
}

$lgeschlecht = test_input(Get("geschlecht", $err));
if ($lgeschlecht == $err) { goto fehler; }
else { $geschlecht = $lgeschlecht; }

goto ende;

fehler: header("Location: /fehler.php");
ende:;
?>
    <div class="div--logo">
        <img class="img--logo" src="/media/AllgPsy_de_4c_einzeilig_2015.png" alt="Das Logo konnte nicht gefunden werden!">
    </div>
    <div class="div--wrapper">
        <p class="lbl--info">Bitte wählen Sie die entsprechende Version von GDT aus:</p>
    </div>
    <div class="div--wrapper">
        <form action="" autocomplete="off">
            <div class="form--div--gdtwahl--top">
                <label class="lbl--form--input">GDT (standard)</label>
                <input type="radio" name="gdt_version" value="standard">
            </div>
            <div class="form--div--gdtwahl">
                <label class="lbl--form--input">GDTmod</label>
                <input type="radio" name="gdt_version" value="gdtmod">
                <span>Noch nicht implementiert!</span>
            </div>
            <div class="form--div--gdtwahl">
                <label class="lbl--form--input">GDTope</label>
                <input type="radio" name="gdt_version" value="gdtope">
                <span>Noch nicht implementiert!</span>
            </div>
            <div class="form--div--gdtwahl">
                <label class="lbl--form--input">GDTsf</label>
                <input type="radio" name="gdt_version" value="gdtsf">
                <span>Noch nicht implementiert!</span>
            </div>
            <div class="form--div--gdtwahl">
                <label class="lbl--form--input">GDTforce</label>
                <input type="radio" name="gdt_version" value="gdtforce">
                <span>Noch nicht implementiert!</span>
            </div><br>
            <input type="button" class="btn--steuerung btn--nav" id="btn_submit" value="Weiter">
            <input type="button" class="btn--steuerung btn--nav" id="btn_abbrechen" value="Abbrechen">
        </form>
    </div>
    <script>
        var name_vpnum = '<?php echo $name_vpnum;?>';
        var alter = '<?php echo $alter;?>';
        var schuljahre = '<?php echo $schuljahre;?>';
        var geschlecht = '<?php echo $geschlecht;?>';
    </script>
    <script src="js/auswahl.js"></script>
</body>