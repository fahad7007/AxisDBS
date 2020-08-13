<?php
    
    //Register Code for admin: adminregcode
    //Register Code for users: userregcode

    include_once("custom_functions.php");
    include_once("mysqlconnect.php");

    session_start();
    if(adminloggedin()) 
        header('Location: admin/index.php');
    else if(userloggedin())
        header('Location: user/index.php');
    
    if(isset($_POST['submit'])){

        $username = forminputsecure($_POST['username']);
        $email = forminputsecure($_POST['email']);
        $firstname = forminputsecure($_POST['firstname']);
        $lastname = forminputsecure($_POST['lastname']);
        $password = forminputsecure($_POST['password']);
        $type = $_POST['type'];
        $status = 'active';
        $code = forminputsecure($_POST['reg_code']);

        $admin_reg_code = "adminregcode";
        $user_reg_code = "userregcode";

        if(!strcmp($type,"admin")){

            if(!strcmp($code,$admin_reg_code)){

                $row = simplequeryrun("SELECT id from admin where email LIKE '".$email."' OR username='".$username."' ",$conn);
                if($row)
                    header('Location: register.php?msg='.urlencode(base64_encode("adminexists")));
                else{
                    $query = "INSERT INTO admin(username,email,firstname,lastname,password,status) VALUES('".$username."','".$email."','".$firstname."','".$lastname."','".$password."','".$status."')";
                    $result = mysqli_query($conn, $query);

                    if($result)
                        header('Location: login.php?msg='.urlencode(base64_encode("adminregistered")));
                    else
                        header('Location: register.php?msg='.urlencode(base64_encode("error")));
                }
            }else
                header('Location: register.php?msg='.urlencode(base64_encode("errorcode")));

        }else if(!strcmp($type,"user")){

            if(!strcmp($code,$user_reg_code)){

                $row = simplequeryrun("SELECT id from users where email LIKE '".$email."' OR username='".$username."' ",$conn);
                if($row)
                    header('Location: register.php?msg='.urlencode(base64_encode("adminexists")));
                else{
                    $query = "INSERT INTO users(username,email,firstname,lastname,password,status) VALUES('".$username."','".$email."','".$firstname."','".$lastname."','".$password."','".$status."')";
                    $result = mysqli_query($conn, $query);

                    if($result)
                        header('Location: login.php?msg='.urlencode(base64_encode("userregistered")));
                    else
                        header('Location: register.php?msg='.urlencode(base64_encode("error")));
                }
            }else
                header('Location: register.php?msg='.urlencode(base64_encode("errorcode")));
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
                                <center><h1>Register</h1></center>
                                <form action="register.php" method="POST" class="form-login">
                                    <div class="row">
                                        <div class="col-md-12 hello-text-wrap"> 
                                        <?php
                                            if(isset($_GET['msg'])){
                                                if(!strcmp($_GET['msg'],base64_encode(urlencode("adminexists")))){
                                        ?>
                                        <div class="alert alert-danger">This admin already exists.</div>
                                        <?php } if(!strcmp($_GET['msg'],base64_encode(urlencode("userexists")))){
                                        ?>
                                        <div class="alert alert-danger">This user already exists.</div>
                                        <?php } if(!strcmp($_GET['msg'],base64_encode(urlencode("error")))){
                                        ?>
                                        <div class="alert alert-danger">Some error occurs, try again later.</div>
                                        <?php } if(!strcmp($_GET['msg'],base64_encode(urlencode("errorcode")))){
                                        ?>
                                        <div class="alert alert-danger">Code Error.</div>
                                        <?php } } ?>   
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group"><input class="form-control" name="username" type="text" required placeholder="User name"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group"><input class="form-control" name="email" type="email" required placeholder="Email Address"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group"><input class="form-control" name="firstname" type="text" required placeholder="First Name"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group"><input class="form-control" name="lastname" type="text" required placeholder="Last Name"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group"><input class="form-control" name="reg_code" type="text" required placeholder="Registration Code"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group"><input class="form-control" name="password" type="password" required placeholder="Your password"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">

                                            <div class="radio">
                                              <label><input type="radio" value="admin" name="type" checked>Admin</label>
                                            </div>
                                            <div class="radio">
                                              <label><input type="radio" value="user" name="type">User</label>
                                            </div>

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            Already registered, <a href="login.php">login here</a>
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn btn-theme btn-block btn-theme" name="submit" type="submit">Register</button>
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
