<script>
$(document).on("click", "#btn-select", function() {
    window.location.href = "http://localhost:8000/phptoexecl/index.php/admin/dbconnect/check?name=" + $(this)
        .val();
})
</script>