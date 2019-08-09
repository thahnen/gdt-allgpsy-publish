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
    $("#btn_submit").click(function() {
        window.location = "/probandendaten.php";
    });

    $("#btn_abbrechen").click(function() {
        if (confirm("Wollen GDT wirklich abbrechen?")) {
            window.location = "/abbruch.php";
        }
    });

    $("#btn_impressum").click(function() {
        window.location = "/404.php";
    });
});
