jQuery(function($) {
var confessBox = $("#confessionBox");
confessBox.focus();
var showDialog = function (e) {
    e.preventDefault();
    $("#createModal").modal("show");
    $("#confirm").focus()
};
confessBox.on('input', function (e) {
    if (confessBox.val()) {
        $("#submitBtn").removeAttr("disabled");
    } else {
        $("#submitBtn").attr("disabled", "disabled");
    }
});
$("#confirm").click(function (e) {
    $("#submitBtn").attr("disabled", "disabled");
    $("#confirm").attr("disabled", "disabled");
    $("#confession-form").unbind("submit").submit()
});
$("#formatting").click(function (e) {
    e.preventDefault();
    $("#formatModal").reveal()
});
$("#confession-form").submit(function (e) {
showDialog(e)
})
});