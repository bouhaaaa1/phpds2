<?php
session_start();
if(isset($_SESSION["login"]) && $_SESSION['password']){
require "../Controller/header.php";
?>
<body data-theme="default" data-layout="fluid" data-sidebar="left">

    <div class="wrapper">
        <?php
            require "../Controller/sidebar.php";
        ?>

        <div class="main">
            <?php
                require "../Controller/navbar.php";
                $articleU=new ArticleU();
$listeArticle=$articleU->afficherAll();
            ?>
            <main class="content">
                <div class="container-fluid p-0">

                    <div class="row mb-2 mb-xl-3">
                      <div class="container">
                          <div class="row">
                            <div class="col-md-2">
                              <p></p>
                            </div>
                              <div class="col-md-4">
                              <h3>Add Mark</h3>
                              </div>
                              <div class="col-md-2">
                              <p></p>
                            </div>
                              <div class="col-md-4">
                              <h3>Edit Mark</h3>
                              </div>
                          </div>
                      </div>

            <div id="page-inner">
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                  <div class="container1">
                  <form>
                            <select class="form-control" name="mark"tabindex="1" id="categorie_list_add" required autofocus>
        <option value="0">Select a Categorie</option>
        <?php
        $CategorieU=new CategorieU();
        $listeCategorie=$CategorieU->afficherCategorie();
        foreach($listeCategorie as $Cat):
          ?>
<option value="<?=$Cat['id_cat'];?>"><?=$Cat['nom'];?></option>
          <?php
        endforeach;
        ?>
      </select>
               <div class="form-group">
      <br>
      <input type="text" class="form-control" name="name" placeholder="Label" id="add_mark_input" tabindex="2" required>
               </div>
               <br>
               <br>
               <input  type="button" id="add_submit_mark" value="Add Mark">
               </form> 
   
            </div>
                  </div>
                  <div class="col-md-6">
                  <div class="container1">
            <form>
               <div class="form-group">
               <select class="form-control" name="mark"tabindex="1" id="mark_list_edit" required autofocus>
        <option value="0">Select a Mark</option>
        <?php
        $SousCategorieU=new SousCategorieU();
        $listeSousCategorie=$SousCategorieU->afficherSousCategorie();
        foreach($listeSousCategorie as $SCat):
          ?>
<option value="<?=$SCat['id_mark'];?>"><?=$SCat['nom'];?></option>
          <?php
        endforeach;
        ?>
      </select>
      <br>
      <input type="text" class="form-control" name="name" placeholder="Label" id="edit_mark_input" tabindex="2" required>
               </div>
               <br>
               <br>
               <input type="button" id="edit_submit_mark" value="Edit Mark">
               </form> 
   
            </div>
                  </div>
                </div>
                <br>
                <br>
                <div class="row">
                <div class="container">
                          <div class="row">
                            <div class="col-md-5">
                              <p></p>
                            </div>
                              <div class="col-md-4">
                              <h3>Delete Mark</h3>
                              </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                              <p></p>
                            </div>
                            <div class="col-md-6">
                            <div class="container1">
            <form>
               <div class="form-group">
               <select class="form-control" name="mark"tabindex="1" id="mark_list_delete" required autofocus>
        <option value="0">Select a Mark</option>
        <?php
        $SousCategorieU=new SousCategorieU();
        $listeSousCategorie=$SousCategorieU->afficherSousCategorie();
        foreach($listeSousCategorie as $SCat):
          ?>
<option value="<?=$SCat['id_mark'];?>"><?=$SCat['nom'];?></option>
          <?php
        endforeach;
        ?>
      </select>
      <br>
               </div>
               <br>
               <br>
               <input type="button" id="delete_submit_mark"  value="Delete Mark">
                             </form> 
   
            </div>

                            </div>
                          </div>
                      </div>
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
$('#mark_sidebar').addClass('active');
</script>
<?php
}else{
    header("location:../views/sign-in.php");
}
?>


