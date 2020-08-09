<?php include "includes/header.php" ?>

<?php 
if(isset($_SESSION['username'])){
   $username = $_SESSION['username'];

   $query = "SELECT * FROM users WHERE user_username = '{$username}'";
   $select_user_profile_query = mysqli_query($connection, $query);

   while($row = mysqli_fetch_array($select_user_profile_query)){
    $user_id = $row['user_id'];
    $user_username = $row['user_username'];
    $user_password = $row['user_password'];  
    $user_firstname = $row['user_firstname'];                   
    $user_lastname = $row['user_lastname'];                
    $user_image = $row['user_image'];
    $user_email = $row['user_email'];
    $user_role = $row['user_role'];
   }
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
    $query .= "WHERE user_username = '{$username}'";
    //echo $query;
    $update_user = mysqli_query($connection, $query);

    if(!$update_user){
        die('QUERY FAILED ' . mysqli_error($connection));
    }

    header("Refresh:0; url=profile.php");
}
?>
    <div id="wrapper">
        <?php include "includes/nav.php" ?>
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-xs-12">
                       <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>

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
                                    ?>    
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="update_user" class="btn btn-primary" value="Update Profile">
                            </div>
                        </form>
                       
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php include "includes/footer.php" ?> 