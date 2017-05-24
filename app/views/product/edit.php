<div id="page-content-wrapper">
    <div id="page-content" style="margin-bottom: 50px;">
        <h3 class="page-title" id="business-info"><u>Edit Product:</u>
            <span class="right-menu"><a href="<?php echo APP_URL;?>product"><i class="fa fa-list"></i> Product List</a></span>
        </h3>
        <div class="row">
           <div class="col-md-12">
                <?php if (isset($this->notif) and ! empty($this->notif)) { ?>
                    <div class="alert alert-<?php echo $this->notif['type']; ?> alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <?php echo $this->notif['msg']; ?>
                    </div>
                <?php } ?>
                <form method="post" action="<?php echo APP_URL; ?>product/edit/<?php echo $this->product['product_id'];?>" id="form1" enctype="multipart/form-data"> 
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label>Product Name</label><em>*</em>
                            <input type="text" name="product_name" id="product_name" class="form-control" value="<?php echo $this->product['product_name'];?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label>Category</label><em>*</em>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="" style="display:none"></option>
                                <?php
                                foreach ($this->category as $key => $value) {
                                    $selected = '';
                                    if ($this->product['category_id'] == $value['category_id']) {
                                        $selected = 'selected';
                                    }
                                    echo '<option value="' . $value['category_id'] . '" ' . $selected . '>' . $value['category_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div> 
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label>Description</label><em></em>
                            <textarea name="description" id="description" class="form-control" rows="3"><?php echo $this->product['description'];?></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label>Unit Price</label><em></em>
                            <input type="text" name="price" id="price" class="form-control autoNum" value="<?php echo $this->product['price'];?>" data-a-sign="$" placeholder="$">
                        </div>
                        <div class="col-md-2">
                            <label>Quantity</label><em></em>
                            <input type="text" name="quantity" id="quantity" class="form-control onlyNumber" value="<?php echo $this->product['quantity'];?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label class="checkbox-inline">
                                <input type="checkbox" id="active" name="active" value="1" <?php if ($this->product['active']) echo 'checked'; ?>>Active
                            </label>
                        </div>
                    </div>
                    <div id="file-content">
                        <div class="row form-group">
                        <?php
                            $images = '';
                            if (!empty($this->images_product)) {
                                foreach ($this->images_product as $key => $value) {
                                    $image_id   = $value['image_id'];
                                    $image_file = $value['image_file'];
                                    $mime_type  = $value['mime_type'];
                                    
                                    $url_delete = APP_URL."product/delete_file/$image_id/".$this->product['product_id'];
                                    $url_file   =  APP_URL."product/get_file/$image_id/".$this->product['product_id'];                                             
                                    
                                    $image_type = 'image/jpeg';
                                    $src_image = 'data:' . $image_type . ';base64,' . base64_encode($image_file);
                                    
                                    echo '<div class="col-md-2 ">
                                            <a href="#"><img src="' . $src_image . '" style="width:200px;height:150px;border:1px solid silver;"></a><br>
                                            <a href="'.$url_delete.'" class="delete_link"><i class="fa fa-trash"></i> Delete</a>  
                                          </div>';
                                }
                            }
                        ?>  
                        </div>       
                    </div>
                    <div class="row form-group row_add_file" style="margin-top:25px">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-default" id="add_file"><i class="fa fa-plus"></i> Add Image</button>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary">Submit the form</button>
                </form>

            </div>
        </div> 
    </div>
</div>