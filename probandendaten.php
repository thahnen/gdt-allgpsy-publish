<!DOCTYPE html>
<html lang="de"> 
<head>
    <meta charset="utf-8" />
    <title>GDT Probandendaten-Eingabe</title>

    <meta name="author" content="Tobias Hahnen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="format-detection" content="telephone=no">

    <link rel="icon" href="https://www.uni-due.de/favicon.ico">
    <link rel="apple-touch-icon" href="https://www.uni-due.de/imperia/md/images/cms/h/apple-touch-icon.png">
    <link rel="stylesheet" type="text/css" href="css/probandendaten.css" />

    <script src="js/libraries/jquery-3.2.1.min.js"></script>
</head>
 
<body>
    <div class="div--logo">
        <img class="img--logo" src="/media/AllgPsy_de_4c_einzeilig_2015.png" alt="Das Logo konnte nicht gefunden werden!">
    </div>

    <div class="div--wrapper">
        <form action="" autocomplete="off">
            <div class="form--div--probandendaten--top">
                <label for="name_vpnum" class="lbl--form--input">Name/ VP-Nummer:</label>
                <input type="text" name="name_vpnum" required minlength="1" maxlength="25">
                <span class="validity"></span>
            </div>

            <div class="form--div--probandendaten">
                <label for="geschlecht" class="lbl--form--input">Geschlecht:</label>

                <div id="form_probandendaten_div_geschlecht_inner">
                    <label for="radio_geschlecht_m" class="lbl--geschlecht">Männlich</label>
                    <input type="radio" name="geschlecht" id="radio_geschlecht_m" value="male" required>
                    <br>
                    <label for="radio_geschlecht_w" class="lbl--geschlecht">Weiblich</label>
                    <input type="radio" name="geschlecht" id="radio_geschlecht_w" value="female" required>
                    <span class="validity"></span>
                </div>
            </div>

            <div class="form--div--probandendaten">
                <label for="alter" class="lbl--form--input">Alter:</label>
                <input type="number" name="alter" required min="1" max="125">
                <span class="validity"></span>
            </div>

            <div class="form--div--probandendaten">
                <label for="schuljahre" class="lbl--form--input">Schuljahre:</label>
                <input type="number" name="schuljahre" required min="0" max="13">
                <span class="validity"></span>
            </div><br>

            <input type="button" class="btn--steuerung btn--nav" id="btn_submit" value="Weiter">
            <input type="button" class="btn--steuerung btn--nav" id="btn_abbrechen" value="Abbrechen">
        </form>
    </div>

    <script src="js/probandendaten.js"></script>
</body>
</html>