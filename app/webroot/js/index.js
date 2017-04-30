$(function () {
    $(window).scrollTop(120);
    var calculateFlg = $('#calculate_flg').val();
    if (calculateFlg) {
        window.open("/units/calculate",
                "Calculate",
                "width=800,height=600,top=100,left=100");
    }
    $('#clear').on('click', function () {
        $('#UnitName').val('');
    });
    $('#artillery').on('click', function () {
        $('#UnitName').val('YB40');
    });
    $('#rocket').on('click', function () {
        $('#UnitName').val('Me163');
    });
    $('#modified').on('click', function () {
        $('#UnitName').val('B17 YB40 B26 Me262 He162');
    });
});