<h1 class="h3 text-center mb-4 font-weight-bold">Tải File Excel Lên Cơ Sỏ Dữ Liệu Mysql</h1>
<hr>
<button id="btn-add" class="btn btn-success my-2"><i class="fa fa-plus mx-2"></i>Tạo Dữ Liệu</button>
<button id="check-modal" class="btn btn-primary my-2"><i class="fa fa-upload mx-2"></i>Upload File Excel</button>
<table class="table table-bordered table-hover shadow">
    <thead>
        <tr class="bg-success text-white">
            <th>STT</th>
            <th>Họ Tên</th>
            <th>Giới Tính</th>
            <th>Ngày Sinh</th>
            <th>Địa Chỉ</th>
            <th>Toán</th>
            <th>Lý</th>
            <th>Hóa</th>
            <th>Điểm Trung Bình</th>
            <th>Thao Tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($before_head as $key => $item) { ?>
        <tr>
            <td><?php echo ($key + 1) ?></td>
            <td><?php echo $item->HoTen ?></td>
            <td><?php echo $item->GioiTinh > 0 ? "Nam" : "Nữ" ?></td>
            <td><?php echo date("d/m/Y",  strtotime($item->NgaySinh)) ?></td>
            <td><?php echo $item->DiaChi ?></td>
            <td><?php echo $item->Toan ?></td>
            <td><?php echo $item->Hoa ?></td>
            <td><?php echo $item->Ly ?></td>
            <td><?php echo $item->DTB ?></td>
            <td>
                <button id="btn-edit" class="btn btn-info" value="<?php echo $item->IDHS ?>">Sửa</button>
                <button id="btn-delete" class="btn btn-danger" value="<?php echo $item->IDHS ?>">Xóa</button>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<!-- Modalupload -->
<div class="modal fade" id="modal-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Tải File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-9 col-xl-9 col-sm-9">
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="customFile" name="filename">
                            <label class="custom-file-label" for="customFile">Chọn File</label>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xl-3 col-lg-3">
                        <input type="button" value="Tải Lên" id="file_xsls" class="btn btn-success">
                    </div>
                </div>
                <div class="loading">
                    <div class="spinner-grow text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-secondary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-success" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-danger" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-warning" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-info" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-light" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-dark" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <br>
                <div class="result"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal delete -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Thông Báo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Bạn có chắc xóa item này không?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-info" id="delete-item">Thực Hiện</button>
            </div>
        </div>
    </div>
</div>