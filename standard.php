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
    <title>GDT Standard Version</title>
    <meta name="author" content="Tobias Hahnen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" href="https://www.uni-due.de/favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/gdt_std.css" />
    <script src="js/libraries/jquery-3.2.1.min.js"></script>
</head>
<body>
<?php
error_reporting(0);

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

fehler: header("Location: /error.php");
ende:;
?>
    <div id="div_aussen_wrapper">
        <div class="div--reihe1">
            <div id="div_video_wrapper">
                <div class="div--item" id="div_video">
                    <p class="lbl--reihe1--ueberschrift">Würfel</p>
                    <video id="video" src="media/wuerfel.mp4">
                        Das Video kann nicht wiedergegeben werden, warum auch immer!
                    </video>
                </div>
            </div>
            <div id="div_gewinn_verlust_diagramm">
                <div id="div_gewinn_verlust_wrapper">
                    <div class="div--item" id="div_gewinn_verlust">
                        <p class="lbl--reihe1--ueberschrift">Gewinn/ Verlust</p>
                        <p class="lbl--guthaben" id="lbl_verlust">Verlust</p>
                        <p class="lbl--guthaben" id="lbl_gewinn">Gewinn</p>
                    </div>
                </div>
                <div id="div_diagramm_wrapper">
                    <div class="div--item" id="div_diagramm">
                        <p class="lbl--reihe1--ueberschrift">Diagramm</p>
                        <canvas id="canvas_diagramm"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="div--reihe2">
            <div id="div_auswahl_wuerfel_wrapper">
                <div class="div--item" id="div_auswahl_wuerfel">
                    <p class="lbl--wuerfel--info" id="lbl_wuerfel_werte">Gewinn/ Verlust</p>
                    <p class="lbl--wuerfel--info" id="lbl_wuerfel_auswahl">Mögliche Zahlenkombinationen</p>
                    <div id="div_wuerfel_wrapper">
                        <br>
                        <button type="submit" class="wuerfel_btn" id="wuerfel_btn_1">
                            <img src="media/wuerfel_1.png" class="wuerfel_reihe_1" alt="Bild nicht gefunden">
                        </button>
                        <button type="submit" class="wuerfel_btn" id="wuerfel_btn_2">
                            <img src="media/wuerfel_2.png" class="wuerfel_reihe_1" alt="Bild nicht gefunden">
                        </button>
                        <button type="submit" class="wuerfel_btn" id="wuerfel_btn_3">
                            <img src="media/wuerfel_3.png" class="wuerfel_reihe_1" alt="Bild nicht gefunden">
                        </button>
                        <button type="submit" class="wuerfel_btn" id="wuerfel_btn_4">
                            <img src="media/wuerfel_4.png" class="wuerfel_reihe_1" alt="Bild nicht gefunden">
                        </button>
                        <button type="submit" class="wuerfel_btn" id="wuerfel_btn_5">
                            <img src="media/wuerfel_5.png" class="wuerfel_reihe_1" alt="Bild nicht gefunden">
                        </button>
                        <button type="submit" class="wuerfel_btn" id="wuerfel_btn_6">
                            <img src="media/wuerfel_6.png" class="wuerfel_reihe_1" alt="Bild nicht gefunden">
                        </button>
                        <a class="lbl--gewinnsumme">1000€</a><br><br><br>
                        <button type="submit" class="wuerfel_btn" id="wuerfel_btn_12">
                            <img src="media/wuerfel_12.png" class="wuerfel_reihe_2" alt="Bild nicht gefunden">
                        </button>
                        <button type="submit" class="wuerfel_btn" id="wuerfel_btn_34">
                            <img src="media/wuerfel_34.png" class="wuerfel_reihe_2" alt="Bild nicht gefunden">
                        </button>
                        <button type="submit" class="wuerfel_btn" id="wuerfel_btn_56">
                            <img src="media/wuerfel_56.png" class="wuerfel_reihe_2" alt="Bild nicht gefunden">
                        </button>
                        <a class="lbl--gewinnsumme">500€</a><br><br><br>
                        <button type="submit" class="wuerfel_btn" id="wuerfel_btn_123">
                            <img src="media/wuerfel_123.png" class="wuerfel_reihe_3" alt="Bild nicht gefunden">
                        </button>
                        <button type="submit" class="wuerfel_btn" id="wuerfel_btn_456">
                            <img src="media/wuerfel_456.png" class="wuerfel_reihe_3" alt="Bild nicht gefunden">
                        </button>
                        <a class="lbl--gewinnsumme">200€</a><br><br><br>
                        <button type="submit" class="wuerfel_btn" id="wuerfel_btn_1234">
                            <img src="media/wuerfel_1234.png" class="wuerfel_reihe_4" alt="Bild nicht gefunden">
                        </button>
                        <button type="submit" class="wuerfel_btn" id="wuerfel_btn_2345">
                            <img src="media/wuerfel_2345.png" class="wuerfel_reihe_4" alt="Bild nicht gefunden">
                        </button>
                        <button type="submit" class="wuerfel_btn" id="wuerfel_btn_3456">
                            <img src="media/wuerfel_3456.png" class="wuerfel_reihe_4" alt="Bild nicht gefunden">
                        </button>
                        <a class="lbl--gewinnsumme">100€</a>
                    </div>
                </div>
            </div>
            <div id="div_probandendaten_buttons">
                <div class="div--wrapper--info" id="div_probandendaten">
                    <div class="div--item div--inner">
                        <p class="lbl--probandendaten">Proband: <?php echo $name_vpnum;?></p>
                        <p class="lbl--probandendaten">Geschlecht: <?php echo $geschlecht;?></p>
                        <p class="lbl--probandendaten">Alter: <?php echo $alter;?></p>
                        <p class="lbl--probandendaten">Schuljahre: <?php echo $schuljahre;?></p>
                        <p class="lbl--probandendaten" id="lbl_runde">Runde: noch keine</p>
                    </div>
                </div>
                <div class="div--wrapper--info" id="div_buttons">
                    <div class="div--item div--inner">
                        <form action="">
                            <input type="button" class="btn--steuerung btn--nav" id="btn_start_weiter" value="Start" />
                            <input type="button" class="btn--steuerung btn--nav" id="btn_abbrechen" value="Abbrechen" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>var name_vpnum = '<?php echo $name_vpnum;?>'; var alter = '<?php echo $alter;?>'; var schuljahre = '<?php echo $schuljahre;?>'; var geschlecht = '<?php echo $geschlecht;?>';</script>
    <script src="js/gdt_std.js"></script>
</body>
</html>