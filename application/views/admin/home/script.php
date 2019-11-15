<script>
$(document).ready(function() {
    var ID = "";
    //edit query
    $(document).on("click", "#btn-edit", function() {
        window.location.href = "http://localhost:8000/phptoexecl/index.php/admin/home/edit?id=" + this
            .value;
    })
    //delete query
    $(document).on("click", "#delete-item", function() {
        window.location.href = "http://localhost:8000/phptoexecl/index.php/admin/home/delete?id=" + ID;
    })
    //delete
    $(document).on("click", "#btn-delete", function() {
        $("#modal-delete").modal();
        ID = $(this).val();
    })
    //insert
    $(document).on("click", "#btn-add", function() {
        window.location.href = "http://localhost:8000/phptoexecl/index.php/admin/home/add";
    })
    // upload data
    $(document).on("click", "#check-modal", function() {
        $("#modal-upload").modal();
        $(".loading").hide();
    })

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
                url: "http://localhost:8000/phptoexecl/index.php/admin/home/upload",
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