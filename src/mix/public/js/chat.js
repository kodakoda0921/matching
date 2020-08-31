
$('#direct_chat').hide();
get_data();
$(function () {
    $("#reload").click(function (e) {
    get_data();
    });
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
                console.log(login_user);
                var html = `
                <div class="direct-chat-msg comment-visible">
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-left">${res.users.name}</span>
                    <span class="direct-chat-timestamp float-right">${res.update_timestamp}</span>
                </div>
                <div class="direct-chat-text">${res.comment}
                </div>

                </div>`;
                var html_image = `
                <div class="direct-chat-msg comment-visible">
                <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name float-left">${res.users.name}</span>
                <span class="direct-chat-timestamp float-right">${res.update_timestamp}</span>
                </div>
                <img class="direct-chat-img" src="../../storage/img/${res.users.user_profiles.picture}">
                <div class="direct-chat-text">${res.comment}
                </div>

                </div>`;
                var html_login_user = `
                <div class="direct-chat-msg right comment-visible">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-right">${res.users.name}</span>
                        <span class="direct-chat-timestamp float-left">${res.update_timestamp}</span>
                    </div>
                    <div class="direct-chat-text">
                    ${res.comment}
                    </div>

                </div>`;
                var html_login_user_image = `
                <div class="direct-chat-msg right comment-visible">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-right">${res.users.name}</span>
                        <span class="direct-chat-timestamp float-left">${res.update_timestamp}</span>
                    </div>
                    <img class="direct-chat-img" src="../../storage/img/${res.users.user_profiles.picture}"
                        alt="message user image">
                    <div class="direct-chat-text">
                    ${res.comment}
                    </div>
                </div>`;
                if (res.users.user_profiles.picture != null) {
                    if (res.user_id == login_user) {
                        $("#comment_data").append(html_login_user_image);
                    } else {
                        $("#comment_data").append(html_image);
                    }
                } else {
                    if (res.user_id == login_user) {
                        $("#comment_data").append(html_login_user);
                    } else {
                        $("#comment_data").append(html);
                    }
                }

            });
        },
        error: function () {
            console.debug('error');
        }
    });
};
$(function () {
    $("#send").click(function (e) {
        var input_message = document.getElementById("input_text").value;
        var input = document.getElementById("input_text");
        input.value = '';
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
            success: function (result) {
                if (result != "") {
                    get_data();
                    alert(result);
                }
            },
            error: function (result) {
                console.log('error');
            }
        });
    });
});
$(function () {
    $("input").keydown(function (e) {
        if ((e.which && e.which === 13) || (e.keyCode && e.keyCode === 13)) {
            return false;
        } else {
            return true;
        }
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
