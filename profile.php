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

$sql = "SELECT * FROM `gallery` WHERE user_id=$userId ORDER BY `created`DESC";
$result = mysqli_query($conn,$sql);

//$sql = "SELECT gallery.image, tasks.title, tasks.description
//FROM gallery
//INNER JOIN tasks ON gallery.user_id = tasks.user_id";
//$res = mysqli_query($conn,$sql);


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
                                    <li><a href="map.php"><i class="fa fa-map-marker fa-2x" aria-hidden="true"></i></a></li>
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
                            <a href="deleteAvatar.php?user_id=<?php echo $userData['id'];  ?>&img_name=<?php echo $userData['avatar']; ?>"><button>Delete</button></a>
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
                <!-- Simple post content example. -->
                <!--<div class="panel panel-default">
                    <div class="panel-body">
                        <div class="pull-left">
                            <a href="#">
                                <img class="media-object img-circle" src="<?php /*echo $avatar; */?>" width="50px" height="50px" style="margin-right:8px; margin-top:-5px;">
                            </a>
                        </div>
                        <h4><a href="#" style="text-decoration:none;"><strong><?php /*echo $userData['name']." ".$userData['lastname'];*/?> </strong></a></h4>
                        <hr>
                        <div class="post-content">
                            <p>Simple post content example.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel gravida metus, non ultrices sapien. Morbi odio metus, dapibus non nibh id amet.</p>
                        </div>
                        <hr>
                        <div>
                            <div class="pull-right btn-group-xs">
                                <a class="btn btn-default btn-xs"><i class="fa fa-heart" aria-hidden="true"></i> Like</a>
                                <a class="btn btn-default btn-xs"><i class="fa fa-retweet" aria-hidden="true"></i> Reshare</a>
                                <a class="btn btn-default btn-xs"><i class="fa fa-comment" aria-hidden="true"></i> Comment</a>
                            </div>
                            <br>
                        </div>
                        <hr>
                    </div>
                </div>-->

                <!-- Sample post content with picture. -->
                <?php while ($row = mysqli_fetch_assoc($result)){ ?>

                    <div class="panel panel-default">
                    <?php
//                        var_dump($row);
                    ?>
                        <div class="panel-body">
                            <div class="pull-left">
                                <a href="#">
                                    <img class="media-object img-circle" src="<?php echo $avatar; ?>" width="50px" height="50px" style="margin-right:8px; margin-top:-5px;">
                                </a>
                            </div>
                            <h4><a href="#" style="text-decoration:none;"><strong><?php echo $userData['name']." ".$userData['lastname'];?> </strong></a></h4>
                            <hr>
                            <div class="post-content">
                                <!--                                <p>Sample post content with picture.</p>-->
                                <img class="img-responsive img_posts" src="gallery/<?php echo $row['image']; ?>">
                            </div>
                            <hr>
                            <div>
                                <div class="pull-right btn-group-xs">
                                    <a class="btn btn-default btn-xs"><i class="fa fa-heart" aria-hidden="true"></i> Like</a>
                                    <a class="btn btn-default btn-xs"><i class="fa fa-retweet" aria-hidden="true"></i> Share</a>
                                    <a class="btn btn-default btn-xs"><i class="fa fa-comment" aria-hidden="true"></i> Comment</a>
                                </div>
                                <br>
                            </div>
                            <hr>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
    </div>


<?php
include("layout/footer.php");
?>