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
                Search Results
                <small></small>
            </h1>
            <?php search_engine(); ?>

        </div>



        <!-- Blog Sidebar Widgets Column -->
        <?php  include "includes/sidebar.php";?>
    </div>
    <!-- /.row -->







<?php
include "includes/footer.php";
?>
