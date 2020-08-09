<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Edit Catagory</label>
        <?php 
            if(isset($_GET['edit'])){
                $cat_id = $_GET['edit'];
                $query = "SELECT * FROM catagories WHERE cat_id = $cat_id";
                $selected_catagories_id = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($selected_catagories_id)){
                    $cat_id =$row['cat_id'];
                    $cat_title = $row['cat_title'];
        ?>

            <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" class="form-control" type="text" name="cat_title">

        <?php  
                }
            } 

            if(isset($_POST['update_catagory'])){
                $update_cat_title = $_POST['cat_title'];
                $query = "UPDATE catagories SET cat_title = '{$update_cat_title}' WHERE cat_id = '{$cat_id}' ";
                $update_query = mysqli_query($connection, $query);
                if(!$update_query){
                    die("QUERY FAILED" . mysqli_error($connection));
                }
            }
        ?>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_catagory" value="Update">
    </div>
</form>