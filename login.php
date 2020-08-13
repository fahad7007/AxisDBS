<?php

    include_once("custom_functions.php");
    include_once("mysqlconnect.php");
    session_start(); 

    if(adminloggedin()) 
        header('Location: admin/index.php');
    else if(userloggedin())
        header('Location: user/index.php');
    
    if(isset($_POST['submit'])){

        $username = forminputsecure($_POST['username']);
        $password = forminputsecure($_POST['password']);
        $type = $_POST['type'];
        
        if(!strcmp($type,"admin")){

            $row = simplequeryrun("SELECT id from admin where password LIKE '".$password."' AND (email LIKE '".$username."' OR username='".$username."') ",$conn);
            if($row){
                $_SESSION['adminid'] = $row['id'];
                header('Location: admin/index.php');
            }else
                header('Location: login.php?msg='.urlencode(base64_encode("incorrect")));

        }else if(!strcmp($type,"user")){

            $row = simplequeryrun("SELECT id from users where password LIKE '".$password."' AND (email LIKE '".$username."' OR username='".$username."') ",$conn);
            if($row){
                $_SESSION['userid'] = $row['id'];
                header('Location: user/index.php');
            }else
                header('Location: login.php?msg='.urlencode(base64_encode("incorrect")));
        }
        
    }
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Axis DBS</title>
        <!-- Favicon -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="shortcut icon" href="assets/ico/favicon.ico">
        <!-- CSS Global -->
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
        <link href="assets/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- Theme CSS -->
        <link href="assets/css/theme2.css" rel="stylesheet">
        <!-- Head Libs -->
        <script src="assets/plugins/modernizr.custom.js"></script>
        <!--[if lt IE 9]>
        <script src="assets/plugins/iesupport/html5shiv.js"></script>
        <script src="assets/plugins/iesupport/respond.min.js"></script>
        <![endif]-->
    </head>
    <body id="home" class="wide header-style-1">
        <!-- WRAPPER -->
        <div class="wrapper">
            <!-- CONTENT AREA -->
            <div class="content-area">
                <!-- PAGE -->
                <section class="page-section color">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-4"></div> <div class="col-sm-4">
                                <h3 ><img class="img-responsive" src="images/logo.PNG"></h3>
                                <center><h1>Login</h1></center>
                                <form action="login.php" method="POST" class="form-login">
                                    <div class="row">
                                        <div class="col-md-12 hello-text-wrap"> 
                                        <?php
                                            if(isset($_GET['msg'])){
                                                if(!strcmp($_GET['msg'],base64_encode(urlencode("incorrect")))){
                                        ?>
                                        <div class="alert alert-danger">Incorrect information</div>
                                        <?php } if(!strcmp($_GET['msg'],base64_encode(urlencode("adminregistered")))){
                                        ?>
                                        <div class="alert alert-success">Admin registered successfully.</div>
                                        <?php } if(!strcmp($_GET['msg'],base64_encode(urlencode("userregistered")))){
                                        ?>
                                        <div class="alert alert-success">User registered successfully.</div>
                                        <?php } } ?>   
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group"><input class="form-control" name="username" required type="text" placeholder="User name or email"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group"><input class="form-control" name="password" required type="password" placeholder="Your password"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">

                                            <div class="radio">
                                              <label><input type="radio" name="type" value="admin" checked>Admin</label>
                                            </div>
                                            <div class="radio">
                                              <label><input type="radio" name="type" value="user" >User</label>
                                            </div>

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            Want to register, <a href="register.php">click here</a>
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn btn-theme btn-block btn-theme" name="submit" type="submit">Login</button>
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-4">
                                <h3 class="block-title"><span></span></h3>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /PAGE -->
            </div>
            <!-- /CONTENT AREA -->
            <div id="to-top" class="to-top"><i class="fa fa-angle-up"></i></div>
        </div>
        <!-- /WRAPPER -->
        <!-- JS Page Level -->
        <script src="assets/js/theme.js"></script>
    </body>
</html>
