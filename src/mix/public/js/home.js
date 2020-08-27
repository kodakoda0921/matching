
var abnormality_tmp_main = 0;
var table = new Tabulator("#example-table", {
  layout: "fitColumns", //fit columns to width of table
  responsiveLayout: "hide", //hide columns that dont fit on the table
  tooltips: true, //show tool tips on cells
  addRowPos: "top", //when adding a new row, add it to the top of the table
  history: true, //allow undo and redo actions on the table
  pagination: "local", //paginate the data
  paginationSize: 10, //allow 7 rows per page of data
  paginationSizeSelector: [10, 25, 50, 100],
  movableColumns: false, //allow column order to be changed
  resizableRows: false, //allow row height fix
  index: "id", //set the index field to the "no" field.
  //   resizableColumns:false,
  initialSort: [ //set the initial sort order of the data
    {
      column: "id",
      dir: "desc"
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
      sorter: "number",
      visible: false
    },
    {
      title: "勉強会名",
      field: "title",
      widthGrow: 3
    },
    {
      title: "言語",
      field: "language",
      widthGrow: 2
    },
    {
      title: "場所",
      field: "area",
      widthGrow: 2
    },
    {
      title: "開催日",
      field: "event_date",
      widthGrow: 3
    }
  ],
  rowClick: function (e, row) {
    var row_id = row._row.data.id;
    console.log("row: ", row_id);
    setModalData(row_id);
    $('#modal-success').modal('show');
  },
});
table.setLocale("ja-ja");

function setModalData(row_id) {
  $.ajax({
    url: "meeting/search/" + row_id,
    type: "GET",
    dataType: 'json',
    //リクエストが完了するまで実行される
    beforeSend: function () {
      $('#user').text('処理中...');
      $('#title').text('処理中...');
      $('#language').text('処理中...');
      $('#area').text('処理中...');
      $('#date').text('処理中...');
      $('#overview').text('処理中...');
      $('#join').text('処理中...');
      $('#meeting_image').hide();
      $("#join_button").prop("disabled", true).text("処理中...")
    },
    success: function (res) {
      $('#user').text(res.res.users.name);
      $('#title').text(res.res.title);
      $('#language').text(res.res.languages.language);
      $('#area').text(res.res.areas.area);
      $('#date').text(res.res.event_date);
      $('#overview').text(res.res.overview);
      $('#join').text(res.count);
      if (res.exist == true){
        $('#join_button').prop("disabled", true).text("参加申請済");
      } else {
        $('#join_button').attr('value', res.res.id).prop("disabled", false).text("参加申請")
      };
      
      if (res.res.picture == null) {
        $('#meeting_image').hide();
      } else {
        $('#meeting_image').attr('src', 'storage/img/' + res.res.picture).show();
      };
    },
    error: function () {
      console.debug('error');
    }
  });
};

$(function () {
  $("#join_button").on("click", function () {

    var con = confirm("参加申請をします。よろしいですか？")
    if (con == true) {
      var id = document.getElementById("join_button").value;
      $.ajax({
        url: "meeting/join/" + id,
        type: "PUT",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
          $("#join_button").prop("disabled", true)
        },
        success: function (messeage) {
          $('#modal-success').modal('hide');
          alert(messeage);
        },
        error: function () {
          console.debug('error');
        }
      });
    };

  });
});

$(function () {
  $("#sendUpdateButton").on("click", function () {
    var v_singer = 0;
    var v_mixer = 0;

    if ($("#chckbxSinger").prop("checked")) { v_singer = 1; }
    if ($("#chckbxMixer").prop("checked")) { v_mixer = 1; }

    $.ajax({
      url: "meetingSerch",
      data: {
        date: $("input#date").val(),
        singer: v_singer,
        mixer: v_mixer,
      },
      type: "GET",
      dataType: 'json',
      success: function (data) {
        var tabledata = data.data;
        table.setData(tabledata);
      },
      error: function () {
        console.debug('error');
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
