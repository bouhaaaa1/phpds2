<?php
session_start();
if(isset($_SESSION["login"]) && $_SESSION['password']){
require "../Controller/header.php";
// require "../config.php";
$articleU=new ArticleU();
$listeArticle=$articleU->afficherAll();
foreach($listeArticle as $art):
  if($art['id'] == $_GET['id']):
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
                            <h3>Edit <?=$art['label'];?></h3>
                        </div>
            <div id="page-inner">
               <form method="POST">
                   <div class="container1">
               <div class="form-group">
      <input type="hidden" value="<?=$art['id'];?>" id="id_art_edit"> 
      <input type="hidden" value="<?=$art['label'];?>" id="oldname_art_edit"> 
      <input type="text" class="form-control" value="<?=$art['label'];?>" id="name_art_edit" tabindex="1" autofocus>
      <br>
      <input type="number" class="form-control" value="<?=$art['prix'];?>" id="price_art_edit" tabindex="2">
<br>
    <input type="number" class="form-control" value="<?=$art['promo'];?>" min="0" max="100" value="0" id="promo_art_edit" tabindex="3">
<br>
<textarea class="form-control" id="description_art_edit" name="description" rows="3" cols="25" required tabindex="4"><?=$art['description'];?></textarea>
      <br>
      <select class="form-control" id="mark_art_edit"tabindex="1" required autofocus>
        <?php
        $SousCategorieU=new SousCategorieU();
        $listeSousCategorie=$SousCategorieU->afficherSousCategorie();
        foreach($listeSousCategorie as $SCat):
          if($SCat['id_mark'] == $art['id_mark']){
            ?>
<option value="<?=$SCat['id_mark'];?>" selected><?=$SCat['nom'];?></option>

            <?php
          }else{
          ?>
<option value="<?=$SCat['id_mark'];?>"><?=$SCat['nom'];?></option>
          <?php
        }
      endforeach;
        ?>
      </select>
      <br>
      <center><img src="<?=$art['image']; ?>" id="img_123" class="control-form" width="250px"></center>
<div class="file-upload">
  <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>

  <div class="image-upload-wrap">
    <input class="file-upload-input" type='file' id="file" onchange="readURL(this);" accept="image/*"/>
    <div class="drag-text"></div>
  </div>
  <div class="file-upload-content justshow">
    <img class="file-upload-image" src="<?=$art['image'];?>" name="image" id="image_art_edit" alt="your image" value="" width="250px"/>
    <div class="image-title-wrap">
      <button type="button" onclick="removeUpload(document.getElementById('file'))" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
    </div>
  </div>
</div>
               </div>
               <input type="button" id="Edit_article_sub" value="Edit Article">
               </form> 
   
            </div>
                        </div>

                </div>
            </main>

        </div>
    </div>
<?php
require "../Controller/footer.php";
    endif;
    endforeach;
?>
<?php
}else{
    header("location:../views/sign-in.php");
}
?>