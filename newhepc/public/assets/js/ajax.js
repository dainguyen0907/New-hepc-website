$(document).ready(function () {
    $('#group_select_in_newPage').change(function (e) {
        e.preventDefault();
        var id_pb=$('#group_select_in_newPage').val();
        $.ajax({
            url:"./admin/ajax/getnew",
            type:"POST",
            data:{
                "id_pb":id_pb,
            },
            success: function(data){
                $('#datatable').html(data)
                $('#datatable').DataTable({
                    destroy: true,   
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
                    },
                    "columnDefs": [
                        { "width": "15%", "targets": [1,2],
                        "render": function ( data, type, row ) {
                            return data.substr( 0, 50 ); }},
                        { "width": "2%", "targets": [0] }
                      ]
                })
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
         }
        });
    })
})