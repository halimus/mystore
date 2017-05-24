<nav class="navbar navbar-default navbar-fixed-top navbar-custom" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <ul class="navbar-ul pull-left">
            <li class="visible-lg visible-md visible-sm visible-xs">
                <a href="javascript:void(0)" class="toggle-side-left">
                    <i class="fa fa-bars"></i>
                </a>
            </li>
            <li class="divider-vertical"></li>
        </ul>       
        <a class="navbar-brand" href="<?php echo APP_URL;?>"><img src="<?php echo APP_URL;?>public/images/logo48.png" style="float:left;margin-top: -14px; margin-left: -10px;"> MyStore</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="<?php echo APP_URL;?>" style="">Dashboard</a></li>
            <li><a href="<?php echo APP_URL;?>category" style="">Category</a></li>
            <li><a href="<?php echo APP_URL;?>subcategory" style="">Sub Category</a></li> 
            <li><a href="<?php echo APP_URL;?>product" style="">Product</a></li>
            
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="divider-vertical"></li>
            <li class="dropdown" style="background-: red">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo Session::get('user_name')?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo APP_URL;?>user/change_password">Change password</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo APP_URL;?>user/logout">Sign out</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
