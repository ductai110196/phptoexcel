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
            <th>Lý</th>
            <th>Hóa</th>
            <th>Toán</th>
            <th>Điểm Trung Bình</th>
            <th>Thao Tác</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Nguyễn Văn A</td>
            <td>Nam</td>
            <td>10/08/1996</td>
            <td>Vĩnh Long</td>
            <td>9</td>
            <td>10</td>
            <td>8</td>
            <td>9</td>
            <td>
                <button class="btn btn-info">Sửa</button>
                <button class="btn btn-danger">Xóa</button>
            </td>
        </tr>
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
                <br>
                <div class="result"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-info">Thực Hiện</button>
            </div>
        </div>
    </div>
</div>