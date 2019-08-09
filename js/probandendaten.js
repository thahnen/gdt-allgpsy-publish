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
    let name_vpnum = alter = schuljahre = geschlecht = "";

    $("#btn_submit").click(function() {
        name_vpnum = $("input[name=name_vpnum]").val();
        alter = $("input[name=alter]").val();
        schuljahre = $("input[name=schuljahre]").val();
        geschlecht = $("input[name=geschlecht]:checked").val();

        let error = 0;

        // Mit jemandem abklären, wie die aufgebaut sind!
        if (name_vpnum == "") {
            error |= 8;
        }

        if (alter != "") {
            try {
                alter = parseInt(alter, 10);
                if (isNaN(alter) || ((alter < 0) || (alter > 125))) {
                    error |= 2;
                }
            } catch (err) {
                error |= 2;
            }
        } else {
            error |= 2;
        }

        // Schuljahre sollte zwischen 9 und 13 liegen (wiederholte werden nicht mitberechnet)
        if (schuljahre != "") {
            try {
                schuljahre = parseInt(schuljahre, 10);
                if (isNaN(schuljahre) || ((schuljahre < 0) || (schuljahre > 13))) {
                    error |= 1;
                }
            } catch (err) {
                error |= 1;
            }
        } else {
            error |= 1;
        }

        if (typeof geschlecht === "undefined") {
            error |= 4;
        }

        if (error != 0) {
            if ((error >>> 3) & 1) {
                $("input[name=name_vpnum]").css({"border-color": "red"});
            }
            if ((error >>> 1) & 1) {
                $("input[name=alter]").css({"border-color": "red"});
            }
            if (error & 1) {
                $("input[name=schuljahre]").css({"border-color": "red"});
            }
        } else {
            window.location = "auswahl.php?name_vpnum=" + name_vpnum + "&alter=" + alter + "&schuljahre=" + schuljahre + "&geschlecht=" + geschlecht;
        }
    });

    $("#btn_abbrechen").click(function() {
        if (confirm("Wollen sie die Dateneingabe abbrechen?")) {
            window.location = "/abbruch.php";
        }
    });

    $("input[name=name_vpnum]").focus(function() {
        $(this).css({"border-color": "initial"});
    });

    $("input[name=alter]").focus(function() {
        $(this).css({"border-color": "initial"});
    });

    $("input[name=schuljahre]").focus(function() {
        $(this).css({"border-color": "initial"});
    });
});
