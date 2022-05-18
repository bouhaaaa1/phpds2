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
                            <h3>Add Article</h3>
                        </div>
            <div id="page-inner">
               <form method="POST">
                   <div class="container1">
               <div class="form-group">
      <input type="text" class="form-control" name="name" placeholder="type the name" id="name_art" tabindex="2" required>
      <br>
      <input type="number" class="form-control" placeholder="price" id="price_art" required tabindex="3">
<br>
    <input type="number" class="form-control" placeholder="promo (%)" min="0" max="100" value="0" id="promo_art">
<br>
<textarea class="form-control" id="description_art" placeholder="Description" name="description" rows="3" cols="25" required tabindex="4"></textarea>
      <br>
      <select class="form-control" id="mark_art"tabindex="1" required autofocus>
        <option value="0">Select Mark</option>
        <?php
        $SousCategorieU=new SousCategorieU();
        $listeSousCategorie=$SousCategorieU->afficherSousCategorie();
        foreach($listeSousCategorie as $SCat):
          ?>
<option value="<?= $SCat['id_mark'];?>"><?= $SCat['nom'];?></option>
          <?php
        endforeach;
        ?>
      </select>
      <br>
<div class="file-upload">
  <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>

  <div class="image-upload-wrap">
    <input class="file-upload-input" type='file' id="file" onchange="readURL(this);" accept="image/*"/>
    <div class="drag-text"></div>
  </div>
  <div class="file-upload-content">
    <img class="file-upload-image" src="#" name="image" id="image_art" alt="your image" value=""/>
    <div class="image-title-wrap">
      <button type="button" onclick="removeUpload(document.getElementById('file'))" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
    </div>
  </div>
</div>
               </div>
               <input type="button" id="article-submit" value="Add Article">
               </form> 
   
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
$('#add_article_sidebar').addClass('active');
</script>
<?php
}else{
    header("location:../views/sign-in.php");
}
?>
