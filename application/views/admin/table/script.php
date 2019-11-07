<script>
$(document).ready(function() {
    $(document).on("click", "#btn-select", function() {
        window.location.href = "http://localhost:8000/phptoexecl/index.php/admin/table/check?name=" + $(
                this)
            .val();
    })
})
</script>