<?php

function blog_post()
{
    if(isset($_GET['p_id'])){
        $the_post_id = $_GET['p_id'];
    }

    global $connection;
    $query = "SELECT * FROM posts WHERE post_status = 'published' ";
    $post_data = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($post_data)) {
        $post_title = $row['post_title'];
        $post_auth = $row['post_auth'];
        $post_date = $row['post_date'];
        $post_pic = $row['post_pic'];
        $post_content = $row['post_content'];
        $post_id = $row['post_id'];
        global $post_status;
        $post_status= $row['post_status'];


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
        <a class="btn btn-primary" href='post.php?p_id=<?php echo $post_id; ?>'>Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        <hr>
    <?php }
    global $post_status;
    if($post_status != 'published'){
        echo "<h3>Currently no published blog posts</h3>";
    }


}





//search function
function search_engine()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $search = $_POST['search'];
        $query = "SELECT * FROM posts WHERE post_tag LIKE '%$search%'";
        $search_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($search_query);
        if ($count === 0) {
            echo "<h1>No Results</h1>";
        } else {
            while ($row = mysqli_fetch_assoc($search_query)) {
                $post_title = $row['post_title'];
                $post_auth = $row['post_auth'];
                $post_date = $row['post_date'];
                $post_pic = $row['post_pic'];
                $post_content = $row['post_content'];
                $post_id = $row['post_id'];

                ?>


                <!-- First Blog Post -->
                <h2>
                    <a href='index.php'><?php echo $post_title ?></a>
                </h2>
            <?php }

        }
    }
}

function sidebar_cats()
{
    global $connection;
    $query = "SELECT * FROM categories";
    $select_cats = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_cats)) {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a>";
    }
}

function category_table()
{
    global $connection;
    $query = "SELECT * FROM categories";
    $select_cats = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_cats)) {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
        echo "<tr>";
        echo "<td>{$cat_title}</td>";
        echo "<td>{$cat_id}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}' class='fa fa-trash''></a></td>";
        echo "<td><a href='categories.php?update={$cat_id}' class='fa fa-pencil''></a></td>";
        echo "</tr>";
    }
}

function new_category()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $new_title = $_POST['cat_title'];
        if ($new_title == "" || empty($new_title)) {
            echo "this field should not be empty";
        } else {
            $query = "INSERT INTO categories(cat_title)";
            $query .= "VALUE('{$new_title}')";
            $new_cat_query = mysqli_query($connection, $query);
            if (!$new_cat_query) {
                die("Query Failed" . mysqli_error($connection));
            }
        }
    }
}

function delete_category()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $cat_id_del = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$cat_id_del}";
        $delete_q = mysqli_query($connection, $query);
        header("Location:categories.php");
    }
}

function edit_category()
{
    global $connection;
    if (isset($_GET['update'])) {
        $cat_id = $_GET['update'];
        $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
        $edit_cats = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($edit_cats)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            ?>
            <input value="<?php if (isset($cat_title)) {
                echo $cat_title;
            } ?>" class="form-control" type="text" name="cat_title">
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="update_cat" value="Update Category">
            </div>

            <?php
            if (isset($_POST['update_cat'])) {
                $cat_title = $_POST['cat_title'];
                $query = "UPDATE categories SET cat_title = '{$cat_title}'  WHERE cat_id = '{$cat_id}' ";
                $update_q = mysqli_query($connection, $query);
                if (!$update_q) {
                    die("QUERY FAILED" . mysqli_error($connection));
                }
            } else if (isset($_GET['update_cat'])) {
                $cat_id = $_GET['update_cat'];
            }
        }
    }

}

