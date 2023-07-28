
$(document).ready(function () {
    $('#datatable').DataTable({
        "language": {
            "lengthMenu": "Hiển thị _MENU_ dòng",
            "zeroRecords": "Không có dữ liệu",
            "info": "Hiển thị trang _PAGE_ trên _PAGES_ trang",
            "infoEmpty": "Không có dữ liệu",
            "search": "Tìm kiếm: ",
            "infoFiltered": "(Lọc từ _MAX_ kết quả)",
            paginate: {
                previous: '‹',
                next: '›'
            },
        }
    });
});
