<form method="GET" class="frm" id="frmReport">
    <div class="container">
    <div class="box-title">Lọc</div>
    </div>
    <div class="row">
        <div class="col-5">
            <div class="row form-group">
                <div class="col col-md-3"><label for="select" class=" form-control-label">Trạng thái</label></div>
                <div class="col-12 col-md-9">
                    <select name="select" id="select" class="form-control">
                        <option value="0">Tất cả</option>
                        <option value="1">Đang chờ</option>
                        <option value="2">Đã hủy</option>
                        <option value="3">Thành công</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- col 4 -->
        <div class="col-4">
            <div class="form-group">
                Thời gian
                <span><i class="fa fa-calendar"></i></span>
                <input id="reportrange" type="text" readonly="readonly" class="form-input">
            </div>
        </div>
    </div>

    <div class="form-btn">
        <button class="btn btn-primary" type="submit">Tìm kiếm</button>
        <button class="btn btn-info" id="btnReport" type="button"><i class="fa fa-file"></i> Export</button>
    </div>
</form>
<br>
<div class="row">
    <div class="col-12">
    <div class="card">
            <div class="card-body">
                <h4 class="box-title">Danh sách đơn vay </h4>
            </div>
            <div class="card-body--">
                <div class="table-stats order-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Họ tên</th>
                                <th>SDT</th>
                                <th>Số tiền</th>
                                <th>Cộng tác viên</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody id="result">
                            
                        </tbody>
                    </table>
                </div> <!-- /.table-stats -->
            </div>
        </div> <!-- /.card -->
    </div>
</div>
<input type="hidden" value="<?php echo homeurl();?>" id="url">
<script>
    $(document).ready(function(){
        var startD;
        var endD;
    });
</script>
<script src="modules/orders/report.js"></script>
<script src="modules/orders/app.js"></script>
<script type="text/javascript">
    startD = moment().format('YYYY-MM-DD');
    endD = moment().format('YYYY-MM-DD');
    //console.log(startD);
    $('#reportrange').daterangepicker({
    "showDropdowns": true,
    ranges: {
        'Hôm nay': [moment(), moment()],
        'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        '7 Ngày qua': [moment().subtract(6, 'days'), moment()],
        '30 Ngày qua': [moment().subtract(29, 'days'), moment()],
        'Tháng này': [moment().startOf('month'), moment().endOf('month')],
        'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    locale: {
        "customRangeLabel": "Tùy chọn",
        "weekLabel": "W",
        "applyLabel": "Chọn",
        "cancelLabel": "Thoát",
        "daysOfWeek": [
            "T2",
            "T3",
            "T4",
            "T5",
            "T6",
            "T7",
            "CN"
        ],
        "monthNames": [
            "Tháng 1",
            "Tháng 2",
            "Tháng 3",
            "Tháng 4",
            "Tháng 5",
            "Tháng 6",
            "Tháng 7",
            "Tháng 8",
            "Tháng 9",
            "Tháng 10",
            "Tháng 11",
            "Tháng 12"
        ],
        "firstDay": 1
    },
    "startDate": moment(),
    "endDate": moment()
}, function(start, end, label) {
  //console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
  startD =  start.format('YYYY-MM-DD');
  endD =  end.format('YYYY-MM-DD');
});
</script>
<script type="text/javascript">
    document.getElementById("btnReport").onclick = function (e) {
        var type = $("#select").val();
        var url = $("#url").val();
        location.href = url+"/export.php"+"?type="+type+"&from="+startD+"&to="+endD;
    };
</script>