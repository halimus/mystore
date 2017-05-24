<div id="page-content-wrapper">
    <div id="page-content" style="margin-bottom: 50px;">
        <h3 class="page-title" id="business-info"><u>Product:</u>
            <span class="right-menu"><a href="<?php echo APP_URL;?>product/create"><i class="fa fa-plus-circle"></i> New Product</a></span>
        </h3>
        <div class="row">
            <div class="col-xs-12 table-responsive" style="">
                <?php 
                   $listItem = '';
                   $nbrItem = 0;
                   foreach ($this->product as $key => $value) {
                       $nbrItem++; 
                       $product_id = $value['product_id'];
                       
                       $listItem.='
                        <tr id="tr_'.$product_id.'">
                            <td>'.$product_id.'</td>
                            <td>'.$value['product_name'].'</td>
                            <td>'.$value['quantity'].'</td>
                            <td>'.$value['price_format'].'</td>
                            <td>'.$value['category_name'].'</td>    
                            <td>'.$value['created_at'].'</td>
                            <td><a href="'.APP_URL.'product/edit/'.$product_id.'" title="Edit" class="btn btn-sm btn-success edit"><i class="fa fa-pencil"></i></a></td>
                            <td><a href="#" rel="'.$product_id.'" title="Delete" class="btn btn-sm btn-danger delete_product"><i class="fa fa-times"></i></a></td>
                        </tr>';
                   }
                ?>
                <?php if($nbrItem > 0){ ?>
                <table id="datatable" class="table table-striped- table-bordered table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id#</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Category</th>
                            <th>Created at</th> 
                            <th style="width: 60px">Edit</th>
                            <th style="width: 60px">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php echo $listItem; ?>    
                    </tbody> 
                </table>
                <?php } else{ ?>
                <div class="alert alert-warning alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <h4>No Product exist yet!</h4>
                </div>
                <?php } ?>
            </div>
        </div>  
    </div>
</div>
