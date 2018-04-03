$(function() {
    var rundenanzahl = 18;
    var aktuelle_runde = 1;

    var werte = [5, 4, 1, 3, 6, 4, 2, 3, 6, 1, 2, 5, 3, 1, 5, 4, 2, 6];

    var guthaben = 1000;
    var ergebnisse = [];
    var wuerfel_auswahl;

    var popup_inhalt;

    $(".wuerfel_btn").prop("disabled", true);
    $(".wuerfel_btn").css({"cursor": "not-allowed"});

    $("#btn_abbrechen").click(function() { if (confirm("Wollen sie die Seite wirklich verlassen und GDT damit abbrechen?")) { window.location = "/abbruch.php"; } });

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
            var ganze_url = "/ende.php?gdt_version=standard&name_vpnum=" + name_vpnum + "&alter=" + alter + "&schuljahre=" + schuljahre + "&geschlecht=" + geschlecht + "&anzahl_ergebnisse=" + rundenanzahl;

            var erwartet_url = "&zuerwartende_werte=";
            for (var i=0; i < werte.length; i++) {
                if (i != werte.length-1) { erwartet_url += werte[i] + "-"; }
                else { erwartet_url += werte[i]; }
            }
            ganze_url += erwartet_url;

            var ergebnisse_url = "&ergebnisse=";
            for (var i=0; i < ergebnisse.length; i++) {
                if (i != ergebnisse.length-1) { ergebnisse_url += ergebnisse[i] + "-"; }
                else { ergebnisse_url += ergebnisse[i]; }
            }
            ganze_url += ergebnisse_url;
            ganze_url += "&guthaben=" + guthaben;

            window.location = ganze_url;
        }

        if (aktuelle_runde == rundenanzahl) { $(this).val("Beenden"); }
        
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
        var erwarteter_wert = werte[aktuelle_runde-2];
        
        // Wenn richtig oder falsch jeweils animieren
        if (wuerfel_auswahl.length == 4) {
            if (wuerfel_auswahl.indexOf(erwarteter_wert) > -1) { guthaben += 100; popup_inhalt = 100; }
            else { guthaben -= 100; popup_inhalt = -100; }
        } else if (wuerfel_auswahl.length == 3) {
            if (wuerfel_auswahl.indexOf(erwarteter_wert) > -1) { guthaben += 200; popup_inhalt = 200; }
            else { guthaben -= 200; popup_inhalt = -200; }
        } else if (wuerfel_auswahl.length == 2) {
            if (wuerfel_auswahl.indexOf(erwarteter_wert) > -1) { guthaben += 500; popup_inhalt = 500; }
            else { guthaben -= 500; popup_inhalt = -500; }
        } else if (wuerfel_auswahl.length == 1) {
            if (wuerfel_auswahl.indexOf(erwarteter_wert) > -1) { guthaben += 1000; popup_inhalt = 1000; }
            else { guthaben -= 1000; popup_inhalt = -1000; }
        } else {
            // Irgendwie besser lösen
            alert("Fehler mit Auswertung Würfel!");
        }

        /*
            Animation zeigen die 3 Sekunden lang würfelt ODER
            Popup zeigen, das man selbst wegdrücken muss UND "Hurra"/ "Buh" Sound abspielen?
        */
        var style_h2;

        if (popup_inhalt < 0) { style_h2 = "color: red"; }
        else { style_h2 = "color: green"; }

        $.fancybox.open("                                                   \
            <div style='border-radius: 25px'>                               \
                <h1 style='" + style_h2 + "'>" + popup_inhalt + "</h1>      \
            </div>                                                          \
        ");

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