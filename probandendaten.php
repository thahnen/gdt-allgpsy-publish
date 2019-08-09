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

    <meta name="robots" content="noindex,nofollow" />
    <meta name="description" content="GDT Standard-Webversion, diese Seite sollte niemals ohne vorherige Webseiten aufgerufen werden!" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="expires" content="0" />
    <meta name="author" content="Tobias Hahnen" />

    <title>GDT Probandendaten-Eingabe</title>

    <link rel="icon" href="https://www.uni-due.de/favicon.ico" />
    <link rel="apple-touch-icon" href="https://www.uni-due.de/imperia/md/images/cms/h/apple-touch-icon.png" />
    <link rel="stylesheet" type="text/css" href="css/probandendaten.css" />

    <script src="js/libraries/jquery-3.2.1.min.js"></script>
</head>

<body>
    <div class="div--logo">
        <img class="img--logo" src="/media/AllgPsy_de_4c_einzeilig_2015.png" alt="Das Logo konnte nicht gefunden werden!" />
    </div>

    <div class="div--wrapper">
        <!--
            - Elemente hinter Eingabefeldern ändern für Info etc.
                => i.M. noch hässlich >.<
            - Noch ein Radiobutton für (anderes) Geschlecht hinzufügen? ... NEIN IHR GESTÖRTEN!
                => Nachtrag (27.12.2018): Mittlerweile muss man "Divers" fast überall angeben, aber meine Meinung bleibt gleich :>
         -->
        <form action="" autocomplete="off">
            <div class="form--div--probandendaten--top">
                <label for="name_vpnum" class="lbl--form--input">Name/ VP-Nummer:</label>
                <input type="text" name="name_vpnum" required minlength="1" maxlength="25" />
                <span class="validity"></span>
            </div>

            <div class="form--div--probandendaten">
                <label for="geschlecht" class="lbl--form--input">Geschlecht:</label>

                <div id="form_probandendaten_div_geschlecht_inner">
                    <label for="radio_geschlecht_m" class="lbl--geschlecht">Männlich</label>
                    <input type="radio" name="geschlecht" id="radio_geschlecht_m" value="male" required />
                    <br>
                    <label for="radio_geschlecht_w" class="lbl--geschlecht">Weiblich</label>
                    <input type="radio" name="geschlecht" id="radio_geschlecht_w" value="female" required />
                    <span class="validity"></span>
                </div>
            </div>

            <div class="form--div--probandendaten">
                <label for="alter" class="lbl--form--input">Alter:</label>
                <input type="number" name="alter" required min="1" max="125" />
                <span class="validity"></span>
            </div>

            <div class="form--div--probandendaten">
                <label for="schuljahre" class="lbl--form--input">Schuljahre:</label>
                <input type="number" name="schuljahre" required min="0" max="13" />
                <span class="validity"></span>
            </div><br>

            <input type="button" class="btn--steuerung btn--nav" id="btn_submit" value="Weiter" />
            <input type="button" class="btn--steuerung btn--nav" id="btn_abbrechen" value="Abbrechen" />
        </form>
    </div>

    <script src="js/probandendaten.js"></script>
</body>
</html>