function post_query()
{

    global $connection;
    $query = "SELECT * FROM posts";
    $select_posts = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_posts)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_cat = $row['post_cat_id'];
        $post_auth = $row['post_auth'];
        $post_stat = $row['post_status'];
        $post_img = $row['post_pic'];
        $post_comments = $row['post_comment_count'];
        $post_date = $row['post_date'];
        echo "<tr>";
        echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='$post_id'></td>";
        echo "<td>{$post_id}</td>";
        echo "<td>{$post_title}</td>";
        echo "<td>{$post_auth}</td>";

        $cat_query = "SELECT * FROM categories WHERE cat_id = {$post_cat}";
        $select_cat_q = mysqli_query($connection, $cat_query);
        while($row = mysqli_fetch_assoc($select_cat_q)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<td>{$cat_title}</td>";
        }

        echo "<td>{$post_stat}</td>";
        echo "<td><img width='100' height='80' src='../images/{$post_img}'></td>";
        echo "<td>{$post_comments}</td>";
        echo "<td>{$post_date}</td>";
        echo "<td><a href='posts.php?source=edit_post&p_id=${post_id}'>Edit</a> </td>";
        echo "<td><a href='posts.php?delete=$post_id'>Delete</a> </td>";
        echo "<td><a href='../post.php?p_id=${post_id}'>View Post</a> </td>";
        echo "<tr>";

    }
}

function viewPosts()
{
    if (isset($_GET['source'])) {
        $source = $_GET['source'];
    } else {
        $source = "";
    }
    switch ($source) {
        case 'add_post';
            include "../admin/add_post.php";
            break;

        case 'edit_post';
            include "../admin/edit_post.php";
            break;

        default:
            include "../admin/view_all_posts.php";
            break;

    }
}

function new_post()
{ global $connection;
    if (isset($_POST['create_post'])) {
        $post_id = $_POST['p_id'];
        $post_category = $_POST['post_category'];
        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_status = $_POST['status'];
        $postTags = $_POST['tags'];
        $postContent = $_POST['content'];
        $postDate = date('d-m-y');
        $postCommentCount = 0;
        $post_image = $_FILES['image']['name'];
        if (isset($_FILES['image']['tmp_name'])) {

            $post_image_temp = $_FILES['image']['tmp_name'];

            move_uploaded_file($_FILES['image']['tmp_name'], "../images/$post_image");
            /*if (!move_uploaded_file($post_image_temp, "../images/$post_image")) {
                echo "unable to upload this is for the picture part ignore for now";
            }*/
        }
        $query = "INSERT INTO posts(post_id, post_cat_id, post_title, post_auth, post_date, post_pic, post_content,post_tag,post_comment_count,post_status) ";
        $query .= "VALUES({$post_id},'{$post_category}','{$post_title}','{$post_author}', now(),'{$post_image}','{$postContent}','{$postTags}',{$postCommentCount} ,'{$post_status}' )";
        $createPost = mysqli_query($connection, $query);
        confirmQuery($createPost);
        echo "<h1 class='bg-success'>Post Created: <a href='../post.php?p_id=$post_id'>View Post</a> or <a href='posts.php'>View All Posts</a> </h1>";
    }
}


function confirmQuery($result){
    global $connection;
    if(!$result){
        die("QUERY FAILED" . mysqli_error($connection));
    }
}

function deletePost(){
    if (isset($_GET['delete'])){
        global $connection;
        $deleting_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id = {$deleting_id}";
        $delete_query = mysqli_query($connection, $query);
        confirmQuery($delete_query);
        header("Location:posts.php");
    }
}

function edit_query($data)
{
    if (isset($_GET['p_id'])) {
        $the_post_id = $_GET['p_id'];
    }

    global $connection;
    $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
    $select_posts = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_posts)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_auth = $row['post_auth'];
        $post_cat = $row['post_cat_id'];
        $post_stat = $row['post_status'];
        $post_img = $row['post_pic'];
        $post_comments = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_content = $row['post_content'];
        if ($data == 'title') {
            return $post_title;
        } elseif ($data == 'id') {
            return $post_id;
        } elseif ($data == 'author') {
            return $post_auth;
        } elseif ($data == 'category') {
            return $post_cat;
        } elseif ($data == 'stat') {
            return $post_stat;
        } elseif ($data == 'img') {
            return $post_img;
        } elseif ($data == 'comments') {
            return $post_comments;
        } elseif ($data == 'date') {
            return $post_date;
        } elseif ($data == 'content') {
            return $post_content;
        } else{
            echo "no data found";
        }
    }
}

