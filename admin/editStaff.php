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

    $id = $_GET["id"];

    $rs_img = mysqli_query($link, "select image from staffs where id = $id");
    $row_img = mysqli_fetch_row($rs_img);
    $img = $row_img[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff #<?php echo $id; ?></title>

    <?php include("admin_head.php"); ?>
</head>
<style type="text/css">
.bookinghome {
  margin: 0 auto;
  margin-top: 9rem;
  width: 90%;
  border-radius: 1rem;
  background: -webkit-gradient(linear, left top, left bottom, from(rgba(17, 17, 17, 0.7)), to(rgba(17, 17, 17, 0.7))), url(../user/images/<?=$img?>) no-repeat;
  background: linear-gradient(rgba(17, 17, 17, 0.7), rgba(17, 17, 17, 0.7)), url(../user/images/<?=$img?>) no-repeat;
  background-size: cover;
  background-position: center;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  min-height: 80vh;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  padding-bottom: 5rem;
}

.bookinghome .content {
  text-align: center;
}

.bookinghome .content span {
  font-weight: bolder;
  color: transparent;
  -webkit-text-stroke: 0.1rem #fff;
  font-size: 4vw;
  display: block;
}

.bookinghome .content h3 {
  font-size: 6vw;
  color: #fff;
}

.bookinghome .content p {
  max-width: 60rem;
  margin: 1rem auto;
  font-size: 1.4rem;
  color: #aaa;
  line-height: 2;
}
textarea{
    width: 1300px;
}
@media (max-width: 768px) {
textarea{
    width: 405px;
    height: 200px;
}
}
</style>
<body>
    
<!-- header section starts  -->

<?php include("admin_header.php"); ?>

<!-- header section ends -->

<!-- booking home section starts  -->

<section class="bookinghome" id="bookinghome">

    <div class="content">
        <?php 
        $rs_staffs = mysqli_query($link,"select * from staffs where id = $id");
        while($row_staffs = mysqli_fetch_array($rs_staffs))
        {
        ?>
            <span data-aos="fade-up" data-aos-delay="150"><?php echo $row_staffs["name"]; ?></span>
            <p data-aos="fade-up" data-aos-delay="450">“<?php echo $row_staffs["msg"]; ?>”</p>
        <?php
        }
        ?>
    </div>

</section>

<!-- booking home section ends -->

<!-- write review section starts  -->

<section class="book-form" id="review">
<h3 class="review_title">edit staff #<?php echo $id; ?></h3>
    <form action="" method="POST">
      <?php 
      $rs_edit = mysqli_query($link, "select * from staffs where id=$id");
      while($row_edit = mysqli_fetch_array($rs_edit))
      {
      ?>
        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>Name?</span>
            <input type="text" name="name" value="<?php echo $row_edit["name"]; ?>">
        </div>
        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>Caption?</span>
            <input type="text" name="profession" value="<?php echo $row_edit["profession"]; ?>">
        </div>
        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>image?</span>
            <input type="file" name="image" style="border: none; cursor: pointer;">
        </div>

        <div data-aos="zoom-in" data-aos-delay="300" class="inputBox">
            <span>description?</span>
            <textarea name="msg"><?php echo $row_edit["msg"]; ?></textarea>
        </div>
      <?php
      }
      ?>
        <input type="submit" name="update_btn" value="update" class="btn" style="background-color:  #29d9d5; color: #111">
    </form>
</section>

<!-- write review section ends -->



<!-- footer section starts  -->
<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="credit"><span>2022 Travel</span> | all rights reserved!</div>
    </div>
</div>
<!-- footer section ends -->



<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<script>

    AOS.init({
        duration: 800,
        offset:150,
    });

</script>
<?php
    if(isset($_POST["update_btn"]))
    {
        if($_POST["name"] == "" || $_POST["profession"] == "" || $_POST["msg"] == "")
        {
                ?>
                    <script type="text/javascript">
                        swal({
                            title: "Update Staff",
                            text: "Fields Must Be Fill !!!",
                            icon: "error"
                        }).then(function() {
                            window.location = "editStaff.php?id=<?php echo $id; ?>";
                        });
                    </script>
                <?php
        }
        else
        {
          if($_POST["image"] == "")
          {
            mysqli_query($link, "update staffs set name = '$_POST[name]', profession = '$_POST[profession]', msg = '$_POST[msg]' where id = $id");
          }
          else
          {
            mysqli_query($link, "update staffs set name = '$_POST[name]', profession = '$_POST[profession]', msg = '$_POST[msg]', image = '$_POST[image]' where id = $id");
          }

                ?>
                    <script type="text/javascript">
                        swal({
                            title: "Update Staff",
                            text: "Staff Updated Successfully !!!",
                            icon: "success"
                        }).then(function() {
                            window.location = "staff.php";
                        });
                    </script>
                <?php


        }
    }
?>
</body>
</html>