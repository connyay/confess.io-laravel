jQuery(function ($) {
    var puralize = function (count, text) {
        if (count === 1) {
            return "1 " + text
        } else {
            return count + " " + text + "s"
        }
    };
    var doVote = function (e, id, vote, target) {
        $.ajax({
            type: "POST",
            url: "http://localhost/lv_base/public/ns/vote",
            data: {
                id: id,
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
    $(".hug-tab, .shrug-tab").click(function (ev) {
        ev.preventDefault();
        ev.stopPropagation();
        $this = $(this);
        if (!$this.hasClass("active")) {
            $this.addClass("active").siblings().removeClass("active");
            doVote(ev, $this.data("id"), $this.data("v"), this);
        }
    });
});