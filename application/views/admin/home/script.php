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
                success: function(res) {
                    /*var html = "";
                    var data = JSON.parse(res);
                    obj = Object.keys(data).length;
                    for (let i = 2; i <= obj; i++) {
                        console.log(data[i]);
                        html += '<tr><th scope="row">' + data[i].A + '</th>';
                        html += '<td>' + data[i].B + '</td>';
                        html += '<td>' + data[i].C + '</td>';
                        html += '<td>' + data[i].D + '</td>';
                        html += '<td>' + data[i].E + '</td></tr>';
                    }
                    $("#result").html(html);*/
                    //console.log(res);
                    toastr.success('Tải dữ liệu thành công');
                    $(".result").html(res);
                    console.log(res);
                }
            });
        }
    });
})
</script>