function categoriesChooser(){
    global $connection;
    global $set_cat;
    $query = "SELECT * FROM categories";
    $select_cats = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_cats)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<option value='{$cat_id}'>{$cat_title}</option>";
        $set_cat = $cat_title;
    }


}

function edit_submit()
{ global $connection;
    global $set_cat;
    if (isset($_GET['p_id'])) {
        $the_post_id = $_GET['p_id'];
    }

    if(isset($_POST['update_post'])){
        $post_auth = $_POST['author'];
        $post_title = $_POST['title'];
        $post_stat = $_POST['status'];
        $post_cat = $_POST['post_category'];
        $post_image = $_FILES['image']['name'];
        $post_content = $_POST['content'];
        $post_tags = $_POST['tags'];


        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
            $select_image = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_image)){
                $post_image = $row['post_pic'];

            }
        }


        move_uploaded_file($_FILES['image']['tmp_name'], "../images/$post_image");
        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_cat_id = '{$post_cat}', ";
        $query .= "post_date = now(), ";
        $query .= "post_auth = '{$post_auth}', ";
        $query .= "post_status = '{$post_stat}', ";
        $query .= "post_tag = '{$post_tags}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_pic = '{$post_image}' ";
        $query .= "WHERE post_id = {$the_post_id} ";

        $update_post = mysqli_query($connection, $query);
        confirmQuery($update_post);
        echo "<h1 class='bg-success'>Post Updated: <a href='../post.php?p_id=$the_post_id'>View Post</a> or <a href='posts.php'>View All Posts</a> </h1>";

    }
}

function blog_post_redirect()
{
    if(isset($_GET['p_id'])){
        $the_post_id = $_GET['p_id'];
    }

    global $connection;
    $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
    $post_data = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($post_data)) {
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

        <hr>
    <?php }
}

function viewComments()
{
    if (isset($_GET['source'])) {
        $source = $_GET['source'];
    } else {
        $source = "";
    }
    switch ($source) {
        case 'add_post';
            include "../admin/add_post.php";
            break;

        case 'edit_post';
            include "../admin/edit_post.php";
            break;

        default:
            include "../admin/view_all_comments.php";
            break;

    }
}

function comment_query()
{

    global $connection;
    $query = "SELECT * FROM comments";
    $select_comments = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_comments)) {
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_date = $row['comment_date'];
        $comment_auth= $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];

        echo "<tr>";
        echo "<td>{$comment_id}</td>";
        echo "<td>{$comment_date}</td>";
        echo "<td>{$comment_auth}</td>";

        /*$cat_query = "SELECT * FROM categories WHERE cat_id = {$post_cat}";
        $select_cat_q = mysqli_query($connection, $cat_query);
        while($row = mysqli_fetch_assoc($select_cat_q)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<td>{$cat_title}</td>";
        }*/

        echo "<td>{$comment_email}</td>";
        echo "<td>{$comment_content}</td>";
        echo "<td>{$comment_status}</td>";

        $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
        $post_id_comment_q = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($post_id_comment_q)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
        }
        echo "<td><a href='../admin/comments.php?approve=$comment_id'>Approve</a> </td>";
        echo "<td><a href='../admin/comments.php?unapprove=$comment_id'>Unapprove</a> </td>";

        echo "<td><a href='../admin/comments.php?delete=$comment_id'>Delete</a> </td>";
        echo "<tr>";

    }
}
function submit_comment(){
    global $connection;
    if(isset($_GET['p_id'])){
        $the_post_id = $_GET['p_id'];
    }
    if(isset($_POST['create_comment'])){
        $the_post_id = $_GET['p_id'];
        $comment_author = $_POST['comment_author'];
        $comment_email = $_POST['comment_email'];
        $comment_content = $_POST['comment_content'];
        $query = "INSERT INTO comments(comment_post_id, comment_date, comment_author, comment_email, comment_content, comment_status)";
        $query .= "VALUES ($the_post_id, now(),'{$comment_author}','{$comment_email}', '{$comment_content}', 'unapproved')";
        $createQuery = mysqli_query($connection, $query);
        confirmQuery($createQuery);
        $query_count = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
        $query_count .= "WHERE post_id = {$the_post_id} ";
        $update_comment_count = mysqli_query($connection, $query_count);
        confirmQuery($update_comment_count);


    }
}
function deleteComment(){
    if (isset($_GET['delete'])){
        global $connection;
        $deleting_comment = $_GET['delete'];
        $query = "DELETE FROM comments WHERE comment_id = {$deleting_comment}";
        $delete_query = mysqli_query($connection, $query);
        confirmQuery($delete_query);
        header("Location:../admin/comments.php");
    }
}
function updateCommentsStatus(){
    if (isset($_GET['unapprove'])){
        global $connection;
        $unapprove_comment = $_GET['unapprove'];
        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$unapprove_comment} ";
        $status_query = mysqli_query($connection, $query);
        confirmQuery($status_query);
        header("Location:../admin/comments.php");
    }
    if (isset($_GET['approve'])){
        global $connection;
        $approve_comment = $_GET['approve'];
        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$approve_comment} ";
        $status_query = mysqli_query($connection, $query);
        confirmQuery($status_query);
        header("Location:../admin/comments.php");
    }
}

