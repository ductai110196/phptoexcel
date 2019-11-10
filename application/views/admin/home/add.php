<h3 class="h3 text-center mb-4 font-weight-bold">Thêm Mới Dữ Liệu</h3>
<hr>
<form action="<?php echo base_url() ?>index.php/admin/home/insert" method="post">
    <div class="row">
        <div class="col-md-10">
            <div class="form-group">
                <label for="exampleInputEmail1">Họ Tên:</label>
                <input type="text" name="hoten" class="form-control" id="exampleInputEmail1" placeholder="Nhập họ tên">
            </div>
        </div>
        <div class="col-md-10">
            <div class="form-group">
                <label for="exampleInputEmail1">Ngày Sinh:</label>
                <input type="date" name="ngaysinh" class="form-control" id="exampleInputEmail1" placeholder=""
                    value="1990-01-01" min="1890-01-01" max="2000-01-01">
            </div>
        </div>
        <div class="col-md-10">
            <div class="form-group">
                <label for="" class="">Giới Tính:</label>
                <div class="custom-control custom-radio d-inline mr-sm-4 mx-4">
                    <input type="radio" class="custom-control-input" id="customRadio" name="gioitinh" value="1"
                        checked="checked">
                    <label class="custom-control-label" for="customRadio">Nam</label>
                </div>
                <div class="custom-control custom-radio d-inline">
                    <input type="radio" class="custom-control-input" id="customRadio1" name="gioitinh" value="0">
                    <label class="custom-control-label" for="customRadio1">Nữ</label>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="form-group">
                <label for="exampleInputEmail1">Địa Chỉ:</label>
                <textarea name="diachi" id="" rows="2" class="form-control" placeholder="Nhập địa chỉ"></textarea>
            </div>
        </div>
        <div class="col-md-10">
            <div class="form-group">
                <label for="exampleInputEmail1">Điểm Toán:</label>
                <input type="number" step="any" name="diemtoan" class="form-control" id="exampleInputEmail1"
                    placeholder="Điểm toán" min="0" max="10">
            </div>
        </div>
        <div class="col-md-10">
            <div class="form-group">
                <label for="exampleInputEmail1">Điểm Lý:</label>
                <input type="number" step="any" name="diemly" class="form-control" id="exampleInputEmail1"
                    placeholder="Điểm lý" min="0" max="10">
            </div>
        </div>
        <div class="col-md-10">
            <div class="form-group">
                <label for="exampleInputEmail1">Điểm Hóa:</label>
                <input type="number" step="any" name="diemhoa" class="form-control" id="exampleInputEmail1"
                    placeholder="Điểm hóa" min="0" max="10">
            </div>
        </div>

    </div>
    <div class="row justify-content-center">
        <button type="submit" class="btn btn-success my-3 btn-lg"><i class="fa fa-save mx-2"></i>Lưu Lại</button>
    </div>
</form>

<a href="<?php echo base_url() ?>index.php/admin/trang-chu" class="btn btn-secondary"><i
        class="fa fa-hand-point-left mx-2 text-warning"></i>Quay Lại</a>