<?php include_once "../includes/functions.php" ?>
<table class="table table-bordered table-hover">
    <?php comment_query(); updateCommentsStatus();?>



    <thead>
    <tr>
        <th>Id</th>
        <th>Date</th>
        <th>Author</th>
        <th>Email</th>
        <th>Content</th>
        <th>Status</th>

        <th>In Response To:<?php deleteComment(); ?></th>

        <th>Approve</th>
        <th>Unapprove</th>
        <th>Delete</th>

    </tr>
    </thead>
    <tbody>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
</table>


