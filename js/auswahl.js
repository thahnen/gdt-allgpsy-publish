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
    let gdt_version = "-1";

    $("#btn_submit").click(function() {
        if ($("input[name=gdt_version]").is(":checked")) {
            gdt_version = $("input[name=gdt_version]:checked").val();
        } else {
            // Das muss irgendwie besser gelöst werden!
            alert("Es ist ein Fehler aufgetreten, keiner der Radio Buttons wurde angeklickt!");
            return false;
        }

        let link = "fehler.php";

        if (gdt_version == "standard" /*|| gdt_version == "..." */) {
            link = gdt_version + ".php?" + "name_vpnum=" + name_vpnum + "&alter=" + alter + "&schuljahre=" + schuljahre + "&geschlecht=" + geschlecht;
        }

        window.location = link;
    });

    $("#btn_abbrechen").click(function() {
        if (confirm("Wollen sie die Dateneingabe abbrechen?")) {
            window.location = "/abbruch.php";
        }
    });
});
