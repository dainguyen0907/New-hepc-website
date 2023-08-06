$(document).ready(function () {
    $('#group_select_in_newPage').change(function (e) {
        e.preventDefault();
        var id_pb=$('#group_select_in_newPage').val();
        $.ajax({
            url:"./admin/ajax/getcatalogueforgroup",
            type:"POST",
            data:{
                "id_pb":id_pb,
            },
            success: function(data){
                console.log(data)
                $('#catalogue_select_in_newPage').html(data)
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
         }
        });
    })
})