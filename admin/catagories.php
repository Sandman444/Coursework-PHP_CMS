<?php include "includes/header.php" ?>
    <div id="wrapper">
        <?php include "includes/nav.php" ?>
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Subheading</small>
                        </h1>
                        <div class="col-xs-6">

                            <?php insert_catagories(); ?>

                            <form action="" method="post">
                            <label for="cat_title">Add Catagory</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                                </div>
                            </form>
                            <?php //UPDATE AND INCLUDE QUERY
                                if(isset($_GET['edit'])){
                                    $cat_id = $_GET['edit'];

                                    include "includes/edit_catagories.php";
                                }
                            ?>

                            <!-- /.Catagory Form  -->     
                        </div>

                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Catagory Title</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php findAllCatagories() ?>
                                    <?php deleteCatagories() ?>
                                </tbody>
                            </table>
                        </div>
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