function showingApprovedComments(){
    global $connection;
    if(isset($_GET['p_id'])){
        $the_post_id = $_GET['p_id'];
    }
    $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
    $query .= "AND comment_status = 'approved' ";
    $query .= "ORDER BY comment_id DESC ";
    $comments_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_array($comments_query)){
        $comment_date = $row['comment_date'];
        $comment_content = $row['comment_content'];
        $comment_author = $row['comment_author'];
       ?>
        <!-- Comment -->
<div class="media">
    <a class="pull-left" href="#">
        <img class="media-object" src="http://placehold.it/64x64" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading"><?php echo $comment_author;?>
            <small><?php echo $comment_date; ?></small>
        </h4>
        <?php echo $comment_content; ?>
    </div>
</div>

   <?php }
    confirmQuery($comments_query);

}

//refractor with camel case, also no closing tag in magento

function viewUsers()
{
    if (isset($_GET['source'])) {
        $source = $_GET['source'];
    } else {
        $source = "";
    }
    switch ($source) {
        case 'add_user';
            include "../admin/add_user.php";
            break;

        case 'edit_user';
            include "../admin/edit_user.php";
            break;

        default:
            include "../admin/view_all_users.php";
            break;

    }
}

function user_query()
{

    global $connection;
    $query = "SELECT * FROM users";
    $select_users = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_firstName = $row['user_firstName'];
        $user_lastName = $row['user_lastName'];
        $user_role = $row['user_role'];
        $user_email = $row['user_email'];


        echo "<tr>";
        echo "<td>{$user_id}</td>";
        echo "<td>{$user_name}</td>";
        echo "<td>{$user_firstName}</td>";


        echo "<td>{$user_lastName}</td>";
        echo "<td>{$user_email}</td>";
        echo "<td>{$user_role}</td>";

        /*
        $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
        $post_id_comment_q = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($post_id_comment_q)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
        }
        echo "<td><a href='../admin/comments.php?approve=$comment_id'>Approve</a> </td>";
        echo "<td><a href='../admin/comments.php?unapprove=$comment_id'>Unapprove</a> </td>";

        echo "<td><a href='../admin/comments.php?delete=$comment_id'>Delete</a> </td>";
        echo "<tr>";
        */
        echo "<td><a href='../admin/users.php?source=edit_user&edit_user=$user_id'>Edit</a> </td>";
        echo "<td><a href='../admin/users.php?delete=$user_id'>Delete</a> </td>";

        echo "<td><a href='../admin/users.php?change_to_admin=$user_id'>Admin</a> </td>";
        echo "<td><a href='../admin/users.php?change_to_sub=$user_id'>Subscriber</a> </td>";
        echo "<tr>";

    }
}
function new_user()
{ global $connection;
    if (isset($_POST['create_user'])) {
        $user_firstName = $_POST['firstName'];
        $user_lastName = $_POST['lastName'];
        $user_role = $_POST['user_role'];
        $user_email = $_POST['email'];
        $user_username = $_POST['username'];
        $user_password = $_POST['password'];
        $user_image = $_FILES['user_image']['name'];

        $query = "INSERT INTO users(user_firstName, user_lastName, user_role, user_email, user_name, user_password, user_image)";
        $query .= "VALUES('{$user_firstName}','{$user_lastName}','{$user_role}','{$user_email}','{$user_username}', '{$user_password}', '{$user_image}')";
        $new_user_query = mysqli_query($connection, $query);
        confirmQuery($new_user_query);
        echo "User Created: ". " ". "<a href='users.php'>View All Users</a>";


        /*
        if (isset($_FILES['image']['tmp_name'])) {

            $post_image_temp = $_FILES['image']['tmp_name'];

            move_uploaded_file($_FILES['image']['tmp_name'], "../images/$post_image");
            if (!move_uploaded_file($post_image_temp, "../images/$post_image")) {
                echo "unable to upload";
            }
        }
        */

    }
}
function deleteUser(){
    if (isset($_GET['delete'])){
        global $connection;
        $deleting_user= $_GET['delete'];
        $query = "DELETE FROM users WHERE user_id = {$deleting_user}";
        $delete_query = mysqli_query($connection, $query);
        confirmQuery($delete_query);
        header("Location:users.php");
    }
}
function changeUser(){
    if (isset($_GET['change_to_admin'])){
        global $connection;
        $changing_user= $_GET['change_to_admin'];
        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$changing_user}";
        $change_query = mysqli_query($connection, $query);
        confirmQuery($change_query);
        header("Location:users.php");
    }
    if (isset($_GET['change_to_sub'])){
        global $connection;
        $changing_user= $_GET['change_to_sub'];
        $query = "UPDATE users SET user_role = 'user' WHERE user_id = {$changing_user}";
        $change_query = mysqli_query($connection, $query);
        confirmQuery($change_query);
        header("Location:users.php");
    }
}



