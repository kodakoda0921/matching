
    var abnormality_tmp_main = 0;
    var table = new Tabulator("#example-table", {
      layout: "fitColumns", //fit columns to width of table
      //responsiveLayout: "hide", //hide columns that dont fit on the table
      tooltips: true, //show tool tips on cells
      addRowPos: "top", //when adding a new row, add it to the top of the table
      history: true, //allow undo and redo actions on the table
      pagination: "local", //paginate the data
      paginationSize: 10, //allow 7 rows per page of data
      paginationSizeSelector:[10, 25, 50, 100],
      movableColumns: false, //allow column order to be changed
      resizableRows: false, //allow row height fix
      index:"id", //set the index field to the "no" field.
    //   resizableColumns:false,
      initialSort: [ //set the initial sort order of the data
        {
          column: "id",
          dir: "asc"
        },
      ],
      langs: {
        "ja-ja": { //French language definition
          "pagination": {
            "first": "最初",
            "first_title": "最初",
            "last": "最後",
            "last_title": "最後",
            "prev": "前へ",
            "prev_title": "前へ",
            "next": "次へ",
            "next_title": "次へ",
          },
        }
      },
      columns: [ //define the table columns
        {
          title: "ユーザーID",
          field: "id",
          visible:false
        },
        {
          title: "名前",
          field: "user_name",
          sorter: "number",
          widthGrow:4,


        },
        {
          title: "歌い手",
          field: "singer",
          align: "left",
          widthGrow:2,

        },
        {
          title: "MIX師",
          field: "mixer",
          align: "left",
          widthGrow:2,

        }
      ],
    });
    table.setLocale("ja-ja");

//

$(function() {
  $("#sendUpdateButton").on("click", function(){
    var v_singer = 0;
    var v_mixer = 0;

    if ($("#chckbxSinger").prop("checked")) {v_singer = 1;}
    if ($("#chckbxMixer").prop("checked")) {v_mixer = 1;}

    $.ajax({
      url: "/api/userProfile",
      data: {
        date: $("input#date").val(),
        singer: v_singer,
        mixer: v_mixer,
      },
      type: "GET",
      //async: false,
      dataType: 'json',
      success:function(data) {
        //console.debug('sendUpdateButton:');
        var tabledata = data.data;
        //console.debug('tabledata : ' + JSON.stringify(tabledata));

        table.setData(tabledata);
      },
      error: function() {
        console.debug('error');
      }
    });
  });
});

//先頭ゼロ付加
function padZero(num) {
	var result;
	if (num < 10) {
		result = "0" + num;
	} else {
		result = "" + num;
	}
	return result;
}

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
