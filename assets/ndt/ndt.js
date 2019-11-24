$(document).ready(function() {
    // call datatable
    configdatatable("table", 1);
    //call toastr;
    setToastr();
});
//setup toastr
setToastr = () => {
    return (toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: false,
        progressBar: false,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
    });
};

//cate !=0 get vietnames,cate==0 get english
configdatatable = (table = "table", cate = 0) => {
    var config = "";
    if (cate != 0) {
        config = $(table).DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copyHtml5',
                    text: 'copy',
                    className: 'btn btn-success',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: 'csv',
                    className: 'btn btn-info',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'excel',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'pdf',
                    className: 'btn btn-danger',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    text: 'print',
                    className: 'btn btn-warning',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'colvis',
                    text: 'Chọn Cột',
                    className: 'btn btn-success'
                },

            ],
            responsive: true,
            language: {
                sEmptyTable: "Không có dữ liệu trong bảng",
                sInfo: "_START_ đến _END_ trong số _TOTAL_ mục nhập",
                sInfoEmpty: "0 đến 0 trong tổng số 0 mục",
                sInfoFiltered: "(được lọc bởi các mục _MAX_)",
                sInfoPostFix: "",
                sInfoThousands: ".",
                sLengthMenu: "Hiển thị các mục _MENU_",
                sLoadingRecords: "Đang tải ...",
                sProcessing: "Vui lòng chờ ...",
                sSearch: "Tìm kiếm",
                sZeroRecords: "Không có mục nào.",
                searchPlaceholder: "Tìm kiếm...",
                oPaginate: {
                    sFirst: "đầu tiên",
                    sPrevious: "trở lại",
                    sNext: "kế tiếp",
                    sLast: "cuối cùng"
                },
                oAria: {
                    sSortAscending: ": cho phép sắp xếp cột theo thứ tự tăng dần",
                    sSortDescending: ": cho phép sắp xếp cột theo thứ tự giảm dần"
                }
            }
        });
    } else {
        config = $(table).DataTable();
    }
    return config;
};