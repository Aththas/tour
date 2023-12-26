<?php
session_start();
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"tourism");
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script src="js/sweetalert.min.js"></script>
    <title>Admin login</title>
  </head>
  <body>
    <section class="login">
        <div class="container py-5 text-center text-white screen">
            <div class="row no-gutters">
                <div class="col-lg-4">
                    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img src="../user/images/gallery-img-1.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <p>"Success is a journey, not a destination"</p>
                                <h5>by <span>admin</span></h5>
                            </div>
                            </div>
                            <div class="carousel-item">
                            <img src="../user/images/gallery-img-5.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <p>"Success is not final; failure is not fatal: it is the courage to continue that counts"</p>
                                <h5>by <span>admin</span></h5>
                            </div>
                            </div>
                            <div class="carousel-item">
                            <img src="../user/images/gallery-img-7.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <p>"You only have to do a few things right in your life so long as you don’t do too many things wrong"</p>
                                <h5>by <span>admin</span></h5>
                            </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 py-5 log">
                    <div class="row">
                        <div class="col-lg-7 mx-auto">
                            <h1><span>Admin</span> Login</h1>
                            <p>Great to have you back</p>
                            <form class="pt-4" method="POST">
                                <div class="form-row py-2">
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" placeholder="Username" name="name">
                                    </div>
                                </div>
                                <div class="form-row pt-4">
                                    <div class="col-lg-12">
                                        <input type="password" class="form-control" placeholder="Password" name="pwd">
                                    </div>
                                </div>
                                <button class="btn1 mb-3 mt-4" name="log">LOG IN</button>
                                <br>
                                <small>Forgot Password? <span><a href="getUsername.php"> Reset Password</a></span></small>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <?php
        if(isset($_POST["log"]))
        {
            $count = 0;
            $rs = mysqli_query($link,"select * from admin where username = '$_POST[name]' and password = '$_POST[pwd]'");
            while($row = mysqli_fetch_array($rs))
            {
                $count++;
                $_SESSION["admin"] = $row["id"];
                ?>
                    <script type="text/javascript">
                        window.location = "dashboard.php";
                    </script>
                <?php
            }
            if($count == 0)
            {
                ?>
                    <script type="text/javascript">
                        swal({
                            title: "Admin Login",
                            text: "Invalid Login",
                            icon: "error"
                        }).then(function() {
                            window.location = "admin_login.php";
                        });
                    </script>
                <?php
            }
        }
    ?>
  </body>
</html>