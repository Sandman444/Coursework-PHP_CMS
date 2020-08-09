<?php
    if(isset($_POST['create_post'])){
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];  
        $post_catagory_id = $_POST['post_catagory_id'];
        echo $post_catagory_id;                    
        $post_status = $_POST['post_status'];          
                
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');            
        $post_comment_count = 0;

        move_uploaded_file($post_image_temp, "../images/$post_image");
        $query = "INSERT INTO posts(post_catagory_id, post_title, post_author, post_date, 
        post_image, post_content, post_tags, post_comment_count, post_status)";
        $query .= "VALUES('{$post_catagory_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}')";
        $create_post_query = mysqli_query($connection, $query);

        confirm($create_post_query);

        header("Refresh:0; url=posts.php");
    }
?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_catagory_id">Post Category</label>
        <select name="post_catagory_id" id="post_catagory">
            <?php 
                $query = "SELECT * FROM catagories";
                $selected_catagories_id = mysqli_query($connection, $query);
                //confirmQuery($selected_catagories_id);

                while($row = mysqli_fetch_assoc($selected_catagories_id)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            ?>    
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" name="post_author" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" name="post_status" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="" cols="30" rows="10" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" name="create_post" class="btn btn-primary" value="Publish Post">
    </div>
</form>