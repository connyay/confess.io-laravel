jQuery(function($) {
$("#confessionBox").focus();
var showDialog = function (e) {
    e.preventDefault();
    $("#createModal").modal("show");
    $("#confirm").focus()
};
$("#confessionBox").keyup(function (e) {
    if ($("#confessionBox").val() == "") {
        $("#submitBtn").attr("disabled", "disabled")
    } else {
        $("#submitBtn").removeAttr("disabled")
    }
});
$("#confirm").click(function (e) {
    $("#submitBtn").attr("disabled", "disabled");
    $("#confirm").attr("disabled", "disabled");
    $("#confessions-form").unbind("submit").submit()
});
$("#formatting").click(function (e) {
    e.preventDefault();
    $("#formatModal").reveal()
});
$("#confessions-form").submit(function (e) {
showDialog(e)
})
});