<?php
    if(isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];
    }

    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $select_user_by_id = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_user_by_id)){
        $user_id = $row['user_id'];
        $user_username = $row['user_username'];
        $user_password = $row['user_password'];  
        $user_firstname = $row['user_firstname'];                   
        $user_lastname = $row['user_lastname'];                
        $user_image = $row['user_image'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
    }

    if(isset($_POST['update_user'])){
        $user_username = $_POST['user_username'];
        $user_password = $_POST['user_password'];  
        $user_firstname = $_POST['user_firstname'];                   
        $user_lastname = $_POST['user_lastname'];          
                
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];

        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];

        move_uploaded_file($user_image_temp, "../images/$user_image");
        if(empty($user_image)){
            $query = "SELECT * FROM users WHERE user_id = $user_id";
            $selected_image = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_array($selected_image)){
                $user_image = $row['user_image'];
            }
        }


        $query = "UPDATE users SET ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_username = '{$user_username}', ";
        $query .= "user_password = '{$user_password}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_image = '{$user_image}', ";
        $query .= "user_role = '{$user_role}' ";
        $query .= "WHERE user_id = {$user_id}";
        //echo $query;
        $update_user = mysqli_query($connection, $query);

        if(!$update_user){
            die('QUERY FAILED ' . mysqli_error($connection));
        }

        header("Refresh:0; url=users.php");
    }
?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_username">Username</label>
        <input value="<?php echo $user_username ?>" type="text" name="user_username" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input value="<?php echo $user_password ?>" type="password" name="user_password" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input value="<?php echo $user_firstname ?>" type="text" name="user_firstname" class="form-control">    
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input value="<?php echo $user_lastname ?>" type="text" name="user_lastname" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_email">User Email</label>
        <input value="<?php echo $user_email ?>" type="text" name="user_email" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_image">Avatar Image</label>
        <img src="../images/<?php echo $user_image ?>" alt="Current Image" width="100">
        <input type="file" name="user_image" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_role">User Role</label>
        <select name="user_role" id="user_role_select">
            <option value=<?php echo $user_role ?> selected>
                <?php echo $user_role ?> 
            </option>
            <?php 
                if($user_role == 'admin'){
                    echo "<option value='subscriber'>subscriber</option>";
                }
                if($user_role == 'subscriber'){
                    echo "<option value='admin'>admin</option>";
                }
                /*$query = "SELECT user_role FROM users WHERE user_id = $user_id";
                $selected_roles_id = mysqli_query($connection, $query);
                //confirmQuery($selected_roles_id);

                while($row = mysqli_fetch_assoc($selected_roles_id)){
                    $role = $row['user_role'];
                    $cat_title = $row['cat_title'];
                    if($cat_id === $user_firstname){
                        echo "<option value='{$cat_id}' selected>{$cat_title}</option>";
                    }else{
                        echo "<option value='{$cat_id}'>{$cat_title}</option>";
                    }
                }*/
            ?>    
        </select>
    </div>

    <div class="form-group">
        <input type="submit" name="update_user" class="btn btn-primary" value="Update User">
    </div>
</form>