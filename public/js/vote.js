jQuery(function ($) {
    var _token = $('meta[name="csrf-token"]').attr('content');
    var puralize = function (count, text) {
        return count + " " + text + ((count === 1) ? "" : "s");
    };
    var doVote = function (e, hash, vote, target) {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/n/" + hash + "/vote",
            data: {
                vote: vote,
                _token: _token
            },
            success: function (data, textStatus, xhr) {
                if (xhr.status === 201) {
                    var count = parseInt(target.innerHTML, 10);
                    count += 1;
                    target.innerHTML = puralize(count, data.vote)
                }
                else if(xhr.status === 200) {
                    var other = $(target).siblings()[0];
                    var count = parseInt(target.innerHTML, 10);
                    var otherCount = parseInt(other.innerHTML, 10);
                    count += 1;
                    otherCount -= 1;
                    otherCount = Math.min(0, Math.abs(otherCount));
                    if (vote === 1) {
                        target.innerHTML = puralize(count, data.vote);
                        other.innerHTML = puralize(otherCount, "Shrug")
                    } else {
                        target.innerHTML = puralize(count, data.vote);
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