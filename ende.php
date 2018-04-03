<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <title>GDT Ende</title>

    <meta name="author" content="Tobias Hahnen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="format-detection" content="telephone=no">
    
    <link rel="icon" href="https://www.uni-due.de/favicon.ico">
    <link rel="apple-touch-icon" href="https://www.uni-due.de/imperia/md/images/cms/h/apple-touch-icon.png">
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <link rel="stylesheet" type="text/css" href="css/github-corner.css">

    <script src="js/libraries/jquery-3.2.1.min.js"></script>
</head>
<body>
<?php
error_reporting(E_ERROR | E_WARNING); // später durch 0 ersetzen!

$parameter = [];
$err = "Error";

function Get($index, $defaultValue) { return isset($_GET[$index]) ? $_GET[$index] : $defaultValue; }

function test_input($data) { return htmlspecialchars(stripslashes(trim($data))); }

function endsWith($haystack, $needle) {
    $length = strlen($needle);
    return $length === 0 || (substr($haystack, -$length) === $needle);
}


/* GDT-Version (Ablauf für alle Versionen gleich) */
$lversion = test_input(Get("gdt_version", $err));
if ($lversion == $err) { goto fehler; }
else { $parameter[0] = $lversion; }


/* Probandendaten (Ablauf für alle Versionen gleich) */
$parameter[1] = [];

$ln_vpn = test_input(Get("name_vpnum", $err));
if ($ln_vpn == $err) { goto fehler; }
else { $parameter[1][0] = $ln_vpn; }

$lalter = test_input(Get("alter", $err));
if ($lalter == $err) { goto fehler; }
else { try {
        $lalter = intval($lalter);
        if ($lalter <= 0 || $lalter > 125) { goto fehler; }
        $parameter[1][1] = $lalter;
    } catch (Exception $e) { goto fehler; }
}

$lschuljahre = test_input(Get("schuljahre", $err));
if ($lschuljahre == $err) { goto fehler; }
else { try {
        $lschuljahre = intval($lschuljahre);
        if ($lschuljahre <= 0 || $lschuljahre > 20) { goto fehler; }
        $parameter[1][2] = $lschuljahre;
    } catch (Exception $e) { goto fehler; }
}

$lgeschlecht = test_input(Get("geschlecht", $err));
if ($lgeschlecht == $err) { goto fehler; }
else { $parameter[1][3] = $lgeschlecht; }


/* Versionsabhängig von hier an: */
if ($parameter[0] == "standard") {
    // Anzahl der Ergebnisse
    $lanzahl_ergebnisse = test_input(Get("anzahl_ergebnisse", $err));
    if ($lanzahl_ergebnisse == $err) { goto fehler; }
    else { try {
            // Keine Einschränkung, nur wenn Einstellung anders (was zu implementieren wäre)!
            $parameter[2] = intval($lanzahl_ergebnisse);
        } catch (Exception $e) { goto fehler; }
    }

    // Erwartete Ergebnisse
    $lerwartete_ergebnisse = test_input(Get("zuerwartende_werte", $err));
    if ($lerwartete_ergebnisse == $err) { goto fehler; }
    else {
        $erwartet_array = explode("-", $lerwartete_ergebnisse);
        if ($parameter[2] != count($erwartet_array)) { goto fehler; }
        $parameter[3] = $erwartet_array;
    }

    // Erspielte Ergebnisse
    $lerspielte_ergebnisse = test_input(Get("ergebnisse", $err));
    if ($lerspielte_ergebnisse == $err) { goto fehler; }
    else {
        $ergebnisse_array = explode("-", $lerspielte_ergebnisse);
        if ($parameter[2] != count($ergebnisse_array)) { goto fehler; }
        $parameter[4] = $ergebnisse_array;
    }

    // Erspieltes Guthaben
    $lguthaben = test_input(Get("guthaben", $err));
    if ($lguthaben == $err) { goto fehler; }
    else { try {
            // Überprüfen, ob mit Ergebnissen Guthaben rekonstruierbar und gleich (wäre zu impl.)
            // Bei anderen Einstellungen noch mit Start-Guthaben abgleichen?
            $parameter[5] = intval($lguthaben);
        } catch (Exception $e) { goto fehler; }
    }

    // Alles auf Richtigkeit überprüfen (wäre zu impl.)

    // Dateinamen erstellen und überprüfen
    $path = "./ergebnisse/";
    $filename = md5($parameter[0] . $parameter[1][0] . $parameter[5]);
    
    if ($handle = opendir($path)) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                if ($entry == ($filename . ".txt") || $entry == ($filename . ".spss")) {
                    // Dateinamen neu setzen
                    if (endsWith(explode(".", $entry)[0], "i")) { $filename = $filename . "i"; }
                    else { $filename = $filename . "-i"; }
                }
            }
        }
        closedir($handle);
    }

    // Abspeichern als TXT-Datei
    $filename = $filename . ".txt";
    $file = fopen($path . $filename, "w");

    $txt = "GDT-Version: " . $parameter[0] . "\n";

    date_default_timezone_set("Europe/Berlin");
    $uhrzeit_unformatiert = time();
    $uhrzeit = date("d.m.Y", $uhrzeit_unformatiert) . " - " . date("H:i", $uhrzeit_unformatiert) . " Uhr";
    $txt = $txt . "Gespielt am " . $uhrzeit . "\n\n";

    $txt = $txt . "Proband: " . $parameter[1][0] . "\n";
    $txt = $txt . "Alter: " . $parameter[1][1] . "\n";
    $txt = $txt . "Bildung: " . $parameter[1][2] . "\n";
    $txt = $txt . "Geschlecht: " . $parameter[1][3] . "\n\n";

    $txt = $txt . "Runde Gewürfelt Erwartet\n";
    for ($i = 0; $i < $parameter[2]; $i++) {
        // Wird nicht so ganz nach dem Schemata, das kommt aber danach alles noch
        $txt = $txt . ($i+1) . "\t\t" . $parameter[4][$i] . "\t\t" . $parameter[3][$i] . "\n";
    }

    $txt = $txt . "\nKontostand: " . $parameter[5];
    
    fwrite($file, $txt);
    fclose($file);

    // Abspeichern als SPSS-Datei (wäre zu impl.)
} else if ($parameter[0] == "mod") {
    // GDTmod ...
} else {
    // Keine Implementierung vorhanden oder fehlerhafte Parameter
}

goto ende;

// Fehler, falls die mitgegebenen Parameter falsch sind wird auf Fehlerseite gesprungen!
fehler: header("Location: /fehler.php");
ende:;
?>
    
    <div class="div--logo">
        <img class="img--logo" src="/media/AllgPsy_de_4c_einzeilig_2015.png" alt="Das Logo konnte nicht gefunden werden!">
    </div>

    <a href="https://github.com/thahnen/gdt-allgpsy-publish" class="github-corner" aria-label="View source on Github">
        <svg width="80" height="80" viewBox="0 0 250 250" style="fill:#151513; color:#fff; position: absolute; top: 0; border: 0; right: 0;" aria-hidden="true">
            <path d="M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z"></path>
            <path d="M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2" fill="currentColor" style="transform-origin: 130px 106px;" class="octo-arm"></path>
            <path d="M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z" fill="currentColor" class="octo-body"></path>
        </svg>
    </a>

    <div class="div--wrapper">
        <p>Vielen Dank, dass sie GDT durchgeführt haben. Sie können diese Website nun schliessen.</p>
    </div>

    <script>
        window.onload = function() { history.replaceState({}, document.title, "/ende.php"); };
    </script>
</body>
</html>