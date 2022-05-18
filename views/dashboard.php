<?php
session_start();
if(isset($_SESSION["login"]) && $_SESSION['password']){
require "../controller/header.php";
$CategorieU=new CategorieU();
$ArticleU=new ArticleU();
$SousCategorieU=new SousCategorieU();

?>

<body data-theme="default" data-layout="fluid" data-sidebar="left">
    <div class="wrapper">
        <?php
            require "../controller/sidebar.php";
        ?>
        <div class="main">

            <?php
                require "../controller/navbar.php";
            ?>
            <main class="content">
                <div class="container-fluid p-0">

                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3>Dashboard</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Categories</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="avatar">
                                                <div class="avatar-title rounded-circle bg-primary-light">
                                                    <i class="align-middle" data-feather="dollar-sign"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?=$CategorieU->CountAllCat();?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Marks</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="avatar">
                                                <div class="avatar-title rounded-circle bg-primary-light">
                                                    <i class="align-middle" data-feather="shopping-bag"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?= $SousCategorieU->CountAllSCat();?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Articles</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="avatar">
                                                <div class="avatar-title rounded-circle bg-primary-light">
                                                    <i class="align-middle" data-feather="shopping-bag"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3"><?=$ArticleU->CountAllArt();?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Visits</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="avatar">
                                                <div class="avatar-title rounded-circle bg-primary-light">
                                                    <i class="align-middle" data-feather="activity"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">0</h1>
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
$('#dashboard_sidebar').addClass('active');
</script>
<?php
}else{
    header("location:../views/sign-in.php");
}
?>
