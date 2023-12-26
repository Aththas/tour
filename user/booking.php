<?php
    $link=mysqli_connect("localhost","root","");
    mysqli_select_db($link,"tourism");
    $id = $_GET["id"];

    $rs_img = mysqli_query($link, "select image from tour where id = $id");
    $row_img = mysqli_fetch_row($rs_img);
    $img = $row_img[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>

    <?php include("head.php"); ?>
</head>
<style type="text/css">
.bookinghome {
  margin: 0 auto;
  margin-top: 9rem;
  width: 90%;
  border-radius: 1rem;
  background: -webkit-gradient(linear, left top, left bottom, from(rgba(17, 17, 17, 0.7)), to(rgba(17, 17, 17, 0.7))), url(images/<?=$img?>) no-repeat;
  background: linear-gradient(rgba(17, 17, 17, 0.7), rgba(17, 17, 17, 0.7)), url(images/<?=$img?>) no-repeat;
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
.hide::-webkit-outer-spin-button,
.hide::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
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
</style>
<body>
    
<!-- header section starts  -->

<?php include("header.php"); ?>

<!-- header section ends -->

<!-- booking home section starts  -->

<section class="bookinghome" id="bookinghome">

    <div class="content">
        <?php 
        $rs_des = mysqli_query($link,"select * from tour where id = $id");
        while($row_des = mysqli_fetch_array($rs_des))
        {
        ?>
            <span data-aos="fade-up" data-aos-delay="150"><?php echo $row_des["name"]; ?></span>
            <h3 data-aos="fade-up" data-aos-delay="300"><?php echo $row_des["days"]; ?> days package</h3>
            <p data-aos="fade-up" data-aos-delay="450">“<?php echo $row_des["des"]; ?>”</p>
        <?php
        }
        ?>
    </div>

</section>

<!-- booking home section ends -->
<?php
$rs_place_name = mysqli_query($link,"select name from tour where id = $id");
$row_place_name = mysqli_fetch_row($rs_place_name);
$place_name = $row_place_name[0];
?>
<!-- booking form section starts  -->

<section class="book-form" id="book-form">
    <?php
    $tomorrow = date("Y-m-d", strtotime("+1 day"));
    ?>
    <form action="" method="POST">

        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>Destination ID?</span>
            <input type="text" name="id" value="<?php echo $id; ?>" readonly>
        </div>

        <div data-aos="zoom-in" data-aos-delay="300" class="inputBox">
            <span>place?</span>
            <input type="text" name="place" value="<?php echo $place_name; ?>" readonly>
        </div>

        <div data-aos="zoom-in" data-aos-delay="450" class="inputBox">
            <span>when?</span>
            <input type="date" value="" name="date" min="<?php echo $tomorrow; ?>">
        </div>
<br>
        <div data-aos="zoom-in" data-aos-delay="600" class="inputBox">
            <span>how many (age above 5yrs)?</span>
            <input type="text" placeholder="number of travelers" name="count" min="1" value="" onkeypress="return validation(event)">
        </div>

        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>name?</span>
            <input type="text" placeholder="name with initials" name="name" value="">
        </div>

        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span>country?</span>
            <input type="text" placeholder="where are you from" name="country" value="">
        </div>

        <div data-aos="zoom-in" data-aos-delay="300" class="inputBox">
            <span>email?</span>
            <input type="email" placeholder="email address" name="email" value="">
        </div>

        <div data-aos="zoom-in" data-aos-delay="450" class="inputBox">
            <span>contact number?</span>
            <input type="text" placeholder="mobile number" name="contact" class="hide" value="" onkeypress="return validation(event)">
        </div>

        <input data-aos="zoom-in" data-aos-delay="600" type="submit" name="book_btn" value="book now" class="btn">
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



<!-- footer section starts  -->
<div class="row">
    <div class="col-xs-12 col-md-12">
        <?php include("footer.php"); ?>
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
    if(isset($_POST["book_btn"]))
    {
        $int_count = intval($_POST["count"]);
        $int_contact = intval($_POST["contact"]);

        if($_POST["name"] == "" || $_POST["date"] == "" || $_POST["count"] == "" || $_POST["country"] == "" || $_POST["email"] == "" || $_POST["contact"] == "")
        {
            ?>
                <script type="text/javascript">
                    swal({
                        title: "Booking Error",
                        text: "Field's Must Be Fill !!!",
                        icon: "error"
                    }).then(function() {
                        window.location = "booking.php?id=<?php echo $id ?>";
                    });
                </script>
            <?php
        }
        else if($int_count<1 || $int_count>20)
        {
            ?>
                <script type="text/javascript">
                    swal({
                        title: "Booking Error",
                        text: "Invalid Travellers Count !!!",
                        icon: "error"
                    }).then(function() {
                        window.location = "booking.php?id=<?php echo $id ?>";
                    });
                </script>
            <?php
        }
        else
        {
            $v1=rand(1111,9999);
            $v2=rand(1111,9999);
   
            $v3=($v1.$v2)/100;
            $code=intval($v3);

            mysqli_query($link, "insert into booking values('','$_POST[name]','$_POST[country]','$_POST[email]','$_POST[contact]','$_POST[count]','$_POST[date]','$id','not verified','$code','Processing')");

            $rs_id = mysqli_query($link, "select booking_id from booking order by booking_id desc limit 1");
            $row_id = mysqli_fetch_row($rs_id);
            $b_id = $row_id[0];
            ?>
                <script type="text/javascript">
                    window.location="mailcode.php?id=<?php echo $b_id ?>";
                </script>
            <?php
        }

    }
?>
</body>
</html>