<?php
error_reporting(0);
define('IN_SITE',true);
require_once('../lib/core.php');
$title = "Tool công cụ";
if(!$user_id){
    redirect(homeurl());
}
require_once('../lib/publisher.php');
?>
<div class="inner">
    <ul class="breadcrumb">
        <li><a href="<?php echo homeurl();?>">Trang chủ</a></li>
        <li><a href="">Báo cáo</a></li>
        <li><a href="" class="active">Đơn vay</a></li>
    </ul>
</div>
<div class="bg-white">
    <div class="box-content">
        <div class="box">
            <form method="POST" class="frm">
                <div class="form-group">
                    <span><i class="fa fa-calendar"></i></span>
                    <input id="reportrange" type="text" readonly="readonly" class="form-input"/>
                </div>
                <!-- <div class="form-btn">
                    <button class="btn btn-complete">Tìm kiếm</button>
                </div> -->
            </form>
            <div class="box_header"><h3 class="box_title">Báo cáo</h3></div>
            <div class="box_body">
                <table id="frmLoan" class="display table-data" style="width:100%">
                    <thead>
                        <tr>
                            <th># Mã đơn</th>
                            <th>Họ tên</th>
                            <th>Ngày sinh</th>
                            <th>Giá đơn</th>
                            <th>Hoa hồng</th>
                            <th>Ngày gửi</th>
                            <th>Trạng thái đơn</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $loans = Loan::myLoanToday();
                    foreach($loans as $loan)
                    {
                        ?>
                        <tr>
                            <td><?php echo $loan['loan_id'];?></td>
                            <td><?php echo $loan['l_fullname'];?></td>
                            <td><?php echo $loan['l_birthday'];?></td>
                            <td><?php echo number_format($loan['l_money']);?> VND</td>
                            <td><?php echo number_format($loan['l_money']*0.1);?> VND</td>
                            <td><?php echo $loan['l_date'];?></td>
                            <td><?php echo showStatus($loan['l_status']);?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    $('#frmLoan').DataTable({
        "order": [[ 0, "desc" ]],
        "language": {
        "sProcessing":    "Đang tải...",
        "sLengthMenu":    "Hiển thị _MENU_ dòng",
        "sZeroRecords":   "Không có dữ liệu",
        "sEmptyTable":    "Chưa có dữ liệu để hiển thị",
        "sInfo":          "Hiển thị _START_ đến _END_ trong _TOTAL_ dòng",
        "sInfoEmpty":     "Hiển thị  0 đến 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Tìm kiếm:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Đang load...",
        "oPaginate": {
            "sFirst":    "Đầu",
            "sLast":    "Cuối",
            "sNext":    "Sau",
            "sPrevious": "Trước"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
    });
});
</script>
<script type="text/javascript">
    var startD;
    var endD;
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
  startD =  start.format('YYYY-MM-DD');
  endD =  end.format('YYYY-MM-DD');
  var table = $("#frmLoan tbody");
  $("#frmLoan").dataTable().fnDestroy();
  table.html("");
  $.ajax({
    url : 'report-ajax2.php',
    type: 'POST',
    dataType: 'text',
    data : {
        from : startD,
        to : endD
    },
    success : function(data){
        table.append(data);
        $("#frmLoan").dataTable({
            "order": [ 0, 'desc' ]
        });
    },
    error : function(){
        alert("Something is wrong");
    }
  });
});
</script>
<?php
require_once('../lib/end.php');
?>