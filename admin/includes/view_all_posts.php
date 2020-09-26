<?php
if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $postValueId){
        $bulk_options = $_POST['bulk_options'];
        
        $query = "";
        switch($bulk_options){
            case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                break;
            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                break;
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
                break;
        }
        $update_posts = mysqli_query($connection, $query);
    }
}
?>

<form action="" method="post">
    <div id=bulkOptionsContainer class="col-xs-4">
        <select class="form-control" name="bulk_options" id="">
            <option value="">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
        </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" value="Apply" class="btn btn-success">
        <a href="add_post.php" class="btn btn-primary">Add New</a>
    </div>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th><input type="checkbox" name="" id="selectAllBoxes"></th>
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
                $post_id = $row['post_id'];
                $post_catagory_id = $row['post_catagory_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_status = $row['post_status'];

                echo "<tr>";
                ?>
                <td>
                    <input 
                        name='checkBoxArray[]' 
                        type='checkbox' 
                        class='checkBoxes'
                        value='<?php echo $post_id; ?>'
                    >
                </td>
                <?php
                
                echo "<td>{$post_id}</td>";
                insertCatagory($post_catagory_id);               
                echo "<td>{$post_title}</td>";               
                echo "<td>{$post_author}</td>";
                echo "<td>{$post_date}</td>";
                echo "<td><img class='img-responsive' src='../images/$post_image'></td>";
                echo "<td>{$post_tags}</td>";
                echo "<td>{$post_comment_count}</td>";
                echo "<td>{$post_status}</td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";

                echo "</tr>";
                }
            ?>
            </tr>
        </tbody>
    </table>
</form>

<?php
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id = {$id}";
        $delete_query = mysqli_query($connection, $query);

        header("Location: posts.php");
    }
?>