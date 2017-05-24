<div id="page-content-wrapper">
    <div id="page-content" style="margin-bottom: 50px;">
        <h3 class="page-title" id="business-info"><u>Edit Category:</u>
            <span class="right-menu"><a href="<?php echo APP_URL;?>category"><i class="fa fa-list"></i> Category List</a></span>
        </h3>
        <div class="row">
            <div class="col-md-12">
               
                <?php if(isset($this->notif) and !empty($this->notif)){ ?>
                <div class="alert alert-<?php echo $this->notif['type']; ?> alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <?php echo $this->notif['msg']; ?>
                    </div>
                <?php } ?>
                
                <form method="post" action="<?php echo APP_URL;?>category/edit/<?php echo $this->category['category_id'];?>" id="form1">
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label>Category Name</label><em>*</em>
                            <?php 
                               //$category_name = !empty(@$_POST['category_name']) ?: $this->category['category_name']; 
                            ?>
                            <input type="text" name="category_name" id="category_name" class="form-control" value="<?php echo $this->category['category_name'];?>">
                        </div>
                    </div> 
                    <hr>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

            </div>
        </div> 
    </div>
</div>