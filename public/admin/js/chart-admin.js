var _token = $('input[name="_token"]').val();
var date_start = $('input[name="date_start"]').val();
var date_end = $('input[name="date_end"]').val();

var ma_nguoi_dung = $('#ma_nguoi_dung').val();
var ma_nguoi_duyet = $('#ma_nguoi_duyet').val();

var room_ids = $('#room_ids').val();
var uses_ids = $('#uses_ids').val();

if (document.getElementById("horizontalBar")) {
    $.ajax({
        url: "ajax/get-chart-admin",
        method: 'post',
        data: {
            date_start: date_start,
            date_end: date_end,
            ma_nguoi_dung: ma_nguoi_dung,
            ma_nguoi_duyet: ma_nguoi_duyet,
            room_ids: room_ids,
            uses_ids: uses_ids,
            _token: _token,
        },
        success: function (data) {
            new Chart(document.getElementById("horizontalBar"), {
                "type": "horizontalBar",
                "data": {
                    "labels": data.chart_list_room,
                    "datasets": [{
                        "label": "Số giờ mượn",
                        "data": data.chart_value,
                        "fill": false,
                        "backgroundColor": data.backgroundColor,
                        "borderColor": data.borderColor,
                        "borderWidth": 1
                    }]
                },
                "options": {
                    "scales": {
                        "xAxes": [{
                            "ticks": {
                                "beginAtZero": true
                            }
                        }]
                    }
                }
            });
        },
    });
}


