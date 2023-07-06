
<?php include_once "../includes/functions.php";

?>
<h3><?php new_post();?></h3>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
    <label for="title">Title:</label>
    <input type="text" class="form-control" name="title" required><br><br>
    </div>

    <div class="form-group">
        <label for="category">Choose Category:</label>
        <select name="post_category" id="post_cat"><?php echo categoriesChooser(); ?></select>
    </div>

    <div class="form-group">
    <label for="category">Post ID:</label>
    <input type="text" class="form-control" name="p_id" ><br><br>
    </div>

    <div class="form-group">
    <label for="author">Post Author:</label>
    <input type="text" class="form-control" name="author" required><br><br>
    </div>

    <div class="form-group">
        <label for="postStatus">Choose Status:</label>
        <select name="status" id="post_stat">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Post Image:</label>
        <input type="file" name="image" value="Upload" ><br><br>



    </div>

    <div  class="form-group">
    <label for="tags">Post Tags:</label>
    <input type="text" class="form-control" name="tags" required><br><br>
    </div>

    <div class="form-group>"
    <label for="summernote">Post Content:</label><br>
    <textarea class="form-control" name="content" rows="10" cols="40" id="summernote" required></textarea><br><br>
    </input>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>

</form>