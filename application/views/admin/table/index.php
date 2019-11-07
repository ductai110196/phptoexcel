<?php
$name = "Tables_in_" . $this->session->userdata("db");
?>
<h1 class="h3 mb-4 text-gray-800 text-center font-weight-bold">Danh Sách Bảng</h1>
<hr>
<?php
if ($before_head ==  "") {
    echo ('<span class="mx-5 text-danger text-center">Vui lòng chọn cơ sỡ dữ liệu!</span>');
} else {
    ?>
<table class="table table-hover table-bordered table-responsive-sm">
    <thead>
        <tr class="bg-success text-white">
            <th>STT</th>
            <th>Tên Bảng</th>
            <th>Thao Tác</th>
        </tr>
    </thead>
    <tbody>
        <?php
                foreach ($before_head as $key => $item) { ?>
        <tr>
            <td><?php echo $key + 1 ?></td>
            <td><?php echo $item->$name ?></td>
            <td>
                <?php if ($item->$name == $curent) { ?>
                <button class="btn btn-success btn-circle btn-lg" id="btn-select" value="<?php echo $item->$name ?>"><i
                        class="fa fa-check"></i></button>
                <?php } else { ?>
                <button class="btn btn-secondary btn-circle btn-lg" id="btn-select"
                    value="<?php echo $item->$name ?>"><i class="fa fa-check"></i></button>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php } ?>