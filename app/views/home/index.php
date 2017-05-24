<link href="<?php echo APP_URL;?>public/css/block.css" rel="stylesheet">
<link href="<?php echo APP_URL;?>public/css/themes.css" rel="stylesheet">

<div id="wrapper-">
    
<div id="page-content-wrapper">
    <div id="page-content" style="margin-bottom: 50px;">

        <h3 class="page-title" id="business-info"><u>Dashboard:</u></h3>

        <div class="block block-tiles  clearfix">
            <a href="<?php echo APP_URL;?>category" class="tile tile-width-2x tile-themed themed-background-amethyst" style="">
                <i class="fa fa-file-text-o"></i>
                <div class="tile-info">
                    <div class="pull-left">Category</div>
                    <div class="pull-right"><strong><?php echo @$this->number_category;?></strong></div>
                </div>
            </a>

            <a href="<?php echo APP_URL;?>subcategory" class="tile tile-width-2x tile-themed themed-background-deepsea">
                <i class="fa fa-file-text-o"></i>
                <div class="tile-info">
                    <div class="pull-left">Sub Category</div>
                    <div class="pull-right"><strong><?php echo @$this->number_subcategory;?></strong></div>
                </div>
            </a>
            
            <a href="<?php echo APP_URL;?>product" class="tile tile-width-2x tile-themed themed-background-dawn">
                <i class="fa fa-shopping-cart"></i>
                <div class="tile-info">
                    <div class="pull-left">Product</div>
                    <div class="pull-right"><strong><?php echo @$this->number_product;?></strong></div>
                </div>
            </a>
            
            <?php if(Session::get('role_id')=='Administrator'){?> 
            <a href="<?php echo APP_URL;?>setting" class="tile tile-themed themed-background-cherry">
                <i class="fa fa-wrench"></i>
                <div class="tile-info"><strong></strong> Settings</div>
            </a>
            <?php } ?> 
            
        </div>

    </div>
</div>

 



