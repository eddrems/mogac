var showOptionsMobile = false;

function js_ShowMobileOptions() {
    if (showOptionsMobile) { $('#optionsMobile').slideUp('fast', function () { $('#btnShowOptionsMobile').html("<i class=\"icon-chevron-down\"></i> Mostrar Opciones"); showOptionsMobile = false; }); } else { $('#optionsMobile').slideDown('fast', function () { $('#btnShowOptionsMobile').html("<i class=\"icon-chevron-up\"></i> Ocultar Opciones"); showOptionsMobile = true; }); }
}