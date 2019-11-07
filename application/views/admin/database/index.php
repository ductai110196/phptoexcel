<h1 class="h3 mb-4 text-gray-800 text-center font-weight-bold">Danh Sách Cơ Sơ Dữ Liệu</h1>
<button class="btn btn-success"><i class="fa fa-plus mx-2"></i>Tạo Cơ Sở Dữ Liệu</button>
<?php
if ($this->session->userdata("db") == NULL) {
    echo ('<span class="mx-5 text-danger">Vui lòng chọn cơ sỡ dữ liệu!</span>');
}
?>
<hr>
<table class="table table-hover table-bordered table-responsive-sm">
    <thead>
        <tr class="bg-success text-white">
            <th>STT</th>
            <th>Tên Cơ Sở Dữ Liệu</th>
            <th>Thao Tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($before_head as $key => $item) { ?>
        <tr>
            <td scope="row"><?php echo ($key + 1) ?></td>
            <td><?php echo $item->Database ?></td>
            <td>
                <?php if ($item->Database == $curent_db) { ?>
                <button class="btn btn-success btn-circle btn-lg" id="btn-select"
                    value="<?php echo $item->Database ?>"><i class="fa fa-check"></i></button>
                <?php } else { ?>
                <button class="btn btn-secondary btn-circle btn-lg" id="btn-select"
                    value="<?php echo $item->Database ?>"><i class="fa fa-check"></i></button>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>