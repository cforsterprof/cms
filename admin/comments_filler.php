<!-- Blog Comments -->
<?php include_once "includes/functions.php";?>
<!-- Comments Form -->
<div class="well" xmlns="http://www.w3.org/1999/html">
    <h4>Leave a Comment:</h4>
    <form action="" method="post" role="form">

        <div class="form-group">
            <label for="author"> Author:
            <input type="text" name="comment_author" class="form-control" required>
            </label>
        </div>
        <div class="form-group">
            <label for="email">Email:
            <input type="email" name="comment_email" class="form-control" required>
            </label>
        </div>
        <div class="form-group">Comment:
            <textarea class="form-control" name="comment_content" rows="3" required></textarea>
        </div><?php submit_comment();?>
        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
    </form>
</div>



<!-- Posted Comments -->

<?php  showingApprovedComments();?>


<!-- Comment -->

        <!-- End Nested Comment -->