function edit_user($data)
{
    global $connection;

    if (isset($_GET['edit_user'])) {
        $editing_user = $_GET['edit_user'];
        $query = "SELECT * FROM users WHERE user_id = {$editing_user}";
        $select_users = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_users)) {
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_firstName = $row['user_firstName'];
            $user_lastName = $row['user_lastName'];
            $user_role = $row['user_role'];
            $user_email = $row['user_email'];
            $user_pass = $row['user_password'];
            $user_image = $row['user_image'];


            if ($data == 'first') {
                return $user_firstName;
            } elseif ($data == 'last') {
                return $user_lastName;
            } elseif ($data == 'role') {
                return $user_role;
            }  elseif ($data == 'email') {
                return $user_email;
            } elseif (($data == 'pass')){
                return $user_pass;
            } elseif ($data == 'img') {
                return $user_image;
            } elseif ($data == 'username') {
                return $user_name;
            } else{
                return "no data retrieved";
            }
        }


    }
}
function submitEditUser()
{
    global $connection;
    if(isset($_GET['edit_user'])){
        $the_user_id = $_GET['edit_user'];
    }

    if (isset($_POST['edit_user'])) {
        $user_first = $_POST['firstName'];
        $user_last = $_POST['lastName'];
        $user_role = $_POST['user_role'];
        $user_email = $_POST['email'];
        $user_name = $_POST['username'];
        $user_pass = $_POST['password'];
        //$user_image = $_POST['user_image'];


        $query = "UPDATE users SET ";
        $query .= "user_firstName = '{$user_first}', ";
        $query .= "user_lastName = '{$user_last}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_name = '{$user_name}', ";
        $query .= "user_password = '{$user_pass}' ";
        $query .= "WHERE user_id = '{$the_user_id}' ";
        $update_user = mysqli_query($connection, $query);
        confirmQuery($update_user);
        header("Location:users.php");


    }
}
function login_query()
{   session_start();
    if (isset($_POST['login'])) {
        global $connection;
        $username = $_POST['username'];
        $password = $_POST['password'];
        $protect_username = mysqli_real_escape_string($connection, $username);
        $protect_password = mysqli_real_escape_string($connection, $password);

        $query = "SELECT * FROM users WHERE user_name = '{$protect_username}' ";
        $select_user_query = mysqli_query($connection, $query);
        confirmQuery($select_user_query);
        while ($row = mysqli_fetch_assoc($select_user_query)) {
            $db_id = $row['user_id'];
            $db_username = $row['user_name'];
            $db_pass = $row['user_password'];
            $db_firstname = $row['user_firstName'];
            $db_lastname = $row['user_lastName'];
            $db_role = $row['user_role'];
            $db_email = $row['user_email'];


        }
        //encrypt pass
        $query = "SELECT user_randSalt FROM users";
        $randSalt = mysqli_query($connection, $query);
        $salt_q= mysqli_fetch_assoc($randSalt);
        $salt_Pass = $salt_q['user_randSalt'];
        $db_pass_upd = crypt($protect_password, $salt_Pass);
        if ($protect_username == $db_username && $db_pass_upd == $db_pass && $db_role == 'admin' || $db_role == 'admin(current role)' ){
            $_SESSION['username'] = $db_username;
            $_SESSION['firstName'] = $db_firstname;
            $_SESSION['lastName'] = $db_lastname;
            $_SESSION['user_role'] = $db_role;
            $_SESSION['user_password'] = $db_pass_upd;

            header("Location: ../admin/index.php");

        } else {

         echo $db_pass;
         echo "<h1>$db_pass_upd</h1>";
         echo "<h2>$protect_password</h2>";

        }
    }
}
function adminButtonValidation()
{
    login_query();
    if($_SESSION['username'] != null){
       echo "<a class='navbar-brand' href='admin/index.php'>Admin</a>";

    }

}
function checkForSession($data){
    global $connection;
    if(isset($_SESSION['username'])){
        global $username;
        $username = $_SESSION['username'];
        $query = "SELECT * FROM users WHERE user_name = '{$username}' ";
        $select_user_prof = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_user_prof)){
            $user_name = $row['user_name'];
            $user_firstName = $row['user_firstName'];
            $user_lastName = $row['user_lastName'];
            $user_role = $row['user_role'];
            $user_email = $row['user_email'];
            $user_pass = $row['user_password'];
            //$user_image = $row['user_image'];

            if ($data == 'first') {
                return $user_firstName;
            } elseif ($data == 'last') {
                return $user_lastName;
            } elseif ($data == 'role') {
                return $user_role;
            }  elseif ($data == 'email') {
                return $user_email;
            } elseif (($data == 'pass')){
                return $user_pass;
            } elseif ($data == 'username') {
                return $user_name;
            } else{
                return "no data retrieved";
            }
        }
        confirmQuery($select_user_prof);

    }
}
function submitEditProf()
{
    global $connection;
    global $username;
        if (isset($_POST['edit_prof'])) {
            $user_first1 = $_POST['firstNamep'];
            $user_last1 = $_POST['lastNamep'];
            $user_role1 = $_POST['user_rolep'];
            $user_email1 = $_POST['emailp'];
            $user_name1 = $_POST['usernamep'];
            $user_pass1 = $_POST['passwordp'];
            //$user_image = $_POST['user_image'];


            $query = "UPDATE users SET ";
            $query .= "user_firstName = '{$user_first1}', ";
            $query .= "user_lastName = '{$user_last1}', ";
            $query .= "user_role = '{$user_role1}', ";
            $query .= "user_email = '{$user_email1}', ";
            $query .= "user_name = '{$user_name1}', ";
            $query .= "user_password = '{$user_pass1}' ";
            $query .= "WHERE user_name = '{$username}' ";
            $update_user = mysqli_query($connection, $query);
            confirmQuery($update_user);
            header("Location: users.php");


        }
    }
