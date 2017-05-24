<div id="page-content-wrapper">
    <div id="page-content" style="margin-bottom: 50px;">
        <h3 class="page-title" id="business-info"><u>SubCategory:</u>
            <span class="right-menu"><a href="<?php echo APP_URL; ?>subcategory/create"><i class="fa fa-plus-circle"></i> New SubCategory</a></span>
        </h3>
        <div class="row">
            <div class="col-xs-12 table-responsive" style="">

                <?php
                $listItem = '';
                $nbrItem = 0;
                foreach ($this->subcategory as $key => $value) {
                    $nbrItem++;
                    $sub_category_id = $value['sub_category_id'];

                    $listItem .= '
                        <tr id="tr_' . $sub_category_id . '">
                            <td>' . $sub_category_id . '</td>
                            <td>' . $value['sub_category_name'] . '</td>
                            <td>' . $value['category_name'] . '</td>
                            <td><a href="' . APP_URL . 'subcategory/edit/' . $sub_category_id . '" title="Edit" class="btn btn-sm btn-success edit"><i class="fa fa-pencil"></i></a></td>
                            <td><a href="#" rel="' . $sub_category_id . '" title="Delete" class="btn btn-sm btn-danger delete_subcategory"><i class="fa fa-times"></i></a></td>
                        </tr>';
                }
                ?>
                <?php if ($nbrItem > 0) { ?>
                    <table id="datatable" class="table table-striped- table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Id#</th>
                                <th>SubCategory Name</th>
                                <th>Category</th>
                                <th style="width: 60px">Edit</th>
                                <th style="width: 60px">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $listItem; ?>    
                        </tbody> 
                    </table>
                <?php } else { ?>
                    <div class="alert alert-warning alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <h4>No SubCategory exist yet!</h4>
                    </div>
                <?php } ?>



            </div>
        </div>  
    </div>
</div>
