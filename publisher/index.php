<?php
error_reporting(0);
define('IN_SITE',true);
require_once('../lib/core.php');
if(!$user_id){
    redirect(homeurl());
}
require_once('../lib/publisher.php');
$month = isset($_GET['month']) ? abs(intval($_GET['month'])) : date("m");
$year = isset($_GET['year']) ? abs(intval($_GET['year'])) : date("Y");
$ordersToday = Loan::revenu($month,$year);
$hoahong = Loan::hoahong($month,$year);
$ctv = Loan::congtacvien($month,$year);
$ordersCtv = Loan::revenu($month,$year,1);
?>        
    <div class="statistic">
        <h1><i class="fas fa-chart-line"></i> Thống kê</h1>
        <div class="select-statistic">
            <span><i class="far fa-calendar-alt"></i></span>
            <select name="statictis" id="select" class="seclect-option">
                <?php
                $loops = LoanStatistic::loopMonthYear();
                foreach($loops as $my)
                {
                    $str =  $my['month'].$my['year'];
                    ?>
                        <option value="<?php echo $str?>" <?php echo ($month.$year == $str ? 'selected' : '');?> data-m="<?php echo $my['month'];?>" data-y="<?php echo $my['year'];?>">
                        tháng <?php echo $my['month'];?> - <?php echo $my['year'];?>
                        </option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
        <div class="dashbroad">
            <div class="row">
                <div class="col-sm-6 col-m-4 col-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-green">
                            <i class="fas fa-hand-holding-usd"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Hoa hồng được duyệt</span>
                            <span class="info-box-number"><?php echo number_format($hoahong);?> VND</span>
                            <div class="info-process"></div>
                            <span class="info-description">
                                Số đơn: <?php echo $ordersToday;?>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- item -->
                <div class="col-sm-6 col-m-4 col-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-blue">
                            <i class="fas fa-user-friends"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Hoa hồng từ cộng tác viên</span>
                            <span class="info-box-number"><?php echo number_format($ctv);?> VND</span>
                            <div class="info-process"></div>
                            <span class="info-description">
                                Số đơn: <?php echo $ordersCtv;?>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- item -->
                <div class="col-sm-6 col-m-4 col-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-orange">
                            <i class="fas fa-mouse-pointer"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Clicks</span>
                            <span class="info-box-number"><?php echo LoanStatistic::getNumberClick($month,$year);?></span>
                            <div class="info-process"></div>
                            <span class="info-description">
                                Tổng lượt nhấp chuột
                            </span>
                        </div>
                    </div>
                </div>
                <!-- item -->
            </div>
        </div>
        <!-- end dashbroad -->
        <!-- chart -->
        <div class="card">
            <div class="card-header">
                Trạng thái các đơn
            </div>
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
                    $loans = Loan::myLoan($month,$year);
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
        </div>
    <script>
    $(document).ready(function() {
        $('#frmLoan').DataTable({
            "order": [[ 0, "desc" ]]
        });
    });
    </script>
    <script>
    document.getElementById("select").onchange = function(event) {
        let month = event.target.selectedOptions[0].getAttribute("data-m");
        let year = event.target.selectedOptions[0].getAttribute("data-y");
        window.location.href = '?month='+month+'&year='+year;
    };
</script>
<?php
require_once('../lib/end.php');
?>