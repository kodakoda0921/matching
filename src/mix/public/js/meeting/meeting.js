// var span = document.getElementById("aaa");
// console.log(span);

// $.ajax({
//     url: "meeting/search/" + row_id,
//     type: "GET",
//     dataType: 'json',
//     //リクエストが完了するまで実行される
//     beforeSend: function () {
//     },
//     success: function (res) {

//     },
//     error: function () {
//     }
// });

    
function showClock() {
    var dt = new Date();
    var y = dt.getFullYear();
    var m = ("00" + (dt.getMonth()+1)).slice(-2);
    var d = ("00" + dt.getDate()).slice(-2);
    var yyyymmdd = y + "/" + m + "/" + d;

    var nowTime = new Date();
    var nowHour =  ("00" + nowTime.getHours()).slice(-2);
    var nowMin  = ("00" + nowTime.getMinutes()).slice(-2);
    var time = nowHour + ":" + nowMin;

    document.getElementById("RealtimeClockArea").innerHTML = yyyymmdd + "　" +time;
  }
  setInterval('showClock()',1000);