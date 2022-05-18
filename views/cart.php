<?php
require "../controller/header_user.php";
//require '../controller/autoload.php';
//require "../controller/ShoppingCart.php";

?>  
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_heading new_arrivals">
                        <h5>Shopping Cart</h5>
                    </div>
                </div>
            </div>
        </div>

    <!-- Wishlist Table Area -->
    <div class="wishlist-table section_padding_100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cart-table wishlist-table">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-30" id="table_cart">
                                <thead>
                                    <tr>
                                        <th scope="col"><a><i class="icofont-ui-delete"></i></a></th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(count($_SESSION['cart'])==0){
                                        ?>
                                        <tr>
                                        <td colspan="6" class="text-left"><h3>Looks like it's empty!</h3>
                                            <h5>Why not add something?</h5></td>
                                        </tr>
                                    <?php
                                    }else{
                                        foreach($_SESSION['cart'] as $id => $quant):
                                            $ArticleU = new ArticleU;
                                            $listeArticle = $ArticleU -> afficherAll();
                                            foreach($listeArticle as $art):
                                                if($id == $art['id']):
                                                    
                                                    $prix_promo = ($art['promo']>0) ? $art['prix']-($art['prix']*$art['promo'])/100 : $art['prix'];
                                                    
                                    ?>
                                    <tr>
                                    <input type="hidden" class="id_art" value="<?= $art['id'];?>">
                                        <th scope="row">
                                            <i onclick="deletec(<?= $art['id'];?>,'<?=$art['label'];?>',<?= $art['promo'];?>);" class="icofont-close"></i>
                                        </th>
                                        <td>
                                            <img src="<?= $art['image']?>" alt="Product">
                                        </td>
                                        <td>
                                            <a href="#"><?= $art['label'];?></a>
                                        </td>
                                        
                                        <td class="promo_prix"><?= $prix_promo ?> DT</td>
                                        <td>
                                            <div class="quantity">
                                                <input type="number" class="qty-text qte" id="qty2" step="1" min="1" max="99" name="quantity" value="<?= $quant;?>">
                                            </div>
                                        </td>
                                        <td class="total_row"><?= $prix_promo*$quant?> DT</td>
                                    </tr>
                                    <?php
                                                endif;
                                            endforeach;
                                        endforeach;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="cart-footer mb-30">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                <div class="back-to-shop text-left">
                                    <a href="../views/shopit.php" class="btn btn-success">Back to shopping</a>
                                </div>
                                </div>
                                <?php 
                                    if(count($_SESSION['cart'])>0):
                                ?>
                                <div class="col-md-6">
                                <div class="back-to-shop text-right">
                                    <a href="#" class="btn btn-primary" onclick="updatec();">Update</a>
                                    <a href="#" class="btn btn-danger" onclick="deleteallc();">Remove All</a>

                                </div>
                                </div>
                                    <?php
                                    endif;
                                    ?>
                            </div>
                        </div>
                    </div>
                    <?php 
                                    if(count($_SESSION['cart'])>0):
                                ?>
                    <div class="container mb-30">
                        <div class="row">
                            <div class="col-md-10"></div>
                            <div class="col-md-2">
                            <table class="table table-bordered mb-30 text-right">
                                <thead>
                                    <tr>
                                        <th scope="col">Order Summary</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row" id="order_summary">
                                            0DT
                                        </th>                                     
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    <?php
                                    endif;
                                    ?>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Table Area -->

    <!-- Footer Area -->
    <?php
    require "../controller/footer_user.php";
    ?>
