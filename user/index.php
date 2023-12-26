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
    <title>Home</title>

    <?php include("head.php"); ?>

<style type="text/css">
.swal-modal {
  background-color: #222222;
  border: 3px solid #29d9d5;
}
.swal-title {
  color: #29d9d5;
}
.swal-text {
  color: white;
}
.swal-button {
  margin-top: 1rem;
  display: inline-block;
  padding: 1rem 3rem;
  font-size: 1.7rem;
  color: #29d9d5;
  border: 0.2rem solid #29d9d5;
  border-radius: 5rem;
  cursor: pointer;
  background: none;
}
.swal-button:hover {
  background: #29d9d5;
  color: #222222;
}
textarea{
      width: 100%;
  padding: 1.2rem 1.4rem;
  border-radius: 5rem;
  border: 0.2rem solid #29d9d5;
  font-size: 1.6rem;
  color: #aaa;
  text-transform: none;
  background: none;
  margin-top: 1rem;
  width: 800px;
}
.review_title{
    font-size: 3rem;
    color: white;
    padding: 20px; 
    text-align: center;
}
@media (max-width: 768px) {
textarea{
    width: 405px;
}
}
</style>

</head>

<body>
    
<!-- header section starts  -->

<?php include("header.php"); ?>

<!-- header section ends -->

<!-- home section starts  -->

<section class="home" id="home">

    <div class="content">
        <span data-aos="fade-up" data-aos-delay="150">WELCOME</span>
        <h3 data-aos="fade-up" data-aos-delay="300">to sri lanka</h3>
        <p data-aos="fade-up" data-aos-delay="450">“Leave nothing but footprints, take nothing but photos, kill nothing but time.”</p>
        <p data-aos="fade-up" data-aos-delay="450">And now, its time to explore</p>
        <a data-aos="fade-up" data-aos-delay="600" href="<?php echo $shop_link; ?>?id=none" class="btn">explore now</a>
    </div>

</section>

<!-- home section ends -->

<!-- booking form section starts  -->

<section class="book-form" id="book-form">
<?php
    $tomorrow = date("Y-m-d", strtotime("+1 day"));
?>
    <form action="" method="POST">
        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>where to?</span>
            <input type="text" placeholder="place name" name="place" value="">
        </div>
        <div data-aos="zoom-in" data-aos-delay="300" class="inputBox">
            <span>when?</span>
            <input type="date" value="" name="date" min="<?php echo $tomorrow; ?>">
        </div>
        <div data-aos="zoom-in" data-aos-delay="450" class="inputBox">
            <span>how many (age above 5yrs)?</span>
            <input type="text" placeholder="number of travelers" name="count" onkeypress="return validation(event)" value="">
        </div>
        <input data-aos="zoom-in" data-aos-delay="600" type="submit" name="find_btn" value="find now" class="btn">
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

<!-- booking form section ends -->

<!-- services section starts  -->

<section class="services" id="services">

    <div class="heading">
        <span>our services</span>
        <h1>countless expericences</h1>
    </div>

    <div class="box-container">

        <div class="box" data-aos="zoom-in-up">
            <i class="fas fa-globe"></i>
            <h3>All Island</h3>
            <p>We provide all island tour packages with lot of new and unique features</p>
        </div>

        <div class="box" data-aos="zoom-in-up">
            <i class="fas fa-hiking"></i>
            <h3>guides</h3>
            <p>Our travel guides and drivers are friendly, trustworthy and professional</p>
        </div>

        <div class="box" data-aos="zoom-in-up">
            <i class="fas fa-utensils"></i>
            <h3>food & drinks</h3>
            <p>We provide healthy food & drinks to take care of our customer's health</p>
        </div>

        <div class="box" data-aos="zoom-in-up">
            <i class="fas fa-headset"></i>
            <h3>24/7 support</h3>
            <p>Our friendly Tour operator staff ready to help you anytime of the day</p>
        </div>

    </div>

</section>

<!-- services section ends -->


<!-- destination section starts  -->
<br><br>
<section class="destination" id="destination">

    <div class="heading">
        <span>Latest destinations</span>
        <h1>choose your destination</h1>
    </div>

    <div class="box-container">

        <?php
            $rs_tours = mysqli_query($link, "select * from tour order by id desc limit 8");
            while($row_tours = mysqli_fetch_array($rs_tours))
            {
                ?>
                <div class="box">
                    <div class="image">
                        <img src="images/<?php echo $row_tours["image"]; ?>" alt="">
                    </div>
                    <div class="content">
                        <h3><?php echo $row_tours["name"]; ?></h3>
                        <p><?php echo $row_tours["days"]; ?> days package</p>
                        <p style="margin-top: -15px;">Rs. <?php echo $row_tours["price"]; ?></p>
                        <a href="single_destination.php?id=<?php echo $row_tours["id"]; ?>">read more <i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
                <?php
            }
        ?>

    </div>

