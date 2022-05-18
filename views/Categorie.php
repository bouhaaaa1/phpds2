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
                              <h3>Add Categorie</h3>
                              </div>
                              <div class="col-md-2">
                              <p></p>
                            </div>
                              <div class="col-md-4">
                              <h3>Edit Categorie</h3>
                              </div>
                          </div>
                      </div>

            <div id="page-inner">
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                  <div class="container1">
            <form>
               <div class="form-group">
      <br>
      <input type="text" class="form-control" name="name" placeholder="Label" id="add_categorie_input" tabindex="2" required>
               </div>
               <br>
               <br>
               <input type="button" id="add_submit_cat" value="Add Categorie">
               </form> 
   
            </div>

                  </div>
                  <div class="col-md-6">
                  <div class="container1">
            <form>
               <div class="form-group">
               <select class="form-control" name="categorie"tabindex="1" id="categorie_list_edit" required autofocus>
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
      <br>
      <input type="text" class="form-control" name="name" placeholder="Label" id="edit_categorie_input" tabindex="2" required>
               </div>
               <br>
               <br>
               <input type="button" id="edit_submit_cat" value="Edit Categorie">
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
                              <h3>Delete Categorie</h3>
                              </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                              <p></p>
                            </div>
                            <div class="col-md-6">
                            <div class="container1">
            <form >
               <div class="form-group">
               <select class="form-control" name="categorie"tabindex="1" id="categorie_list_delete" required autofocus>
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
      <br>
               </div>
               <br>
               <br>
               <input type="button" id="delete_submit_cat" value="Delete Categorie">
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
$('#categorie_sidebar').addClass('active');
</script>
<?php
}else{
    header("location:../views/sign-in.php");
}
?>


