<?php
session_start();
if(isset($_SESSION["login"]) && $_SESSION['password']){
require "../controller/header.php";
?>
<body data-theme="default" data-layout="fluid" data-sidebar="left">

    <div class="wrapper">
        <?php
            require "../Controller/sidebar.php";
        ?>

        <div class="main">
            <?php
                require "../Controller/navbar.php";
            ?>
            <main class="content">
                <div class="container-fluid p-0">

                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3>Articles</h3>
                        </div>
                        <div id="page-inner">
                            <div class="container">
		                        <div class="table-responsive">
			                        <div class="table-wrapper">
                                    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>label</th>
                <th>Prix</th>
                <th>description</th>
                <th>image</th>
                <th>promo</th>
                <th>mark</th>
                <th>categorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
             $articleU=new ArticleU();
             $listeArticle=$articleU->afficherAll();
                             foreach($listeArticle as $art):
                                ?>
                                     <tr name='articles-all'>
                                     <td><?=$art['label']?></td>
                                     <td><?=$art['prix']?> DT</td>
                                     <td><?=$art['description']?></td>
                                     <td><img src="<?=$art['image']?>" class='admin-article'></td>
                                     <td><?=$art['promo'] ?>%</td>
                                    <?php
                                         $SousCategorieU=new SousCategorieU();
                                         $listeSousCategorie=$SousCategorieU->afficherSousCategorie();
                                         foreach($listeSousCategorie as $SCat):
                                             if($art['id_mark'] == $SCat["id_mark"]):
                                    ?>
                                         <td><?= $SCat['nom']?></td>
                                    <?php
                                             endif;
                                         $CategorieU=new CategorieU();
                                         $listeCategorie=$CategorieU->afficherCategorie();
                                         foreach($listeCategorie as $Cat):
                                         if($art['id_mark'] == $SCat["id_mark"] && $SCat['id_cat'] == $Cat['id_cat']):
                                    ?>    
                                         <td><?= $Cat['nom']?></td>
                                    <?php
                                         endif;
                                        endforeach;
                                        endforeach;
                                         
                                    ?>
                                         <td><a href='EditArticle.php?id=<?=$art['id']?>'><i class='fa fa-edit editdel' title='Edit'></i></a><button type='button' class='btn btn-link' onclick=Delete_Article(<?=$art['id']?>)><i class='fa fa-trash editdel' title='Delete'></i></button></td>
                                         </tr>
                                        <?php
                                        
                                    endforeach;
             ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Label</th>
                <th>Prix</th>
                <th>description</th>
                <th>image</th>
                <th>promo</th>
                <th>Mark</th>
                <th>categorie</th>
                <th>actions</th>
            </tr>
        </tfoot>
    </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </main>

        </div>
    </div>
<?php
require "../Controller/footer.php";
?>
        <script>
$('#all_sidebar').find('.sidebar-item').removeClass('active');
$('#articles_sidebar').addClass('active');
</script>
<?php
}else{
    header("location:../views/sign-in.php");
}
?>