function modifyWidgetPosts(){
    global $connection;
    $query = "SELECT * FROM posts ";
    $checking_query = mysqli_query($connection, $query);
    $post_count = mysqli_num_rows($checking_query);
    echo $post_count;
}
function modifyWidgetComments()
{
    global $connection;
    $query = "SELECT * FROM comments ";
    $checking_query = mysqli_query($connection, $query);
    $comment_count = mysqli_num_rows($checking_query);
    echo $comment_count;
}
function modifyWidgetUsers()
{
    global $connection;
    $query = "SELECT * FROM users ";
    $checking_query = mysqli_query($connection, $query);
    $users_count = mysqli_num_rows($checking_query);
    echo $users_count;
}
function modifyWidgetCategories()
{
    global $connection;
    $query = "SELECT * FROM categories ";
    $checking_query = mysqli_query($connection, $query);
    $cat_count = mysqli_num_rows($checking_query);
    echo $cat_count;
}

function statusChooser(){
    global $connection;
    $query = "SELECT * FROM posts ";
    $select_cats = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_cats)){
        $post_stat = $row['post_status'];
        if($post_stat != 'published'){
            echo "<option value='published'>Publish</option>";
        } else {
            echo "<option value = 'draft'>Draft</option>";
        }

    }

}
function checkBoxArray(){
    global $connection;
    if(isset($_POST['checkBoxArray'])){
        foreach ($_POST['checkBoxArray'] as $checkBoxId) {
             $bulkOptions = $_POST['bulkOptions'];
             switch ($bulkOptions){
                 case 'published':
                     $query = "UPDATE posts SET post_status = '{$bulkOptions}' WHERE post_id = {$checkBoxId} ";
                     $new_query = mysqli_query($connection, $query);
                     confirmQuery($new_query);
                     header("Location: posts.php");
                     break;
                     case 'draft':
                         $query = "UPDATE posts SET post_status = '{$bulkOptions}' WHERE post_id = {$checkBoxId} ";
                         $new_query = mysqli_query($connection, $query);
                         confirmQuery($new_query);
                         header("Location: posts.php");
                         break;

                         case 'delete':
                            $query = "DELETE FROM posts WHERE post_id = {$checkBoxId} ";
                            $new_query = mysqli_query($connection, $query);
                            confirmQuery($new_query);
                            header("Location: posts.php");
                            break;
                     break;
             }

        }
    }
}

