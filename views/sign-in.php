<?php
session_start();
if(isset($_SESSION["login"])&& $_SESSION["password"]){
header('location:dashboard.php'); 
}else{
include "../controller/ArticleU.php";
	if(isset($_POST["sub"])){
	$log = htmlspecialchars($_POST["user"]);
	$psw = htmlspecialchars(md5($_POST["password"]));
	$db = config::getConnexion();
	$query = $db->prepare("SELECT * FROM admin WHERE user = :log");
	$query->bindValue(':log',$log);
	$query->execute();
	$user = $query->fetch(PDO::FETCH_ASSOC);
if ($psw ===  $user['password'])
{
    $_SESSION["login"] = $log;
    $_SESSION["password"] = $psw;
    header("location:dashboard.php");
} else {
    header("location:sign-in.php");

}
}


?>
<!doctype html>
<html >

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Custom Css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/authentication.css">
</head>

<body class="authentication">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top navbar-transparent">
    <div class="container">        
        <div class="navbar-translate n_logo">
            <a class="navbar-brand" href="#">SHOPIT</a>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav">            
                <li class="nav-item">
                    <a class="nav-link btn btn-primary btn-round" href="shopit.html">GO TO MAIN WEBSITE</a>
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
                <form class="form" method="POST" action="#">
                    <div class="header">
                        <div class="logo-container">
                            <img src="../assets/img/images/ShopIt.png" alt="">
                        </div>
                        <h5>Log in</h5>
                    </div>
                    <div class="content">                                                
                        <div class="input-group input-lg">
                            <input type="text" class="form-control" placeholder="Enter User Name" name="user">
                        </div>
                        <div class="input-group input-lg">
                            <input type="password" placeholder="Password" class="form-control" name="password"/>
                        </div>
                    </div>
                    <div class="footer text-center">
                        <input type="submit" name="sub" class="btn l-cyan btn-round btn-lg btn-block waves-effect waves-light" value="SIGN IN">
                        <h6 class="m-t-20"><a href="forgot-password.php" class="link">Forgot Password?</a></h6>
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
                <span>Designed by <a href="#" target="_blank">Mostapha Ghribi</a></span>
            </div>
        </div>
    </footer>
</div>

<!-- Jquery Core Js -->

<script>
   $(".navbar-toggler").on('click',function() {
    $("html").toggleClass("nav-open");
});
$('.form-control').on("focus", function() {
    $(this).parent('.input-group').addClass("input-group-focus");
}).on("blur", function() {
    $(this).parent(".input-group").removeClass("input-group-focus");
});
</script>
</body>

</html>
<?php
}
?>
