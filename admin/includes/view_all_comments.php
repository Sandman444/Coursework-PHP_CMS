<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Disapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        
        $query = "SELECT * FROM comments";
        $selected_comments = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($selected_comments)){
            echo "<tr>";

            $comment_id = $row['comment_id'];
            echo "<td>{$comment_id}</td>";
            
            $comment_author = $row['comment_author'];
            echo "<td>{$comment_author}</td>";
            
            $comment_content = $row['comment_content'];
            echo "<td>{$comment_content}</td>";
            
            $comment_email = $row['comment_email'];
            echo "<td>{$comment_email}</td>";
             
            $comment_status = $row['comment_status'];
            echo "<td>{$comment_status}</td>";
            
            $comment_post_id = $row['comment_post_id'];
            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            $selected_post = mysqli_query($connection, $query);
            while($post = mysqli_fetch_assoc($selected_post)){
                $post_id = $post['post_id'];
                $post_title = $post['post_title'];
                echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</td>";
            }
        
            $comment_date = $row['comment_date'];
            echo "<td>{$comment_date}</td>";
            
            echo "<td><a href='comments.php?approve={$comment_id}'>
                <i class='fa fa-check fa-lg text-success' aria-hidden='true'></i>
            </a></td>";
            echo "<td><a href='comments.php?unapprove={$comment_id}'>
                <i class='fa fa-times fa-lg text-danger' aria-hidden='true'></i>
            </a></td>";

            echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";

            echo "</tr>";
            }
        ?>
        </tr>
    </tbody>
</table>

<?php
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $query = "DELETE FROM comments WHERE comment_id = {$id}";
        $delete_query = mysqli_query($connection, $query);

        header("Location: comments.php");
    }

    if(isset($_GET['approve'])){
        $id = $_GET['approve'];

        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$id}";
        $approve_comment = mysqli_query($connection, $query);

        header("Location: comments.php");
    }

    if(isset($_GET['unapprove'])){
        $id = $_GET['unapprove'];

        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$id}";
        $approve_comment = mysqli_query($connection, $query);

        header("Location: comments.php");
    }
?>