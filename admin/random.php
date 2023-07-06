<?php
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
if (!move_uploaded_file($post_image_temp, "../images/$post_image")) {
echo "unable to upload";
}
}
$query = "INSERT INTO posts(post_id, post_cat_id, post_title, post_auth, post_date, post_pic, post_content,post_tag,post_comment_count,post_status) ";
$query .= "VALUES({$post_id},'{$post_category}','{$post_title}','{$post_author}', now(),'{$post_image}','{$postContent}','{$postTags}',{$postCommentCount} ,'{$post_status}' )";
$createPost = mysqli_query($connection, $query);
confirmQuery($createPost);
}
}