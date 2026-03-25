<script>
    async function showData(columns, ajax,table= ".data-table" ) {
        $(table).DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 50, 100, 500, -1],
                [10, 50, 100, 500, "الكل"]
            ],
            "language": {
                "sProcessing": "جاري تحميل البيانات...",
                "sZeroRecords": "لم يتم العثور على نتائج",
                "sEmptyTable": "لا توجد بيانات متاحة في الجدول",
                "sInfo": "عرض _START_ إلى _END_ من أصل _TOTAL_ سجل",
                "sInfoEmpty": "عرض 0 إلى 0 من أصل 0 سجل",
                "sInfoFiltered": "(منتقاة من مجموع _MAX_ سجل)",
                "sSearch": "بحث:",
            },
            "ajax": ajax,
            "columns": columns,
            "error": function(xhr, error, thrown) {
                console.log('DataTables Ajax error:', xhr, error, thrown);
            },

        });
    }

    async function showData1(columns, ajax,table= ".data-table" ) {
        $(table).DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 50, 100, 500, -1],
                [10, 50, 100, 500, "الكل"]
            ],
            "language": {
                "sProcessing": "جاري تحميل البيانات...",
                "sZeroRecords": "لم يتم العثور على نتائج",
                "sEmptyTable": "لا توجد بيانات متاحة في الجدول",
                "sInfo": "عرض _START_ إلى _END_ من أصل _TOTAL_ سجل",
                "sInfoEmpty": "عرض 0 إلى 0 من أصل 0 سجل",
                "sInfoFiltered": "(منتقاة من مجموع _MAX_ سجل)",
                "sSearch": "بحث:",
            },
            "ajax": ajax,
            "columns": columns,
            "error": function(xhr, error, thrown) {
                console.log('DataTables Ajax error:', xhr, error, thrown);
            },

        });
    }
</script>
