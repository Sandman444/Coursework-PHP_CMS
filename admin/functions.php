<?php
function confirm($result){
    global $connection;

    if(!$result){
        die('QUERY FAILED' . mysqli_error($connection));
    }
}

function insert_catagories() {
    global $connection;

    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)){
            echo "This field should not be empty";
        }else{
            $query = "INSERT INTO catagories(cat_title) ";
            $query .= "VALUE('{$cat_title}')";

            $create_category_query = mysqli_query($connection, $query);

            confirm($create_category_query);
        }
    }
}

function insertCatagory($cat_id) {
    global $connection;

    $query = "SELECT * FROM catagories WHERE cat_id = {$cat_id}";

    $selected_catagories = mysqli_query($connection, $query);

    while($row = mysqli_fetch_array($selected_catagories)){
        $cat_title = $row['cat_title'];
        echo "<td>{$cat_title}</td>";
    }
}

function findAllCatagories() {
    global $connection;

    $query = "SELECT * FROM catagories";
    $selected_catagories = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($selected_catagories)){
        $table_row = "<tr>";
        $cat_id = $row['cat_id'];
        $table_row .= "<td>{$cat_id}</td>";

        $cat_title = $row['cat_title'];
        $table_row .= "<td>{$cat_title}</td>";

        $table_row .= "<td><a href='catagories.php?delete={$cat_id}'>Delete</a></td>";
        $table_row .= "<td><a href='catagories.php?edit={$cat_id}'>Edit</a></td>";
        $table_row .= "</tr>";
        echo $table_row;    
    }
}

function deleteCatagories() {
    global $connection;

    if(isset($_GET['delete'])){
        $del_cat_id = $_GET['delete'];
        $query = "DELETE FROM catagories WHERE cat_id = {$del_cat_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: catagories.php");
    }
}
?>