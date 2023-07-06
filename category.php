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


            <?php
            global $connection;
            if(isset($_GET['category'])){
                $post_cat = $_GET['category'];
            }
            $query = "SELECT * FROM posts WHERE post_cat_id = {$post_cat}";
            $cat_q = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($cat_q)) {
                $post_title = $row['post_title'];
                $post_auth = $row['post_auth'];
                $post_date = $row['post_date'];
                $post_pic = $row['post_pic'];
                $post_content = $row['post_content'];
                $post_id = $row['post_id'];


            ?>


            <!-- First Blog Post -->
            <h2>
                <a href='post.php?p_id=<?php echo $post_id; ?>'><?php echo $post_title ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $post_auth ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $post_pic ?>" alt="">
            <hr>
            <p><?php echo $post_content ?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>
            <?php } ?>
            </div>





            <!-- /.row -->
            <!-- Blog Sidebar Widgets Column -->
            <?php  include "includes/sidebar.php";?>
        </div>
        <hr>
<?php
include "includes/footer.php";
?>
