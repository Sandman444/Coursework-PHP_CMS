<?php include "includes/header.php"?>
<?php include "includes/db.php"?>
   
<!-- Navigation -->
<?php include "includes/nav.php"?>
   
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php 
                if(isset($_GET['p_id'])){
                    $post_id = $_GET['p_id'];
                }

                $query = "SELECT * FROM posts WHERE post_id = $post_id";
                $selected_posts = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($selected_posts)){
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_comment_count = $row['post_comment_count'];

                    ?>

                    <h1 class="page-header">
                        Page Heading
                        <small>Secondary Text</small>
                    </h1>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="#"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt=""> 
                    <hr>
                    <p><?php echo $post_content ?></p>
                    
                    <hr>
                <?php } ?>
                
                <!-- Blog Comment Section -->
                <?php 
                    if(isset($_POST['create_comment'])){
                        $post_id = $_GET['p_id'];

                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];
                        
                        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                            //submit comment to comments database
                            $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_date, comment_status) ";
                            $query .= "VALUES ($post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', now(), 'unapproved')";

                            $submitted_comment = mysqli_query($connection, $query);
                            if(!$submitted_comment){
                                die('QUERY FAILED' . mysqli_error()); 
                            }

                            //update comment count on post database
                            $post_comment_count++;
                            $query = "UPDATE posts SET post_comment_count = $post_comment_count WHERE post_id = $post_id";

                            $updated_comment_count = mysqli_query($connection, $query);
                            if(!$updated_comment_count){
                                die('QUERY FAILED' . mysqli_error()); 
                            }
                        }else{
                            echo "<script>alert('Fields can not be empty')</script>";
                        }
                        

                        
                    }
                ?>

                <!-- Comments Form -->
                <div class="well" id="comment-form">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <label for="comment_author">Author</label>
                            <input type="text" class="form-control" name="comment_author"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input type="email" class="form-control" name="comment_email"></textarea>
                        </div>
                        <div class="form-group">
                            <textarea name="comment_content" rows="3" class="form-control"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">
                            Submit
                        </button>
                    </form>
                </div>

                 <!-- Comments -->
                <?php 
                    if(isset($_GET['p_id'])){
                        $post_id = $_GET['p_id'];
                    }
    
                    $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                    $selected_comments = mysqli_query($connection, $query);

                    while($comment = mysqli_fetch_assoc($selected_comments)){
                        $comment_status = $comment['comment_status'];
                        if($comment_status === 'approved'){
                            $comment_author = $comment['comment_author'];
                            $comment_content = $comment['comment_content'];
                            $comment_date = $comment['comment_date'];
                            $comment_content = $comment['comment_content'];
                ?>
                            <div class="media">
                                <a href="#" class="pull-left">
                                    <img src="http://placehold.it/64x64" alt="" class="media-object"}>
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"> 
                                        <?php echo $comment_author ?>
                                        <small><?php echo $comment_date ?></small>
                                    </h4>
                                    <?php echo $comment_content ?>
                                </div>
                            </div>
                <?php 
                        }      
                     } 
                ?>     
        
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"?>

        </div>
        <!-- /.row -->

        <hr>
<?php 
include "includes/footer.php"
?>