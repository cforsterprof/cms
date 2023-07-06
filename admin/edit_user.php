<?php include_once "../includes/functions.php";?>




<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="firstName">FirstName</label>
        <input value="<?php echo edit_user('first'); ?>" type="text" class="form-control" name="firstName" required><br><br>
    </div>
    <div class="form-group">
        <label for="lastName">LastName</label>
        <input value="<?php echo edit_user("last"); ?>" type="text" class="form-control" name="lastName" required><br><br>
    </div>

    <div class="form-group">
        <label for="user_role">Choose Role:</label>
        <select name="user_role" id="user_role">
            <option ><?php echo edit_user("role"); ?>(current role)</option>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
    </div>

    <div class="form-group">
        <label for="author">Email</label>
        <input value="<?php echo edit_user("email"); ?>" type="email" class="form-control" name="email" required><br><br>
    </div>

    <div class="form-group">
        <label for="status">Username</label>
        <input value="<?php echo edit_user("username"); ?>" type="text" class="form-control" name="username" ><br><br>
    </div>

    <div class="form-group">
        <label for="status">Password</label>
        <input value="<?php echo edit_user("pass"); ?>" type="text" class="form-control" name="password" ><br><br>
    </div>


    <div class="form-group">
        <label for="image">User Image:</label>
        <input type="file" name="user_image" value="Upload" ><br><br>



    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
        <?php submitEditUser();?>
    </div>

</form>