</section>

<!-- destination section ends -->

<!-- about section starts  -->

<section class="about" id="about">

    <div class="video-container" data-aos="fade-right" data-aos-delay="300">
        <?php
            $rs_main_video = mysqli_query($link, "select link from video where id = 2");
            $row_main_video = mysqli_fetch_row($rs_main_video);
            $main_video = $row_main_video[0];
        ?>
        <video src="images/<?php echo $main_video; ?>" muted autoplay loop class="video"></video>
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
        <a href="<?php echo $about_link; ?>" class="btn">about us</a>
    </div>

</section>

<!-- about section ends -->


<br><br><br>
<!-- review section starts  -->
<div class="heading" data-aos="fade-left">
        <span>Customer Reviews</span>
        <h1>Good news from our customers</h1>
</div>

<section class="review">

    <div class="box-container" data-aos="fade-left">
        <?php
            $rs_feedback = mysqli_query($link, "select * from tbl_feedback order by id desc limit 4");
            while($row_feedback = mysqli_fetch_array($rs_feedback))
            {
                ?>
                <div class="box">
                    <p><?php echo $row_feedback["feedback"]; ?></p>
                    <div class="user">
                        <img src="images/<?php echo $row_feedback["image"]; ?>" alt="">
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

<!-- write review section starts  -->

<section class="book-form" id="review">
<h3 class="review_title">Write reviews here</h3>
    <form action="" method="POST">
        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>Name?</span>
            <input type="text" placeholder="name" name="name">
        </div>
        <div data-aos="zoom-in" data-aos-delay="300" class="inputBox">
            <span>Profession?</span>
            <input type="text" placeholder="profession" name="profession">
        </div>
        <div data-aos="zoom-in" data-aos-delay="450" class="inputBox">
            <span>image?</span>
            <input type="file" name="image" style="border: none; cursor: pointer;">
        </div>
        
        <div data-aos="zoom-in" data-aos-delay="450" class="inputBox">
            <span>feedback?</span>
            <textarea placeholder="feedback here" name="feedback" maxlength="200"></textarea>
        </div>
        <input data-aos="zoom-in" data-aos-delay="600" type="submit" name="review_btn" value="submit" class="btn" style="margin-bottom: 15px;">
    </form>

</section>

<!-- write review section ends -->

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
<?php
    //find destination
    if(isset($_POST["find_btn"]))
    {
        if($_POST["place"] == "" || $_POST["date"] == "" || $_POST["count"] == "")
        {
            ?>
                <script type="text/javascript">
                    swal({
                        title: "Search Destination",
                        text: "Fields Must Be Fill !!!",
                        icon: "error"
                    }).then(function() {
                        window.location = "<?php echo $home_link; ?>";
                    });
                </script>
            <?php
        }
        else
        {
            $rs_place_check = mysqli_query($link, "select count(*) from tour where name = '$_POST[place]'");
            $row_place_check = mysqli_fetch_row($rs_place_check);
            $place_check = $row_place_check[0];

            if($place_check == 0)
            {
                ?>
                    <script type="text/javascript">
                        swal({
                            title: "Search Destination",
                            text: "Invalid Place !!!",
                            icon: "error"
                        }).then(function() {
                            window.location = "<?php echo $home_link; ?>";
                        });
                    </script>
                <?php
            }
            else
            {
                ?>
                    <script type="text/javascript">
                        window.location = "<?php echo $shop_link; ?>?id=<?php echo $_POST["place"]; ?>"
                    </script>
                <?php
            }
        }
    }

    //write reviews
    if(isset($_POST["review_btn"]))
    {

        if($_POST["image"] == "")
        {
            $_POST["image"] = "user.png";
        }   

        if($_POST["name"] == "" || $_POST["profession"] == "" || $_POST["feedback"] == "")
        {
            ?>
                <script type="text/javascript">
                    swal({
                        title: "Writing Reviews",
                        text: "Field's Must Be Fill !!!",
                        icon: "error"
                    }).then(function() {
                        window.location = "<?php echo $home_link; ?>";
                    });
                </script>
            <?php
        }
        else
        {
            mysqli_query($link, "insert into tbl_feedback values('','$_POST[name]','$_POST[profession]','$_POST[feedback]','$_POST[image]')");

            ?>
                <script type="text/javascript">
                    swal({
                        title: "Writing Reviews",
                        text: "Review Added Successfully !!!",
                        icon: "success"
                    }).then(function() {
                        window.location = "<?php echo $home_link; ?>";
                    });
                </script>
            <?php
        }
    }


?>

</body>
</html>