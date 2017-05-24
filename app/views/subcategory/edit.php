<div id="page-content-wrapper">
    <div id="page-content" style="margin-bottom: 50px;">
        <h3 class="page-title" id="business-info"><u>Edit SubCategory:</u>
            <span class="right-menu"><a href="<?php echo APP_URL;?>subcategory"><i class="fa fa-list"></i> SubCategory List</a></span>
        </h3>
        <div class="row">
            <div class="col-md-12"> 
                <?php if(isset($this->notif) and !empty($this->notif)){ ?>
                <div class="alert alert-<?php echo $this->notif['type']; ?> alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <?php echo $this->notif['msg']; ?>
                    </div>
                <?php } ?>
                
                <form method="post" action="<?php echo APP_URL;?>subcategory/edit/<?php echo $this->subcategory['sub_category_id'];?>" id="form1">
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label>SubCategory Name</label><em>*</em>
                            <input type="text" name="sub_category_name" id="sub_category_name" class="form-control" value="<?php echo $this->subcategory['sub_category_name'];?>">
                        </div>
                    </div> 
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label>Category</label><em>*</em>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="" style="display:none"></option>
                                <?php 
                                    foreach ($this->category as $key => $value) {
                                        $selected='';
                                        if ($this->subcategory['category_id'] == $value['category_id']) {
                                            $selected = 'selected';
                                        }
                                        echo '<option value="'.$value['category_id'].'" '.$selected.'>'.$value['category_name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div> 
                    <hr>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                
            </div>
        </div> 
    </div>
</div>