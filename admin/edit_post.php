<?php include_once "../includes/functions.php";

?>
<h3><?php new_post();?>
    <?php edit_submit(); ?></h3>



<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title:</label>
        <input value="<?php echo edit_query("title"); ?>" type="text" class="form-control" name="title" required><br><br>
    </div>

    <div class="form-group">
        <label for="category">Choose Category:</label>
        <select name="post_category" id="post_cat"><?php echo categoriesChooser(); ?></select>
    </div>

    <div class="form-group">
        <label for="identification">Post ID:</label>
        <input value="<?php echo edit_query("id"); ?>" type="text" class="form-control" name="p_id" ><br><br>
    </div>

    <div class="form-group">
        <label for="author">Post Author:</label>
        <input value="<?php echo edit_query("author"); ?>" type="text" class="form-control" name="author" required><br><br>
    </div>


    <div class="form-group">
        <label for="status">Post Status:</label>
        <select name="status" id="post_stat">
           <?php statusChooser(); ?>
            </select>
    </div>


    <div class="form-group">
        <label for="image">Post Image:</label>
        <img src="../images/<?php echo edit_query("img"); ?>" >
        <input value="" type="file" name="image" ><br><br>



    </div>

    <div  class="form-group">
        <label for="tags">Post Tags:</label>
        <input value="<?php echo edit_query("tag"); ?>" type="text" class="form-control" name="tags" required><br><br>
    </div>

    <div class="form-group>"
    <label for="content">Post Content:</label><br>
    <textarea class="form-control" name="content" rows="10" cols="40" id="summernote" required><?php echo edit_query("content"); ?></textarea><br><br>


    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Edit Post">

    </div>

</form>