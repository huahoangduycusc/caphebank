<div class="box-title">Tìm kiếm người dùng</div>
<div class="row form-group">
    <div class="col col-md-12">
        <div class="input-group">
            <input type="text" id="value" name="input2-group2" placeholder="Tên hoặc ID người dùng" class="form-control">
            <div class="input-group-btn"><button class="btn btn-primary" id="search"><span class="ti-search"></span> Tìm</button></div>
        </div>
        <div class="row">
            <div class="col col-md-4 ml-auto">
                <div class="form-check-inline form-check">
                    <label for="inline-radio1" class="form-check-label ">
                        <input type="radio" id="inline-radio1" name="type" value="1" class="form-check-input" checked>ID
                    </label>
                </div>
            </div>
            <div class="col col-md-5">
                <div class="form-check-inline form-check">
                    <label for="inline-radio2" class="form-check-label ">
                        <input type="radio" id="inline-radio2" name="type" value="2" class="form-check-input">Tên tài khoản
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="orders">
    <div class="card">
        <div class="card-body">
            <h4 class="box-title">Danh sách </h4>
        </div>
        <div class="card-body--">
            <div class="table-stats order-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Họ tên</th>
                            <th>SDT</th>
                            <th>Email</th>
                            <th>Số dư (VNĐ)</th>
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
<script src="modules/users/search.js"></script>
<script src="modules/users/app.js"></script>