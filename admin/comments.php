
<?php include "includes/admin_header.php";
include "../includes/functions.php";
?>

<body>

<div id="wrapper">


    <?php include "includes/admin_nav.php";?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Comments Page</small>
                    </h1>
                    <?php viewComments();?>


                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include "includes/admin_footer.php";?>
