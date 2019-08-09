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

    <title>Fehlerseite</title>

    <link rel="icon" href="https://www.uni-due.de/favicon.ico" />
    <link rel="apple-touch-icon" href="https://www.uni-due.de/imperia/md/images/cms/h/apple-touch-icon.png" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <link rel="stylesheet" type="text/css" href="css/github-corner.css" />

    <script src="js/libraries/jquery-3.2.1.min.js"></script>
</head>
<body>
    <div class="div--logo">
        <img class="img--logo" src="/media/AllgPsy_de_4c_einzeilig_2015.png" alt="Das Logo konnte nicht gefunden werden!" />
    </div>

    <a href="https://github.com/thahnen" class="github-corner" aria-label="View source on Github">
        <svg width="80" height="80" viewBox="0 0 250 250" style="fill:#151513; color:#fff; position: absolute; top: 0; border: 0; right: 0;" aria-hidden="true">
            <path d="M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z"></path>
            <path d="M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2" fill="currentColor" style="transform-origin: 130px 106px;" class="octo-arm"></path>
            <path d="M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z" fill="currentColor" class="octo-body"></path>
        </svg>
    </a>

    <div class="div--wrapper">
        <p>Sie sind auf der Fehlerseite gelandet :(</p>
        <p>Wenn möglich melden sie diesen Fehler bitte an uns mit einer Beschreibung:
            <a href="mailto:fehler@gdt.allgpsy.uni-due.de?subject=Fehler in GDT">Hier klicken</a>
        </p>
    </div>

    <div class="div--wrapper">
        <form action="">
            <input type="button" class="btn--steuerung btn--nav" id="btn_submit" value="Zum Anfang" />
            <input type="button" class="btn--steuerung btn--imp" id="btn_impressum" value="Impressum" />
        </form>
    </div>

<script>
    $(function() {
        $("#btn_submit").click(function() { window.location = "/index.php"; });
        $("#btn_impressum").click(function() { window.location = "/404.php"; });
    });
</script>
</body>
