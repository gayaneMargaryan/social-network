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

$sql = "SELECT * FROM `gallery` WHERE user_id='$userId'";
$result = mysqli_query($conn,$sql);
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
                            <input id="avatar"  type="file" name="avatar" >
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



<!--            <div class="container">-->
                <div class="row">
                    <form action="loadImage.php" method="post" enctype="multipart/form-data">
                        <input id="img" type="file" name="img[]" multiple>
                        <button name="load" class="hide"  id="load_img" >Load image</button>
                    </form>


                    <?php
                    while ($imgData = mysqli_fetch_assoc($result)){ ?>
                        <div class="col-lg-3 col-sm-4 col-xs-6">
                            <a  title="Image" href="#">
                                <img class="thumbnail img-responsive" src="gallery/<?php echo $imgData['image']; ?>">
                            </a>
                            <a href="deleteImg.php?img_id=<?php echo $imgData["id"] ?>&img_name=<?php echo $imgData['image'];?>"><button class="btn-default btn">Delete</button></a>
                            <a href="Avatar.php?img_id=<?php echo $imgData["id"] ?>&img_name=<?php echo $imgData['image'];?>"><button name="avatar" class="btn-default btn">Avatar</button></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div tabindex="-1" class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" type="button" data-dismiss="modal">×</button>
                            <h3 class="modal-title">Heading</h3>
                        </div>
                        <div class="modal-body">

                        </div>
<!--                        <div class="modal-footer">-->
<!--                            <button class="btn btn-default" data-dismiss="modal">Delet image</button>-->
<!--                        </div>-->
                    </div>
                </div>
<!--            </div>-->

        </div>
<?php
include("layout/footer.php");
?>


