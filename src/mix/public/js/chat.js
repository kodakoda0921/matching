
$('#direct_chat').hide();
$(function () {
    get_data();
});

function get_data() {
    $.ajax({
        url: "get/" + meeting_id,
        type: "GET",
        dataType: 'json',
        success: function (result) {
            $("#comment_data").find(".comment-visible")
                .remove();
            $('#direct_chat').show();
            result.forEach(function (res) {
                var html = `<div class="media comment-visible">
                <div class="direct-chat-msg">
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-left">${res.users.name}</span>
                    <span class="direct-chat-timestamp float-right">${res.update_timestamp}</span>
                </div>
                <div class="direct-chat-text">${res.comment}
                </div>
                </div>
                </div>`;
                var html_image = `<div class="media comment-visible">
                <div class="direct-chat-msg">
                <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name float-left">${res.users.name}</span>
                <span class="direct-chat-timestamp float-right">${res.update_timestamp}</span>
                </div>
                <img class="direct-chat-img" src="../../storage/img/${res.users.user_profiles.picture}">
                <div class="direct-chat-text">${res.comment}
                </div>
                </div>
                </div>`;
                if (res.users.user_profiles.picture != null) {
                    $("#comment_data").append(html_image);
                } else {
                    $("#comment_data").append(html);
                }

            });
        },
        error: function () {
            console.debug('error');
        }
    });
    setTimeout("get_data()", 10000);
};
$(function () {
    $("#send").click(function (e) {
        var input_message = document.getElementById("input_text").value;
        $.ajax({
            url: "put/",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'text',
            data: {
                meeting_id: meeting_id,
                comment: input_message
            },
            success: function () {
                console.log('success');
            },
            error: function () {
                console.log('error');
            }
        });
    });
});

function showClock() {
    var dt = new Date();
    var y = dt.getFullYear();
    var m = ("00" + (dt.getMonth() + 1)).slice(-2);
    var d = ("00" + dt.getDate()).slice(-2);
    var yyyymmdd = y + "/" + m + "/" + d;

    var nowTime = new Date();
    var nowHour = ("00" + nowTime.getHours()).slice(-2);
    var nowMin = ("00" + nowTime.getMinutes()).slice(-2);
    var time = nowHour + ":" + nowMin;

    document.getElementById("RealtimeClockArea").innerHTML = yyyymmdd + "　" + time;
}
setInterval('showClock()', 1000);
