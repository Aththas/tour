<?php
    $link=mysqli_connect("localhost","root","");
    mysqli_select_db($link,"tourism");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>

    <?php include("head.php"); ?>

</head>
<body>
    
<!-- header section starts  -->

<?php include("header.php"); ?>

<!-- header section ends -->

<!-- page heading starts  -->

<br><br><br><br><br>
<div class="credit" style="background-color: black; height: 200px; margin:auto; margin-top: 40px;">
    <span style="font-size: 5rem; font-weight: bolder;">About Us</span>
    <h3 style="font-size: 4rem; font-weight: bolder; color: white;">Check Who Are We</h3>
</div>

<!-- page heading ends  -->

<!-- review section starts  -->

<section class="review">

    <div class="content" data-aos="fade-right" data-aos-delay="300">
        <span style="font-size: 5rem; font-weight: bolder;">Our Staffs</span>
        <h3>good news from our staffs</h3>
        <p>10 years of experience in the field of tourism for tourists from world wide. Tour guidance will be provided by Mr. Ikram, graduate of Al-Azhar University-Egypt ( Faculty of Mass Communication)</p>
    </div>

    <div class="box-container" data-aos="fade-left" data-aos-delay="600">

        <?php
            $rs_staff = mysqli_query($link, "select * from staffs order by id");
            while($row_staff = mysqli_fetch_array($rs_staff))
            {
                ?>
                <div class="box">
                    <p><?php echo $row_staff["msg"]; ?></p>
                    <div class="user">
                        <img src="images/<?php echo $row_staff["image"]; ?>" alt="">
                        <div class="info">
                            <h3><?php echo $row_staff["name"]; ?></h3>
                            <span><?php echo $row_staff["profession"]; ?></span>
                        </div>
                    </div>
                </div>
                <?php
            }
        ?>

    </div>

</section>

<!-- review section ends -->

<!-- about section starts  -->

<section class="about" id="about">

    <div class="video-container" data-aos="fade-right" data-aos-delay="300">
        <?php
            $rs_main_video = mysqli_query($link, "select link from video where id = 1");
            $row_main_video = mysqli_fetch_row($rs_main_video);
            $main_video = $row_main_video[0];
        ?>
        <video src="images/<?php echo $main_video; ?>" muted autoplay loop class="video"></video>
        <div class="controls">
            <?php
            $rs_video = mysqli_query($link, "select * from video order by id");
            while($row_video = mysqli_fetch_array($rs_video))
            {
                ?>
                    <span class="control-btn" data-src="images/<?php echo $row_video["link"]; ?>"></span>
                <?php
            }
            ?>
        </div>
    </div>
    <?php 
        $rs_contact  = mysqli_query($link, "select contact_no from admin where id = 'A0001'");
        $row_contact = mysqli_fetch_row($rs_contact);
        $contact = $row_contact[0];
    ?>
    <div class="content" data-aos="fade-left" data-aos-delay="600">
        <span>why choose us?</span>
        <h3 style="font-size: 3rem;">Customer satisfaction is our priority</h3>
        <p>We would be more than happy to help you to organize Sri Lanka Tour. Our Tour Operators are 24/7 at your service to help you</p>
        <a href="https://wa.me/<?php echo $contact; ?>?text=i want to make a booking" class="btn">Contact us via whatsapp</a>
    </div>

</section>

<!-- about section ends -->


<!-- footer section starts  -->

<?php include("footer.php"); ?>

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