<!doctype html>
<html lang="en">
<?PHP
session_start();
	// require "../Config.php";
	require "../controller/CategorieU.php";
	require "../controller/ArticleU.php";
if(!isset($_SESSION['cart'])){
$_SESSION['cart'] = [];
}
if(!isset($_SESSION['total'])){
    $_SESSION['total'] = [];
}

if(!isset($_SESSION['wishlist'])){
    $_SESSION['wishlist'] = [];
}


	$CategorieU=new CategorieU();
	$ArticleU=new ArticleU();
    $listeCategorie=$CategorieU->afficherCategorie();
    //unset($_SESSION['cart']);
     //unset($_SESSION['wishlist']);
     // unset($_SESSION['total']);
    // var_dump($_SESSION['cart']);
    // var_dump($_SESSION['total']);
    // var_dump($_SESSION['wishlist']);



?>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title  -->
    <title>ShopIt</title>

    <!-- Favicon  -->
    <link rel="icon" href="../assets/img/images/ShopIt.png">

    <!-- Style CSS -->
    <link rel="stylesheet" href="../assets/css/user/style.css">


</head>

<body class="body">
    <!-- Header Area -->
    <header class="header_area">
        <!-- Main Menu -->
        <div class="bigshop-main-menu">
            <div class="container">
                <div class="classy-nav-container breakpoint-off">
                    <nav class="classy-navbar" id="bigshopNav">

                        <!-- Nav Brand -->
                        <a href="../views/shopit.php" class="nav-brand"><img src="../assets/img/images/ShopIt.png" width="90px" alt="logo"></a>

                        <!-- Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">
                            <!-- Close -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="../views/shopit.php" data-toggle="tooltip" title="Home">Home</a></li>
                                    <li><a href="#">Categories</a>
                                        <ul class="dropdown">
                                            <?php
                                                foreach($listeCategorie as $Cat):
                                            ?>
                                                    <li><a><?= $Cat['nom'];?></a>
                                                        <ul class="dropdown">
                                                        <?php
                                                            $SousCategorieU=new SousCategorieU();
                                                            $listeSousCategorie=$SousCategorieU->afficherSousCategorie();
                                                    foreach($listeSousCategorie as $SCat):
                                                        if($SCat['id_cat']==$Cat['id_cat']):
                                                    ?>
                                                            <li><a href="../views/AfficherArticle.php?cat=<?= $Cat['nom']."&mark=".$SCat['nom']?>"><?= $SCat['nom']?><span class="badge_art"><?=$ArticleU->CountArt($Cat['nom'],$SCat['nom'])?></span></a></li>
                                                        <?php
                                                           endif;
                                                        endforeach;
                                                        ?>
                                                        </ul>
                                                    </li>
                                            <?php   
                                                     
                                                endforeach;
                                            ?>
                                        </ul>
                                    </li>
                                    <li><a href="contact.html" data-toggle="tooltip" title="Contact">Contact</a></li>
                                    <li><a href="#" data-toggle="tooltip" title="Phone number">+(216) 52 52 52 52</a></li>

                                </ul>
                            </div>
                        </div>

                        <!-- Hero Meta -->
                        <div class="hero_meta_area ml-auto d-flex align-items-center justify-content-end">
                             <!-- Login -->
                            <div class="login-area">
                                <a href="../views/sign-in.php" class="login-btn" title="login" data-toggle="tooltip"><i class="icofont-sign-in"></i></a>
                            </div>
                            <!-- Search -->
                            <div class="search-area">
                                <div class="search-btn" title="Search" data-toggle="tooltip"><i class="icofont-search"></i></div>
                                <!-- Form -->
                                <div class="search-form">
                                    <input type="search" class="form-control" placeholder="Search" id="search">
                                    <input type="submit" class="d-none" value="Send">
                                </div>
                            </div>

                            <!-- Wishlist -->
                            <div class="wishlist-area">
                                <div class="wishlist-btn"><i class="icofont-heart"></i> </div>

                                <!-- Cart Dropdown Content -->
                                <div class="wishlist-dropdown-content">
                                    <ul class="wishlist-list" id="wishlist-ul">

                                        <?php
                                       if(!($_SESSION['wishlist'])){
                                            ?>
                                            <h5>Looks like it's empty!</h>
                                            <h6>Why not add something?</h6>
                                            <?php
                                     }else{
                                            foreach($_SESSION['wishlist'] as $id):
                                        ?>
                                        <li>
                                            <div class="wishlist-item-desc">
                                                <input type="hidden" value="<?= $id['id']?>" class="wishlist-id">
                                                <a href="#" class="image">
                                                    <img src="<?= $id['image']; ?>" class="wishlist-thumb" alt="">
                                                </a>
                                                <div>
                                                    <a href="#" class="wishlist-label"><?= $id['label']; ?></a>
                                                    <p><span class="wishlist-quantity"><?= $id['quantity']; ?></span> x - <span class="price wishlist-price"><?= $id['prix']; ?>DT</span></p>
                                                </div>
                                            </div>
                                            <span class="dropdown-product-add"><i class="icofont-ui-add" onclick="addwtoc(<?=$id['id']?>,<?=$id['quantity']?>, <?=$id['prix']?>)"></i></span>
                                            <span class="dropdown-product-remove"><i class="icofont-bin" onclick="deletew(<?=$id['id']?>)"></i></span>
                                        </li>
                                        <?php
                                            endforeach;
                                        ?>
                                    </ul>
                                    <?php 
                                    if(count($_SESSION['wishlist'])>1):
                                    ?>
                                    <div class="wishlist-box">
                                        <a href="#" class="btn btn-primary d-block" onclick="addwtocall()">Add All</a>
                                    </div>
                                    <?php
                                    endif;
                                    }
                                    ?>
                                </div>
                            </div>


                            <!-- Cart -->
                            <div class="cart-area">
                                <a href="cart.php" class="cart-btn" data-toggle="tooltip" title="Cart"><i class="icofont-cart"></i><span class="cart_quantity" id="quantity_cart"><?= count($_SESSION['cart']);?></span></a>
                            </div>
                            <div>
                            <li><a id="pay" href="#" data-toggle="tooltip" title="Order Summary"><?= (isset($_SESSION['total']))?array_sum($_SESSION['total']):'0';?> DT</a></li>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->
