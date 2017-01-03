$(function () {
    $("input[name=meanings]:radio").change(function () {
        $("input[name=selectedMng]:hidden").val($("input[name=meanings]:checked").val());
        $("input[name=meanings]:radio").attr('disabled', 'disabled');
        $("p#correctMng").removeClass('hidden');
    });
});
