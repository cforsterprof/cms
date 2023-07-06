
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
                        <small>Your Profile</small>
                    </h1>


                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="firstName">FirstName</label>
                            <input value="<?php echo checkForSession('first'); ?>" type="text" class="form-control" name="firstNamep" required><br><br>
                        </div>
                        <div class="form-group">
                            <label for="lastName">LastName</label>
                            <input value="<?php echo checkForSession("last"); ?>" type="text" class="form-control" name="lastNamep" required><br><br>
                        </div>

                        <div class="form-group">
                            <label for="user_role">Choose Role:</label>
                            <select name="user_rolep" id="user_role">
                                <option value="<?php echo checkForSession("role");?>" ></option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="author">Email</label>
                            <input value="<?php echo checkForSession("email"); ?>" type="email" class="form-control" name="emailp" required><br><br>
                        </div>

                        <div class="form-group">
                            <label for="status">Username</label>
                            <input value="<?php echo checkForSession("username"); ?>" type="text" class="form-control" name="usernamep" ><br><br>
                        </div>

                        <div class="form-group">
                            <label for="status">Password</label>
                            <input value="<?php echo checkForSession("pass"); ?>" type="text" class="form-control" name="passwordp" ><br><br>
                        </div>


                        <div class="form-group">
                            <label for="image">User Image:</label>
                            <input type="file" name="user_image" value="Upload" ><br><br>

                        </div>

                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="edit_prof" value="Edit Profile">
                            <?php submitEditProf(); ?>
                        </div>

                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include "includes/admin_footer.php";?>
