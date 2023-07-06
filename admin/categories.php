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
                        <small>//Categories HomePage</small>
                    </h1>

                    <?php //category forms CRUD?>

                    <div class="col-xs-6">
                        <?php new_category();?>
                        <form action="" method="post">
                            <div class="form-group">
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title"></label>
                                <?php if (isset($_GET['update'])) {edit_category();} ; ?>
                            </div>
                        </form>
                    </div>


                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Category Title</th>
                                <th>Id</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php category_table();
                            delete_category();
                            ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    <?php include "includes/admin_footer.php";?>