function signUp()
{

    global $connection;
    if (isset($_POST['register'])) {
        $user_email = $_POST['email'];
        $user_username = $_POST['username'];
        $user_password = $_POST['password'];
        if (!empty($user_username) && !empty($user_password) && !empty($user_email)) {
            $userEmail = mysqli_real_escape_string($connection, $user_email);
            $userName = mysqli_real_escape_string($connection, $user_username);
            $userPassword = mysqli_real_escape_string($connection, $user_password);

            //encrypt pass
            $query = "SELECT user_randSalt FROM users";
            $randSalt = mysqli_query($connection, $query);
            $salt_q= mysqli_fetch_assoc($randSalt);
            $salt_Pass = $salt_q['user_randSalt'];




            $query = "INSERT INTO users(user_email, user_name, user_password, user_firstName, user_lastName, user_role, user_image)";
            $query .= "VALUES('{$userEmail}','{$userName}', '{$userPassword}', 'default_first', 'default_last', 'admin', 'default_img')";
            $new_user_query = mysqli_query($connection, $query);
            confirmQuery($new_user_query);
            echo "Profile Created: Please login with new credentials and complete your profile " . " " . "<a href='index.php'>Home</a>";


        }
        else{
          echo "Fields cannot be empty";
        }
    }
}

?>




