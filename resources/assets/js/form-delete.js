$(".btn-delete").click(function (e) {
    if (confirm($(this).data("message"))) {
        $(this.closest('form')).submit();
    }
    return false;
});
