<?php
session_start();
if(isset($_SESSION["login"])){
include "../config.php";
$login = $_SESSION['login'];
$_SESSION["password"] = "";
$db = config::getConnexion();
$query = $db->prepare("SELECT * FROM admin WHERE user = '$login'");
$query->execute();
$user = $query->fetch(PDO::FETCH_ASSOC);
$pass = $user['password'];
if(isset($_POST['lock'])):
    if (md5($_POST['passlock'])== $pass):
        $_SESSION['password'] = $_POST['passlock'];
        header("location:dashboard.php");
    endif;
endif;
?>
<!doctype html>
<html>

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Custom Css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/authentication.css">
    
</head>

<body class="theme-cyan authentication sidebar-collapse">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top navbar-transparent">
    <div class="container">        
        <div class="navbar-translate n_logo">
            <a class="navbar-brand" href="#" title="">SHOPIT</a>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link btn btn-primary btn-round" href="sign-in.php">SIGN IN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary btn-round" href="shopit.php">GO TO MAIN WEBSITE</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
<div class="page-header">
    <div class="page-header-image" style="background-image:url(../assets/img/images/login.jpg)"></div>
    <div class="container">
        <div class="col-md-12 content-center">
            <div class="card-plain">
                <form class="form" method="POST">
                    <div class="header">
                        <div class="logo-container">
                            <img class="rounded-circle img-raised" src="<?=$user['image']; ?>" alt="">
                        </div>
                        <h5><?=$user['user']; ?></h5>
                        <span>Locked</span>
                    </div>
                    <div class="content">
                        <div class="input-group input-lg">
                            <input type="password" class="form-control" placeholder="Enter your Password" name="passlock">
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-lock"></i>
                            </span>
                        </div>
                    </div>
                    <div class="footer text-center">
                        <input type="submit" name="lock" class="btn l-cyan btn-round btn-lg btn-block waves-effect waves-light" value="LOG IN">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <nav>
                <ul>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </nav>
            <div class="copyright">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script>,
                <span>Designed by <a href="#">Mostapha Ghribi</a></span>
            </div>
        </div>
    </footer>
</div>

<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script>
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script>
   $(".navbar-toggler").on('click',function() {
    $("html").toggleClass("nav-open");
});
</script>
</body>

</html>
<?php
}else{
    header("location:sign-in.php");   
    }
?>