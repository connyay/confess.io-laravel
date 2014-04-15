jQuery(function ($) {
    var _token = $('meta[name="csrf-token"]').attr('content');
    var puralize = function (count, text) {
        return count + " " + text + ((count === 1) ? "" : "s");
    };
    var doVote = function (e, hash, vote, target) {
        $.ajax({
            type: "POST",
            url: "/n/" + hash + "/vote",
            data: {
                vote: vote,
                _token: _token
            },
            success: function (response) {
                var data = JSON.parse(response);
                if (data.result === "new") {
                    var count = parseInt(target.innerHTML, 10);
                    count += 1;
                    if (vote === 1) {
                        target.innerHTML = puralize(count, "Hug")
                    } else {
                        target.innerHTML = puralize(count, "Shrug")
                    }
                }
                if (data.result === "changed") {
                    var other = $(target).siblings()[0];
                    var count = parseInt(target.innerHTML, 10);
                    var otherCount = parseInt(other.innerHTML, 10);
                    count += 1;
                    otherCount -= 1;
                    otherCount = Math.min(0, Math.abs(otherCount));
                    if (vote === 1) {
                        target.innerHTML = puralize(count, "Hug");
                        other.innerHTML = puralize(otherCount, "Shrug")
                    } else {
                        target.innerHTML = puralize(count, "Shrug");
                        other.innerHTML = puralize(otherCount, "Hug")
                    }
                }
            }
        })
    };
    $(".btn-hug, .btn-shrug").click(function (ev) {
        ev.preventDefault();
        ev.stopPropagation();
        $this = $(this);
        if (!$this.hasClass("active")) {
            $this.addClass("active").siblings().removeClass("active");
            doVote(ev, $this.data("hash"), $this.data("v"), this);
        }
    });
});