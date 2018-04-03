$(function() {
    $("#btn_submit").click(function() { window.location = "/probandendaten.php"; });
    $("#btn_abbrechen").click(function() { if (confirm("Wollen GDT wirklich abbrechen?")) { window.location = "/abbruch.php"; } });
    $("#btn_impressum").click(function() { window.location = "/impressum.php"; });
});