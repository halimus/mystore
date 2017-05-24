<div id="page-content-wrapper">
    <div id="page-content" style="margin-bottom: 50px;">
        <h3 class="page-title" id="business-info"><u>New Product:</u>
            <span class="right-menu"><a href="<?php echo APP_URL; ?>product"><i class="fa fa-list"></i> Product List</a></span>
        </h3>
        <div class="row">
            <div class="col-md-12">
                <?php if (isset($this->notif) and ! empty($this->notif)) { ?>
                    <div class="alert alert-<?php echo $this->notif['type']; ?> alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <?php echo $this->notif['msg']; ?>
                    </div>
                <?php } ?>
                <form method="post" action="<?php echo APP_URL; ?>product/create" id="form1" enctype="multipart/form-data"> 
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label>Product Name</label><em>*</em>
                            <input type="text" name="product_name" id="product_name" class="form-control" value="<?php echo @$_POST['product_name']; ?>">
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
                                    if ($_POST['category_id'] == $value['category_id']) {
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
                            <textarea name="description" id="description" class="form-control" rows="3"><?php echo @$_POST['description']; ?></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label>Unit Price</label><em></em>
                            <input type="text" name="price" id="price" class="form-control autoNum" value="<?php echo @$_POST['price']; ?>" data-a-sign="$" placeholder="$">
                        </div>
                        <div class="col-md-2">
                            <label>Quantity</label><em></em>
                            <input type="text" name="quantity" id="quantity" class="form-control onlyNumber" value="<?php echo @$_POST['quantity']; ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label class="checkbox-inline">
                                <input type="checkbox" id="active" name="active" value="1" <?php if (@$_POST['active']) echo 'checked'; ?>>Active
                            </label>
                        </div>
                    </div>
                    <div id="file-content">
                        <?php
                          //require_once(APPPATH . 'views/loan/form_file.php');
                        ?>   
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