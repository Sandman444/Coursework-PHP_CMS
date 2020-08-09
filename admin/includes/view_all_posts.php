<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Category</th>
            <th>Title</th>
            <th>Author</th>
            <th>Date</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        
        $query = "SELECT * FROM posts";
        $selected_posts = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($selected_posts)){
            echo "<tr>";

            $post_id = $row['post_id'];
            echo "<td>{$post_id}</td>";
            
            $post_catagory_id = $row['post_catagory_id'];
            insertCatagory($post_catagory_id);
            
            $post_title = $row['post_title'];
            echo "<td>{$post_title}</td>";
            
            $post_author = $row['post_author'];
            echo "<td>{$post_author}</td>";
            
            $post_date = $row['post_date'];
            echo "<td>{$post_date}</td>";
            
            $post_image = $row['post_image'];
            echo "<td><img class='img-responsive' src='../images/$post_image'></td>";
            
            $post_tags = $row['post_tags'];
            echo "<td>{$post_tags}</td>";
            
            $post_comment_count = $row['post_comment_count'];
            echo "<td>{$post_comment_count}</td>";

            $post_status = $row['post_status'];
            echo "<td>{$post_status}</td>";
            
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
            echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";

            echo "</tr>";
            }
        ?>
        </tr>
    </tbody>
</table>

<?php
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id = {$id}";
        $delete_query = mysqli_query($connection, $query);

        header("Location: posts.php");
    }
?>