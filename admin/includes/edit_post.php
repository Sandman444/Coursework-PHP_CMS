<?php
    if(isset($_GET['p_id'])){
        $p_id = $_GET['p_id'];
    }

    $query = "SELECT * FROM posts WHERE post_id = $p_id";
    $select_posts_by_id = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_posts_by_id)){

        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];  
        $post_catagory_id = $row['post_catagory_id'];                   
        $post_status = $row['post_status'];                
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];
        $post_date = $row['post_date'];         
        $post_comment_count = $row['post_comment_count'];
    }

    if(isset($_POST['update_post'])){
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];  
        $post_catagory_id = $_POST['post_catagory_id'];                   
        $post_status = $_POST['post_status'];          
                
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];

        move_uploaded_file($post_image_temp, "../images/$post_image");
        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = $p_id";
            $selected_image = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_array($selected_image)){
                $post_image = $row['post_image'];
            }
        }


        $query = "UPDATE posts SET ";
        $query .= "post_catagory_id = '{$post_catagory_id}', ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_date = now(), ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_image = '{$post_image}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_status = '{$post_status}' ";
        $query .= "WHERE post_id = {$p_id}";
        //echo $query;
        $update_post = mysqli_query($connection, $query);

        if(!$update_post){
            die('QUERY FAILED' . mysqli_error($connection));
        }

        header("Refresh:0; url=posts.php");
    }
?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo $post_title ?>" type="text" name="post_title" class="form-control">
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
                    if($cat_id === $post_catagory_id){
                        echo "<option value='{$cat_id}' selected>{$cat_title}</option>";
                    }else{
                        echo "<option value='{$cat_id}'>{$cat_title}</option>";
                    }
                }
            ?>    
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input value="<?php echo $post_author ?>" type="text" name="post_author" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input value="<?php echo $post_status ?>" type="text" name="post_status" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <img src="../images/<?php echo $post_image ?>" alt="Current Image" width="100">
        <input type="file" name="post_image" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags ?>" type="text" name="post_tags" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="" cols="30" rows="10" class="form-control"><?php echo $post_content ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" name="update_post" class="btn btn-primary" value="Update Post">
    </div>
</form>