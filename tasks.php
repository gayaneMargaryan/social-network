<?php

session_start();
include ("config/config.php");

$userId = $_SESSION["userId"];
if(!$userId){
    header("Location:login.php");
    die;
}

include("layout/header.php");
$sql = "SELECT * FROM `user` WHERE id=$userId";
$result = mysqli_query($conn,$sql);
$userData = mysqli_fetch_assoc($result);



?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="mainbody container-fluid">
    <div class="row">
        <div class="navbar-wrapper">
            <div class="container-fluid">
                <div class="navbar navbar-default navbar-static-top" role="navigation">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="profile.php" style="margin-right:-8px; margin-top:-5px;">
                                <img alt="Brand" src="https://lut.im/7trApsDX08/GeilMRp1FIm4f2p7.png" width="30px" height="30px">
                            </a>
                            <a class="navbar-brand" href="profile.php">Project</a>
                        </div>
                        <div class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <li><a href="gallery.php">Gallery</a></li>
                                <li><a href="tasks.php">Tasks</a></li>
                                <!--                                    <li><a href="#"><i class="fa fa-bell-o fa-lg" aria-hidden="true"></i></a></li>-->
                                <!--                                    <li><a href="#"><i class="fa fa-envelope-o fa-lg" aria-hidden="true"></i></a></li>-->
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li> <a href="logout.php">Sign out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="padding-top:50px;"> </div>
        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="media">
                        <div align="center">

                            <?php
                            if(!$userData["avatar"]) {

                                if ($userData["gender"] == "MALE") {
                                    $avatar = "images/male.png";
                                } elseif ($userData["gender"] == "FEMALE") {
                                    $avatar = "images/female.png";
                                } else {
                                    $avatar = "images/other.png";
                                }
                            }else{
                                $avatar = "uploads/".$userData['avatar'];
                            }
                            ?>

                            <img class="thumbnail img-responsive" src="<?php echo $avatar; ?>" width="300px" height="300px">
                        </div>
                        <form action="uploadAvatar.php" method="post" enctype="multipart/form-data">
                            <input id="avatar" type="file" name="avatar">
                            <button name="upload" class="hide" id="saveBtn">Save image</button>
                        </form>
                        <div class="media-body">
                            <hr>
                            <h3><strong><?php echo $userData['name']." ".$userData['lastname'];?> </strong></h3>
                            <hr>
                            <p> Email: <?php echo $userData['email'];?></p>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

            <form action="taskCreation.php" method="POST">
                <p class="form-group" style="margin: 10px 0;">
                    <input class="form-control" type="text" name="title">
                </p>
                <p class="form-group">
                    <textarea class="form-control" name="description" id=""  rows="5"></textarea>
                </p>
                <p class="form-group">
                    <input class="btn-success" type="submit" name="submit" value="Add">
                </p>
            </form>
            <?php
                $tasks = $sql = "SELECT * FROM `tasks` WHERE user_id=$userId";
                $result = mysqli_query($conn,$sql);
            ?>
            <div id="pageData">
                <table class="table table-stripped">
                    <tr>
                        <th>#</th>
                        <th class="table_title_creat">Title</th>
                        <th>Description</th>
                        <th class="table_title_creat">Created</th>
                        <th></th>
                        <th></th
                    </tr>
                    <?php
                    $i = 1;
                    while ($task = mysqli_fetch_assoc($result)){
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $task["title"] ?></td>
                            <td><?php echo $task["description"] ?></td>
                            <td><?php echo $task["created"] ?></td>
                            <td><button type="button" data-task-id="<?php echo $task["id"] ?>" class="btn btn-info btn-sm btn-edit" data-toggle="modal" data-target="#editModal">Edit</button></td>

                            <td><a onclick="return confirm('Are you sure?')" href="deleteTask.php?task_id=<?php echo $task['id'] ?>" data-page="<?php echo $page; ?>" data-task-id="<?php echo $task["id"] ?>" class="deleteTask"><i  class="glyphicon glyphicon-remove"></i></a></td>

                        </tr>

                        <?php
                        $i ++;
                    }

                    ?>

                </table>
                <div class="spinner hide"></div>
        </div>
            <div id="editModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Task</h4>
                        </div>
                        <div class="modal-body">

                            <form action="updateTaskProcess.php" method="post" id="editTaskForm">
                                <p class="form-group">
                                    <input id="title" class="form-control" type="text" name="title" >
                                </p>
                                <p class="form-group">
                                    <textarea id="description" class="form-control" name="description" cols="30" rows="10" ></textarea>
                                </p>
                                <p class="form-group">
                                    <input id="taskId" type="hidden" name="task_id">
                                </p>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success update-btn" data-page="<?php echo $page; ?>">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>



<?php
include("layout/footer.php");
?>
