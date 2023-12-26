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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <?php include("admin_head.php"); ?>

</head>

<body>
    
<!-- header section starts  -->

<?php include("admin_header.php"); ?>

<!-- header section ends -->
<?php
    $admin_id = $_SESSION["admin"];
    $rs_admin_name = mysqli_query($link,"select username from admin where id = '$admin_id'");
    $row_admin_name = mysqli_fetch_row($rs_admin_name);
    $admin_name = $row_admin_name[0];
?>
<!-- home section starts  -->

<section class="home" id="home">

    <div class="content">
        <span data-aos="fade-up" data-aos-delay="150">WELCOME</span>
        <h3 data-aos="fade-up" data-aos-delay="300"><?php echo $admin_name; ?></h3>
        <p data-aos="fade-up" data-aos-delay="450">"Success is not final; failure is not fatal: it is the courage to continue that counts"</p>
        <p data-aos="fade-up" data-aos-delay="450">And now, its time to progress</p>
        <a data-aos="fade-up" data-aos-delay="600" href="booking.php" class="btn">check booking now</a>
    </div>

</section>

<!-- home section ends -->

<!-- destination section starts  -->
<br><br>
<section class="destination" id="destination">

    <div class="heading">
        <span>Latest destinations</span>
        <h1 style="margin-top: 10px; margin-bottom: 10px;">View to Edit the destination</h1>
    </div>

    <div class="box-container">

        <?php
            $rs_tours = mysqli_query($link, "select * from tour order by id desc limit 8");
            while($row_tours = mysqli_fetch_array($rs_tours))
            {
                ?>
                <div class="box">
                    <div class="image">
                        <img src="../user/images/<?php echo $row_tours["image"]; ?>" alt="">
                    </div>
                    <div class="content">
                        <h3><?php echo $row_tours["name"]; ?></h3>
                        <p><?php echo $row_tours["days"]; ?> days package</p>
                        <p style="margin-top: -15px;">Rs. <?php echo $row_tours["price"]; ?></p>
                        <a href="editTour.php?id=<?php echo $row_tours["id"]; ?>">edit tour<i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
                <?php
            }
        ?>

    </div>

</section>

<!-- destination section ends -->

<br><br><br>
<!-- review section starts  -->
<div class="heading" data-aos="fade-left">
        <span>Customer Reviews</span>
        <h1>Latest Reviews from our customer</h1>
</div>

<section class="review">

    <div class="box-container" data-aos="fade-left">
        <?php
            $rs_feedback = mysqli_query($link, "select * from tbl_feedback order by id desc limit 8");
            while($row_feedback = mysqli_fetch_array($rs_feedback))
            {
                ?>
                <div class="box">
                    <p><?php echo $row_feedback["feedback"]; ?></p>
                    <div class="user">
                        <img src="../user/images/<?php echo $row_feedback["image"]; ?>" alt="">
                        <div class="info">
                            <h3><?php echo $row_feedback["name"]; ?></h3>
                            <span><?php echo $row_feedback["profession"]; ?></span>
                        </div>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>

</section>

<!-- review section ends -->

<!-- footer section starts  -->

<div class="credit"><span>2022 Travel</span> | all rights reserved!</div>

<!-- footer section ends -->



<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<script>

    AOS.init({
        duration: 800,
        offset:150,
    });

</script>
</body>
</html>