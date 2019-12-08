<script>
//call modal upload
$(document).ready(function() {
    $("#check-modal").click(function() {
        $("#modal-upload").modal();
    });
    //add upload call controller
    $(document).on("click", "#file_xsls", function() {
        var file = document.getElementById("customFile").files[0];
        let name = file.name;
        var image_extension = name.split('.').pop().toLowerCase();
        if (jQuery.inArray(image_extension, ['xlsx', '']) == -1) {
            alert("Vui lòng chọn file excel để thực hiện upload");
        } else {
            var form_data = new FormData();
            form_data.append("file", file);
            $.ajax({
                url: "http://localhost:8000/phptoexecl/index.php/admin/upload/add",
                type: "POST",
                data: form_data,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $(".loading").show();
                },
                success: function(res) {
                    $(".loading").hide();
                    var html = '';
                    if (res == 0) {
                        toastr.error('Tải dữ liệu thất bại');
                        html += '<h4 class="text-danger font-weight-bold">';
                        html += "Tải dữ liệu không thành công do dữ liệu đã có";
                    } else {
                        toastr.success('Tải dữ liệu thành công');
                        html += '<h4 class="text-success font-weight-bold">';
                        html += "Tải dữ liệu thành công";
                    }
                    html += '</h4>';
                    $(".result").html(html);
                    setTimeout(function() {
                        window.location.reload();
                    }, 5000)
                }
            })
        }
    });
})
</script>