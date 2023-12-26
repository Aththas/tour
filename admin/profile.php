<?php
session_start();
if($_SESSION["admin"]=="")
{
?>
<script type="text/javascript">
window.location="admin_login.php";
</script>
<?php
}
    $link=mysqli_connect("localhost","root","");
    mysqli_select_db($link,"tourism");
    $id = $_SESSION["admin"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <?php include("admin_head.php"); ?>
</head>

<body>
    
<!-- header section starts  -->

<?php include("admin_header.php"); ?>

<!-- header section ends -->

<!-- write review section starts  -->

<section class="book-form" id="review" style="margin-top: 130px;">
<h3 class="review_title" style="margin-bottom: 20px;">Update Profile</h3>
    <form action="" method="POST">
        <?php
        $rs_edit = mysqli_query($link, "select * from admin where id = '$id'");
        while($row_edit = mysqli_fetch_array($rs_edit))
        {
            ?>
            <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
                <span>Username?</span>
                <input type="text" name="username" style="text-transform: none;" value="<?php echo $row_edit["username"]; ?>">
            </div>
            <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
                <span>Location?</span>
                <input type="text" name="location" value="<?php echo $row_edit["location"]; ?>">
            </div>
            <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
                <span>Contact No?</span>
                <input type="text" name="contact" onkeypress="return validation(event)" value="<?php echo $row_edit["contact_no"]; ?>">
            </div>
            <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
                <span>Email?</span>
                <input type="email" name="email" style="text-transform: none;" value="<?php echo $row_edit["email"]; ?>">
            </div>
            <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
                <span>Open time?</span>
                <input type="text" name="time" style="text-transform: none;" value="<?php echo $row_edit["available_time"]; ?>">
            </div>
            <?php
        }
        ?>
        <input type="submit" name="add_btn" value="Update" class="btn" style="background-color:  #29d9d5; color: #111">
    </form>
<script type="text/javascript">
    function validation(evt) {
          
        var ASCII = (evt.which) ? evt.which : evt.keyCode
        if (ASCII > 31 && (ASCII < 48 || ASCII > 57) )
            return false;
        return true;
    }
</script>
</section>

<!-- write review section ends -->

<!-- write review section starts  -->

<section class="book-form" id="review" style="margin-top: 50px;">
<h3 class="review_title" style="margin-bottom: 20px;">Change Password</h3>
    <form action="" method="POST">
            <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
                <span>Current password?</span>
                <input type="text" name="c_pwd" placeholder="Current Password">
            </div>
            <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
                <span>New password?</span>
                <input type="text" name="n_pwd" placeholder="New Password">
            </div>
            <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
                <span>Re-enter password?</span>
                <input type="text" name="r_pwd" placeholder="Re-enter Password">
            </div>
        <input type="submit" name="change_btn" value="Change" class="btn" style="background-color:  #29d9d5; color: #111">
    </form>
</section>

<!-- write review section ends -->


<!-- footer section starts  -->

<div class="credit" style="margin-top: 70px;"><span>2022 Travel</span> | all rights reserved!</div>

<!-- footer section ends -->



<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<script>

    AOS.init({
        duration: 800,
        offset:150,
    });

</script>
<?php
    if(isset($_POST["add_btn"]))
    {

        if($_POST["username"] == "" || $_POST["location"] == "" || $_POST["contact"] == "" || $_POST["email"] == "" || $_POST["time"] == "")
        {
                ?>
                    <script type="text/javascript">
                        swal({
                            title: "Update Profile",
                            text: "Fields Must Be Fill !!!",
                            icon: "error"
                        }).then(function() {
                            window.location = "profile.php";
                        });
                    </script>
                <?php
        }
        else
        {
            mysqli_query($link,"update admin set username = '$_POST[username]', location = '$_POST[location]', contact_no = '$_POST[contact]', email = '$_POST[email]',  available_time = '$_POST[time]' where id = '$id'");
                ?>
                    <script type="text/javascript">
                        swal({
                            title: "Update Profile",
                            text: "Profile Updated Successfully !!!",
                            icon: "success"
                        }).then(function() {
                            window.location = "profile.php";
                        });
                    </script>
                <?php

        }
    }

    if(isset($_POST["change_btn"]))
    {

        $rs_pwd = mysqli_query($link, "select password from admin where id = '$id'");
        $row_pwd = mysqli_fetch_row($rs_pwd);
        $pwd = $row_pwd[0];
        $check_pwd = strcmp($pwd, $_POST["c_pwd"]);
        $compare_pwd = strcmp($_POST["n_pwd"] , $_POST["r_pwd"]);

        if($check_pwd == 0)
        {
            if($_POST["n_pwd"] == "" || $_POST["r_pwd"] == "")
            {
                ?>
                    <script type="text/javascript">
                        swal({
                            title: "Password",
                            text: "Fields Must Be Fill !!!",
                            icon: "error"
                        }).then(function() {
                            window.location = "profile.php";
                        });
                    </script>
                <?php
            }
            else if($compare_pwd != 0)
            {
                ?>
                    <script type="text/javascript">
                        swal({
                            title: "Password",
                            text: "Passwords not matched !!!",
                            icon: "error"
                        }).then(function() {
                            window.location = "profile.php";
                        });
                    </script>
                <?php
            }
            else
            {
                mysqli_query($link, "update admin set password = '$_POST[n_pwd]' where id = '$id'");
                ?>
                    <script type="text/javascript">
                        swal({
                            title: "Password",
                            text: "Passwords changed successfully !!!",
                            icon: "success"
                        }).then(function() {
                            window.location = "profile.php";
                        });
                    </script>
                <?php
            }
        }
        else
        {
                ?>
                    <script type="text/javascript">
                        swal({
                            title: "Password",
                            text: "Invalid password !!!",
                            icon: "error"
                        }).then(function() {
                            window.location = "profile.php";
                        });
                    </script>
                <?php
        }

    }
?>
</body>
</html>