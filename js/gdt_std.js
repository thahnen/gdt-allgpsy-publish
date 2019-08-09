/* ====================================================================
     * Copyright (C) 2017-2018 Hahnen Industries - All Rights Reserved
     *
     * This file is part of GDT.
     * Unauthorized copying of this file or the software, via any medium
     * is strictly prohibited and can not be distributed without the express
     * permission of Hahnen Industries representated by Tobias Hahnen
     *
     * Written by Tobias Hahnen <tobias.hahnen@stud.hn.de>, March 2018
    ===================================================================== */

'use strict';

$(function() {
    let rundenanzahl = 18;
    let aktuelle_runde = 1;

    // Alle die "zufälligen Werte" => wenn alles richtig +19000€/ alles falsch -17000€
    const werte = [5, 4, 1, 3, 6, 4, 2, 3, 6, 1, 2, 5, 3, 1, 5, 4, 2, 6];

    let guthaben = 1000;
    let ergebnisse = [];
    let wuerfel_auswahl;

    $(".wuerfel_btn").prop("disabled", true);
    $(".wuerfel_btn").css({"cursor": "not-allowed"});

    $("#btn_abbrechen").click(function() {
        if (confirm("Wollen sie die Seite wirklich verlassen und GDT damit abbrechen?")) {
            window.location = "/abbruch.php";
        }
    });

    $("#btn_start_weiter").click(function() {
        if ($(this).val() == "Start") {
            $(this).val("Weiter");

            if (guthaben >= 0) {
                document.getElementById("lbl_verlust").innerHTML = "- " + "0" + " €";
                document.getElementById("lbl_gewinn").innerHTML = "+ " + guthaben + " €";
            } else {
                document.getElementById("lbl_verlust").innerHTML = guthaben + " €";
                document.getElementById("lbl_gewinn").innerHTML = "+ " + "0" + " €";
            }
        } else if ($(this).val() == "Beenden") {
            let ganze_url = "/ende.php?gdt_version=standard&name_vpnum=" + name_vpnum + "&alter=" + alter + "&schuljahre=" + schuljahre + "&geschlecht=" + geschlecht + "&anzahl_ergebnisse=" + rundenanzahl;

            let erwartet_url = "&zuerwartende_werte=";
            for (let i=0; i < werte.length; i++) {
                if (i != werte.length-1) {
                    erwartet_url += werte[i] + "-";
                } else {
                    erwartet_url += werte[i];
                }
            }
            ganze_url += erwartet_url;

            let ergebnisse_url = "&ergebnisse=";
            for (let i=0; i < ergebnisse.length; i++) {
                if (i != ergebnisse.length-1) {
                    ergebnisse_url += ergebnisse[i] + "-";
                } else {
                    ergebnisse_url += ergebnisse[i];
                }
            }
            ganze_url += ergebnisse_url;
            ganze_url += "&guthaben=" + guthaben;
            window.location = ganze_url;
        }

        if (aktuelle_runde == rundenanzahl) {
            $(this).val("Beenden");
        }

        document.getElementById("lbl_runde").innerHTML = "Runde " + aktuelle_runde + " von " + rundenanzahl;
        aktuelle_runde++;

        $(".wuerfel_btn").prop("disabled", false);
        $(".wuerfel_btn").css({"cursor": "pointer"});

        $(this).prop("disabled", true);
        $(this).css({"cursor": "not-allowed"});
    });

    $(".wuerfel_btn").click(function() {
        wuerfel_auswahl = ($(this).attr("id")).replace("wuerfel_btn_", "");
        ergebnisse.push(wuerfel_auswahl);

        // Die Würfel wieder sperren
        $(".wuerfel_btn").prop("disabled", true);
        $(".wuerfel_btn").css({"cursor": "not-allowed"});

        // Neues Guthaben berechnen
        let erwarteter_wert = werte[aktuelle_runde-2];

        // Wenn richtig oder falsch jeweils animieren
        if (wuerfel_auswahl.length == 4) {
            if (wuerfel_auswahl.indexOf(erwarteter_wert) > -1) { guthaben += 100; }
            else { guthaben -= 100; }
        } else if (wuerfel_auswahl.length == 3) {
            if (wuerfel_auswahl.indexOf(erwarteter_wert) > -1) { guthaben += 200; }
            else { guthaben -= 200; }
        } else if (wuerfel_auswahl.length == 2) {
            if (wuerfel_auswahl.indexOf(erwarteter_wert) > -1) { guthaben += 500; }
            else { guthaben -= 500; }
        } else if (wuerfel_auswahl.length == 1) {
            if (wuerfel_auswahl.indexOf(erwarteter_wert) > -1) { guthaben += 1000; }
            else { guthaben -= 1000; }
        } else {
            // Irgendwie besser lösen
            alert("Fehler mit Auswertung Würfel!");
        }

        /* Animation zeigen die 3 Sekunden lang würfelt */

        /* Ergebnis zeigen/ Alle Infos neusetzen (Canvas, Gewinn/ Verlust) */
        if (guthaben >= 0) {
            document.getElementById("lbl_verlust").innerHTML = "- " + "0" + " €";
            document.getElementById("lbl_gewinn").innerHTML = "+ " + guthaben + " €";
        } else {
            document.getElementById("lbl_verlust").innerHTML = guthaben + " €";
            document.getElementById("lbl_gewinn").innerHTML = "+ " + "0" + " €";
        }

        /* Start/Weiter-Button aktivieren */
        $("#btn_start_weiter").prop("disabled", false);
        $("#btn_start_weiter").css({"cursor": "pointer"});
    });
})
