$(function () {
    init();
    $('#copy_1').on('click', function () {
        copy(1, 2);
        copy(1, 3);
    });
    $('#copy_2_1').on('click', function () {
        copy(2, 1);
    });
    $('#copy_2_3').on('click', function () {
        copy(2, 3);
    });

    //不存在チェックボックス
    $('#UnitNone1').change(function () {
        if ($(this).is(':checked')) {
            clearSpec(1);
        }
    });
    $('#UnitNone2').change(function () {
        if ($(this).is(':checked')) {
            clearSpec(2);
        }
    });
    $('#UnitNone3').change(function () {
        if ($(this).is(':checked')) {
            clearSpec(3);
        }
    });

    //対爆撃機はドイツのみ
    $("input[name='data[Unit][nationality]']").on('click', function () {
        decideUntiFighter();
       
    });
    //増槽なし距離は戦闘機のみ
    $("input[name='data[Unit][type]']").on('click', function () {
        decideCrusingRangeNotank();
       
    });
  
});
//初期表示時処理
function init() {
    decideUntiFighter();
    decideCrusingRangeNotank()
}
function check() {
    if (window.confirm('登録しますか？')) {
        return true;
    } else {
        return false;
    }
}
//スペックコピー
function copy(i, j) {
    var fields = ['FightingSpeed', 'CrusingSpeed', 'CrusingRange', 'CrusingRangeNotank', 'UntiFighter', 'UntiBomber'];
    $.each(fields,function(index,val){
        $('#Unitspec' + j + val).val($('#Unitspec' + i + val).val())
    });
}
function disableUntiFighter() {
    $('#Unitspec1UntiBomber').prop('disabled', true);
    $('#Unitspec2UntiBomber').prop('disabled', true);
    $('#Unitspec3UntiBomber').prop('disabled', true);
}
function activateUntiFighter() {
    $('#Unitspec1UntiBomber').prop('disabled', false);
    $('#Unitspec2UntiBomber').prop('disabled', false);
    $('#Unitspec3UntiBomber').prop('disabled', false);
}
function decideUntiFighter() {
    if ($("input[name='data[Unit][nationality]']:checked").val() != 3) {
        disableUntiFighter();
    } else {
        activateUntiFighter();
    }
}
function disableCrusingRangeNotank() {
    $('#Unitspec1CrusingRangeNotank').prop('disabled', true);
    $('#Unitspec2CrusingRangeNotank').prop('disabled', true);
    $('#Unitspec3CrusingRangeNotank').prop('disabled', true);
}
function activateCrusingRangeNotank() {
    $('#Unitspec1CrusingRangeNotank').prop('disabled', false);
    $('#Unitspec2CrusingRangeNotank').prop('disabled', false);
    $('#Unitspec3CrusingRangeNotank').prop('disabled', false);
}
function decideCrusingRangeNotank() {
    if ($("input[name='data[Unit][type]']:checked").val() != 1) {
        disableCrusingRangeNotank();
    } else {
        activateCrusingRangeNotank();
    }
}
//スペックをクリア
function clearSpec(i) {
    var fields = ['FightingSpeed', 'CrusingSpeed', 'CrusingRange', 'CrusingRangeNotank', 'UntiFighter', 'UntiBomber'];
    $.each(fields,function(index,val){
        $('#Unitspec' + i + val).val('')
    });
}