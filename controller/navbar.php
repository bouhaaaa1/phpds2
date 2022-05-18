<?php
 //require "header.php";
if(isset($_SESSION["login"]) && $_SESSION['password']){
$login = $_SESSION['login'];
$db = config::getConnexion();
$query = $db->prepare("SELECT * FROM admin WHERE user = '$login'");
$query->execute();
$user = $query->fetch(PDO::FETCH_ASSOC);	
                    
    

?>

<style>
.web-area {
    position: relative;
    z-index: 1;
}

.web-area .web-btn {
    display: block;
    width: 35px;
    height: 35px;
    line-height: 35px;
    background-color: #f8f8ff;
    text-align: center;
    border-radius: 50%;
    cursor: pointer;
    margin-right: 15px;
}

@media only screen and (max-width: 767px) {
    .web-area .web-btn {
        margin-right: 8px;
        width: 30px;
        height: 30px;
        line-height: 30px;
    }
}

@media only screen and (min-width: 576px) and (max-width: 767px) {
    .web-area .web-btn {
        margin-right: 15px;
        width: 35px;
        height: 35px;
        line-height: 35px;
    }
a{
    list-style-type: none;
}
}
</style>
<nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle d-flex">
                    <i class="hamburger align-self-center"></i>
                </a>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item">
                    <div class="web-area">
                                <a href="../views/shopit.php" class="web-btn" title="Go to main site" data-toggle="tooltip"><i class="icofont-web" width="150px"></i></a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
                                <img src="<?php echo $user['image']; ?>" class="avatar img-fluid rounded mr-1" /> <span class="text-dark"><?php echo $user['user'];?>
									</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="../Views/settings.php"><i class="align-middle mr-1" data-feather="settings"></i> Settings &
									Privacy</a>
                                <a class="dropdown-item" href="#"><i class="align-middle mr-1" data-feather="help-circle"></i> Help Center</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../controller/logout.php">Log out</a>
                                <a class="dropdown-item" href="../views/locked.php">Lock</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <?php
}else{
    header("location:../views/sign-in.php");
}

?>
