<?php
// error_reporting(0);
require "../controller/header_user.php";
include "../Controller/QuickView.php";
$ArticleU=new ArticleU();
$listeArticle=$ArticleU->afficherArticles($_GET['cat'],$_GET['mark']);

?>
    <section class="new_arrivals_area section_padding_100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_heading new_arrivals">
                        <h5><?= $_GET['mark'];?></h5>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php
                if($ArticleU->CountArt($_GET['cat'],$_GET['mark'])==0):
                                                ?>
                                                <h3>There's no article here</h3>
                                                <?php
                                                endif;
                                                ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="new_arrivals_slides owl-carousel" id="div_all">
                        <?php                   
                        foreach($listeArticle as $Art):
                            $prix_promo = ($Art['promo']>0) ? $Art['prix']-($Art['prix']*$Art['promo'])/100 : $Art['prix'];
                        ?>
                        <div class="single-product-area art1">
                            <div class="product_image">
                                <input type="hidden" id="idartcart" value="<?= $Art['id']; ?>">
                                <!-- Product Image -->
                                <img class="normal_img" src="<?= $Art['image']; ?>" alt="">

                                <!-- Product Badge -->
                                <?php
                                if($Art['promo']>0):
                                ?>
                                <div class="product_badge">
                                    <span>-<?= $Art['promo']; ?>%</span>
                                </div>
                                <?php
                                endif;
                                ?>
                                <!-- Wishlist -->
                                <div class="product_wishlist">
                                    <a href="#"><i class="icofont-heart" onclick="addw(<?= intval($Art['id']);?>,'<?= strval($Art['image']);?>','<?= strval($Art['label']);?>',1, <?= floatval($Art['prix']-($Art['prix']*$Art['promo'])/100)?>)"></i></a>
                                </div>
                            </div>
                            
                                
                            <!-- Product Description -->
                            <div class="product_description">
                                <!-- Add to cart -->
                                <div class="product_add_to_cart">
                                    <a href="#" id="addcart" onclick="addc(<?=$Art['id'];?>,1,<?= $prix_promo?>);"><i class="icofont-shopping-cart"></i> Add to Cart</a>
                                </div>

                                <!-- Quick View -->
                                <div class="product_quick_view">
                                <a href="#"  title="Quick View" onclick="QuickView(<?= $Art['id'];?>,'<?= $Art['label'];?>',<?= $Art['prix'];?>,'<?= $Art['description'];?>','<?= $Art['image'];?>',<?= $Art['promo'];?>);"><i class="icofont-eye-alt"></i></a>
                                </div>

                                <p class="brand_name"><?= $Art['label']; ?></p>
                                <h6 class="product-price">
                                    <?php
                                        if($Art['promo']>0){
                                    ?>
                                        <?= $Art['prix']-($Art['prix']*$Art['promo'])/100; ?>DT
                                        <span><?= $Art['prix']; ?></span>
                                    <?php
                                        }else{
                                    ?>
                                        <?= $Art['prix']; ?>DT
                                    <?php
                                        }
                                        ?>
                                </h6>
                            </div>
                        </div>
                        <?php
                        endforeach;

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    require "../controller/footer_user.php";
    ?>