<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Image</th>
            <th>Role</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        
        $query = "SELECT * FROM users";
        $selected_posts = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($selected_posts)){
            echo "<tr>";

            $user_id = $row['user_id'];
            echo "<td>{$user_id}</td>";
            
            $user_username = $row['user_username'];
            echo "<td>{$user_username}</td>";
            
            $user_firstname = $row['user_firstname'];
            echo "<td>{$user_firstname}</td>";
            
            $user_lastname = $row['user_lastname'];
            echo "<td>{$user_lastname}</td>";
            
            $user_email = $row['user_email'];
            echo "<td>{$user_email}</td>";

            $user_image = $row['user_image'];
            echo "<td><img class='img-responsive' src='../images/$user_image'></td>";
            
            $user_role = $row['user_role'];
            echo "<td>{$user_role}</td>";
            
            echo "<td><a href='users.php?source=edit_user&user_id={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";

            echo "</tr>";
            }
        ?>
        </tr>
    </tbody>
</table>

<?php
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $query = "DELETE FROM users WHERE user_id = {$id}";
        $delete_query = mysqli_query($connection, $query);

        header("Location: users.php");
    }
?>