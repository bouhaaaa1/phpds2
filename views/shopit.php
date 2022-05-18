<?php
require "../controller/header_user.php";
include "../controller/QuickView.php";
$ArticleU=new ArticleU();
$listeArticle=$ArticleU->afficherAll();
?>
<section class="best_rated_onsale_top_sellares section_padding_100_70">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tabs_area">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="product-tab">
                            <li class="nav-item">
                                <a href="#on-sale" class="nav-link active" data-toggle="tab" role="tab">On Sale<span class="badge" ><?= $ArticleU->CountPromo()?> Products</span></a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <div role="tabpanel" class="tab-pane fade show active" id="on-sale">
                                <div class="on_sale_area on_sale_slides">
                                    <div class="row div_all" id="div_all">
                                    <!-- <div id="table_promo"> -->
                                     <?php
                                               foreach($listeArticle as $Art):
                                                if($Art['promo']>0):

                                        ?>
                                        <div class="col-12 col-sm-6 col-lg-4 art1">
                                            <div class="single_top_sellers">
                                            <div class="product_badge">
                                                <span>-<?= $Art['promo'];?>%</span>
                                            </div>
                                                <div class="top_seller_image">
                                                    <img src="<?= $Art['image'];?>" class="size-img" alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5 class="label"><?= $Art['label'];?></h5>
                                                    <h6><?= $Art['prix']-($Art['prix']*$Art['promo'])/100;?>DT <span><?= $Art['prix'];?>DT</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart" >
                                                            <a href="#" title="Add To Cart" ><i class="addcart icofont-shopping-cart" onclick="addc(<?= $Art['id'];?>,1,<?= $Art['prix']-($Art['prix']*$Art['promo'])/100?>)"></i></a>
                                                            <input type="hidden" class="idartcart" value="<?= $Art['id'];?>">
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="#" title="Wishlist"><i class="icofont-heart" onclick="addw(<?= intval($Art['id']);?>,'<?= strval($Art['image']);?>','<?= strval($Art['label']);?>',1, <?= floatval($Art['prix']-($Art['prix']*$Art['promo'])/100)?>)"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#"  title="Quick View" onclick="QuickView(<?= $Art['id'];?>,'<?= $Art['label'];?>',<?= $Art['prix'];?>,'<?= $Art['description'];?>','<?= $Art['image'];?>',<?= $Art['promo'];?>);"><i class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <?php
                                                    endif;
                                                endforeach;
                                            ?>
                                        <!-- </span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    require "../controller/footer_user.php";
    ?>
