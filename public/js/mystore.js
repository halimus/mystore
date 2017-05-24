/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function () { 
    $(".toggle-side-left").click(function (e) {
        $("#wrapper").toggleClass("toggled");

        if ($("#wrapper").hasClass("toggled")) {
        } else {
        }
        e.preventDefault();
    });
    $.sidebarMenu($('.sidebar-menu'));
    $('[data-toggle="popover"]').popover();
    
    /*
     * 
     */
    $('.autoNum').autoNumeric('init');
    
    /*
     * Delete category
     */
    $(document).on('click', '.delete_category', function () {
        var id = $(this).attr('rel');
        msgConfirm = 'Do you really want to delete this category?';
        if (confirm(msgConfirm)) {
            $.ajax({
                type: "POST",
                url: application_url + "category/delete",
                data: {'id': id},
                dataType: 'JSON',
                success: function (response) {
                    if (response.notif['type'] == 'success') {
                        $('#tr_'+id).remove();
                    }
                    else{
                        alert(response.notif['msg']);
                    }
                },
                error: function () {
                    alert('Failed request to delete');
                }
            });
        }
        return false;
    });
    
    /*
     * Delete sub_category
     */
    $(document).on('click', '.delete_subcategory', function () {
        var id = $(this).attr('rel');
        msgConfirm = 'Do you really want to delete this subcategory?';
        if (confirm(msgConfirm)) {
            $.ajax({
                type: "POST",
                url: application_url + "subcategory/delete",
                data: {'id': id},
                dataType: 'JSON',
                success: function (response) {
                    if (response.notif['type'] == 'success') {
                        $('#tr_'+id).remove();
                    }
                    else{
                        alert(response.notif['msg']);
                    }
                },
                error: function () {
                    alert('Failed request to delete');
                }
            });
        }
        return false;
    });
    
    /*
     * 
     */
    var file_num=0;
    $(document).on('click', '#add_file', function () {
        file_num++; 
        var file=''+
        '<div class="row form-group file_'+file_num+'">'+
            '<div class="col-md-4">'+
                '<label class="control-label">Image</label>'+
                '<input type="file" name="image[]" id="" accept="image/*" class="form-control">'+
            '</div>'+
            '<div class="col-md-2">'+
                '<label class="control-label tsp">delete</label><br>'+
                '<button type="button" class="btn btn-danger remove_file" rel="'+file_num+'" title="Delete"><i class="fa fa-trash"></i></button>'+
            '</div>'+
        '</div>';

        $('#file-content').append(file);
        
        $('[data-toggle="popover"]').popover();
    });
    
    /*
     * 
     * @param {type} value
     * @returns {Boolean}
     */
    $(document).on('click', '.remove_file', function () {
        var num = $(this).attr('rel');
        $(".file_"+num).remove();
    });
    
    
    /*
     * 
     * @param {type} event
     * @returns {undefined}
     */
    $('.onlyNumber').keypress(function(event) {
        only_number(event);
    });
    
    /*
     * Delete product
     */
    $(document).on('click', '.delete_product', function () {
        var id = $(this).attr('rel');
        msgConfirm = 'Do you really want to delete this product?';
        if (confirm(msgConfirm)) {
            $.ajax({
                type: "POST",
                url: application_url + "product/delete",
                data: {'id': id},
                dataType: 'JSON',
                success: function (response) {
                    if (response.notif['type'] == 'success') {
                        $('#tr_'+id).remove();
                    }
                    else{
                        alert(response.notif['msg']);
                    }
                },
                error: function () {
                    alert('Failed request to delete');
                }
            });
        }
        return false;
    });

});

/*
 * 
 */
function only_number(event) {
    if (event.which < 48 || event.which > 57) {
        if (event.which == 8 || event.which == 0) {
        }
        else {
            event.preventDefault();
            event.stopPropagation();
        }
    }
}