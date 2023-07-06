<?php
include "includes/header.php";
include_once "includes/functions.php";
?>
<!-- Navigation -->
<?php include "includes/nav.php";?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">

                <small></small>
            </h1> <?php blog_post_redirect();?>
        </div>



        <!-- Blog Sidebar Widgets Column -->
        <?php  include "includes/sidebar.php";?>
    </div>
    <!-- /.row -->
    <?php include "admin/comments_filler.php"; ?>

    <hr>
    <?php
    include "includes/footer.php";
    ?>
