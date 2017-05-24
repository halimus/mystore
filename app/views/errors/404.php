<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>404 Page Not Found</title>
        <link rel="icon" type="image/png" href="<?php echo APP_URL;?>public/images/logo24.png">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <style>
            .center {text-align: center; margin-left: auto; margin-right: auto; margin-bottom: auto; margin-top: auto;}
            #main {
                min-height:100%;
                position:relative;
            }
            .vcenter {
                min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
                min-height: 100vh; /* These two lines are counted as one :-) */
                width: 100%;
                display: flex;
                align-items: center;
            }
            h1{
                margin: 20px 0 20px;
                letter-spacing: 1px;
                line-height: 1.6;
                text-align: center;
                color: #666;
                margin-top: -100px;
                font-size: 4em;
            }
            h3{
                margin: 20px 0 10px;
                letter-spacing: 1px;
                text-align: center;
                color: #666;
            }
            .centered{
                text-align:center;
            }
            .btn{
                margin-top: 20px;
                border-radius: 0px;
                padding: 10px 20px;
                border: 2px;
                font-size: 1.5em;
            }
        </style>
    </head>
    <body>
        <div id="main">
            <section class="vcenter">
                <div id="page-content" class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1>404 Page Not Found</h1>
                            <h3>The page you requested was not found.</h3>      
                            <div class="centered">
                                <a href="<?php echo APP_URL;?>" class="btn btn-primary" role="button" style="">Take Me Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>