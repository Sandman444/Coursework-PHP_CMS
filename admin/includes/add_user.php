<?php
    if(isset($_POST['create_user'])){
        $user_username = $_POST['user_username'];
        $user_password = $_POST['user_password'];  

        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
                
        $user_email = $_POST['user_email'];          
                
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];

        $user_role = $_POST['user_role'];
        $salt = 0; //$_POST['randSalt'];

        move_uploaded_file($user_image_temp, "../images/$user_image");
        $query = "INSERT INTO users(user_username, user_password, user_firstname, user_lastname, 
        user_email, user_image, user_role, randSalt)";
        $query .= "VALUES('{$user_username}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_image}', '{$user_role}', '{$salt}')";
        $create_user_query = mysqli_query($connection, $query);

        confirm($create_user_query);

        header("Refresh:0; url=users.php");
    }
?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_username">Username</label>
        <input type="text" name="user_username" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" name="user_password" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" name="user_firstname" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" name="user_lastname" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" name="user_email" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_image">User Avatar</label>
        <input type="file" name="user_image" class="form-control">
    </div>

    <div class="form-group">
        <label for="user_role">User's Role</label>
        <select name="user_role" id="">
            <option value="admin">Admin</option>
            <option value="subscriber" selected>Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" name="create_user" class="btn btn-primary" value="Add User">
    </div>
</form>